# คู่มือการติดตั้งและ Deploy ระบบ PDHWeb (Deployment Guide)

เอกสารฉบับนี้อธิบายสถาปัตยกรรม Routing, การตั้งค่า Environment, และขั้นตอนการนำขึ้นใช้งาน (Deployment) ทั้งบนเครื่องพัฒนา **Local (XAMPP / Apache)**, **TEST Server (Ubuntu 24.04 + Nginx + PHP 8.4-FPM)**, และ **Production Server** โดยใช้ Source Code ชุดเดียวกัน 100%

---

## 1. สถาปัตยกรรม Routing (Cross-Environment Routing Architecture)

ระบบใช้ **Declarative Front Controller & Dynamic Router (`App\Core\Router`)** ที่สามารถทำงานได้ทุกสภาพแวดล้อม:
- **Localhost XAMPP (Subdirectory):** `http://localhost/pdhweb/` หรือ `http://localhost/pdhweb/public/`
- **TEST Server (Domain Root):** `https://test.pluakdaenghospital.cloud/`
- **Production Server:** `https://pluakdaenghospital.cloud/`

### หลักการทำงานของการแปลง URL (URL Parsing Strategy):
1. **Nginx Standard:** ดึง Path จาก `$_SERVER['REQUEST_URI']` แล้วตัด Query String และ Base Directory ออกอัตโนมัติ
2. **Apache / XAMPP Rewrite:** รองรับทั้ง `index.php?url=...` จาก `.htaccess` และการส่งผ่าน `REQUEST_URI`
3. **Dynamic Base URL Auto-Detection:** ตรวจสอบ Host Header อย่างปลอดภัย (ป้องกัน Host Header Injection) และสลับ Protocol `http`/`https` ตาม Reverse Proxy / SSL
4. **404 Not Found Handling:** หากไม่มี Route ที่ตรงกันใน `routes/web.php` ระบบจะส่ง HTTP Status `404` และแสดงหน้า 404 สวยงาม (ไม่ Fallback กลับหน้าแรก)

---

## 2. โครงสร้าง Environment Configuration (`.env`)

คัดลอกไฟล์ `.env.example` ไปเป็น `.env` บนเซิร์ฟเวอร์แต่ละชุด:

### สำหรับ Local XAMPP (`.env`):
```ini
APP_NAME="โรงพยาบาลปลวกแดง"
APP_ENV=development
APP_URL=http://localhost/pdhweb

DB_HOST=localhost
DB_DATABASE=pdhweb
DB_USERNAME=root
DB_PASSWORD=
```

### สำหรับ TEST Server (`.env`):
```ini
APP_NAME="โรงพยาบาลปลวกแดง (TEST)"
APP_ENV=production
APP_URL=https://test.pluakdaenghospital.cloud

DB_HOST=localhost
DB_DATABASE=pdhweb_test
DB_USERNAME=pdh_user
DB_PASSWORD=your_secure_password_here
```

### สำหรับ Production Server (`.env`):
```ini
APP_NAME="โรงพยาบาลปลวกแดง"
APP_ENV=production
APP_URL=https://pluakdaenghospital.cloud

DB_HOST=localhost
DB_DATABASE=pdhweb_prod
DB_USERNAME=pdh_prod_user
DB_PASSWORD=your_production_password_here
```

> **ข้อควรระวังด้านความปลอดภัย:** ห้าม Commit หรือ Push ไฟล์ `.env` เข้าสู่ Git Repository โดยเด็ดขาด

---

## 3. ขั้นตอนการ Deploy บน TEST Server (Ubuntu 24.04 + Nginx + PHP 8.4-FPM)

### 3.1 ดึงโค้ดเวอร์ชันล่าสุดจาก GitHub
```bash
cd /var/www/test/source
git checkout main
git fetch origin
git reset --hard origin/main
```

