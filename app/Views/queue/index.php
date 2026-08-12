<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary"><?= $page_title ?></h1>
        <p class="lead text-muted">กรุณาเลือกแผนกเพื่อตรวจสอบสถานะคิวการรับบริการในขณะนี้ (ระบบ Real-time)</p>
    </div>

    <div class="row justify-content-center g-4">
        <?php foreach($departments as $dept): ?>
            <div class="col-md-4 col-lg-3">
                <a href="<?= URLROOT ?>/queue/display/<?= $dept->id ?>" class="text-decoration-none">
                    <div class="card h-100 text-center py-5 border-0 shadow-sm hover-shadow transition">
                        <div class="card-body">
                            <i class="bi <?= $dept->icon ?? 'bi-hospital' ?> display-4 text-primary mb-3"></i>
                            <h4 class="card-title fw-bold text-dark mb-0"><?= $dept->name ?></h4>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .hover-shadow:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -2px rgba(0,0,0,.05) !important; transform: translateY(-5px); }
    .transition { transition: all 0.3s ease; }
</style>
