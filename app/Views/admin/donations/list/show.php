<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">รหัสรายการบริจาค: <strong>#<?= $donation->id ?></strong> (<?= htmlspecialchars($donation->donor_name) ?>)</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= URLROOT ?>/admin/donation/edit/<?= $donation->id ?>" class="btn btn-outline-primary rounded-3">
            <i class="bi bi-pencil me-1"></i> แก้ไขข้อมูล
        </a>
        <form action="<?= URLROOT ?>/admin/donation/delete/<?= $donation->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลการบริจาคนี้ใช่หรือไม่?');">
            <?= \App\Helpers\Security::csrfField() ?>
            <button type="submit" class="btn btn-outline-danger rounded-3">
                <i class="bi bi-trash me-1"></i> ลบรายการ
            </button>
        </form>
        <a href="<?= URLROOT ?>/admin/donation" class="btn btn-outline-secondary rounded-3">
            <i class="bi bi-arrow-left me-1"></i> กลับ
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Donor & Details -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 bg-white">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-person-heart me-2"></i> ข้อมูลผู้ร่วมบริจาค</h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless align-middle mb-4">
                    <tr>
                        <th width="35%" class="text-muted small fw-bold">รหัสติดตาม (Tracking):</th>
                        <td><span class="badge bg-light text-primary font-monospace fs-6 border px-3 py-1"><?= htmlspecialchars($donation->tracking_code ?? '-') ?></span></td>
                    </tr>
                    <tr>
                        <th width="35%" class="text-muted small fw-bold">ชื่อ-นามสกุล ผู้บริจาค:</th>
                        <td class="fs-6 fw-bold text-dark"><?= htmlspecialchars($donation->donor_name) ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted small fw-bold">อีเมล:</th>
                        <td><?= htmlspecialchars($donation->donor_email ?: '-') ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted small fw-bold">เบอร์โทรศัพท์:</th>
                        <td><?= htmlspecialchars($donation->donor_phone ?: '-') ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted small fw-bold">วันที่แจ้งบริจาค:</th>
                        <td class="font-monospace"><?= date('d/m/Y H:i น.', strtotime($donation->created_at)) ?></td>
                    </tr>
                </table>
                
                <hr>
                
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-gift me-2"></i> รายละเอียดการบริจาค</h5>
                <table class="table table-borderless align-middle mb-0">
                    <tr>
                        <th width="35%" class="text-muted small fw-bold">โครงการที่เลือก:</th>
                        <td class="fw-semibold text-dark"><?= htmlspecialchars($donation->item_title) ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted small fw-bold">ยอดเงิน / จำนวน:</th>
                        <td class="fs-4 fw-bold text-success font-monospace">
                            <?php if (!empty($donation->amount)): ?>
                                ฿<?= number_format($donation->amount, 2) ?>
                            <?php elseif (!empty($donation->quantity)): ?>
                                <?= number_format($donation->quantity) ?> ชิ้น
                            <?php else: ?>
                                ทั่วไป
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted small fw-bold">สถานะปัจจุบัน:</th>
                        <td>
                            <?php if ($donation->status == 'pending'): ?>
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning border-opacity-50 rounded-pill px-3 py-2 fw-semibold">
                                    <i class="bi bi-hourglass-split me-1"></i> รอตรวจสอบ
                                </span>
                            <?php elseif ($donation->status == 'approved'): ?>
                                <span class="badge bg-success-subtle text-success border border-success border-opacity-50 rounded-pill px-3 py-2 fw-semibold">
                                    <i class="bi bi-check-circle-fill me-1"></i> อนุมัติแล้ว
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-50 rounded-pill px-3 py-2 fw-semibold">
                                    <i class="bi bi-x-circle-fill me-1"></i> ไม่อนุมัติ
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Right Column: Payment Slip Image -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 bg-white">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-receipt me-2"></i> หลักฐานสลิปการโอนเงิน</h5>
            </div>
            <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                <?php if (!empty($donation->payment_slip_image)): ?>
                    <a href="<?= URLROOT ?>/assets/images/slips/<?= htmlspecialchars($donation->payment_slip_image) ?>" target="_blank" class="d-inline-block border rounded-3 p-2 shadow-sm bg-light">
                        <img src="<?= URLROOT ?>/assets/images/slips/<?= htmlspecialchars($donation->payment_slip_image) ?>" alt="Slip" class="img-fluid rounded" style="max-height: 280px; object-fit: contain;">
                    </a>
                    <p class="text-muted small mt-2 mb-0"><i class="bi bi-zoom-in me-1"></i> คลิกที่รูปเพื่อดูภาพขนาดเต็ม</p>
                <?php else: ?>
                    <div class="p-5 bg-light rounded-4 text-muted w-100">
                        <i class="bi bi-image-alt fs-1 mb-2 d-block text-secondary"></i>
                        <p class="mb-0">ไม่มีการแนบหลักฐานภาพสลิป</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Section: Approval Form -->
<div class="card shadow-sm border-0 rounded-4 mt-4 bg-white">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-shield-check text-primary me-2"></i> การตรวจสอบและอนุมัติยอดบริจาค</h5>
    </div>
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/donation/updateStatus/<?= $donation->id ?>" method="POST">
            <?= \App\Helpers\Security::csrfField() ?>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="status" class="form-label fw-bold small text-dark">เปลี่ยนสถานะ</label>
                    <select class="form-select rounded-3 py-2 fw-semibold" id="status" name="status" <?= $donation->status == 'approved' ? 'disabled' : '' ?>>
                        <option value="pending" <?= $donation->status == 'pending' ? 'selected' : '' ?>>รอตรวจสอบ (Pending)</option>
                        <option value="approved" <?= $donation->status == 'approved' ? 'selected' : '' ?>>อนุมัติแล้ว (ได้รับยอดเงินแล้ว - แสดงบนทำเนียบผู้บริจาค)</option>
                        <option value="rejected" <?= $donation->status == 'rejected' ? 'selected' : '' ?>>ไม่อนุมัติ (สลิปไม่ถูกต้อง / ยกเลิก)</option>
                    </select>
                    <?php if ($donation->status == 'approved'): ?>
                        <input type="hidden" name="status" value="approved">
                        <div class="form-text text-success mt-2"><i class="bi bi-check-circle-fill"></i> รายการนี้ได้รับการอนุมัติและรวมยอดเข้าโครงการเรียบร้อยแล้ว</div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-6">
                    <label for="admin_note" class="form-label fw-bold small text-dark">หมายเหตุจากเจ้าหน้าที่</label>
                    <textarea class="form-control rounded-3" id="admin_note" name="admin_note" rows="2" placeholder="ระบุข้อมูลเพิ่มเติม หรือเหตุผลกรณีไม่อนุมัติ..." <?= $donation->status == 'approved' ? 'readonly' : '' ?>><?= htmlspecialchars($donation->admin_note ?? '') ?></textarea>
                </div>
            </div>
            
            <?php if ($donation->status != 'approved'): ?>
            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                    <i class="bi bi-check-circle-fill me-1"></i> บันทึกการตรวจสอบและอนุมัติ
                </button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>
