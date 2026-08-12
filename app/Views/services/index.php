<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">บริการทางการแพทย์</h1>
        <p class="text-muted">โรงพยาบาลปลวกแดงพร้อมให้บริการดูแลสุขภาพของคุณอย่างครบวงจร</p>
    </div>

    <div class="row g-4">
        <?php foreach($services as $srv): ?>
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-dark mb-2"><?= htmlspecialchars($srv->name) ?></h4>
                    <span class="badge bg-secondary mb-3"><?= htmlspecialchars($srv->department_name ?? 'ทั่วไป') ?></span>
                    <p class="text-muted mb-4"><?= htmlspecialchars($srv->description) ?></p>
                    
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="bi bi-clock text-primary me-2"></i> <strong>เวลาทำการ:</strong> <?= htmlspecialchars($srv->open_time) ?></li>
                        <li><i class="bi bi-geo-alt text-primary me-2"></i> <strong>สถานที่:</strong> <?= htmlspecialchars($srv->location) ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
