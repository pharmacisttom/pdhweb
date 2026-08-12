<div class="bg-light py-4 mb-5 border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= URLROOT ?>" class="text-decoration-none">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="<?= URLROOT ?>/donation" class="text-decoration-none">ร่วมบริจาค</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($item->title) ?></li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mb-5 pb-5">
    
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['flash_message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div class="row g-5">
        <div class="col-lg-7">
            <img src="<?= URLROOT ?>/assets/images/donations/<?= $item->image ?: 'default-donation.jpg' ?>" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="<?= htmlspecialchars($item->title) ?>">
            
            <div class="mb-4 d-flex align-items-center gap-3">
                <?php if ($item->type == 'money'): ?>
                    <span class="badge bg-success px-3 py-2 rounded-pill"><i class="bi bi-cash-coin me-1"></i> รับเงินบริจาค</span>
                <?php elseif ($item->type == 'equipment'): ?>
                    <span class="badge bg-info px-3 py-2 rounded-pill"><i class="bi bi-heart-pulse me-1"></i> อุปกรณ์การแพทย์</span>
                <?php else: ?>
                    <span class="badge bg-secondary px-3 py-2 rounded-pill"><i class="bi bi-box-seam me-1"></i> ทั่วไป</span>
                <?php endif; ?>
                <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> เริ่มเปิดรับบริจาค: <?= date('d M Y', strtotime($item->created_at)) ?></span>
            </div>

            <h1 class="fw-bold mb-4"><?= htmlspecialchars($item->title) ?></h1>
            
            <div class="content-body fs-5 text-secondary" style="line-height: 1.8;">
                <?= nl2br(htmlspecialchars($item->description)) ?>
            </div>
            
            <?php if ($item->type == 'money' && $item->target_amount > 0): ?>
                <div class="card bg-light border-0 rounded-4 mt-5 p-4">
                    <h5 class="fw-bold mb-4 text-center">ความคืบหน้าการรับบริจาคเงิน</h5>
                    <?php $percent = min(100, ($item->current_amount / $item->target_amount) * 100); ?>
                    <div class="progress mb-3" style="height: 25px; border-radius: 20px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100">
                            <?= number_format($percent, 1) ?>%
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="text-muted d-block small">ยอดบริจาคปัจจุบัน</span>
                            <span class="fs-4 fw-bold text-success"><?= number_format($item->current_amount, 2) ?></span> บาท
                        </div>
                        <div class="text-end">
                            <span class="text-muted d-block small">เป้าหมาย</span>
                            <span class="fs-4 fw-bold text-dark"><?= number_format($item->target_amount, 2) ?></span> บาท
                        </div>
                    </div>
                </div>
            <?php elseif ($item->type == 'equipment' && $item->target_quantity > 0): ?>
                <div class="card bg-light border-0 rounded-4 mt-5 p-4">
                    <h5 class="fw-bold mb-4 text-center">ความคืบหน้าการรับบริจาคอุปกรณ์</h5>
                    <?php $percent = min(100, ($item->current_quantity / $item->target_quantity) * 100); ?>
                    <div class="progress mb-3" style="height: 25px; border-radius: 20px;">
                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100">
                            <?= number_format($percent, 1) ?>%
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="text-muted d-block small">จำนวนที่ได้รับ</span>
                            <span class="fs-4 fw-bold text-info"><?= number_format($item->current_quantity) ?></span> ชิ้น
                        </div>
                        <div class="text-end">
                            <span class="text-muted d-block small">เป้าหมาย</span>
                            <span class="fs-4 fw-bold text-dark"><?= number_format($item->target_quantity) ?></span> ชิ้น
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 sticky-top" style="top: 100px; z-index: 10;">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4 border-0" style="background: linear-gradient(135deg, var(--primary-color), #0369a1);">
                    <h4 class="mb-0 fw-bold">แบบฟอร์มร่วมบริจาค</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <?php if ($item->status == 'completed' || $item->status == 'inactive'): ?>
                        <div class="text-center py-4">
                            <i class="bi bi-x-circle text-danger display-4 mb-3 d-block"></i>
                            <h5 class="fw-bold">ปิดรับบริจาคแล้ว</h5>
                            <p class="text-muted">รายการนี้ปิดรับบริจาคแล้ว ขอขอบคุณทุกท่านที่ให้การสนับสนุน</p>
                        </div>
                    <?php else: ?>
                    
                        <?php if ($item->type == 'money'): ?>
                        <div class="alert alert-info border-0 bg-info-subtle mb-4">
                            <strong>บัญชีธนาคารสำหรับโอนเงิน:</strong><br>
                            ธนาคารกรุงไทย สาขาปลวกแดง<br>
                            ชื่อบัญชี: เงินบริจาคโรงพยาบาลปลวกแดง<br>
                            เลขที่บัญชี: <strong>228-0-XXXXX-X</strong>
                        </div>
                        <?php endif; ?>

                        <form action="<?= URLROOT ?>/donation/store" method="POST" enctype="multipart/form-data">
                            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            <input type="hidden" name="donation_item_id" value="<?= $item->id ?>">
                            
                            <div class="mb-3">
                                <label for="donor_name" class="form-label fw-bold">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg bg-light" id="donor_name" name="donor_name" required placeholder="ชื่อ-นามสกุล หรือ นามแฝง">
                            </div>
                            
                            <div class="mb-3">
                                <label for="donor_phone" class="form-label fw-bold">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control form-control-lg bg-light" id="donor_phone" name="donor_phone" placeholder="08X-XXX-XXXX">
                            </div>
                            
                            <div class="mb-3">
                                <label for="donor_email" class="form-label fw-bold">อีเมล</label>
                                <input type="email" class="form-control form-control-lg bg-light" id="donor_email" name="donor_email" placeholder="example@email.com">
                            </div>

                            <?php if ($item->type == 'money'): ?>
                            <div class="mb-3">
                                <label for="amount" class="form-label fw-bold">จำนวนเงิน (บาท) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="1" class="form-control form-control-lg bg-light border-primary" id="amount" name="amount" required placeholder="ระบุจำนวนเงิน">
                            </div>
                            
                            <div class="mb-4">
                                <label for="payment_slip" class="form-label fw-bold">แนบสลิปโอนเงิน <span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-control-lg bg-light" id="payment_slip" name="payment_slip" accept="image/*" required>
                                <div class="form-text text-muted small mt-2"><i class="bi bi-info-circle me-1"></i>รองรับไฟล์รูปภาพ (.jpg, .png, .jpeg)</div>
                            </div>
                            <?php elseif ($item->type == 'equipment'): ?>
                            <div class="mb-4">
                                <label for="quantity" class="form-label fw-bold">จำนวนที่บริจาค (ชิ้น) <span class="text-danger">*</span></label>
                                <input type="number" min="1" class="form-control form-control-lg bg-light border-primary" id="quantity" name="quantity" required placeholder="ระบุจำนวน">
                            </div>
                            <?php else: ?>
                            <div class="mb-4">
                                <label for="payment_slip" class="form-label fw-bold">ภาพถ่ายสิ่งของที่บริจาค (ถ้ามี)</label>
                                <input type="file" class="form-control form-control-lg bg-light" id="payment_slip" name="payment_slip" accept="image/*">
                            </div>
                            <?php endif; ?>

                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold rounded-pill shadow" style="background: linear-gradient(135deg, var(--primary-color), #0369a1); border: none;">
                                แจ้งการบริจาค
                            </button>
                            <p class="text-center text-muted small mt-3 mb-0">ข้อมูลของท่านจะถูกเก็บเป็นความลับ</p>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
