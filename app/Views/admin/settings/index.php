<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2 class="fw-bold mb-0">ตั้งค่าระบบ (Settings)</h2>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-tags me-2 text-primary"></i> หมวดหมู่ข่าวสาร</h5>
                    <form action="<?= URLROOT ?>/admin/settings/updateCategories" method="POST">
                        <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                        <div id="categoryContainer">
                            <?php if(!empty($news_categories)): ?>
                                <?php foreach($news_categories as $index => $cat): ?>
                                    <div class="row mb-3 category-row">
                                        <div class="col-5">
                                            <label class="form-label small text-muted">รหัส (Slug - ภาษาอังกฤษ)</label>
                                            <input type="text" class="form-control" name="category_slug[]" value="<?= htmlspecialchars($cat['slug']) ?>" required>
                                        </div>
                                        <div class="col-5">
                                            <label class="form-label small text-muted">ชื่อหมวดหมู่</label>
                                            <input type="text" class="form-control" name="category_name[]" value="<?= htmlspecialchars($cat['name']) ?>" required>
                                        </div>
                                        <div class="col-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-outline-danger w-100 remove-btn"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Empty state -->
                            <?php endif; ?>
                        </div>

                        <button type="button" class="btn btn-outline-primary mb-4" id="addCategoryBtn">
                            <i class="bi bi-plus-circle me-2"></i> เพิ่มหมวดหมู่
                        </button>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 8px;">บันทึกหมวดหมู่ข่าว</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('categoryContainer');
    const addBtn = document.getElementById('addCategoryBtn');

    addBtn.addEventListener('click', function() {
        const row = document.createElement('div');
        row.className = 'row mb-3 category-row';
        row.innerHTML = `
            <div class="col-5">
                <label class="form-label small text-muted">รหัส (Slug - ภาษาอังกฤษ)</label>
                <input type="text" class="form-control" name="category_slug[]" placeholder="เช่น jobs" required>
            </div>
            <div class="col-5">
                <label class="form-label small text-muted">ชื่อหมวดหมู่</label>
                <input type="text" class="form-control" name="category_name[]" placeholder="เช่น ข่าวรับสมัครงาน" required>
            </div>
            <div class="col-2 d-flex align-items-end">
                <button type="button" class="btn btn-outline-danger w-100 remove-btn"><i class="bi bi-trash"></i></button>
            </div>
        `;
        container.appendChild(row);
    });

    container.addEventListener('click', function(e) {
        if(e.target.closest('.remove-btn')) {
            e.target.closest('.category-row').remove();
        }
    });
});
</script>
