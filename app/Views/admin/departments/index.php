<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">จัดการโครงสร้างกลุ่มงานและฝ่ายภายในโรงพยาบาลปลวกแดง</p>
    </div>
    <a href="<?= URLROOT ?>/admin/department/create" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-lg me-1"></i> เพิ่มกลุ่มงานใหม่
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-4">ID</th>
                        <th width="10%">ไอคอน</th>
                        <th width="30%">ชื่อกลุ่มงาน / ฝ่าย</th>
                        <th width="30%">รายละเอียด</th>
                        <th width="10%">สถานะ</th>
                        <th width="15%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($departments)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลกลุ่มงาน
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($departments as $dept): ?>
                        <tr>
                            <td class="ps-4 fw-bold font-monospace text-muted"><?= $dept->id ?></td>
                            <td>
                                <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi <?= htmlspecialchars($dept->icon ?: 'bi-building') ?> fs-5 text-primary"></i>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($dept->name) ?></div>
                            </td>
                            <td class="text-muted small">
                                <?= htmlspecialchars(mb_strimwidth($dept->description ?? '', 0, 60, '...')) ?>
                            </td>
                            <td>
                                <?php if ($dept->status == 'active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-1">เปิดใช้งาน</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">ปิดใช้งาน</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/admin/department/edit/<?= $dept->id ?>" class="btn btn-sm btn-outline-primary rounded-3" title="แก้ไข">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/department/delete/<?= $dept->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบกลุ่มงานนี้ใช่หรือไม่?');">
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
