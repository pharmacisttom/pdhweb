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
                            <?php $bannerLink = normalize_banner_link($banner->link ?? ''); ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <?php if($bannerLink !== ''): ?>
                                    <a href="<?= htmlspecialchars($bannerLink) ?>" class="d-block text-decoration-none">
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
                                
                                <?php if($bannerLink !== ''): ?>
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

        <?php if ($queueEnabled): ?>
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

        <?php endif; ?>
        <!-- 4. E-Donation -->
        <div class="col-6 col-lg-3">
            <a href="<?= URLROOT ?>/donations" class="fast-track-card position-relative overflow-hidden border-2 border-danger-subtle">
                <div class="position-absolute top-0 end-0 m-2">
                    <span class="badge bg-danger text-white rounded-pill px-2 py-0" style="font-size: 0.65rem;">
                        ลดหย่อน 2 เท่า
                    </span>
                </div>
                <div class="fast-track-icon" style="background: #ffe4e6; color: #e11d48;">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <h5 class="fast-track-title">ร่วมบริจาค</h5>
                <p class="fast-track-desc">e-Donation โรงพยาบาลปลวกแดง</p>
            </a>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- PROMINENT DONATION SPOTLIGHT SECTION (แคมเปญการให้ไม่มีสิ้นสุด & e-Donation) -->
