<!-- Donations Header -->
<div class="hero-wrapper py-5 mb-4 text-center">
    <div class="container">
        <div class="section-badge mb-3"><i class="bi bi-box2-heart-fill text-danger"></i> E-Donation Portal</div>
        <h1 class="hero-title mb-2">ร่วมบริจาค & สมทบทุน</h1>
        <p class="hero-subtitle mx-auto" style="max-width: 600px;">
            ร่วมเป็นส่วนหนึ่งในการสนับสนุนโรงพยาบาลปลวกแดง เพื่อจัดซื้อครุภัณฑ์การแพทย์และพัฒนาการรักษาพยาบาล
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4">
        <?php if (empty($items)): ?>
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded-4 shadow-sm d-inline-block">
                    <i class="bi bi-box2-heart display-4 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted mb-0">ขณะนี้ยังไม่มีรายการเปิดรับบริจาค</h5>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($items as $item): ?>
            <div class="col-md-6 col-lg-4">
                <div class="glass-card h-100 overflow-hidden d-flex flex-column">
                    <div style="height: 220px; overflow: hidden; position: relative;">
                        <img src="<?= URLROOT ?>/assets/images/donations/<?= $item->image ?: 'default-donation.jpg' ?>" class="w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($item->title) ?>" onerror="this.src='https://placehold.co/600x400?text=Donation'">
                        <div class="position-absolute top-0 start-0 m-3">
                            <?php if ($item->type == 'money'): ?>
                                <span class="badge bg-success text-white px-3 py-1 rounded-pill shadow-sm"><i class="bi bi-cash-stack me-1"></i> ระดมทุน</span>
                            <?php elseif ($item->type == 'equipment'): ?>
                                <span class="badge bg-info text-white px-3 py-1 rounded-pill shadow-sm"><i class="bi bi-heart-pulse-fill me-1"></i> อุปกรณ์การแพทย์</span>
                            <?php else: ?>
                                <span class="badge bg-secondary text-white px-3 py-1 rounded-pill shadow-sm"><i class="bi bi-box-seam me-1"></i> สิ่งของบริจาค</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="p-4 flex-grow-1 d-flex flex-column">
                        <h5 class="fw-bold mb-2 text-dark"><?= htmlspecialchars($item->title) ?></h5>
                        <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
                            <?= mb_strimwidth(htmlspecialchars($item->description ?? ''), 0, 100, '...') ?>
                        </p>
                        
                        <?php if ($item->type == 'money' && $item->target_amount > 0): ?>
                            <?php $percent = min(100, ($item->current_amount / $item->target_amount) * 100); ?>
                            <div class="mb-2 d-flex justify-content-between small">
                                <span class="text-muted">ได้รับแล้ว: <strong class="text-success"><?= number_format($item->current_amount) ?></strong> บ.</span>
                                <span class="text-muted">เป้าหมาย: <strong><?= number_format($item->target_amount) ?></strong> บ.</span>
                            </div>
                            <div class="progress progress-modern mb-4">
                                <div class="progress-bar progress-bar-modern" style="width: <?= $percent ?>%;"></div>
                            </div>
                        <?php elseif ($item->type == 'equipment' && $item->target_quantity > 0): ?>
                            <?php $percent = min(100, ($item->current_quantity / $item->target_quantity) * 100); ?>
                            <div class="mb-2 d-flex justify-content-between small">
                                <span class="text-muted">ได้รับแล้ว: <strong class="text-info"><?= number_format($item->current_quantity) ?></strong> ชิ้น</span>
                                <span class="text-muted">เป้าหมาย: <strong><?= number_format($item->target_quantity) ?></strong> ชิ้น</span>
                            </div>
                            <div class="progress progress-modern mb-4">
                                <div class="progress-bar bg-info" style="width: <?= $percent ?>%;"></div>
                            </div>
                        <?php endif; ?>

                        <a href="<?= URLROOT ?>/donation/show/<?= $item->id ?>" class="btn btn-modern-primary w-100 justify-content-center mt-auto">
                            <i class="bi bi-heart-fill me-1"></i> ร่วมบริจาค
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
