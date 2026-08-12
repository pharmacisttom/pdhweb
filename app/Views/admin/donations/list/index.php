<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">ชื่อผู้บริจาค</th>
                        <th width="30%">รายการที่บริจาค</th>
                        <th width="15%">ยอด/จำนวน</th>
                        <th width="15%">วันที่บริจาค</th>
                        <th width="10%">สถานะ</th>
                        <th width="5%" class="text-center">ตรวจสอบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($donations)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">ไม่มีข้อมูลการบริจาค</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($donations as $donation): ?>
                        <tr>
                            <td><?= $donation->id ?></td>
                            <td class="fw-medium">
                                <?= $donation->donor_name ?><br>
                                <small class="text-muted"><i class="bi bi-telephone"></i> <?= $donation->donor_phone ?: '-' ?></small>
                            </td>
                            <td><?= $donation->item_title ?></td>
                            <td>
                                <?php if (!empty($donation->amount)): ?>
                                    <?= number_format($donation->amount, 2) ?> บาท
                                <?php elseif (!empty($donation->quantity)): ?>
                                    <?= number_format($donation->quantity) ?> ชิ้น
                                <?php else: ?>
                                    ทั่วไป
                                <?php endif; ?>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($donation->created_at)) ?></td>
                            <td>
                                <?php if ($donation->status == 'pending'): ?>
                                    <span class="badge bg-warning-pastel text-dark">รอตรวจสอบ</span>
                                <?php elseif ($donation->status == 'approved'): ?>
                                    <span class="badge bg-success-pastel">อนุมัติแล้ว</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-pastel">ไม่อนุมัติ</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/admin/donation/show/<?= $donation->id ?>" class="btn btn-sm btn-outline-info"><i class="bi bi-search"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
