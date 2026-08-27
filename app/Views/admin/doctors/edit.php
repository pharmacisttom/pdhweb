<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">แก้ไขข้อมูลแพทย์: <strong><?= htmlspecialchars($doctor->prefix) ?><?= htmlspecialchars($doctor->firstname) ?> <?= htmlspecialchars($doctor->lastname) ?></strong></p>
    </div>
    <a href="<?= URLROOT ?>/admin/doctor" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> กลับ
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
    <form action="<?= URLROOT ?>/admin/doctor/update/<?= $doctor->id ?>" method="POST" enctype="multipart/form-data">
        <?= \App\Helpers\Security::csrfField() ?>

        <div class="row g-4">
            
            <div class="col-md-3">
                <label class="form-label fw-bold small text-dark">คำนำหน้าชื่อ <span class="text-danger">*</span></label>
                <select class="form-select rounded-3 py-2" name="prefix" required>
                    <?php
                    $prefixes = ['นพ.', 'พญ.', 'ทพ.', 'ทพญ.', 'ภก.', 'ภญ.', 'ดร.', 'นาย', 'นาง', 'นางสาว'];
                    foreach($prefixes as $pfx):
                    ?>
                        <option value="<?= $pfx ?>" <?= ($doctor->prefix == $pfx) ? 'selected' : '' ?>><?= $pfx ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">ชื่อจริง <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-3 py-2" name="firstname" value="<?= htmlspecialchars($doctor->firstname) ?>" required>
            </div>

            <div class="col-md-5">
                <label class="form-label fw-bold small text-dark">นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-3 py-2" name="lastname" value="<?= htmlspecialchars($doctor->lastname) ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">สาขาความเชี่ยวชาญ (Specialty)</label>
                <input type="text" class="form-control rounded-3 py-2" name="specialty" value="<?= htmlspecialchars($doctor->specialty ?? '') ?>" placeholder="เช่น อายุรศาสตร์, กุมารเวชศาสตร์">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">ตำแหน่งทางวิชาการ / ตำแหน่งบริหาร</label>
                <input type="text" class="form-control rounded-3 py-2" name="position" value="<?= htmlspecialchars($doctor->position ?? '') ?>" placeholder="เช่น นายแพทย์ชำนาญการพิเศษ">
            </div>

            <div class="col-12">
                <label class="form-label fw-bold small text-dark">ประวัติการศึกษาและการฝึกอบรม (Biography / Education)</label>
                <textarea class="form-control rounded-3" name="biography" rows="4"><?= htmlspecialchars($doctor->biography ?? '') ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">รูปถ่ายโปรไฟล์แพทย์</label>
                <input type="file" class="form-control rounded-3 py-2" name="profile_image" accept="image/*">
                <?php if(!empty($doctor->profile_image) && $doctor->profile_image != 'default-doctor.jpg'): ?>
                    <div class="mt-2 small text-muted">
                        รูปภาพปัจจุบัน: <code><?= htmlspecialchars($doctor->profile_image) ?></code>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">สถานะ</label>
                <select class="form-select rounded-3 py-2" name="status">
                    <option value="active" <?= ($doctor->status == 'active') ? 'selected' : '' ?>>ปฏิบัติงานปกติ (Active)</option>
                    <option value="inactive" <?= ($doctor->status == 'inactive') ? 'selected' : '' ?>>พักงาน / ลาศึกษาต่อ / ลาออก (Inactive)</option>
                </select>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
            <a href="<?= URLROOT ?>/admin/doctor" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                <i class="bi bi-check-circle-fill me-1"></i> บันทึกการแก้ไข
            </button>
        </div>
    </form>
</div>
