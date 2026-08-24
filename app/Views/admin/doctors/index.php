<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">จัดการทำเนียบแพทย์ผู้เชี่ยวชาญและแพทย์ประจำโรงพยาบาลปลวกแดง</p>
    </div>
    <a href="<?= URLROOT ?>/admin/doctor/create" class="btn btn-primary rounded-3">
        <i class="bi bi-person-plus-fill me-1"></i> เพิ่มแพทย์ใหม่
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-4">ID</th>
                        <th width="30%">ชื่อ-นามสกุล แพทย์</th>
                        <th width="25%">สาขาความเชี่ยวชาญ (Specialty)</th>
                        <th width="20%">ตำแหน่ง</th>
                        <th width="10%">สถานะ</th>
                        <th width="10%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($doctors)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลแพทย์
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td class="ps-4 fw-bold font-monospace text-muted"><?= $doctor->id ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle overflow-hidden bg-light me-2 border d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                        <?php if(!empty($doctor->profile_image) && $doctor->profile_image != 'default-doctor.jpg'): ?>
                                            <img src="<?= URLROOT ?>/assets/images/doctors/<?= htmlspecialchars($doctor->profile_image) ?>" alt="Doctor" style="width: 100%; height: 100%; object-fit: cover;">
                                        <?php else: ?>
                                            <i class="bi bi-person-fill fs-5 text-secondary"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="fw-bold text-dark">
                                        <?= htmlspecialchars($doctor->prefix) ?><?= htmlspecialchars($doctor->firstname) ?> <?= htmlspecialchars($doctor->lastname) ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1">
                                    <?= htmlspecialchars($doctor->specialty ?: 'แพทย์ทั่วไป') ?>
                                </span>
                            </td>
                            <td>
                                <small class="text-muted"><?= htmlspecialchars($doctor->position ?: '-') ?></small>
                            </td>
                            <td>
                                <?php if ($doctor->status == 'active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-1">ปฏิบัติงาน</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">พักงาน/ลาออก</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/admin/doctor/edit/<?= $doctor->id ?>" class="btn btn-sm btn-outline-primary rounded-3" title="แก้ไข">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/doctor/delete/<?= $doctor->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลแพทย์ท่านนี้ใช่หรือไม่?');">
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
