<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/procurements/create" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> เพิ่มประกาศใหม่</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="10%">วันที่ประกาศ</th>
                        <th width="35%">หัวข้อประกาศ</th>
                        <th width="20%">หมวดหมู่</th>
                        <th width="15%">ผู้เพิ่มข้อมูล</th>
                        <th width="10%">สถานะ</th>
                        <th width="10%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($procurements)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">ไม่มีข้อมูลจัดซื้อจัดจ้าง</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($procurements as $proc): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($proc->published_at)) ?></td>
                            <td>
                                <div class="fw-medium text-primary"><?= $proc->title ?></div>
                                <?php if($proc->project_budget): ?>
                                    <div class="small text-muted">งบประมาณ: <?= number_format($proc->project_budget, 2) ?> ฿</div>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= $proc->category ?></span></td>
                            <td><?= $proc->firstname ?> <?= $proc->lastname ?></td>
                            <td>
                                <?php if ($proc->status == 'active'): ?>
                                    <span class="badge bg-success-pastel">ใช้งานปกติ</span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border">เก็บถาวร</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/admin/procurements/edit/<?= $proc->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?= URLROOT ?>/admin/procurements/delete/<?= $proc->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?');">
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
