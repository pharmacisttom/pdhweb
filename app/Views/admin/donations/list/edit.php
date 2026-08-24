<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">แก้ไขข้อมูลผู้ร่วมบริจาค รหัส: <strong>#<?= $donation->id ?> (<?= htmlspecialchars($donation->donor_name) ?>)</strong></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= URLROOT ?>/admin/donation/show/<?= $donation->id ?>" class="btn btn-outline-info rounded-3">
            <i class="bi bi-eye me-1"></i> ดูรายละเอียด
        </a>
        <a href="<?= URLROOT ?>/admin/donation" class="btn btn-outline-secondary rounded-3">
            <i class="bi bi-arrow-left me-1"></i> กลับ
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
    <form action="<?= URLROOT ?>/admin/donation/update/<?= $donation->id ?>" method="POST" enctype="multipart/form-data">
        <?= \App\Helpers\Security::csrfField() ?>

        <div class="row g-4">
            
            <!-- Donor Name -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">ชื่อ-นามสกุล / นามหน่วยงานผู้บริจาค <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-3 py-2" name="donor_name" value="<?= htmlspecialchars($donation->donor_name) ?>" required>
            </div>

            <!-- Donation Project -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">โครงการที่ระบุรับบริจาค <span class="text-danger">*</span></label>
                <select name="donation_item_id" class="form-select rounded-3 py-2" required>
                    <?php if(!empty($items)): ?>
                        <?php foreach($items as $it): ?>
                            <option value="<?= $it->id ?>" <?= ($donation->donation_item_id == $it->id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($it->title) ?> (<?= $it->type == 'money' ? 'เงินบริจาค' : 'อุปกรณ์' ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">อีเมล</label>
                <input type="email" class="form-control rounded-3 py-2" name="donor_email" value="<?= htmlspecialchars($donation->donor_email ?? '') ?>">
            </div>

            <!-- Phone -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control rounded-3 py-2" name="donor_phone" value="<?= htmlspecialchars($donation->donor_phone ?? '') ?>">
            </div>

            <!-- Amount -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">ยอดเงินบริจาค (บาท)</label>
                <input type="text" class="form-control rounded-3 py-2 font-monospace" name="amount" value="<?= $donation->amount ? number_format($donation->amount, 2) : '' ?>" placeholder="เช่น 1,000.00">
            </div>

            <!-- Quantity -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">จำนวนชิ้น (กรณีเป็นอุปกรณ์ / เวชภัณฑ์)</label>
                <input type="text" class="form-control rounded-3 py-2" name="quantity" value="<?= $donation->quantity ? number_format($donation->quantity) : '' ?>" placeholder="เช่น 5">
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">สถานะการตรวจสอบ</label>
                <select class="form-select rounded-3 py-2 fw-semibold" name="status">
                    <option value="pending" <?= ($donation->status == 'pending') ? 'selected' : '' ?>>รอตรวจสอบ (Pending)</option>
                    <option value="approved" <?= ($donation->status == 'approved') ? 'selected' : '' ?>>อนุมัติแล้ว (Approved - แสดงบนทำเนียบผู้บริจาค)</option>
                    <option value="rejected" <?= ($donation->status == 'rejected') ? 'selected' : '' ?>>ไม่อนุมัติ (Rejected)</option>
                </select>
            </div>

            <!-- Slip Image Upload / Replacement -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">เปลี่ยนรูปสลิปหลักฐานโอนเงิน</label>
                <input type="file" class="form-control rounded-3 py-2" name="payment_slip_image" accept="image/*">
                <?php if(!empty($donation->payment_slip_image)): ?>
                    <div class="mt-2 small text-muted">
                        <i class="bi bi-image me-1"></i> สลิปปัจจุบัน: 
                        <a href="<?= URLROOT ?>/assets/images/slips/<?= htmlspecialchars($donation->payment_slip_image) ?>" target="_blank" class="fw-bold text-primary">
                            <?= htmlspecialchars($donation->payment_slip_image) ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Admin Note -->
            <div class="col-12">
                <label class="form-label fw-bold small text-dark">หมายเหตุจากเจ้าหน้าที่ / บันทึกภายใน</label>
                <textarea class="form-control rounded-3" name="admin_note" rows="3" placeholder="ระบุข้อมูลเพิ่มเติมสำหรับการตรวจสอบ..."><?= htmlspecialchars($donation->admin_note ?? '') ?></textarea>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
            <a href="<?= URLROOT ?>/admin/donation" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                <i class="bi bi-check-circle-fill me-1"></i> บันทึกการแก้ไขข้อมูล
            </button>
        </div>
    </form>
</div>
