<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">ตรวจสอบและติดตามข้อร้องเรียน ข้อเสนอแนะ จากผู้รับบริการและประชาชน</p>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="15%" class="ps-4">รหัสติดตาม (Code)</th>
                        <th width="15%">วันที่รับเรื่อง</th>
                        <th width="35%">หัวข้อเรื่องร้องเรียน / ผู้ส่ง</th>
                        <th width="15%">สถานะ</th>
                        <th width="20%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($complaints)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลเรื่องร้องเรียน
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($complaints as $comp): ?>
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-light text-dark border font-monospace px-3 py-2 fw-bold user-select-all">
                                    <?= htmlspecialchars($comp->tracking_code) ?>
                                </span>
                            </td>
                            <td>
                                <div class="small fw-semibold text-dark font-monospace"><?= date('d/m/Y', strtotime($comp->created_at)) ?></div>
                                <small class="text-muted"><?= date('H:i น.', strtotime($comp->created_at)) ?></small>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($comp->topic) ?></div>
                                <?php if($comp->is_anonymous): ?>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-2 py-1 small">
                                        <i class="bi bi-incognito me-1"></i> ไม่ประสงค์ออกนาม
                                    </span>
                                <?php else: ?>
                                    <small class="text-muted"><i class="bi bi-person me-1"></i> <?= htmlspecialchars($comp->fullname) ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($comp->status == 'pending'): ?>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border rounded-pill px-3 py-1">รอตรวจสอบ</span>
                                <?php elseif ($comp->status == 'investigating'): ?>
                                    <span class="badge bg-info-subtle text-info-emphasis border rounded-pill px-3 py-1">กำลังตรวจสอบ</span>
                                <?php elseif ($comp->status == 'resolved'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-1">ดำเนินการแล้ว</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border rounded-pill px-3 py-1">ยุติเรื่อง</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/admin/complaint/show/<?= $comp->id ?>" class="btn btn-sm btn-primary rounded-3">
                                        <i class="bi bi-search me-1"></i> ตรวจสอบ
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/complaint/delete/<?= $comp->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อร้องเรียนนี้ใช่หรือไม่?');">
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
