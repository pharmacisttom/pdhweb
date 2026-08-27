<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="h3 mb-1 text-gray-800 fw-bold"><i class="bi bi-calendar-check text-primary me-2"></i><?= $page_title ?></h2>
        <p class="text-muted small mb-0">ระบบตรวจสอบโควตานัดหมายรายวัน ควบคุมสถานะคิวตรวจ และดูใบนัดพร้อม QR Code</p>
    </div>
    <a href="<?= URLROOT ?>/appointment" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
        <i class="bi bi-box-arrow-up-right me-1"></i> เปิดหน้าปฏิทินจองคิวผู้ป่วย
    </a>
</div>

<!-- Today's Quota Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4 p-3 bg-white border-start border-primary border-4">
            <small class="text-muted fw-bold">คิวนัดวันนี้ทั้งหมด</small>
            <div class="d-flex justify-content-between align-items-end mt-2">
                <h3 class="fw-bold mb-0 text-dark"><?= $todayStats->total_today ?? 0 ?> / <?= $dailyQuota ?></h3>
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">โควตา 50</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4 p-3 bg-white border-start border-warning border-4">
            <small class="text-muted fw-bold">ช่วงเช้า (08:30-11:30)</small>
            <div class="d-flex justify-content-between align-items-end mt-2">
                <h3 class="fw-bold mb-0 text-warning"><?= $todayStats->morning_today ?? 0 ?> / 25</h3>
                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">เหลือ <?= max(0, 25 - ($todayStats->morning_today ?? 0)) ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4 p-3 bg-white border-start border-info border-4">
            <small class="text-muted fw-bold">ช่วงบ่าย (13:00-15:30)</small>
            <div class="d-flex justify-content-between align-items-end mt-2">
                <h3 class="fw-bold mb-0 text-info"><?= $todayStats->afternoon_today ?? 0 ?> / 25</h3>
                <span class="badge bg-info bg-opacity-10 text-info rounded-pill">เหลือ <?= max(0, 25 - ($todayStats->afternoon_today ?? 0)) ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4 p-3 bg-white border-start border-success border-4">
            <small class="text-muted fw-bold">ยืนยันแล้ววันนี้</small>
            <div class="d-flex justify-content-between align-items-end mt-2">
                <h3 class="fw-bold mb-0 text-success"><?= $todayStats->confirmed_today ?? 0 ?></h3>
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">พร้อมตรวจ</span>
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="<?= URLROOT ?>/admin/appointments" class="row g-2 align-items-center">
            <div class="col-md-3">
                <label class="small text-muted fw-bold mb-1">กรองตามวันที่นัด:</label>
                <input type="date" name="date" class="form-control form-control-sm" value="<?= htmlspecialchars($filterDate) ?>">
            </div>
            <div class="col-md-3">
                <label class="small text-muted fw-bold mb-1">แผนก:</label>
                <select name="department_id" class="form-select form-select-sm">
                    <option value="">-- ทุกแผนก --</option>
                    <?php foreach($departments as $d): ?>
                        <option value="<?= $d->id ?>" <?= ($filterDept == $d->id) ? 'selected' : '' ?>><?= htmlspecialchars($d->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="small text-muted fw-bold mb-1">สถานะ:</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">-- ทุกสถานะ --</option>
                    <option value="pending" <?= ($filterStatus == 'pending') ? 'selected' : '' ?>>รอยืนยัน</option>
                    <option value="confirmed" <?= ($filterStatus == 'confirmed') ? 'selected' : '' ?>>ยืนยันแล้ว</option>
                    <option value="completed" <?= ($filterStatus == 'completed') ? 'selected' : '' ?>>เสร็จสิ้น</option>
                    <option value="cancelled" <?= ($filterStatus == 'cancelled') ? 'selected' : '' ?>>ยกเลิก</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3"><i class="bi bi-search me-1"></i> ค้นหา</button>
                <a href="<?= URLROOT ?>/admin/appointments" class="btn btn-sm btn-light border rounded-pill px-3">ล้างค่า</a>
            </div>
        </form>
    </div>
</div>

<!-- Appointments Table -->
<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">รหัสคิว / Ref</th>
                        <th>ข้อมูลผู้ป่วย</th>
                        <th>วันที่และช่วงเวลานัด</th>
                        <th>แผนก / แพทย์</th>
                        <th>สถานะคิว</th>
                        <th class="text-center pe-4">จัดการ & ใบนัด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($appointments)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-calendar-x fs-1 d-block mb-2 text-muted"></i>
                            ไม่พบคิวนัดหมายตามเงื่อนไขที่เลือก
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($appointments as $appt): ?>
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-primary fs-6 font-monospace px-2 py-1"><?= !empty($appt->queue_code) ? htmlspecialchars($appt->queue_code) : 'Q-'.str_pad($appt->id, 3, '0', STR_PAD_LEFT) ?></span>
                                <div class="small text-muted font-monospace mt-1"><?= htmlspecialchars($appt->booking_ref ?? 'PDH-'.$appt->id) ?></div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($appt->patient_name) ?></div>
                                <div class="small text-muted"><i class="bi bi-telephone me-1"></i><?= htmlspecialchars($appt->phone) ?></div>
                                <?php if($appt->hn_number): ?>
                                    <div class="small text-muted">HN: <?= htmlspecialchars($appt->hn_number) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-bold text-primary"><i class="bi bi-calendar3 me-1"></i><?= date('d/m/Y', strtotime($appt->appointment_date)) ?></div>
                                <div class="small text-muted">
                                    <span class="badge bg-light text-dark border">
                                        <?= ($appt->time_slot === 'morning') ? '🌅 ช่วงเช้า (08:30-11:30)' : '🌇 ช่วงบ่าย (13:00-15:30)' ?>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium"><?= htmlspecialchars($appt->department_name ?? 'ตรวจทั่วไป') ?></div>
                                <?php if($appt->doctor_name): ?>
                                    <div class="small text-muted"><i class="bi bi-person-badge me-1"></i><?= htmlspecialchars($appt->doctor_name) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($appt->status == 'pending'): ?>
                                    <span class="badge bg-warning bg-opacity-10 text-dark rounded-pill px-3 py-1">รอยืนยัน</span>
                                <?php elseif ($appt->status == 'confirmed'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">ยืนยันแล้ว</span>
                                <?php elseif ($appt->status == 'completed'): ?>
                                    <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1">เสร็จสิ้น</span>
                                <?php else: ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1">ยกเลิก</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <!-- View Smart Digital Ticket with QR -->
                                    <?php if(!empty($appt->booking_ref)): ?>
                                        <a href="<?= URLROOT ?>/appointment/ticket/<?= $appt->booking_ref ?>" target="_blank" class="btn btn-sm btn-outline-info rounded-pill" title="ดูใบนัดดิจิทัลและ QR Code">
                                            <i class="bi bi-qr-code-scan"></i> ใบนัด
                                        </a>
                                    <?php endif; ?>

                                    <!-- Update Status Form -->
                                    <form action="<?= URLROOT ?>/admin/appointment/updateStatus/<?= $appt->id ?>" method="POST" class="d-inline">
                                        <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                                        <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                            <option value="pending" <?= $appt->status == 'pending' ? 'selected' : '' ?>>รอยืนยัน</option>
                                            <option value="confirmed" <?= $appt->status == 'confirmed' ? 'selected' : '' ?>>ยืนยันแล้ว</option>
                                            <option value="completed" <?= $appt->status == 'completed' ? 'selected' : '' ?>>เสร็จสิ้น</option>
                                            <option value="cancelled" <?= $appt->status == 'cancelled' ? 'selected' : '' ?>>ยกเลิก</option>
                                        </select>
                                    </form>

                                    <!-- Delete Form -->
                                    <form action="<?= URLROOT ?>/admin/appointment/delete/<?= $appt->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลนัดหมายนี้ใช่หรือไม่?');">
                                        <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" style="width: 32px; height: 32px; padding: 0;" title="ลบ"><i class="bi bi-trash"></i></button>
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
