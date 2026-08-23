<!-- Hero Banner Carousel Section -->
<section class="hero-wrapper">
    <div class="container">
        <?php if(!empty($banners)): ?>
            <div class="hero-carousel-container mb-4">
                <div id="heroCarousel" class="carousel slide <?= ($slider_transition === 'fade') ? 'carousel-fade' : '' ?>" data-bs-ride="carousel" data-bs-interval="<?= htmlspecialchars($slider_interval ?? '5000') ?>">
                    <!-- Indicators -->
                    <div class="carousel-indicators mb-3">
                        <?php foreach($banners as $index => $banner): ?>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner">
                        <?php foreach($banners as $index => $banner): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <?php if(!empty($banner->link)): ?>
                                    <a href="<?= htmlspecialchars($banner->link) ?>" class="d-block text-decoration-none">
                                <?php endif; ?>
                                
                                <div class="banner-carousel-img" style="background-image: url('<?= URLROOT ?>/assets/images/banners/<?= $banner->image_file ?>');">
                                    <div class="banner-carousel-overlay">
                                        <div style="max-width: 700px;">
                                            <span class="badge bg-primary px-3 py-1 rounded-pill mb-2 fw-bold"><i class="bi bi-shield-check me-1"></i> โรงพยาบาลปลวกแดง</span>
                                            <h2 class="text-white fw-bold display-6 mb-2"><?= htmlspecialchars($banner->title) ?></h2>
                                            <p class="text-white-50 small mb-0 d-none d-md-block">พร้อมดูแลและให้บริการทางการแพทย์ด้วยมาตรฐานและความปลอดภัยสูงสุด</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if(!empty($banner->link)): ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Glass Arrows -->
                    <button class="carousel-control-prev border-0 bg-transparent" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <div class="carousel-glass-btn">
                            <i class="bi bi-chevron-left fs-5"></i>
                        </div>
                    </button>
                    <button class="carousel-control-next border-0 bg-transparent" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <div class="carousel-glass-btn">
                            <i class="bi bi-chevron-right fs-5"></i>
                        </div>
                    </button>
                </div>
            </div>
        <?php else: ?>
            <!-- Fallback Hero Header -->
            <div class="p-5 rounded-4 mb-4 text-white text-center" style="background: linear-gradient(135deg, #0d9488, #0f172a);">
                <span class="section-badge mb-3 bg-white text-primary">มาตรฐานคุณภาพระดับสากล</span>
                <h1 class="display-5 fw-bold text-white mb-3">โรงพยาบาลปลวกแดง</h1>
                <p class="lead text-white-50 mx-auto" style="max-width: 600px;">ดูแลด้วยมาตรฐาน ใส่ใจประชาชน มุ่งมั่นพัฒนาบริการทางการแพทย์เพื่อสุขภาพที่ดีของทุกคน</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Fast-Track 4 Hub Cards (4 การเข้าถึงด่วน) -->
<div class="container fast-track-wrapper">
    <div class="row g-3 g-md-4">
        <!-- 1. Find Doctor -->
        <div class="col-6 col-lg-3">
            <a href="<?= URLROOT ?>/doctors" class="fast-track-card">
                <div class="fast-track-icon" style="background: #e0f2fe; color: #0284c7;">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h5 class="fast-track-title">ทำเนียบแพทย์</h5>
                <p class="fast-track-desc">ค้นหาแพทย์ & ตารางออกตรวจ</p>
            </a>
        </div>

        <!-- 2. Specialist Clinics -->
        <div class="col-6 col-lg-3">
            <a href="<?= URLROOT ?>/clinics" class="fast-track-card">
                <div class="fast-track-icon" style="background: #f0fdfa; color: #0d9488;">
                    <i class="bi bi-hospital"></i>
                </div>
                <h5 class="fast-track-title">คลินิกเฉพาะโรค</h5>
                <p class="fast-track-desc">เบาหวาน, ความดัน, คลินิกเด็ก</p>
            </a>
        </div>

        <!-- 3. Smart Queue -->
        <div class="col-6 col-lg-3">
            <a href="<?= URLROOT ?>/queue" class="fast-track-card">
                <div class="fast-track-icon" style="background: #fef3c7; color: #d97706;">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h5 class="fast-track-title">ระบบคิวตรวจ</h5>
                <p class="fast-track-desc">เช็คสถานะคิวแบบ Real-time</p>
            </a>
        </div>

        <!-- 4. E-Donation -->
        <div class="col-6 col-lg-3">
            <a href="<?= URLROOT ?>/donations" class="fast-track-card">
                <div class="fast-track-icon" style="background: #ffe4e6; color: #e11d48;">
                    <i class="bi bi-heart-pulse"></i>
                </div>
                <h5 class="fast-track-title">ร่วมบริจาค</h5>
                <p class="fast-track-desc">สมทบทุนจัดซื้อเครื่องมือแพทย์</p>
            </a>
        </div>
    </div>
