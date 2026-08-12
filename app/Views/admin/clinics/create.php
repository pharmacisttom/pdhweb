<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/clinics" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/clinics/store" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label fw-bold">ชื่อคลินิก <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="department_id" class="form-label fw-bold">สังกัดกลุ่มงาน</label>
                    <select class="form-select" id="department_id" name="department_id">
                        <option value="">-- ไม่ระบุ --</option>
                        <?php foreach($departments as $dept): ?>
                            <option value="<?= $dept->id ?>"><?= $dept->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">รายละเอียด</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="location" class="form-label fw-bold">สถานที่</label>
                    <input type="text" class="form-control" id="location" name="location">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label fw-bold">เบอร์โทรศัพท์ติดต่อ</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-8">
                    <label for="note" class="form-label fw-bold">หมายเหตุเพิ่มเติม</label>
                    <input type="text" class="form-control" id="note" name="note">
                </div>
                
                <div class="col-md-4">
                    <label for="status" class="form-label fw-bold">สถานะ</label>
                    <select class="form-select" id="status" name="status">
                        <option value="active">เปิดใช้งาน</option>
                        <option value="inactive">ปิดใช้งาน</option>
                    </select>
                </div>
            </div>
            
            <hr>
            <div class="text-end mt-3">
                <a href="<?= URLROOT ?>/admin/clinics" class="btn btn-light me-2">ยกเลิก</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>
