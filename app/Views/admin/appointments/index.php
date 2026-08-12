<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>ข้อมูลผู้ป่วย</th>
                        <th>วันที่และเวลานัด</th>
                        <th>แผนก / แพทย์</th>
                        <th>สถานะ</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($appointments)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">ไม่มีข้อมูลการนัดหมาย</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($appointments as $appt): ?>
                        <tr>
                            <td><?= $appt->id ?></td>
                            <td>
                                <div class="fw-bold"><?= $appt->patient_name ?></div>
                                <div class="small text-muted"><i class="bi bi-telephone"></i> <?= $appt->phone ?></div>
                                <?php if($appt->hn_number): ?>
                                    <div class="small text-muted">HN: <?= $appt->hn_number ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-medium text-primary"><i class="bi bi-calendar3"></i> <?= date('d/m/Y', strtotime($appt->appointment_date)) ?></div>
                                <?php if($appt->appointment_time): ?>
                                    <div class="small text-muted"><i class="bi bi-clock"></i> <?= date('H:i', strtotime($appt->appointment_time)) ?> น.</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div><?= $appt->department_name ?></div>
                                <?php if($appt->doctor_name): ?>
                                    <div class="small text-muted">แพทย์: <?= $appt->doctor_name ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($appt->status == 'pending'): ?>
                                    <span class="badge bg-warning-pastel text-dark">รอยืนยัน</span>
                                <?php elseif ($appt->status == 'confirmed'): ?>
                                    <span class="badge bg-info-pastel">ยืนยันแล้ว</span>
                                <?php elseif ($appt->status == 'completed'): ?>
                                    <span class="badge bg-success-pastel">เสร็จสิ้น</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-pastel">ยกเลิก</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <!-- Update Status Form -->
                                <form action="<?= URLROOT ?>/admin/appointments/updateStatus/<?= $appt->id ?>" method="POST" class="d-inline">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                        <option value="pending" <?= $appt->status == 'pending' ? 'selected' : '' ?>>รอยืนยัน</option>
                                        <option value="confirmed" <?= $appt->status == 'confirmed' ? 'selected' : '' ?>>ยืนยันแล้ว</option>
                                        <option value="completed" <?= $appt->status == 'completed' ? 'selected' : '' ?>>เสร็จสิ้น</option>
                                        <option value="cancelled" <?= $appt->status == 'cancelled' ? 'selected' : '' ?>>ยกเลิก</option>
                                    </select>
                                </form>

                                <form action="<?= URLROOT ?>/admin/appointments/delete/<?= $appt->id ?>" method="POST" class="d-inline ms-1" onsubmit="return confirm('คุณต้องการลบข้อมูลนัดหมายนี้ใช่หรือไม่?');">
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
