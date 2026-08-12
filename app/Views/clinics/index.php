<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary"><?= $page_title ?></h1>
        <p class="lead text-muted">คลินิกเฉพาะโรคและบริการตรวจรักษาโรคต่างๆ</p>
    </div>

    <div class="row g-4">
        <?php if(empty($clinics)): ?>
            <div class="col-12 text-center text-muted">
                <p>ยังไม่มีข้อมูลคลินิก</p>
            </div>
        <?php else: ?>
            <?php foreach($clinics as $clinic): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded p-3 me-3">
                                    <i class="bi bi-heart-pulse fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="card-title fw-bold mb-1 text-dark"><?= $clinic->name ?></h5>
                                    <span class="badge bg-light text-secondary"><?= $clinic->department_name ?? 'ทั่วไป' ?></span>
                                </div>
                            </div>
                            <p class="card-text text-muted mb-4"><?= mb_strimwidth($clinic->description, 0, 100, '...') ?></p>
                            
                            <ul class="list-unstyled text-muted small mb-4">
                                <li class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i> <?= $clinic->location ?: 'ไม่ได้ระบุสถานที่' ?></li>
                                <li><i class="bi bi-telephone text-primary me-2"></i> <?= $clinic->phone ?: '-' ?></li>
                            </ul>
                            
                            <a href="<?= URLROOT ?>/clinics/show/<?= $clinic->id ?>" class="btn btn-outline-primary w-100">ดูตารางแพทย์ <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    .hover-shadow:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -2px rgba(0,0,0,.05) !important; transform: translateY(-3px); }
    .transition { transition: all 0.3s ease; }
</style>
