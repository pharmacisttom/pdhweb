<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">แก้ไขข้อมูลกลุ่มงาน: <strong><?= htmlspecialchars($department->name) ?></strong></p>
    </div>
    <a href="<?= URLROOT ?>/admin/department" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> กลับ
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
    <form action="<?= URLROOT ?>/admin/department/edit/<?= $department->id ?>" method="POST">
        <?= \App\Helpers\Security::csrfField() ?>

        <div class="row g-4">
            
            <div class="col-md-8">
                <label class="form-label fw-bold small text-dark">ชื่อกลุ่มงาน / ฝ่าย <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-3 py-2" name="name" value="<?= htmlspecialchars($department->name) ?>" required>
            </div>
            
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">ไอคอน (Bootstrap Icon)</label>
                <input type="text" class="form-control rounded-3 py-2 font-monospace" name="icon" value="<?= htmlspecialchars($department->icon ?? 'bi-building') ?>">
            </div>

            <div class="col-12">
                <label class="form-label fw-bold small text-dark">รายละเอียด / บทบาทหน้าที่</label>
                <textarea class="form-control rounded-3" name="description" rows="4"><?= htmlspecialchars($department->description ?? '') ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">สถานะ</label>
                <select class="form-select rounded-3 py-2" name="status">
                    <option value="active" <?= ($department->status == 'active') ? 'selected' : '' ?>>เปิดใช้งาน (Active)</option>
                    <option value="inactive" <?= ($department->status == 'inactive') ? 'selected' : '' ?>>ปิดใช้งานชั่วคราว (Inactive)</option>
                </select>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
            <a href="<?= URLROOT ?>/admin/department" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                <i class="bi bi-check-circle-fill me-1"></i> บันทึกการแก้ไข
            </button>
        </div>
    </form>
</div>
