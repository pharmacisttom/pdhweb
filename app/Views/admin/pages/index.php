<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">จัดการหน้าเพจข้อมูลองค์กร ประวัติโรงพยาบาล ผู้บริหาร และวิสัยทัศน์</p>
    </div>
    <a href="<?= URLROOT ?>/admin/page/create" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-lg me-1"></i> สร้างหน้าเพจใหม่
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-4">ID</th>
                        <th width="35%">หัวข้อเพจ (Title)</th>
                        <th width="25%">ลิงก์เข้าชม (Slug)</th>
                        <th width="15%">สถานะ</th>
                        <th width="20%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pages)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลหน้าเพจ
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($pages as $page): ?>
                        <tr>
                            <td class="ps-4 fw-bold font-monospace text-muted"><?= $page->id ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($page->title) ?></div>
                            </td>
                            <td>
                                <a href="<?= URLROOT ?>/page/<?= htmlspecialchars($page->slug) ?>" target="_blank" class="badge bg-light text-primary border text-decoration-none px-3 py-2">
                                    <i class="bi bi-link-45deg me-1"></i>/page/<?= htmlspecialchars($page->slug) ?>
                                </a>
                            </td>
                            <td>
                                <?php if ($page->status == 'published'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-1">เผยแพร่แล้ว</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border rounded-pill px-3 py-1">ฉบับร่าง</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/page/<?= htmlspecialchars($page->slug) ?>" target="_blank" class="btn btn-sm btn-outline-info rounded-3" title="ดูหน้าเว็บ">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= URLROOT ?>/admin/page/edit/<?= $page->id ?>" class="btn btn-sm btn-outline-primary rounded-3" title="แก้ไข">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/page/delete/<?= $page->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบหน้าเพจนี้ใช่หรือไม่?');">
                                        <?= \App\Helpers\Security::csrfField() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="ลบ">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