### 3.2 ตั้งค่าสิทธิ์โฟลเดอร์ (File Permissions)
```bash
sudo chown -R www-data:www-data /var/www/test/source
sudo chmod -R 755 /var/www/test/source
sudo chmod -R 775 /var/www/test/source/public/assets/uploads
sudo chmod -R 775 /var/www/test/source/public/assets/images
```

### 3.3 นำเข้าโครงสร้างฐานข้อมูล (Database Import)
*(ทำเฉพาะเมื่อเริ่มติดตั้งใหม่ หรือมีการเปลี่ยนแปลง Schema)*
```bash
mysql -u pdh_user -p pdhweb_test < /var/www/test/source/database/pdhweb_full_latest.sql
```

### 3.4 ตั้งค่า Nginx VirtualHost
สร้างหรือแก้ไขไฟล์ `/etc/nginx/sites-available/test.pluakdaenghospital.cloud`:
*(ดูตัวอย่างเต็มได้ที่ [`deploy/nginx/pdhweb.conf.example`](deploy/nginx/pdhweb.conf.example))*

```nginx
server {
    listen 80;
    server_name test.pluakdaenghospital.cloud;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    server_name test.pluakdaenghospital.cloud;

    # Document Root ชี้ไปยังโฟลเดอร์ /public
    root /var/www/test/source/public;
    index index.php index.html;

    # SSL Config...

    # Front Controller Routing
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP 8.4-FPM
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Security Rules
    location ~ /\.(?!well-known).* { deny all; }
    location ~* \.(env|log|sql|git|md|yml|yaml|ini|json|bak|config)$ { deny all; return 404; }
    location ~ ^/(app|config|database|deploy|routes|vendor)/ { deny all; return 404; }
}
```

ทดสอบและ Reload Nginx กับ PHP-FPM:
```bash
sudo nginx -t
sudo systemctl reload nginx
sudo systemctl restart php8.4-fpm
```

---

## 4. การทดสอบและตรวจสอบความถูกต้อง (Verification & Smoke Test)

รันคำสั่งตรวจสอบ HTTP Response Header บนเซิร์ฟเวอร์:

```bash
# 1. ตรวจสอบหน้าแรก (Frontend)
curl -I https://test.pluakdaenghospital.cloud/

# 2. ตรวจสอบหน้าเข้าสู่ระบบหลังบ้าน (Admin Login)
curl -I https://test.pluakdaenghospital.cloud/admin/login

# 3. ตรวจสอบหน้า 404 (Invalid Route)
curl -I https://test.pluakdaenghospital.cloud/this-route-does-not-exist
```

### รัน Automated Routing Test Suite:
```bash
php tests/RoutingTest.php
```

---

## 5. การแก้ไขปัญหาที่พบบ่อย (Troubleshooting)

| อาการ | สาเหตุที่เป็นไปได้ | วิธีแก้ไข |
| :--- | :--- | :--- |
| เข้า `/admin/login` แล้วเด้งกลับหน้าแรก | Nginx `try_files` ไม่ได้ส่งค่าให้ `index.php?$query_string` | ตรวจสอบ Nginx Block `location / { try_files $uri $uri/ /index.php?$query_string; }` |
| รูปภาพหรือ CSS โหลดไม่ขึ้น (404) | Document Root ไม่ได้ชี้ไปที่ `/public` | เปลี่ยน `root /var/www/test/source;` เป็น `root /var/www/test/source/public;` ใน Nginx |
| HTTP 500 Internal Server Error | ปัญหาการเชื่อมต่อฐานข้อมูล หรือ PHP Extension ขาดหาย | ตรวจสอบค่า DB ใน `.env` และดู Log ที่ `/var/log/nginx/error.log` |
| Session หลุดทันทีหลัง Login | Cookie Secure Flag ถูกเปิดบน HTTP ปกติ | เข้าใช้งานผ่าน `https://` หรือตรวจสอบค่า `APP_URL` ใน `.env` |
