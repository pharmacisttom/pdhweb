<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/clinics/create" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> เพิ่มคลินิก</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="25%">ชื่อคลินิก</th>
                        <th width="20%">กลุ่มงาน</th>
                        <th width="20%">สถานที่</th>
                        <th width="15%">เบอร์ติดต่อ</th>
                        <th width="5%">สถานะ</th>
                        <th width="10%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clinics)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">ไม่มีข้อมูลคลินิก</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($clinics as $clinic): ?>
                        <tr>
                            <td><?= $clinic->id ?></td>
                            <td class="fw-medium"><?= $clinic->name ?></td>
                            <td><?= $clinic->department_name ?? '<span class="text-muted">-</span>' ?></td>
                            <td><?= $clinic->location ?></td>
                            <td><?= $clinic->phone ?></td>
                            <td>
                                <?php if ($clinic->status == 'active'): ?>
                                    <span class="badge bg-success-pastel">เปิด</span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border">ปิด</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/admin/clinics/edit/<?= $clinic->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?= URLROOT ?>/admin/clinics/delete/<?= $clinic->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?');">
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
