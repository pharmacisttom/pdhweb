<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">แก้ไขข้อมูลหน้าเพจ: <strong><?= htmlspecialchars($page->title) ?></strong></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= URLROOT ?>/page/<?= htmlspecialchars($page->slug) ?>" target="_blank" class="btn btn-outline-info rounded-3">
            <i class="bi bi-eye me-1"></i> ดูหน้าเว็บ
        </a>
        <a href="<?= URLROOT ?>/admin/page" class="btn btn-outline-secondary rounded-3">
            <i class="bi bi-arrow-left me-1"></i> กลับ
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
    <form action="<?= URLROOT ?>/admin/page/edit/<?= $page->id ?>" method="POST">
        <?= \App\Helpers\Security::csrfField() ?>

        <div class="row g-4">
            
            <div class="col-12">
                <label class="form-label fw-bold small text-dark">หัวข้อหน้าเพจ <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-3 py-2" name="title" value="<?= htmlspecialchars($page->title) ?>" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">URL Slug (ภาษาอังกฤษ)</label>
                <input type="text" class="form-control rounded-3 py-2 font-monospace" name="slug" value="<?= htmlspecialchars($page->slug) ?>">
                <div class="form-text small text-muted">ตัวอย่าง: about, vision, executives</div>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">สถานะ</label>
                <select class="form-select rounded-3 py-2" name="status">
                    <option value="published" <?= ($page->status == 'published') ? 'selected' : '' ?>>เผยแพร่ทันที (Published)</option>
                    <option value="draft" <?= ($page->status == 'draft') ? 'selected' : '' ?>>ฉบับร่าง (Draft)</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold small text-dark">เนื้อหาหน้าเพจ (รองรับ HTML และข้อความตกแต่ง) <span class="text-danger">*</span></label>
                <textarea class="form-control rounded-3 font-monospace" name="content" rows="18" required><?= htmlspecialchars($page->content) ?></textarea>
            </div>

        </div>
        
        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
            <a href="<?= URLROOT ?>/admin/page" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                <i class="bi bi-check-circle-fill me-1"></i> บันทึกการแก้ไข
            </button>
        </div>
    </form>
</div>
