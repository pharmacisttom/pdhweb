<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">แก้ไขข้อมูลบริการ: <strong><?= htmlspecialchars($service->name) ?></strong></p>
    </div>
    <a href="<?= URLROOT ?>/admin/service" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> กลับ
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
    <form action="<?= URLROOT ?>/admin/service/update/<?= $service->id ?>" method="POST" enctype="multipart/form-data">
        <?= \App\Helpers\Security::csrfField() ?>

        <div class="row g-4">
            
            <!-- Service Name -->
            <div class="col-md-8">
                <label class="form-label fw-bold small text-dark">ชื่อบริการ <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control rounded-3 py-2" value="<?= htmlspecialchars($service->name) ?>" required>
            </div>

            <!-- Department -->
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">กลุ่มงาน / ฝ่ายที่รับผิดชอบ</label>
                <select name="department_id" class="form-select rounded-3 py-2">
                    <option value="">-- ไม่ระบุกลุ่มงาน --</option>
                    <?php if(!empty($departments)): ?>
                        <?php foreach($departments as $dept): ?>
                            <option value="<?= $dept->id ?>" <?= ($service->department_id == $dept->id) ? 'selected' : '' ?>><?= htmlspecialchars($dept->name) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label fw-bold small text-dark">รายละเอียดบริการ</label>
                <textarea name="description" class="form-control rounded-3" rows="4"><?= htmlspecialchars($service->description ?? '') ?></textarea>
            </div>

            <!-- Open Time -->
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">เวลาเปิดให้บริการ</label>
                <input type="text" name="open_time" class="form-control rounded-3 py-2" value="<?= htmlspecialchars($service->open_time ?? '') ?>">
            </div>

            <!-- Location -->
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">สถานที่ / จุดให้บริการ</label>
                <input type="text" name="location" class="form-control rounded-3 py-2" value="<?= htmlspecialchars($service->location ?? '') ?>">
            </div>

            <!-- Phone -->
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">เบอร์โทรศัพท์ติดต่อ / เบอร์ต่อภายใน</label>
                <input type="text" name="phone" class="form-control rounded-3 py-2" value="<?= htmlspecialchars($service->phone ?? '') ?>">
            </div>

            <!-- Preparation Instructions -->
            <div class="col-12">
                <label class="form-label fw-bold small text-dark">คำแนะนำและการเตรียมตัวของผู้ป่วย</label>
                <textarea name="preparation" class="form-control rounded-3" rows="3"><?= htmlspecialchars($service->preparation ?? '') ?></textarea>
            </div>

            <!-- Cover Image -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">รูปภาพประกอบบริการ</label>
                <input type="file" name="cover_image" class="form-control rounded-3 py-2" accept="image/*">
                <?php if(!empty($service->cover_image)): ?>
                    <div class="mt-2 small text-muted">ภาพปัจจุบัน: <code><?= htmlspecialchars($service->cover_image) ?></code></div>
                <?php endif; ?>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">สถานะ</label>
                <select name="status" class="form-select rounded-3 py-2">
                    <option value="active" <?= ($service->status == 'active') ? 'selected' : '' ?>>เปิดบริการ (Active)</option>
                    <option value="inactive" <?= ($service->status == 'inactive') ? 'selected' : '' ?>>ปิดบริการชั่วคราว (Inactive)</option>
                </select>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
            <a href="<?= URLROOT ?>/admin/service" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                <i class="bi bi-check-circle-fill me-1"></i> บันทึกการแก้ไข
            </button>
        </div>
    </form>
</div>
