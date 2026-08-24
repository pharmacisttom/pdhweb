<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">แก้ไขข้อมูลคลินิก: <strong><?= htmlspecialchars($clinic->name) ?></strong></p>
    </div>
    <a href="<?= URLROOT ?>/admin/clinic" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> กลับ
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
    <form action="<?= URLROOT ?>/admin/clinic/edit/<?= $clinic->id ?>" method="POST">
        <?= \App\Helpers\Security::csrfField() ?>

        <div class="row g-4">
            
            <div class="col-md-8">
                <label class="form-label fw-bold small text-dark">ชื่อคลินิก <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-3 py-2" name="name" value="<?= htmlspecialchars($clinic->name) ?>" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">กลุ่มงานที่สังกัด</label>
                <select name="department_id" class="form-select rounded-3 py-2">
                    <option value="">-- ไม่ระบุกลุ่มงาน --</option>
                    <?php if(!empty($departments)): ?>
                        <?php foreach($departments as $dept): ?>
                            <option value="<?= $dept->id ?>" <?= ($clinic->department_id == $dept->id) ? 'selected' : '' ?>><?= htmlspecialchars($dept->name) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold small text-dark">รายละเอียดคลินิก / วันเวลาที่เปิดให้บริการ</label>
                <textarea class="form-control rounded-3" name="description" rows="3"><?= htmlspecialchars($clinic->description ?? '') ?></textarea>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">สถานที่ตั้ง / ห้องตรวจ</label>
                <input type="text" class="form-control rounded-3 py-2" name="location" value="<?= htmlspecialchars($clinic->location ?? '') ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">เบอร์โทรศัพท์ / ต่อภายใน</label>
                <input type="text" class="form-control rounded-3 py-2" name="phone" value="<?= htmlspecialchars($clinic->phone ?? '') ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">สถานะ</label>
                <select class="form-select rounded-3 py-2" name="status">
                    <option value="active" <?= ($clinic->status == 'active') ? 'selected' : '' ?>>เปิดให้บริการ (Active)</option>
                    <option value="inactive" <?= ($clinic->status == 'inactive') ? 'selected' : '' ?>>ปิดชั่วคราว (Inactive)</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold small text-dark">หมายเหตุ / คำแนะนำเพิ่มเติม</label>
                <input type="text" class="form-control rounded-3 py-2" name="note" value="<?= htmlspecialchars($clinic->note ?? '') ?>">
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
            <a href="<?= URLROOT ?>/admin/clinic" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                <i class="bi bi-check-circle-fill me-1"></i> บันทึกการแก้ไข
            </button>
        </div>
    </form>
</div>
