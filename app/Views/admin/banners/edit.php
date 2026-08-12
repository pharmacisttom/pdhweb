<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/banner" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/banner/update/<?= $banner->id ?>" method="POST" enctype="multipart/form-data">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <img id="image-preview" src="<?= URLROOT ?>/assets/images/banners/<?= $banner->image_file ?>" alt="Preview" class="img-thumbnail mb-3" style="max-height: 300px; width: 100%; object-fit: cover; background: #f8fafc;" onerror="this.src='https://via.placeholder.com/1200x400.png?text=Banner+Image'">
                    <div>
                        <label for="image_file" class="btn btn-outline-primary">
                            <i class="bi bi-upload me-2"></i> เปลี่ยนรูปภาพ <span class="text-muted">(แนะนำ 1920x600 px)</span>
                        </label>
                        <input type="file" id="image_file" name="image_file" class="d-none" accept="image/*" onchange="previewImage(this);">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label fw-bold">หัวข้อ (Title) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($banner->title) ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="link" class="form-label fw-bold">ลิงก์ URL (ถ้ามี)</label>
                    <input type="text" class="form-control" id="link" name="link" value="<?= htmlspecialchars($banner->link) ?>">
                    <div class="form-text">ใส่ลิงก์เพื่อให้ผู้ใช้คลิกจากแบนเนอร์ไปหน้าอื่นได้</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label fw-bold">ลำดับการแสดงผล</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" value="<?= $banner->sort_order ?>">
                    <div class="form-text">ตัวเลขน้อยจะแสดงก่อน</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label fw-bold">สถานะ</label>
                    <select class="form-select" id="status" name="status">
                        <option value="active" <?= $banner->status == 'active' ? 'selected' : '' ?>>ใช้งาน (Active)</option>
                        <option value="inactive" <?= $banner->status == 'inactive' ? 'selected' : '' ?>>ปิดการใช้งาน (Inactive)</option>
                    </select>
                </div>
            </div>
            
            <hr>
            <div class="text-end mt-3">
                <a href="<?= URLROOT ?>/admin/banner" class="btn btn-light me-2">ยกเลิก</a>
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
