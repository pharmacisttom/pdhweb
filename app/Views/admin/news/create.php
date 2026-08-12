<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/news" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/news/store" method="POST" enctype="multipart/form-data">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <div class="row mb-3">
                <div class="col-md-6 mb-3 text-center">
                    <img id="image-preview" src="<?= URLROOT ?>/assets/images/news/default-news.jpg" alt="Preview" class="img-thumbnail mb-2" style="max-height: 200px; object-fit: cover;">
                    <div>
                        <label for="cover_image" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-image"></i> เลือกรูปหน้าปก
                        </label>
                        <input type="file" id="cover_image" name="cover_image" class="d-none" accept="image/*" onchange="previewImage(this);">
                    </div>
                </div>
                
                <div class="col-md-6 mb-3 d-flex flex-column justify-content-center align-items-center bg-light border rounded">
                    <i class="bi bi-file-earmark-pdf text-danger mb-2" style="font-size: 3rem;"></i>
                    <p class="text-muted small mb-2" id="pdf-filename">ยังไม่ได้เลือกไฟล์ PDF</p>
                    <div>
                        <label for="pdf_file" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-filetype-pdf"></i> แนบไฟล์ PDF (ทางเลือก)
                        </label>
                        <input type="file" id="pdf_file" name="pdf_file" class="d-none" accept="application/pdf" onchange="updatePdfFilename(this);">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label fw-bold">หัวข้อข่าว <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg" id="title" name="title" required>
            </div>
            
            <div class="mb-3">
                <label for="summary" class="form-label fw-bold">เรื่องย่อ (Summary)</label>
                <textarea class="form-control" id="summary" name="summary" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label fw-bold">เนื้อหาข่าว <span class="text-danger">*</span></label>
                <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                <div class="form-text">คุณสามารถใส่ HTML ได้ (ในอนาคตสามารถติดตั้ง CKEditor หรือ TinyMCE ได้)</div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="category" class="form-label fw-bold">หมวดหมู่</label>
                    <select class="form-select" id="category" name="category">
                        <option value="general">ข่าวประชาสัมพันธ์ทั่วไป</option>
                        <option value="service">ข่าวประชาสัมพันธ์การบริการของโรงพยาบาล</option>
                        <option value="procurement">ข่าวประชาสัมพันธ์สำหรับระบบงานจัดซื้อจัดจ้าง</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="status" class="form-label fw-bold">สถานะ</label>
                    <select class="form-select" id="status" name="status">
                        <option value="draft">ฉบับร่าง (Draft)</option>
                        <option value="published">เผยแพร่ทันที (Published)</option>
                    </select>
                </div>
            </div>
            
            <hr>
            <div class="text-end mt-3">
                <a href="<?= URLROOT ?>/admin/news" class="btn btn-light me-2">ยกเลิก</a>
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

function updatePdfFilename(input) {
    var filename = "ยังไม่ได้เลือกไฟล์ PDF";
    if (input.files && input.files[0]) {
        filename = input.files[0].name;
    }
    document.getElementById('pdf-filename').textContent = filename;
}
</script>
