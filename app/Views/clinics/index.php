<!-- Clinics Header -->
<div class="hero-wrapper py-5 mb-4 text-center">
    <div class="container">
        <div class="section-badge mb-3"><i class="bi bi-hospital-fill text-primary"></i> Specialized Clinics</div>
        <h1 class="hero-title mb-2">คลินิกเฉพาะโรค & ตารางออกตรวจ</h1>
        <p class="hero-subtitle mx-auto" style="max-width: 600px;">
            ข้อมูลคลินิกเฉพาะทาง เวลาเปิดทำการ และแพทย์ผู้ออกตรวจประจำโรงพยาบาลปลวกแดง
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4">
        <?php if(empty($clinics)): ?>
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded-4 shadow-sm d-inline-block">
                    <i class="bi bi-hospital display-4 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted mb-0">ยังไม่มีข้อมูลคลินิกในขณะนี้</h5>
                </div>
            </div>
        <?php else: ?>
            <?php foreach($clinics as $clinic): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card h-100 p-4 d-flex flex-column">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3 fs-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($clinic->name) ?></h5>
                                <span class="badge bg-light text-secondary border small"><?= htmlspecialchars($clinic->department_name ?? 'แผนกทั่วไป') ?></span>
                            </div>
                        </div>

                        <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
                            <?= mb_strimwidth(htmlspecialchars($clinic->description ?? ''), 0, 110, '...') ?>
                        </p>
                        
                        <div class="bg-light bg-opacity-75 rounded-3 p-3 mb-4 small text-muted">
                            <div class="mb-2 d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i> 
                                <span><?= htmlspecialchars($clinic->location ?: 'อาคารผู้ป่วยนอก') ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-telephone-fill text-success me-2"></i> 
                                <span><?= htmlspecialchars($clinic->phone ?: '038-659-188 ต่อ 101') ?></span>
                            </div>
                        </div>
                        
                        <a href="<?= URLROOT ?>/clinic/show/<?= $clinic->id ?>" class="btn btn-modern-primary w-100 justify-content-center">
                            ดูตารางแพทย์ <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
