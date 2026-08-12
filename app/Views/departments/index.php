<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary"><?= $page_title ?></h1>
        <p class="lead text-muted">บริการทางการแพทย์และกลุ่มงานต่างๆ ในโรงพยาบาลปลวกแดง</p>
    </div>

    <div class="row g-4">
        <?php if(empty($departments)): ?>
            <div class="col-12 text-center text-muted">
                <p>ยังไม่มีข้อมูลกลุ่มงาน</p>
            </div>
        <?php else: ?>
            <?php foreach($departments as $dept): ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 text-center py-4 border-0 shadow-sm hover-shadow transition">
                        <div class="card-body">
                            <i class="bi <?= $dept->icon ?? 'bi-hospital' ?> display-4 text-secondary mb-3"></i>
                            <h5 class="card-title fw-bold text-dark"><?= $dept->name ?></h5>
                            <p class="card-text text-muted small"><?= mb_strimwidth($dept->description, 0, 80, '...') ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    .hover-shadow:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -2px rgba(0,0,0,.05) !important; transform: translateY(-5px); }
    .transition { transition: all 0.3s ease; }
</style>