<!-- ========================================================================= -->
<section class="py-4 my-2">
    <div class="container">
        
        <!-- Main Spotlight Card -->
        <div class="card border-0 shadow-xl rounded-5 overflow-hidden text-white mb-4 position-relative" style="background: linear-gradient(135deg, #042f2e 0%, #0f766e 45%, #0284c7 100%);">
            
            <div class="card-body p-4 p-md-5 position-relative">
                <div class="row align-items-center g-4">
                    
                    <!-- Left: Campaign Overview & Bank Details -->
                    <div class="col-lg-7 text-start">
                        
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-infinity me-1"></i> แคมเปญการให้ไม่มีสิ้นสุด (The Endless Giving)
                            </span>
                            <span class="badge bg-white px-3 py-2 rounded-pill fw-bold shadow-sm" style="color: #0d9488 !important; border: 1px solid rgba(13,148,136,0.2);">
                                <i class="bi bi-patch-check-fill text-success me-1"></i> e-Donation ลดหย่อนภาษี 2 เท่า
                            </span>
                        </div>

                        <h2 class="display-6 fw-bold text-white mb-2" style="letter-spacing: -0.5px;">
                            พลังแห่งการให้... สร้างปาฏิหาริย์แห่งชีวิต
                        </h2>
                        <p class="lead fs-6 mb-4 max-w-600" style="color: rgba(255, 255, 255, 0.95); line-height: 1.6;">
                            ร่วมสมทบทุนจัดซื้อเครื่องมือแพทย์และช่วยเหลือผู้ป่วยยากไร้ โรงพยาบาลปลวกแดง ทุกบาทของท่านส่งตรงถึงกรมสรรพากรเพื่อลดหย่อนภาษีได้ 2 เท่าโดยอัตโนมัติ
                        </p>

                        <!-- Bank Account Box on Homepage -->
                        <div class="p-3 p-md-4 rounded-4 bg-white text-dark shadow-lg mb-4 max-w-600 border border-white">
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-2 pb-2 border-bottom">
                                <div>
                                    <span class="small fw-semibold text-dark"><i class="bi bi-bank2 text-primary me-1"></i> ธนาคารกรุงไทย จำกัด (มหาชน)</span>
                                    <span class="badge bg-primary text-white ms-1 px-2 py-1 rounded-pill">สาขาปลวกแดง</span>
                                </div>
                                <span class="badge bg-success-subtle text-success small font-monospace border border-success-subtle px-2 py-1 rounded-pill">e-Donation ID: 0994000164877</span>
                            </div>
                            <div class="small text-dark mb-1">ชื่อบัญชี: <span class="text-primary fw-bold">บัญชีเงินบริจาคของโรงพยาบาลปลวกแดง</span></div>
                            <div class="d-flex align-items-center justify-content-between pt-1">
                                <div>
                                    <small class="text-muted d-block fw-semibold" style="font-size: 0.75rem;">เลขที่บัญชี:</small>
                                    <span class="fs-4 fw-bold font-monospace text-primary">671-9-87195-1</span>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2 fw-semibold shadow-sm" onclick="copyHomeBankAcc('6719871951')">
                                    <i class="bi bi-clipboard me-1"></i> <span id="homeCopyBtnText">คัดลอกเลขบัญชี</span>
                                </button>
                            </div>
                        </div>

                        <!-- CTA Action Buttons -->
                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?= URLROOT ?>/donations" class="btn btn-warning btn-lg rounded-pill px-4 py-3 fw-bold text-dark shadow-lg d-inline-flex align-items-center gap-2">
                                <i class="bi bi-heart-fill text-danger"></i>
                                <span>ร่วมบริจาคออนไลน์ (สแกน QR)</span>
                            </a>
                            <a href="<?= URLROOT ?>/donation/track" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                                <i class="bi bi-search"></i>
                                <span>ติดตามสถานะการบริจาค</span>
                            </a>
                        </div>

                    </div>

                    <!-- Right: e-Donation QR Card & Official Emblem -->
                    <div class="col-lg-5 text-center">
                        <div class="p-4 rounded-5 bg-white text-dark shadow-2xl position-relative mx-auto" style="max-width: 400px;">
                            
                            <!-- Official e-Donation Header Badge -->
                            <div class="mb-2">
                                <span class="badge text-white rounded-pill px-3 py-1 fw-bold" style="background-color: #0284c7; font-size: 0.8rem;">
                                    <i class="bi bi-qr-code me-1"></i> QR รับบริจาคทางการ (e-Donation)
                                </span>
                            </div>

                            <div class="small fw-bold text-muted mb-2">สแกนผ่าน Mobile Banking ได้ทุกธนาคาร</div>

                            <!-- Official Krungthai e-Donation QR Code from Bank Poster -->
                            <div class="p-2 bg-light rounded-4 border d-inline-block shadow-sm mb-3 position-relative overflow-hidden">
                                <img src="<?= URLROOT ?>/assets/images/donations/official-edonation-qr.png" alt="Official PromptPay e-Donation QR Code" class="img-fluid rounded" style="max-height: 230px; object-fit: contain;">
                            </div>

                            <div class="small fw-bold text-dark mb-1">บัญชีเงินบริจาคของโรงพยาบาลปลวกแดง</div>
                            <div class="text-muted font-monospace small mb-3" style="font-size: 0.78rem;">ธนาคารกรุงไทย สาขาปลวกแดง • <strong>671-9-87195-1</strong></div>

                            <div class="d-flex gap-2">
                                <a href="<?= URLROOT ?>/donations" class="btn btn-teal-gradient flex-grow-1 py-2 px-3 rounded-pill fw-bold text-white shadow-sm d-inline-flex align-items-center justify-content-center gap-1">
                                    <i class="bi bi-heart-fill text-danger"></i> <span>เข้าสู่หน้าบริจาค</span>
                                </a>
                                <a href="<?= URLROOT ?>/assets/images/donations/donation-poster.jpg" target="_blank" class="btn btn-outline-secondary rounded-pill px-3 py-2 fw-semibold" title="ดูป้ายประกาศทางการ">
                                    <i class="bi bi-file-earmark-image"></i> ป้ายประกาศ
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Featured Active Donation Campaigns Preview Cards (if available) -->
        <?php if (!empty($donationItems)): ?>
            <div class="d-flex justify-content-between align-items-end mb-3 mt-4">
                <div>
                    <span class="badge bg-teal-subtle text-teal px-3 py-1 rounded-pill fw-bold small mb-1">
                        <i class="bi bi-box2-heart-fill me-1"></i> โครงการที่กำลังเปิดรับ
                    </span>
                    <h3 class="h4 fw-bold text-dark mb-0">โครงการเพื่อผู้ป่วย โรงพยาบาลปลวกแดง</h3>
                </div>
                <a href="<?= URLROOT ?>/donations" class="text-teal text-decoration-none fw-semibold small">
                    ดูทั้งหมด <?= count($donationItems) ?> โครงการ &rarr;
                </a>
            </div>

            <div class="row g-3">
                <?php foreach ($donationItems as $dItem): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white d-flex flex-column justify-content-between hover-shadow">
                            <div class="position-relative" style="height: 140px; background: #0f172a;">
                                <img src="<?= URLROOT ?>/assets/images/donations/<?= $dItem->image ?: 'default-donation.jpg' ?>" class="w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($dItem->title) ?>" onerror="this.src='https://placehold.co/400x250/0d9488/ffffff?text=PDH+Campaign'">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-success text-white px-2 py-1 rounded-pill" style="font-size: 0.7rem;">
                                        ลดหย่อน 2 เท่า
                                    </span>
                                </div>
                            </div>
                            <div class="p-3 d-flex flex-column justify-content-between flex-grow-1">
                                <div>
                                    <h6 class="fw-bold text-dark line-clamp-2 mb-2" style="font-size: 0.9rem; line-height: 1.35;">
                                        <?= htmlspecialchars($dItem->title) ?>
                                    </h6>
                                </div>
                                <div class="pt-2 border-top">
                                    <?php 
                                        $tAmount = floatval($dItem->target_amount ?? 0);
                                        $cAmount = floatval($dItem->current_amount ?? 0);
                                        $pct = ($tAmount > 0) ? min(100, round(($cAmount / $tAmount) * 100, 1)) : 0;
                                    ?>
                                    <div class="d-flex justify-content-between small text-muted mb-1" style="font-size: 0.75rem;">
                                        <span>ได้รับแล้ว: <strong class="text-teal">฿<?= number_format($cAmount) ?></strong></span>
                                        <span class="fw-bold text-teal"><?= $pct ?>%</span>
                                    </div>
                                    <div class="progress mb-3" style="height: 6px; border-radius: 10px;">
                                        <div class="progress-bar bg-teal" role="progressbar" style="width: <?= $pct ?>%;"></div>
                                    </div>
                                    <a href="<?= URLROOT ?>/donation/show/<?= $dItem->id ?>" class="btn btn-outline-teal btn-sm w-100 rounded-pill fw-semibold" style="font-size: 0.8rem;">
                                        ร่วมบริจาคโครงการนี้ &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Custom Styling for Donation Section -->
