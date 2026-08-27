<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0"><?= escape($title) ?></h5>
        <a href="<?= url('/admin/news') ?>" class="btn btn-outline-secondary btn-sm"><i data-lucide="arrow-left" style="width:16px;"></i> กลับไปหน้ารายการ</a>
    </div>
    <div class="card-body p-4">
        
        <?php $actionUrl = $post ? url('/admin/news/update/' . $post['id']) : url('/admin/news/create'); ?>

        <form action="<?= $actionUrl ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">หัวข้อข่าว <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="<?= escape($post['title'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">คำอธิบายย่อ (Short Description)</label>
                        <textarea name="short_description" class="form-control" rows="3"><?= escape($post['short_description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">เนื้อหาข่าว <span class="text-danger">*</span></label>
                        <!-- In production, replace with TinyMCE script loaded below -->
                        <textarea name="content" id="editor" class="form-control" rows="15"><?= escape($post['content'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold border-bottom pb-2">การตั้งค่า</h6>
                            
                            <div class="mb-3">
                                <label class="form-label">หมวดหมู่</label>
                                <select name="category_id" class="form-select">
                                    <option value="">-- เลือกหมวดหมู่ --</option>
                                    <?php foreach($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= (($post['category_id'] ?? '') == $cat['id']) ? 'selected' : '' ?>><?= escape($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">สถานะ</label>
                                <select name="status" class="form-select">
                                    <option value="draft" <?= (($post['status'] ?? 'draft') == 'draft') ? 'selected' : '' ?>>ฉบับร่าง (Draft)</option>
                                    <option value="published" <?= (($post['status'] ?? '') == 'published') ? 'selected' : '' ?>>เผยแพร่ (Published)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card border mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold border-bottom pb-2">รูปภาพหน้าปก (Cover Image)</h6>
                            <?php if (!empty($post['cover_image'])): ?>
                                <div class="mb-2">
                                    <img src="<?= url($post['cover_image']) ?>" class="img-fluid rounded border">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="cover_image" class="form-control" accept="image/jpeg,image/png,image/webp">
                            <small class="text-muted d-block mt-1">รองรับ JPG, PNG, WEBP</small>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-success px-4"><i data-lucide="save" style="width:18px;"></i> บันทึกข้อมูล</button>
            </div>
        </form>

    </div>
</div>

<!-- TinyMCE Script (CDN for simplicity) -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        language: 'th_TH',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template help',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons',
        menubar: 'file edit view insert format tools table help',
        height: 500,
        content_style: 'body { font-family: "Noto Sans Thai", sans-serif; font-size: 16px; }'
    });
</script>
