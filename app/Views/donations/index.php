<div class="bg-primary text-white py-5 mb-5" style="background: linear-gradient(135deg, #0f172a, #1e293b);">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3"><?= $title ?></h1>
        <p class="lead mb-0 text-white-50">ร่วมเป็นส่วนหนึ่งในการสนับสนุนโรงพยาบาล เพื่อการดูแลรักษาผู้ป่วยที่ดียิ่งขึ้น</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4">
        <?php if (empty($items)): ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-box-heart display-1 text-muted mb-3 d-block"></i>
                <h4 class="text-muted">ขณะนี้ยังไม่มีรายการเปิดรับบริจาค</h4>
            </div>
        <?php else: ?>
            <?php foreach ($items as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    <img src="<?= URLROOT ?>/assets/images/donations/<?= $item->image ?: 'default-donation.jpg' ?>" class="card-img-top" alt="<?= htmlspecialchars($item->title) ?>" style="height: 250px; object-fit: cover;">
                    <div class="card-body p-4">
                        <?php if ($item->type == 'money'): ?>
                            <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill"><i class="bi bi-cash-coin me-1"></i> รับเงินบริจาค</span>
                        <?php elseif ($item->type == 'equipment'): ?>
                            <span class="badge bg-info-subtle text-info mb-2 px-3 py-2 rounded-pill"><i class="bi bi-heart-pulse me-1"></i> อุปกรณ์การแพทย์</span>
                        <?php else: ?>
                            <span class="badge bg-secondary-subtle text-secondary mb-2 px-3 py-2 rounded-pill"><i class="bi bi-box-seam me-1"></i> ทั่วไป</span>
                        <?php endif; ?>
                        
                        <h5 class="card-title fw-bold mb-3"><?= htmlspecialchars($item->title) ?></h5>
                        <p class="card-text text-muted mb-4"><?= mb_strimwidth(htmlspecialchars($item->description), 0, 100, '...') ?></p>
                        
                        <?php if ($item->type == 'money' && $item->target_amount > 0): ?>
                            <?php $percent = min(100, ($item->current_amount / $item->target_amount) * 100); ?>
                            <div class="mb-2 d-flex justify-content-between small">
                                <span>ยอดบริจาค: <strong><?= number_format($item->current_amount) ?></strong> บาท</span>
                                <span>เป้าหมาย: <strong><?= number_format($item->target_amount) ?></strong> บาท</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php elseif ($item->type == 'equipment' && $item->target_quantity > 0): ?>
                            <?php $percent = min(100, ($item->current_quantity / $item->target_quantity) * 100); ?>
                            <div class="mb-2 d-flex justify-content-between small">
                                <span>จำนวน: <strong><?= number_format($item->current_quantity) ?></strong> ชิ้น</span>
                                <span>เป้าหมาย: <strong><?= number_format($item->target_quantity) ?></strong> ชิ้น</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-white border-0 p-4 pt-0">
                        <a href="<?= URLROOT ?>/donation/show/<?= $item->id ?>" class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2">ร่วมบริจาค</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