<style>
.btn-teal-gradient {
    background: linear-gradient(135deg, #0d9488 0%, #059669 100%) !important;
    color: #ffffff !important;
    border: none !important;
    transition: all 0.3s ease;
}
.btn-teal-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4) !important;
    color: #ffffff !important;
}
.btn-outline-teal {
    border: 1.5px solid #0d9488 !important;
    color: #0d9488 !important;
    background: transparent;
}
.btn-outline-teal:hover {
    background: #0d9488 !important;
    color: #ffffff !important;
}
.text-teal {
    color: #0d9488 !important;
}
.bg-teal {
    background-color: #0d9488 !important;
}
.bg-teal-subtle {
    background-color: #ccfbf1 !important;
    color: #0f766e !important;
}
</style>

<script>
function copyHomeBankAcc(accNo) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(accNo).then(() => {
            const btn = document.getElementById('homeCopyBtnText');
            if (btn) {
                btn.innerText = 'คัดลอกสำเร็จ!';
                setTimeout(() => { btn.innerText = 'คัดลอกเลขบัญชี'; }, 2000);
            }
        });
    }
}
</script>

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

<?php if ($queueEnabled): ?>
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

<?php endif; ?>
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
                                                <a href="<?= URLROOT ?>/news/<?= $newsItem->slug ?: $newsItem->id ?>" class="btn btn-sm btn-outline-primary rounded-pill w-100">
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

<!-- GPS Navigation & Location Banner -->
<section class="py-3 mb-5">
    <div class="container">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #093f35 0%, #0d9488 60%, #0284c7 100%);">
            <div class="card-body p-4 p-md-5 text-white">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-3">
                            <i class="bi bi-geo-alt-fill me-1"></i> แผนที่ & นำทาง GPS
                        </span>
                        <h2 class="fw-bold text-white mb-2">เดินทางมาโรงพยาบาลปลวกแดง</h2>
                        <p class="text-white-50 mb-4" style="max-width: 650px;">
                            ตั้งอยู่เลขที่ 272 หมู่ 1 ถนนเทศบาล 8 ต.ปลวกแดง อ.ปลวกแดง จ.ระยอง (พิกัด GPS: <strong>12.969940, 101.218922</strong>) พร้อมระบบนำทางผ่าน Google Maps
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=12.969940,101.218922&travelmode=driving" target="_blank" rel="noopener noreferrer" class="btn btn-warning py-2 px-4 rounded-pill fw-bold text-dark shadow">
                                <i class="bi bi-cursor-fill me-1"></i> เปิด Google Maps นำทางทันที
                            </a>
                            <a href="<?= URLROOT ?>/contact#smartNavigation" class="btn btn-outline-light py-2 px-4 rounded-pill">
                                <i class="bi bi-compass me-1"></i> ระบบนำทางอัจฉริยะ & เบอร์ภายใน
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center d-none d-lg-block">
                        <div class="p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-20 d-inline-block shadow-lg">
                            <i class="bi bi-map-fill display-3 text-warning mb-2 d-block"></i>
                            <div class="small fw-bold text-white font-monospace">12.969940, 101.218922</div>
                            <small class="text-white-50">ระยอง 21140</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================================= -->
