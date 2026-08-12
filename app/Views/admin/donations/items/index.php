<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/donationitem/create" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> เพิ่มรายการรับบริจาค</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="35%">หัวข้อรับบริจาค</th>
                        <th width="15%">ประเภท</th>
                        <th width="20%">ยอด/จำนวน</th>
                        <th width="10%">สถานะ</th>
                        <th width="15%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">ไม่มีข้อมูลรายการรับบริจาค</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td class="fw-medium">
                                <?= $item->title ?><br>
                                <small class="text-muted"><i class="bi bi-clock"></i> <?= date('d/m/Y H:i', strtotime($item->created_at)) ?></small>
                            </td>
                            <td>
                                <?php
                                    if($item->type == 'money') echo 'เงินบริจาค';
                                    else if($item->type == 'equipment') echo 'อุปกรณ์การแพทย์';
                                    else echo 'ทั่วไป';
                                ?>
                            </td>
                            <td>
                                <?php if($item->type == 'money' || $item->type == 'general'): ?>
                                    <?= number_format($item->current_amount, 2) ?> / <?= $item->target_amount ? number_format($item->target_amount, 2) : 'ไม่ระบุ' ?>
                                <?php else: ?>
                                    <?= number_format($item->current_quantity) ?> / <?= $item->target_quantity ? number_format($item->target_quantity) : 'ไม่ระบุ' ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($item->status == 'active'): ?>
                                    <span class="badge bg-success-pastel">เปิดรับบริจาค</span>
                                <?php elseif ($item->status == 'completed'): ?>
                                    <span class="badge bg-info-pastel text-dark">ปิดรับบริจาค (ครบแล้ว)</span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border">ปิดรับบริจาค</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/admin/donationitem/edit/<?= $item->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?= URLROOT ?>/admin/donationitem/delete/<?= $item->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');">
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
