<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/departments/create" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> เพิ่มกลุ่มงาน</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Icon</th>
                        <th width="30%">ชื่อกลุ่มงาน</th>
                        <th width="30%">รายละเอียด</th>
                        <th width="10%">สถานะ</th>
                        <th width="15%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($departments)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">ไม่มีข้อมูลกลุ่มงาน</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($departments as $dept): ?>
                        <tr>
                            <td><?= $dept->id ?></td>
                            <td><i class="bi <?= $dept->icon ?> fs-4 text-secondary"></i></td>
                            <td class="fw-medium"><?= $dept->name ?></td>
                            <td class="text-muted small"><?= mb_strimwidth($dept->description, 0, 50, '...') ?></td>
                            <td>
                                <?php if ($dept->status == 'active'): ?>
                                    <span class="badge bg-success-pastel">เปิดใช้งาน</span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border">ปิดใช้งาน</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/admin/departments/edit/<?= $dept->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?= URLROOT ?>/admin/departments/delete/<?= $dept->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?');">
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
