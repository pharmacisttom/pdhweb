<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">จัดการรายการบริการทางการแพทย์และบริการผู้ป่วยนอก/ใน</p>
    </div>
    <a href="<?= URLROOT ?>/admin/service/create" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-lg me-1"></i> เพิ่มบริการใหม่
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-4">ID</th>
                        <th width="35%">ชื่อบริการ / รายละเอียด</th>
                        <th width="20%">กลุ่มงาน / ฝ่าย</th>
                        <th width="15%">เวลาเปิดบริการ / สถานที่</th>
                        <th width="10%">สถานะ</th>
                        <th width="15%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($services)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลบริการผู้ป่วย
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($services as $service): ?>
                        <tr>
                            <td class="ps-4 fw-bold font-monospace text-muted"><?= $service->id ?></td>
                            <td>
                                <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($service->name) ?></div>
                                <small class="text-muted line-clamp-1" style="font-size: 0.8rem;">
                                    <?= mb_strimwidth(htmlspecialchars($service->description ?? ''), 0, 70, '...') ?>
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1">
                                    <?= htmlspecialchars($service->department_name ?? 'ไม่ระบุ') ?>
                                </span>
                            </td>
                            <td>
                                <div class="small fw-semibold text-dark"><i class="bi bi-clock text-primary me-1"></i><?= htmlspecialchars($service->open_time ?: 'ตามเวลาราชการ') ?></div>
                                <small class="text-muted"><i class="bi bi-geo-alt me-1"></i><?= htmlspecialchars($service->location ?: '-') ?></small>
                            </td>
                            <td>
                                <?php if (($service->status ?? 'active') == 'active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-1">เปิดบริการ</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">ปิดบริการ</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/admin/service/edit/<?= $service->id ?>" class="btn btn-sm btn-outline-primary rounded-3" title="แก้ไข">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/service/delete/<?= $service->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบบริการนี้ใช่หรือไม่?');">
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
