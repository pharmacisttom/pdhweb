<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/pages/create" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> สร้างหน้าใหม่</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="35%">หัวข้อเพจ (Title)</th>
                        <th width="20%">ลิงก์ (Slug)</th>
                        <th width="15%">สถานะ</th>
                        <th width="25%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pages)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">ไม่มีข้อมูลหน้าเพจ</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($pages as $page): ?>
                        <tr>
                            <td><?= $page->id ?></td>
                            <td class="fw-medium">
                                <?= $page->title ?>
                            </td>
                            <td><span class="text-muted small"><?= URLROOT ?>/page/<?= $page->slug ?></span></td>
                            <td>
                                <?php if ($page->status == 'published'): ?>
                                    <span class="badge bg-success-pastel">เผยแพร่แล้ว</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-pastel text-dark">ฉบับร่าง</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/page/<?= $page->slug ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="ดูหน้าเว็บ"><i class="bi bi-eye"></i></a>
                                <a href="<?= URLROOT ?>/admin/pages/edit/<?= $page->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?= URLROOT ?>/admin/pages/delete/<?= $page->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบหน้าเพจนี้ใช่หรือไม่?');">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
