<div class="container my-5">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/donation" class="btn btn-modern-outline btn-sm">
            <i class="bi bi-arrow-left"></i> กลับไปหน้ารวมการบริจาค
        </a>
    </div>

    <div class="row g-5">
        <div class="col-lg-7">
            <div class="glass-card p-4 mb-4">
                <img src="<?= URLROOT ?>/assets/images/donations/<?= $item->image ?: 'default-donation.jpg' ?>" class="img-fluid rounded-4 shadow-sm mb-4 w-100 object-fit-cover" style="max-height: 380px;" alt="<?= htmlspecialchars($item->title) ?>" onerror="this.src='https://placehold.co/800x500?text=Donation+Project'">
                
                <div class="mb-3 d-flex align-items-center gap-3">
                    <?php if ($item->type == 'money'): ?>
                        <span class="badge bg-success text-white px-3 py-2 rounded-pill"><i class="bi bi-cash-stack me-1"></i> ระดมทุนเงินบริจาค</span>
                    <?php elseif ($item->type == 'equipment'): ?>
                        <span class="badge bg-info text-white px-3 py-2 rounded-pill"><i class="bi bi-heart-pulse-fill me-1"></i> อุปกรณ์การแพทย์</span>
                    <?php else: ?>
                        <span class="badge bg-secondary text-white px-3 py-2 rounded-pill"><i class="bi bi-box-seam me-1"></i> สิ่งของบริจาค</span>
                    <?php endif; ?>
                    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> เริ่มโครงการ: <?= date('d M Y', strtotime($item->created_at)) ?></span>
                </div>

                <h2 class="fw-bold text-dark mb-3"><?= htmlspecialchars($item->title) ?></h2>
                
                <div class="text-secondary mb-4" style="line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($item->description)) ?>
                </div>
                
                <?php if ($item->type == 'money' && $item->target_amount > 0): ?>
                    <div class="p-4 bg-light rounded-4 border">
                        <h5 class="fw-bold mb-3 text-dark">ความคืบหน้ายอดบริจาค</h5>
                        <?php $percent = min(100, ($item->current_amount / $item->target_amount) * 100); ?>
                        <div class="progress progress-modern mb-3" style="height: 18px;">
                            <div class="progress-bar progress-bar-modern" role="progressbar" style="width: <?= $percent ?>%;">
                                <?= number_format($percent, 1) ?>%
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="text-muted d-block small">ยอดบริจาคปัจจุบัน</span>
                                <span class="fs-4 fw-bold text-success"><?= number_format($item->current_amount, 2) ?></span> <span class="text-muted small">บาท</span>
                            </div>
                            <div class="text-end">
                                <span class="text-muted d-block small">เป้าหมาย</span>
                                <span class="fs-4 fw-bold text-dark"><?= number_format($item->target_amount, 2) ?></span> <span class="text-muted small">บาท</span>
                            </div>
                        </div>
                    </div>
                <?php elseif ($item->type == 'equipment' && $item->target_quantity > 0): ?>
                    <div class="p-4 bg-light rounded-4 border">
                        <h5 class="fw-bold mb-3 text-dark">ความคืบหน้าจำนวนอุปกรณ์</h5>
                        <?php $percent = min(100, ($item->current_quantity / $item->target_quantity) * 100); ?>
                        <div class="progress progress-modern mb-3" style="height: 18px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $percent ?>%;">
                                <?= number_format($percent, 1) ?>%
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="text-muted d-block small">ได้รับแล้ว</span>
                                <span class="fs-4 fw-bold text-info"><?= number_format($item->current_quantity) ?></span> <span class="text-muted small">ชิ้น</span>
                            </div>
                            <div class="text-end">
                                <span class="text-muted d-block small">เป้าหมาย</span>
                                <span class="fs-4 fw-bold text-dark"><?= number_format($item->target_quantity) ?></span> <span class="text-muted small">ชิ้น</span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="col-lg-5">
            <div class="glass-card p-4 p-md-5 sticky-top" style="top: 100px;">
                <div class="text-center mb-4">
                    <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                        <i class="bi bi-heart-fill fs-3"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">แบบฟอร์มร่วมบริจาค</h4>
                    <p class="text-muted small">กรุณากรอกข้อมูลและแนบหลักฐานการโอนเงิน</p>
                </div>
                
                <?php if ($item->status == 'completed' || $item->status == 'inactive'): ?>
                    <div class="text-center py-4">
                        <i class="bi bi-check-circle-fill text-success display-4 mb-3 d-block"></i>
                        <h5 class="fw-bold">ปิดรับบริจาคแล้ว</h5>
                        <p class="text-muted small">รายการนี้ปิดรับบริจาคแล้ว ขอขอบพระคุณทุกท่านที่ร่วมสนับสนุน</p>
                    </div>
                <?php else: ?>
                    <?php if ($item->type == 'money'): ?>
                    <div class="p-3 rounded-3 bg-primary-light border border-primary border-opacity-25 mb-4 small">
                        <strong class="text-primary d-block mb-1"><i class="bi bi-bank2 me-1"></i> บัญชีรับบริจาค:</strong>
                        <div>ธนาคารกรุงไทย สาขาปลวกแดง</div>
                        <div>ชื่อบัญชี: <strong>เงินบริจาคโรงพยาบาลปลวกแดง</strong></div>
                        <div>เลขที่บัญชี: <strong class="text-primary fs-6">228-0-XXXXX-X</strong></div>
                    </div>
                    <?php endif; ?>

                    <form action="<?= URLROOT ?>/donation/store" method="POST" enctype="multipart/form-data">
                        <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="donation_item_id" value="<?= $item->id ?>">
                        
                        <div class="mb-3">
                            <label for="donor_name" class="form-label fw-bold small text-muted">ชื่อ-นามสกุล หรือ นามแฝง <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-modern" id="donor_name" name="donor_name" required placeholder="นายรักสุขภาพ ใจดี">
                        </div>
                        
                        <div class="mb-3">
                            <label for="donor_phone" class="form-label fw-bold small text-muted">เบอร์โทรศัพท์ติดต่อ</label>
                            <input type="text" class="form-control form-control-modern" id="donor_phone" name="donor_phone" placeholder="08X-XXX-XXXX">
                        </div>
                        
                        <div class="mb-3">
                            <label for="donor_email" class="form-label fw-bold small text-muted">อีเมล (สำหรับรับใบเสร็จ/ขอบคุณ)</label>
                            <input type="email" class="form-control form-control-modern" id="donor_email" name="donor_email" placeholder="example@email.com">
                        </div>

                        <?php if ($item->type == 'money'): ?>
                        <div class="mb-3">
                            <label for="amount" class="form-label fw-bold small text-muted">จำนวนเงินที่บริจาค (บาท) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="1" class="form-control form-control-modern fw-bold text-primary" id="amount" name="amount" required placeholder="1000.00">
                        </div>
                        
                        <div class="mb-4">
                            <label for="payment_slip" class="form-label fw-bold small text-muted">แนบสลิปโอนเงิน <span class="text-danger">*</span></label>
                            <input type="file" class="form-control form-control-modern" id="payment_slip" name="payment_slip" accept="image/*" required>
                        </div>
                        <?php elseif ($item->type == 'equipment'): ?>
                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-bold small text-muted">จำนวนที่บริจาค (ชิ้น) <span class="text-danger">*</span></label>
                            <input type="number" min="1" class="form-control form-control-modern fw-bold text-primary" id="quantity" name="quantity" required placeholder="1">
                        </div>
                        <?php else: ?>
                        <div class="mb-4">
                            <label for="payment_slip" class="form-label fw-bold small text-muted">ภาพถ่ายสิ่งของที่บริจาค (ถ้ามี)</label>
                            <input type="file" class="form-control form-control-modern" id="payment_slip" name="payment_slip" accept="image/*">
                        </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-modern-primary w-100 py-3 fs-6">
                            <i class="bi bi-send-fill me-1"></i> ยืนยันแจ้งการบริจาค
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
