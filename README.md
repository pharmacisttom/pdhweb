# PDH Web Portal (โรงพยาบาลปลวกแดง)

ระบบ Web Application สำหรับโรงพยาบาลปลวกแดง พัฒนาด้วยสถาปัตยกรรม Modular MVC โดยมีจุดประสงค์เพื่อใช้เป็นเว็บไซต์หลักและ Digital Hospital Portal ในอนาคต

## Requirements

- PHP 8.2 หรือสูงกว่า
- MySQL 8.0+ หรือ MariaDB
- Web Server: Apache (รองรับ `mod_rewrite`)
- PHP Extensions: `pdo`, `pdo_mysql`, `mbstring`, `json`, `curl`

## Installation (การติดตั้ง)

1. **Clone Repository** (หรือ Copy ไฟล์ทั้งหมดมาลงใน `htdocs` หรือ `www`)
2. **สร้างฐานข้อมูล**: สร้าง Database ใน MySQL เช่น `pdhweb`
3. **นำเข้าข้อมูล (Import Database)**:
   - นำเข้าไฟล์ `database/pdhweb.sql`
   - นำเข้าไฟล์ `database/pdhweb_medical.sql`
4. **ตั้งค่า Environment**:
   - คัดลอกไฟล์ `.env.example` แล้วเปลี่ยนชื่อเป็น `.env`
   - แก้ไขการเชื่อมต่อฐานข้อมูลใน `.env` ให้ถูกต้อง
5. **ตั้งค่า Web Server (Apache)**:
   - ตรวจสอบว่า Apache เปิดใช้งาน `mod_rewrite` แล้ว
   - ชี้ Document Root ไปที่โฟลเดอร์โปรเจกต์ หรือรันผ่าน `http://localhost/pdhweb`

## การเข้าใช้งานระบบ

- **หน้าเว็บไซต์ (Frontend)**: `http://localhost/pdhweb/`
- **ระบบจัดการหลังบ้าน (Backend)**: `http://localhost/pdhweb/admin/`
  - **Username**: `admin`
  - **Password**: `password`

## โครงสร้างระบบ (Architecture)

ใช้สถาปัตยกรรมแบบ **Custom MVC** เพื่อความรวดเร็วและควบคุมง่าย
- `app/Controllers`: จัดการ Request/Response
- `app/Models`: จัดการการเชื่อมต่อและ Query ข้อมูล (PDO)
- `app/Views`: ระบบแสดงผล HTML / PHP
- `app/Services` / `app/Repositories`: ใช้สำหรับการจัดการ Business Logic และ Data Access Layer ที่ซับซ้อน
- `public`: สำหรับไฟล์ Assets (CSS, JS, Images) และ `index.php` ซึ่งเป็น Entry point หลัก

## Security Checklist

- [x] ใช้ PDO Prepared Statement ป้องกัน SQL Injection
- [x] ใช้ `password_hash()` สำหรับรหัสผ่าน
- [x] จัดการ Routing ผ่าน `index.php` (Single Entry Point) ป้องกันการเข้าถึงไฟล์โดยตรง
- [ ] XSS Filtering & CSRF Protection (อยู่ระหว่างการพัฒนา)
# pdhweb