</div>

<!-- Medical Services Overview Section -->
<section class="py-4 mb-5">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
            <div>
                <span class="section-badge mb-2"><i class="bi bi-heart-pulse-fill me-1"></i> บริการทางการแพทย์</span>
                <h2 class="section-title mb-0">บริการและการรักษาพยาบาล</h2>
            </div>
            <a href="<?= URLROOT ?>/clinics" class="btn btn-modern-outline mt-3 mt-md-0">
                ดูบริการทั้งหมด <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 text-center h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #e0f2fe; color: #0284c7; width: 64px; height: 64px;">
                            <i class="bi bi-hospital fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">แผนกผู้ป่วยนอก (OPD)</h5>
                        <p class="text-muted small">บริการตรวจรักษาโรคทั่วไปโดยแพทย์ผู้เชี่ยวชาญ พร้อมระบบนัดหมาย</p>
                    </div>
                    <a href="<?= URLROOT ?>/clinics" class="text-primary text-decoration-none fw-bold small">ดูรายละเอียด &rarr;</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 text-center h-100 d-flex flex-column justify-content-between" style="border-color: rgba(239, 68, 68, 0.3);">
                    <div>
                        <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 bg-danger bg-opacity-10 text-danger" style="width: 64px; height: 64px;">
                            <i class="bi bi-ambulance fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-danger">อุบัติเหตุ-ฉุกเฉิน (ER)</h5>
                        <p class="text-muted small">บริการดูแลรักษาผู้ป่วยภาวะฉุกเฉินตลอด 24 ชั่วโมง โดยทีมกู้ชีพระดับสูง</p>
                    </div>
                    <a href="tel:1669" class="text-danger text-decoration-none fw-bold small">โทรฉุกเฉิน 1669 &rarr;</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 text-center h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #f0fdfa; color: #0d9488; width: 64px; height: 64px;">
                            <i class="bi bi-heart-pulse fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">คลินิกทันตกรรม</h5>
                        <p class="text-muted small">บริการดูแลสุขภาพช่องปาก อุดฟัน ถอนฟัน ขูดหินปูน และรักษารากฟัน</p>
                    </div>
                    <a href="<?= URLROOT ?>/clinics" class="text-primary text-decoration-none fw-bold small">ดูรายละเอียด &rarr;</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 text-center h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #fef3c7; color: #d97706; width: 64px; height: 64px;">
                            <i class="bi bi-capsule fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">เภสัชกรรม & จ่ายยา</h5>
                        <p class="text-muted small">บริการจ่ายยา ให้คำปรึกษาการใช้ยาอย่างปลอดภัยโดยเภสัชกรวิชาชีพ</p>
                    </div>
                    <a href="<?= URLROOT ?>/services" class="text-primary text-decoration-none fw-bold small">ดูรายละเอียด &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Smart Hospital Queue & Kiosk Banner -->
