<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/doctors/create" class="btn btn-primary"><i class="bi bi-person-plus-fill me-1"></i> เพิ่มแพทย์</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="25%">ชื่อ-นามสกุล</th>
                        <th width="25%">ความเชี่ยวชาญ (Specialty)</th>
                        <th width="20%">ตำแหน่ง</th>
                        <th width="10%">สถานะ</th>
                        <th width="15%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($doctors)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">ไม่มีข้อมูลแพทย์</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td><?= $doctor->id ?></td>
                            <td class="fw-medium">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex justify-content-center align-items-center text-secondary me-2" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person-fill fs-5"></i>
                                    </div>
                                    <?= $doctor->prefix ?><?= $doctor->firstname ?> <?= $doctor->lastname ?>
                                </div>
                            </td>
                            <td><?= $doctor->specialty ?></td>
                            <td><?= $doctor->position ?></td>
                            <td>
                                <?php if ($doctor->status == 'active'): ?>
                                    <span class="badge bg-success-pastel">ปฏิบัติงาน</span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border">พักงาน/ลาออก</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/admin/doctors/edit/<?= $doctor->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?= URLROOT ?>/admin/doctors/delete/<?= $doctor->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลแพทย์ท่านนี้ใช่หรือไม่?');">
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