<!-- CSR & COMMUNITY PARTNERSHIP SLIDER SECTION (ภาพสไลด์กิจกรรม CSR ท้ายหน้าแรก) -->
<!-- ========================================================================= -->
<?php if (!empty($csrProjects)): ?>
<section class="py-5 mb-5 bg-white border-top border-bottom" id="homeCsrSection">
    <div class="container">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
            <div>
                <span class="badge bg-teal-subtle text-teal px-3 py-1 rounded-pill fw-bold small mb-2">
                    <i class="bi bi-people-fill me-1"></i> ความร่วมมือเพื่อสังคม (CSR)
                </span>
                <h2 class="section-title mb-1">พลังความร่วมมือ CSR & ภาคีเครือข่าย</h2>
                <p class="text-muted small mb-0">ร่วมสร้างการเปลี่ยนแปลงและยกระดับคุณภาพชีวิตของผู้ป่วย โรงพยาบาลปลวกแดง</p>
            </div>
            <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
                <a href="<?= URLROOT ?>/csr" class="btn btn-outline-teal rounded-pill px-4 py-2 fw-semibold">
                    ดูเรื่องราวทั้งหมด (<?= count($csrProjects) ?> กิจกรรม) <i class="bi bi-arrow-right ms-1"></i>
                </a>
                <div class="btn-group ms-2 d-none d-md-inline-flex" role="group">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle p-2 me-1" style="width: 38px; height: 38px;" data-bs-target="#csrHomeCarousel" data-bs-slide="prev">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle p-2" style="width: 38px; height: 38px;" data-bs-target="#csrHomeCarousel" data-bs-slide="next">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Carousel Container -->
        <div id="csrHomeCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">
                <?php 
                    $chunks = array_chunk($csrProjects, 3);
                    foreach ($chunks as $chunkIdx => $group):
                ?>
                <div class="carousel-item <?= $chunkIdx === 0 ? 'active' : '' ?>">
                    <div class="row g-4">
                        <?php foreach ($group as $proj): ?>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-light hover-card d-flex flex-column justify-content-between">
                                <a href="<?= URLROOT ?>/csr" class="position-relative d-block overflow-hidden" style="height: 300px; background: #0b1329;">
                                    <?php if (!empty($proj->image)): ?>
                                        <!-- Ambient blurred background -->
                                        <img src="<?= URLROOT ?>/assets/images/csr/<?= rawurlencode($proj->image) ?>" alt="" class="position-absolute w-100 h-100 object-fit-cover" style="filter: blur(16px); opacity: 0.35; transform: scale(1.15);">
                                        <!-- Sharp full poster without any cropping -->
                                        <img src="<?= URLROOT ?>/assets/images/csr/<?= rawurlencode($proj->image) ?>" alt="<?= htmlspecialchars($proj->project_title) ?>" class="position-relative w-100 h-100 object-fit-contain p-2 transition-scale">
                                    <?php else: ?>
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white-50">
                                            <i class="bi bi-building-heart fs-1"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="position-absolute top-0 end-0 m-2" style="z-index: 2;">
                                        <span class="badge bg-dark bg-opacity-75 text-white rounded-pill px-2 py-1 small">
                                            <i class="bi bi-calendar3 me-1"></i> <?= $proj->project_date ? date('d/m/Y', strtotime($proj->project_date)) : 'CSR' ?>
                                        </span>
                                    </div>
                                </a>
                                <div class="p-4 d-flex flex-column justify-content-between flex-grow-1 bg-white">
                                    <div>
                                        <span class="badge bg-primary-subtle text-primary fw-semibold small mb-2 text-wrap text-start">
                                            <i class="bi bi-buildings me-1"></i> <?= htmlspecialchars($proj->company_name) ?>
                                        </span>
                                        <h5 class="fw-bold text-dark mb-2" style="font-size: 1rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            <?= htmlspecialchars($proj->project_title) ?>
                                        </h5>
                                        <p class="text-muted small mb-3" style="font-size: 0.8rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            <?= strip_tags($proj->summary) ?>
                                        </p>
                                    </div>
                                    <?php if (!empty($proj->contribution)): ?>
                                    <div class="pt-2 border-top">
                                        <div class="small text-teal fw-semibold text-truncate">
                                            <i class="bi bi-heart-fill text-danger me-1"></i> <?= htmlspecialchars($proj->contribution) ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Carousel Indicators -->
            <?php if (count($chunks) > 1): ?>
            <div class="carousel-indicators position-relative mt-4 mb-0">
                <?php foreach ($chunks as $cIdx => $cGroup): ?>
                    <button type="button" data-bs-target="#csrHomeCarousel" data-bs-slide-to="<?= $cIdx ?>" class="<?= $cIdx === 0 ? 'active' : '' ?> bg-teal" style="width: 25px; height: 6px; border-radius: 4px;" aria-current="<?= $cIdx === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $cIdx + 1 ?>"></button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

    </div>
</section>
<?php endif; ?>

