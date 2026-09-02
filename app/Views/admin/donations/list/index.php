<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">ตรวจสอบสลิปหลักฐานการโอนเงิน อนุมัติ แก้ไข และจัดการข้อมูลผู้ร่วมบริจาค</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= URLROOT ?>/admin/donationitem" class="btn btn-outline-primary rounded-3">
            <i class="bi bi-box2-heart me-1"></i> จัดการโครงการรับบริจาค
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-4">ID</th>
                        <th width="24%">ชื่อผู้บริจาค</th>
                        <th width="24%">โครงการที่บริจาค</th>
                        <th width="14%">ยอดเงินบริจาค</th>
                        <th width="13%">วันที่บริจาค</th>
                        <th width="10%">สถานะ</th>
                        <th width="10%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($donations)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลการบริจาค
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($donations as $donation): ?>
                        <tr>
                            <td class="ps-4 fw-bold font-monospace text-muted">#<?= $donation->id ?></td>
                            <td>
                                <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($donation->donor_name) ?></div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-light text-secondary font-monospace border"><?= htmlspecialchars($donation->tracking_code ?? '-') ?></span>
                                    <small class="text-muted"><i class="bi bi-telephone me-1"></i><?= htmlspecialchars($donation->donor_phone ?: '-') ?></small>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium text-dark small"><?= htmlspecialchars($donation->item_title) ?></div>
                            </td>
                            <td>
                                <div class="fw-bold text-success font-monospace" style="font-size: 0.95rem;">
                                    <?php if (!empty($donation->amount)): ?>
                                        ฿<?= number_format($donation->amount, 2) ?>
                                    <?php elseif (!empty($donation->quantity)): ?>
                                        <?= number_format($donation->quantity) ?> ชิ้น
                                    <?php else: ?>
                                        ทั่วไป
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="small text-dark fw-semibold font-monospace"><?= date('d/m/Y', strtotime($donation->created_at)) ?></div>
                                <small class="text-muted"><?= date('H:i น.', strtotime($donation->created_at)) ?></small>
                            </td>
                            <td>
                                <?php if ($donation->status == 'pending'): ?>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning border-opacity-50 rounded-pill px-3 py-1 fw-semibold">
                                        <i class="bi bi-hourglass-split me-1"></i> รอตรวจ
                                    </span>
                                <?php elseif ($donation->status == 'approved'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-50 rounded-pill px-3 py-1 fw-semibold">
                                        <i class="bi bi-check-circle-fill me-1"></i> อนุมัติ
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-50 rounded-pill px-3 py-1 fw-semibold">
                                        <i class="bi bi-x-circle-fill me-1"></i> ปฏิเสธ
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/admin/donation/show/<?= $donation->id ?>" class="btn btn-sm btn-outline-info rounded-3" title="ตรวจสอบสลิป">
                                        <i class="bi bi-search"></i>
                                    </a>
                                    <a href="<?= URLROOT ?>/admin/donation/edit/<?= $donation->id ?>" class="btn btn-sm btn-outline-primary rounded-3" title="แก้ไขข้อมูล">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/donation/delete/<?= $donation->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลการบริจาคนี้ใช่หรือไม่? (หากลบ ข้อมูลจะหายไปถาวร)');">
                                        <?= \App\Helpers\Security::csrfField() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="ลบรายการ">
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
