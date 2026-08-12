<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="15%">รหัสติดตาม</th>
                        <th width="20%">วันที่รับเรื่อง</th>
                        <th width="30%">หัวข้อร้องเรียน</th>
                        <th width="20%">สถานะ</th>
                        <th width="15%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($complaints)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">ไม่มีข้อมูลเรื่องร้องเรียน</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($complaints as $comp): ?>
                        <tr>
                            <td><span class="fw-bold user-select-all"><?= $comp->tracking_code ?></span></td>
                            <td><?= date('d/m/Y H:i', strtotime($comp->created_at)) ?></td>
                            <td>
                                <div class="fw-medium text-dark"><?= $comp->topic ?></div>
                                <?php if($comp->is_anonymous): ?>
                                    <span class="badge bg-light text-muted border opacity-75">ไม่ประสงค์ออกนาม</span>
                                <?php else: ?>
                                    <div class="small text-muted">จาก: <?= $comp->fullname ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($comp->status == 'pending'): ?>
                                    <span class="badge bg-warning-pastel text-dark">รอตรวจสอบ</span>
                                <?php elseif ($comp->status == 'investigating'): ?>
                                    <span class="badge bg-info-pastel text-dark">กำลังตรวจสอบ</span>
                                <?php elseif ($comp->status == 'resolved'): ?>
                                    <span class="badge bg-success-pastel">ดำเนินการแล้ว</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-pastel">ยุติเรื่อง</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/admin/complaints/show/<?= $comp->id ?>" class="btn btn-sm btn-primary">เปิดดูรายละเอียด <i class="bi bi-arrow-right-short"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
