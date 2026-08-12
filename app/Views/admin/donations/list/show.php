<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/donation" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลผู้บริจาค</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">ชื่อ-นามสกุล:</th>
                        <td><?= htmlspecialchars($donation->donor_name) ?></td>
                    </tr>
                    <tr>
                        <th>อีเมล:</th>
                        <td><?= htmlspecialchars($donation->donor_email ?: '-') ?></td>
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์:</th>
                        <td><?= htmlspecialchars($donation->donor_phone ?: '-') ?></td>
                    </tr>
                    <tr>
                        <th>วันที่บริจาค:</th>
                        <td><?= date('d/m/Y H:i', strtotime($donation->created_at)) ?></td>
                    </tr>
                </table>
                
                <hr>
                
                <h6 class="m-0 font-weight-bold text-primary mb-3">รายละเอียดการบริจาค</h6>
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">โครงการ/รายการ:</th>
                        <td><?= htmlspecialchars($donation->item_title) ?></td>
                    </tr>
                    <tr>
                        <th>ยอด/จำนวน:</th>
                        <td class="fs-5 fw-bold text-success">
                            <?php if (!empty($donation->amount)): ?>
                                <?= number_format($donation->amount, 2) ?> บาท
                            <?php elseif (!empty($donation->quantity)): ?>
                                <?= number_format($donation->quantity) ?> ชิ้น
                            <?php else: ?>
                                ทั่วไป
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>สถานะปัจจุบัน:</th>
                        <td>
                            <?php if ($donation->status == 'pending'): ?>
                                <span class="badge bg-warning-pastel text-dark">รอตรวจสอบ</span>
                            <?php elseif ($donation->status == 'approved'): ?>
                                <span class="badge bg-success-pastel">อนุมัติแล้ว</span>
                            <?php else: ?>
                                <span class="badge bg-danger-pastel">ไม่อนุมัติ</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h6 class="m-0 font-weight-bold text-primary">หลักฐานการโอนเงิน/บริจาค</h6>
            </div>
            <div class="card-body text-center">
                <?php if (!empty($donation->payment_slip_image)): ?>
                    <a href="<?= URLROOT ?>/assets/images/slips/<?= $donation->payment_slip_image ?>" target="_blank">
                        <img src="<?= URLROOT ?>/assets/images/slips/<?= $donation->payment_slip_image ?>" alt="Slip" class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                    </a>
                    <p class="text-muted small mt-2">คลิกที่รูปเพื่อดูขนาดเต็ม</p>
                <?php else: ?>
                    <div class="p-5 bg-light rounded text-muted">
                        <i class="bi bi-image-alt fs-1 mb-2"></i>
                        <p>ไม่มีการแนบหลักฐาน</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0 pt-4 pb-0">
        <h6 class="m-0 font-weight-bold text-primary">การตรวจสอบและอนุมัติ</h6>
    </div>
    <div class="card-body">
        <form action="<?= URLROOT ?>/admin/donation/updateStatus/<?= $donation->id ?>" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            
            <div class="mb-3">
                <label for="status" class="form-label fw-bold">เปลี่ยนสถานะ</label>
                <select class="form-select w-25" id="status" name="status" <?= $donation->status == 'approved' ? 'disabled' : '' ?>>
                    <option value="pending" <?= $donation->status == 'pending' ? 'selected' : '' ?>>รอตรวจสอบ</option>
                    <option value="approved" <?= $donation->status == 'approved' ? 'selected' : '' ?>>อนุมัติแล้ว (ได้รับแล้ว)</option>
                    <option value="rejected" <?= $donation->status == 'rejected' ? 'selected' : '' ?>>ไม่อนุมัติ (ข้อมูลไม่ถูกต้อง/ยกเลิก)</option>
                </select>
                <?php if ($donation->status == 'approved'): ?>
                    <!-- If disabled above, we need to pass the value secretly or we just don't allow changes after approval -->
                    <input type="hidden" name="status" value="approved">
                    <div class="form-text text-success"><i class="bi bi-check-circle"></i> รายการนี้ได้รับการอนุมัติแล้ว ไม่สามารถเปลี่ยนสถานะได้เพื่อป้องกันยอดการบริจาคคลาดเคลื่อน</div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label for="admin_note" class="form-label fw-bold">หมายเหตุจากเจ้าหน้าที่ (ระบุเหตุผลหากไม่อนุมัติ)</label>
                <textarea class="form-control" id="admin_note" name="admin_note" rows="3" <?= $donation->status == 'approved' ? 'readonly' : '' ?>><?= htmlspecialchars($donation->admin_note) ?></textarea>
            </div>
            
            <?php if ($donation->status != 'approved'): ?>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> บันทึกการตรวจสอบ</button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>
