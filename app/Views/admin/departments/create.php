<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/departments" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/departments/store" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">ชื่อกลุ่มงาน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">รายละเอียด</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="icon" class="form-label fw-bold">Bootstrap Icon Class</label>
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="เช่น bi-hospital">
                    <div class="form-text">สามารถดูชื่อ Icon ได้ที่ <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></div>
                </div>
                
                <div class="col-md-6">
                    <label for="status" class="form-label fw-bold">สถานะ</label>
                    <select class="form-select" id="status" name="status">
                        <option value="active">เปิดใช้งาน</option>
                        <option value="inactive">ปิดใช้งาน</option>
                    </select>
                </div>
            </div>
            
            <hr>
            <div class="text-end mt-3">
                <a href="<?= URLROOT ?>/admin/departments" class="btn btn-light me-2">ยกเลิก</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>
