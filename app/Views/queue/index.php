<!-- Smart Queue Hub Header -->
<div class="hero-wrapper py-5 mb-4 text-center">
    <div class="container">
        <div class="section-badge mb-3"><i class="bi bi-cpu-fill text-primary"></i> AI & Smart Hospital Queue</div>
        <h1 class="hero-title mb-2">ศูนย์บริการระบบคิวอัจฉริยะ (Smart Queue System)</h1>
        <p class="hero-subtitle mx-auto" style="max-width: 650px;">
            นวัตกรรมการบริหารจัดการคิวตรวจผู้ป่วยแบบ Real-time ตรวจสอบเวลารอคอยโดยประมาณ พร้อมระบบเรียกคิวหน้าห้องตรวจและจอดิจิทัลอัตโนมัติ
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <!-- 4 Main Queue Service Hubs -->
    <div class="row g-4 mb-5">
        <!-- 1. Kiosk -->
        <div class="col-md-6 col-lg-3">
            <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between text-center">
                <div>
                    <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #e0f2fe; color: #0284c7; width: 64px; height: 64px;">
                        <i class="bi bi-ticket-perforated-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">กดรับบัตรคิวออนไลน์</h5>
                    <p class="text-muted small">ตู้ Kiosk ออนไลน์สำหรับผู้ป่วยกดรับบัตรคิวดิจิทัลผ่านมือถือ</p>
                </div>
                <a href="<?= URLROOT ?>/queue/kiosk" class="btn btn-primary rounded-pill w-100 py-2 fw-bold">
                    เข้าสู่ตู้ Kiosk &rarr;
                </a>
            </div>
        </div>

        <!-- 2. Room Calling Station (หน้าห้องตรวจ) -->
        <div class="col-md-6 col-lg-3">
            <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between text-center" style="border-color: rgba(13, 148, 136, 0.4);">
                <div>
                    <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #f0fdfa; color: #0d9488; width: 64px; height: 64px;">
                        <i class="bi bi-megaphone-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">สถานีเรียกคิวประจำห้องตรวจ</h5>
                    <p class="text-muted small">สำหรับแพทย์/พยาบาลกดเรียกคิว เรียกซ้ำ และตรวจเสร็จสิ้น</p>
                </div>
                <a href="<?= URLROOT ?>/queue/room/1" class="btn btn-teal rounded-pill w-100 py-2 fw-bold text-white" style="background: var(--primary-color);">
                    เปิดสถานีเรียกคิว &rarr;
                </a>
            </div>
        </div>

        <!-- 3. Door Screen TV -->
        <div class="col-md-6 col-lg-3">
            <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between text-center">
                <div>
                    <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #fef3c7; color: #d97706; width: 64px; height: 64px;">
                        <i class="bi bi-tv-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">จอแสดงคิวหน้าห้องตรวจ</h5>
                    <p class="text-muted small">จอแท็บเล็ต/ทีวีติดหน้าประตูห้องตรวจ พร้อมเสียงสังเคราะห์ภาษาไทย</p>
                </div>
                <a href="<?= URLROOT ?>/queue/door/1" target="_blank" class="btn btn-warning rounded-pill w-100 py-2 fw-bold text-dark">
                    เปิดจอหน้าห้องตรวจ &rarr;
                </a>
            </div>
        </div>

        <!-- 4. Multi-Room Clinic Overview Display -->
        <div class="col-md-6 col-lg-3">
            <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between text-center">
                <div>
                    <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #0f172a; color: #38bdf8; width: 64px; height: 64px;">
                        <i class="bi bi-fullscreen fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">จอดิจิทัลรวมแผนก (Smart TV)</h5>
                    <p class="text-muted small">จอทีวีรวมทุกห้องตรวจ แสดงคิวที่กำลังรับบริการพร้อมกัน</p>
                </div>
                <a href="<?= URLROOT ?>/queue/display/1" target="_blank" class="btn btn-dark rounded-pill w-100 py-2 fw-bold text-white">
                    เปิดจอรวมแผนก &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Select Examination Room Fast-Selector -->
    <div class="card-modern p-4 mb-5">
        <h5 class="fw-bold text-dark mb-3">
            <i class="bi bi-door-open-fill text-primary me-2"></i>เลือกลัดห้องตรวจที่ต้องการเปิดใช้งาน:
        </h5>
        <div class="row g-2">
            <?php for($i = 1; $i <= 8; $i++): ?>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-light rounded-4 border d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark">ห้องตรวจที่ <?= $i ?></span>
                        <div class="d-flex gap-1">
                            <a href="<?= URLROOT ?>/queue/room/<?= $i ?>" class="btn btn-sm btn-primary rounded-circle" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;" title="เปิดหน้าจอเรียกคิว">
                                <i class="bi bi-megaphone-fill" style="font-size: 0.8rem;"></i>
                            </a>
                            <a href="<?= URLROOT ?>/queue/door/<?= $i ?>" target="_blank" class="btn btn-sm btn-warning rounded-circle" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;" title="เปิดจอหน้าห้องตรวจ">
                                <i class="bi bi-tv-fill" style="font-size: 0.8rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Select Department Section -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="bi bi-building-check text-primary me-2"></i>เลือกแผนกเพื่อดูคิว Real-time</h4>
            <p class="text-muted small mb-0">คลิกที่แผนกเพื่อดูสถานะคิวที่กำลังรับบริการ</p>
        </div>
    </div>

    <div class="row justify-content-center g-4">
        <?php if(empty($departments)): ?>
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded-4 shadow-sm d-inline-block">
                    <i class="bi bi-diagram-3 display-4 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted mb-0">ยังไม่มีแผนกที่เปิดระบบคิว</h5>
                </div>
            </div>
        <?php else: ?>
            <?php foreach($departments as $dept): ?>
                <div class="col-md-6 col-lg-3">
                    <a href="<?= URLROOT ?>/queue/display/<?= $dept->id ?>" class="text-decoration-none">
                        <div class="quick-hub-card h-100 py-4">
                            <div class="quick-hub-icon-wrap" style="background: #e0f2fe; color: #0284c7; width: 72px; height: 72px;">
                                <i class="bi <?= $dept->icon ?? 'bi-hospital' ?> fs-2"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2"><?= htmlspecialchars($dept->name) ?></h5>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 small">
                                <span class="pulse-dot me-1"></span> เปิดให้บริการ
                            </span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