<section class="py-3 mb-5">
    <div class="container">
        <div class="glass-card p-4 p-md-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a, #134e4a); color: #ffffff;">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-3">
                        <i class="bi bi-cpu-fill me-1"></i> AI & Smart Hospital System
                    </span>
                    <h2 class="fw-bold text-white mb-2">ระบบคิวอัจฉริยะ & E-Kiosk ดิจิทัล</h2>
                    <p class="text-white-50 mb-4" style="max-width: 600px;">
                        ท่านสามารถกดรับบัตรคิวออนไลน์ผ่านมือถือ ตรวจสอบเวลารอพบแพทย์โดยประมาณ หรือเปิดจอดิจิทัลเรียกคิวออกจอทีวีได้ทันที
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?= URLROOT ?>/appointment" class="btn btn-warning py-2 px-4 rounded-pill fw-bold text-dark">
                            <i class="bi bi-calendar-check-fill me-1"></i> จองคิวนัดหมาย (ปฏิทิน)
                        </a>
                        <a href="<?= URLROOT ?>/queue/kiosk" class="btn btn-outline-light py-2 px-4 rounded-pill">
                            <i class="bi bi-ticket-perforated-fill me-1"></i> ตู้คิว Kiosk ออนไลน์
                        </a>
                        <a href="<?= URLROOT ?>/queue/display/1" target="_blank" class="btn btn-outline-light py-2 px-4 rounded-pill">
                            <i class="bi bi-tv me-1"></i> จอทีวีแสดงผลคิว
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-center d-none d-lg-block">
                    <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-20 d-inline-block shadow-lg">
                        <i class="bi bi-broadcast display-1 text-warning"></i>
                        <h6 class="text-white mt-2 mb-0">Live Real-time Queue</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section with Dynamic Tabs -->
<section class="py-4 mb-5">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
            <div>
                <span class="section-badge mb-2"><i class="bi bi-newspaper me-1"></i> ข่าวสาร & ประชาสัมพันธ์</span>
                <h2 class="section-title mb-0">ข่าวสารและกิจกรรมล่าสุด</h2>
            </div>
            <a href="<?= URLROOT ?>/news" class="btn btn-modern-outline mt-3 mt-md-0">
                ดูข่าวทั้งหมด <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <?php if(!empty($newsByCategory)): ?>
            <ul class="nav nav-pills modern-pills mb-4" id="newsTab" role="tablist">
                <?php $i = 0; foreach($newsByCategory as $slug => $cat): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $i === 0 ? 'active' : '' ?> rounded-pill px-4 py-2" id="<?= $slug ?>-tab" data-bs-toggle="pill" data-bs-target="#tab-<?= $slug ?>" type="button" role="tab">
                            <?= htmlspecialchars($cat['name']) ?>
                        </button>
                    </li>
                <?php $i++; endforeach; ?>
            </ul>

            <div class="tab-content" id="newsTabContent">
                <?php $i = 0; foreach($newsByCategory as $slug => $cat): ?>
                    <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="tab-<?= $slug ?>" role="tabpanel">
                        <div class="row g-4">
                            <?php if(empty($cat['items'])): ?>
                                <div class="col-12 text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-muted"></i>
                                    ยังไม่มีข่าวสารในหมวดหมู่นี้
                                </div>
                            <?php else: ?>
                                <?php foreach($cat['items'] as $newsItem): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="glass-card h-100 overflow-hidden d-flex flex-column justify-content-between">
                                            <div>
                                                <div style="height: 190px; background: #0f172a; overflow: hidden;">
                                                    <img src="<?= URLROOT ?>/assets/images/news/<?= !empty($newsItem->cover_image) ? $newsItem->cover_image : 'default-news.jpg' ?>" alt="<?= htmlspecialchars($newsItem->title) ?>" class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onerror="this.src='https://placehold.co/400x200?text=PDH+News'">
                                                </div>
                                                <div class="p-4">
                                                    <div class="d-flex align-items-center gap-2 mb-2">
                                                        <span class="badge bg-primary-light text-primary small px-2 py-1"><?= htmlspecialchars($cat['name']) ?></span>
                                                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i><?= date('d/m/Y', strtotime($newsItem->published_at ?? $newsItem->created_at)) ?></small>
                                                    </div>
                                                    <h5 class="fw-bold mb-2 text-dark" style="line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                        <?= htmlspecialchars($newsItem->title) ?>
                                                    </h5>
                                                    <p class="text-muted small mb-0" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                        <?= strip_tags($newsItem->summary ?: $newsItem->content) ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="p-4 pt-0">
                                                <a href="<?= URLROOT ?>/news/show/<?= $newsItem->slug ?: $newsItem->id ?>" class="btn btn-sm btn-outline-primary rounded-pill w-100">
                                                    อ่านรายละเอียด <i class="bi bi-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
