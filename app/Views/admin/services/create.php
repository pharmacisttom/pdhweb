<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">กรอกข้อมูลบริการทางการแพทย์และบริการผู้ป่วยเพื่อแสดงบนเว็บไซต์</p>
    </div>
    <a href="<?= URLROOT ?>/admin/service" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> กลับ
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
    <form action="<?= URLROOT ?>/admin/service/create" method="POST" enctype="multipart/form-data">
        <?= \App\Helpers\Security::csrfField() ?>

        <div class="row g-4">
            
            <!-- Service Name -->
            <div class="col-md-8">
                <label class="form-label fw-bold small text-dark">ชื่อบริการ <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control rounded-3 py-2" placeholder="เช่น บริการตรวจสุขภาพและออกใบรับรองแพทย์" required>
            </div>

            <!-- Department -->
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">กลุ่มงาน / ฝ่ายที่รับผิดชอบ</label>
                <select name="department_id" class="form-select rounded-3 py-2">
                    <option value="">-- ไม่ระบุกลุ่มงาน --</option>
                    <?php if(!empty($departments)): ?>
                        <?php foreach($departments as $dept): ?>
                            <option value="<?= $dept->id ?>"><?= htmlspecialchars($dept->name) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label fw-bold small text-dark">รายละเอียดบริการ</label>
                <textarea name="description" class="form-control rounded-3" rows="4" placeholder="ระบุขอบเขตการให้บริการ ขั้นตอน หรือรายละเอียดที่ผู้รับบริการควรทราบ"></textarea>
            </div>

            <!-- Open Time -->
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">เวลาเปิดให้บริการ</label>
                <input type="text" name="open_time" class="form-control rounded-3 py-2" placeholder="เช่น ทุกวันจันทร์ - ศุกร์ 08.00 - 16.00 น.">
            </div>

            <!-- Location -->
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">สถานที่ / จุดให้บริการ</label>
                <input type="text" name="location" class="form-control rounded-3 py-2" placeholder="เช่น อาคารผู้ป่วยนอก ชั้น 1">
            </div>

            <!-- Phone -->
            <div class="col-md-4">
                <label class="form-label fw-bold small text-dark">เบอร์โทรศัพท์ติดต่อ / เบอร์ต่อภายใน</label>
                <input type="text" name="phone" class="form-control rounded-3 py-2" placeholder="เช่น 033-650-413 ต่อ 106">
            </div>

            <!-- Preparation Instructions -->
            <div class="col-12">
                <label class="form-label fw-bold small text-dark">คำแนะนำและการเตรียมตัวของผู้ป่วย</label>
                <textarea name="preparation" class="form-control rounded-3" rows="3" placeholder="เช่น งดน้ำและอาหารก่อนตรวจ 8 ชั่วโมง, นำบัตรประจำตัวประชาชนและสิทธิการรักษามาด้วย"></textarea>
            </div>

            <!-- Cover Image -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">รูปภาพประกอบบริการ</label>
                <input type="file" name="cover_image" class="form-control rounded-3 py-2" accept="image/*">
                <small class="text-muted" style="font-size: 0.75rem;">รองรับไฟล์ภาพ JPG, PNG, WEBP</small>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">สถานะ</label>
                <select name="status" class="form-select rounded-3 py-2">
                    <option value="active" selected>เปิดบริการ (Active)</option>
                    <option value="inactive">ปิดบริการชั่วคราว (Inactive)</option>
                </select>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
            <a href="<?= URLROOT ?>/admin/service" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                <i class="bi bi-check-circle-fill me-1"></i> บันทึกข้อมูลบริการ
            </button>
        </div>
    </form>
</div>
