<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">จัดการโครงการระดมทุนและรายการรับบริจาค แคมเปญการให้ไม่มีสิ้นสุด</p>
    </div>
    <a href="<?= URLROOT ?>/admin/donationitem/create" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-lg me-1"></i> เพิ่มโครงการรับบริจาค
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="ps-4">ID</th>
                        <th width="35%">หัวข้อรับบริจาค / โครงการ</th>
                        <th width="15%">ประเภท</th>
                        <th width="20%">ยอดระดมทุน / เป้าหมาย</th>
                        <th width="12%">สถานะ</th>
                        <th width="13%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลโครงการรับบริจาค
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                        <tr>
                            <td class="ps-4 fw-bold font-monospace text-muted"><?= $item->id ?></td>
                            <td>
                                <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($item->title) ?></div>
                                <small class="text-muted"><i class="bi bi-clock me-1"></i><?= date('d/m/Y H:i น.', strtotime($item->created_at)) ?></small>
                            </td>
                            <td>
                                <?php
                                    if($item->type == 'money') echo '<span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1">เงินบริจาค</span>';
                                    else if($item->type == 'equipment') echo '<span class="badge bg-info-subtle text-info-emphasis border rounded-pill px-3 py-1">อุปกรณ์การแพทย์</span>';
                                    else echo '<span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">ทั่วไป</span>';
                                ?>
                            </td>
                            <td>
                                <?php if($item->type == 'money' || $item->type == 'general'): ?>
                                    <div class="fw-bold text-success font-monospace">฿<?= number_format($item->current_amount, 2) ?></div>
                                    <small class="text-muted">เป้าหมาย: <?= $item->target_amount ? '฿' . number_format($item->target_amount, 2) : 'ไม่จำกัด' ?></small>
                                <?php else: ?>
                                    <div class="fw-bold text-success font-monospace"><?= number_format($item->current_quantity) ?> ชิ้น</div>
                                    <small class="text-muted">เป้าหมาย: <?= $item->target_quantity ? number_format($item->target_quantity) . ' ชิ้น' : 'ไม่จำกัด' ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($item->status == 'active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-50 rounded-pill px-3 py-2 fw-semibold">
                                        <i class="bi bi-check-circle me-1"></i> เปิดรับบริจาค
                                    </span>
                                <?php elseif ($item->status == 'completed'): ?>
                                    <span class="badge bg-info-subtle text-info-emphasis border border-info border-opacity-50 rounded-pill px-3 py-2 fw-semibold">
                                        <i class="bi bi-check-all me-1"></i> ครบตามเป้าแล้ว
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-2 fw-semibold">
                                        ปิดรับบริจาค
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/admin/donationitem/edit/<?= $item->id ?>" class="btn btn-sm btn-outline-primary rounded-3" title="แก้ไข">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/donationitem/delete/<?= $item->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');">
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
