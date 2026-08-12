<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/doctors" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/doctors/store" method="POST" enctype="multipart/form-data">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            
            <h5 class="mb-3 text-primary border-bottom pb-2">ข้อมูลส่วนตัว</h5>
            <div class="row mb-3">
                <div class="col-md-12 mb-3 text-center">
                    <img id="image-preview" src="<?= URLROOT ?>/assets/images/doctors/default-doctor.jpg" alt="Preview" class="img-thumbnail rounded-circle mb-2" style="width: 150px; height: 150px; object-fit: cover;">
                    <div>
                        <label for="profile_image" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-camera"></i> เลือกรูปโปรไฟล์
                        </label>
                        <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*" onchange="previewImage(this);">
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="prefix" class="form-label fw-bold">คำนำหน้า <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="prefix" name="prefix" value="นพ." required>
                </div>
                <div class="col-md-5">
                    <label for="firstname" class="form-label fw-bold">ชื่อ <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="col-md-5">
                    <label for="lastname" class="form-label fw-bold">นามสกุล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
            </div>
            
            <h5 class="mb-3 mt-4 text-primary border-bottom pb-2">ข้อมูลทางวิชาชีพ</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="specialty" class="form-label fw-bold">ความเชี่ยวชาญ (Specialty) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="specialty" name="specialty" placeholder="เช่น อายุรกรรม, ศัลยกรรม" required>
                </div>
                <div class="col-md-6">
                    <label for="position" class="form-label fw-bold">ตำแหน่ง</label>
                    <input type="text" class="form-control" id="position" name="position" placeholder="เช่น นายแพทย์ชำนาญการ">
                </div>
            </div>

            <div class="mb-3">
                <label for="biography" class="form-label fw-bold">ประวัติย่อ / การศึกษา</label>
                <textarea class="form-control" id="biography" name="biography" rows="4"></textarea>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="status" class="form-label fw-bold">สถานะการทำงาน</label>
                    <select class="form-select" id="status" name="status">
                        <option value="active">ปฏิบัติงาน</option>
                        <option value="inactive">พักงาน / ลาออก</option>
                    </select>
                </div>
            </div>
            
            <hr>
            <div class="text-end mt-3">
                <a href="<?= URLROOT ?>/admin/doctors" class="btn btn-light me-2">ยกเลิก</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
