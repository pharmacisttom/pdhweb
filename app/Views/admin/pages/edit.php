<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <div class="d-flex gap-2">
        <?php if($page->status == 'published'): ?>
            <a href="<?= URLROOT ?>/page/<?= $page->slug ?>" target="_blank" class="btn btn-outline-info"><i class="bi bi-eye"></i> ดูหน้าเว็บ</a>
        <?php endif; ?>
        <a href="<?= URLROOT ?>/admin/pages" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/pages/update/<?= $page->id ?>" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <div class="mb-3">
                <label for="title" class="form-label fw-bold">หัวข้อหน้าเพจ <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg" id="title" name="title" value="<?= htmlspecialchars($page->title) ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="slug" class="form-label fw-bold">URL Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="<?= $page->slug ?>">
                <div class="form-text">เว้นว่างไว้เพื่อสร้างอัตโนมัติจากหัวข้อ ภาษาอังกฤษตัวเล็กหรือตัวเลขเชื่อมด้วยขีดกลาง</div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label fw-bold">เนื้อหา <span class="text-danger">*</span></label>
                <textarea class="form-control" id="content" name="content" rows="15" required><?= htmlspecialchars($page->content) ?></textarea>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="status" class="form-label fw-bold">สถานะ</label>
                    <select class="form-select" id="status" name="status">
                        <option value="draft" <?= $page->status == 'draft' ? 'selected' : '' ?>>ฉบับร่าง (Draft)</option>
                        <option value="published" <?= $page->status == 'published' ? 'selected' : '' ?>>เผยแพร่ทันที (Published)</option>
                    </select>
                </div>
            </div>
            
            <hr>
            <div class="text-end mt-3">
                <a href="<?= URLROOT ?>/admin/pages" class="btn btn-light me-2">ยกเลิก</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>
