<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">จัดการคลินิกเฉพาะทางและคลินิกเฉพาะโรค โรงพยาบาลปลวกแดง</p>
    </div>
    <a href="<?= URLROOT ?>/admin/clinic/create" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-lg me-1"></i> เพิ่มคลินิกใหม่
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-4">ID</th>
                        <th width="25%">ชื่อคลินิก</th>
                        <th width="20%">กลุ่มงาน / ฝ่าย</th>
                        <th width="20%">สถานที่ตั้ง</th>
                        <th width="15%">เบอร์ติดต่อ</th>
                        <th width="5%">สถานะ</th>
                        <th width="10%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clinics)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลคลินิก
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($clinics as $clinic): ?>
                        <tr>
                            <td class="ps-4 fw-bold font-monospace text-muted"><?= $clinic->id ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($clinic->name) ?></div>
                                <small class="text-muted"><?= htmlspecialchars(mb_strimwidth($clinic->description ?? '', 0, 40, '...')) ?></small>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1">
                                    <?= htmlspecialchars($clinic->department_name ?? 'ไม่ระบุ') ?>
                                </span>
                            </td>
                            <td>
                                <small class="text-dark"><i class="bi bi-geo-alt text-primary me-1"></i><?= htmlspecialchars($clinic->location ?: '-') ?></small>
                            </td>
                            <td>
                                <small class="text-muted"><i class="bi bi-telephone me-1"></i><?= htmlspecialchars($clinic->phone ?: '-') ?></small>
                            </td>
                            <td>
                                <?php if ($clinic->status == 'active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-1">เปิด</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">ปิด</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/admin/clinic/edit/<?= $clinic->id ?>" class="btn btn-sm btn-outline-primary rounded-3" title="แก้ไข">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/clinic/delete/<?= $clinic->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบคลินิกนี้ใช่หรือไม่?');">
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
