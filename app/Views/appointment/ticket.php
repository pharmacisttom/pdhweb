<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Top Status Alert -->
            <div class="alert alert-success border-0 rounded-4 shadow-sm p-4 mb-4 d-flex align-items-center gap-3">
                <i class="bi bi-check-circle-fill text-success fs-1"></i>
                <div>
                    <h5 class="fw-bold mb-1">บันทึกการจองคิวนัดหมายสำเร็จเรียบร้อยแล้ว!</h5>
                    <p class="mb-0 small text-success-emphasis">
                        ระบบได้บันทึกคิวตรวจของท่านลงในปฏิทินโรงพยาบาลแล้ว กรุณาบันทึกหรือแคปหน้าจอใบนัดนี้ไว้แสดงต่อเจ้าหน้าที่
                    </p>
                </div>
            </div>

            <!-- Digital Smart Ticket Card -->
            <div class="card-modern p-0 overflow-hidden shadow-lg mb-4" id="printableTicket">
                <!-- Ticket Header -->
                <div class="p-4 text-white text-center" style="background: linear-gradient(135deg, #0d9488, #0f172a);">
                    <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                        <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="rounded-circle border border-2 border-white" width="36" height="36" style="object-fit: cover;">
                        <span class="fw-bold fs-5">โรงพยาบาลปลวกแดง</span>
                    </div>
                    <h3 class="fw-bold mb-1">ใบนัดหมายคิวตรวจผู้ป่วยออนไลน์</h3>
                    <small class="text-white-50">Pluak Daeng Hospital Digital Appointment Pass</small>
                </div>

                <div class="p-4 p-md-5 bg-white">
                    <div class="row g-4 align-items-center">
                        <!-- Left Info Details -->
                        <div class="col-md-7 border-end-md">
                            <div class="mb-4">
                                <span class="badge bg-primary-light text-primary px-3 py-1 rounded-pill mb-2 fw-bold">หมายเลขใบนัด (Ref Code)</span>
                                <h4 class="fw-bold text-dark font-monospace mb-0"><?= htmlspecialchars($appointment->booking_ref) ?></h4>
                            </div>

                            <div class="p-3 rounded-4 bg-light mb-4 border">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">รหัสคิวลำดับตรวจ</small>
                                        <strong class="fs-4 text-primary font-monospace"><?= htmlspecialchars($appointment->queue_code) ?></strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">ช่วงเวลานัดหมาย</small>
                                        <strong class="text-dark">
                                            <?= ($appointment->time_slot === 'morning') ? 'ช่วงเช้า (08:30-11:30)' : 'ช่วงบ่าย (13:00-15:30)' ?>
                                        </strong>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-2 d-flex justify-content-between">
                                    <span class="text-muted">ชื่อผู้รับบริการ:</span>
                                    <strong class="text-dark"><?= htmlspecialchars($appointment->patient_name) ?></strong>
                                </li>
                                <li class="mb-2 d-flex justify-content-between">
                                    <span class="text-muted">หมายเลข HN:</span>
                                    <strong class="text-dark"><?= !empty($appointment->hn_number) ? htmlspecialchars($appointment->hn_number) : '-' ?></strong>
                                </li>
                                <li class="mb-2 d-flex justify-content-between">
                                    <span class="text-muted">เบอร์โทรศัพท์:</span>
                                    <strong class="text-dark"><?= htmlspecialchars($appointment->phone) ?></strong>
                                </li>
                                <li class="mb-2 d-flex justify-content-between">
                                    <span class="text-muted">วันที่นัดตรวจ:</span>
                                    <strong class="text-primary"><?= date('d/m/Y', strtotime($appointment->appointment_date)) ?></strong>
                                </li>
                                <li class="mb-2 d-flex justify-content-between">
                                    <span class="text-muted">แผนก / คลินิก:</span>
                                    <strong class="text-dark"><?= htmlspecialchars($appointment->department_name ?? 'ตรวจโรคทั่วไป') ?></strong>
                                </li>
                                <?php if(!empty($appointment->doctor_name)): ?>
                                    <li class="mb-2 d-flex justify-content-between">
                                        <span class="text-muted">แพทย์ผู้นัด:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($appointment->doctor_name) ?></strong>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <!-- Right QR Code & Check-in info -->
                        <div class="col-md-5 text-center">
                            <div class="p-3 bg-light rounded-4 border d-inline-block shadow-sm mb-3">
                                <?php
                                    $qrData = urlencode(URLROOT . '/appointment/ticket/' . $appointment->booking_ref);
                                    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=" . $qrData;
                                ?>
                                <img src="<?= $qrUrl ?>" alt="QR Code" class="img-fluid rounded-3" style="width: 170px; height: 170px;">
                            </div>
                            <div class="small fw-bold text-dark">สแกน QR เพื่อเช็คอินที่ตู้ Kiosk</div>
                            <small class="text-muted d-block mt-1">หรือแสดงต่อเจ้าหน้าที่ห้องบัตร</small>
                        </div>
                    </div>
                </div>

                <!-- Ticket Footer Note -->
                <div class="p-3 bg-light border-top text-center text-muted small">
                    <i class="bi bi-info-circle text-primary me-1"></i> กรุณาเดินทางมาถึงก่อนเวลานัดหมายอย่างน้อย 15 นาที พร้อมนำบัตรประชาชนมาด้วย
                </div>
            </div>

            <!-- Action Buttons: LINE OA & Calendar -->
            <div class="card-modern p-4 mb-4">
                <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-bell-fill text-warning me-2"></i>บริการแจ้งเตือนนัดหมายอัตโนมัติ</h5>
                
                <div class="row g-3">
                    <!-- LINE OA Reminder Button -->
                    <div class="col-md-6">
                        <a href="<?= htmlspecialchars($lineUrl) ?>" target="_blank" class="btn btn-success w-100 py-3 rounded-4 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-line fs-4"></i>
                            <div class="text-start">
                                <div style="font-size: 0.95rem;">แจ้งเตือนผ่าน LINE OA</div>
                                <small style="font-size: 0.75rem; opacity: 0.9;">แอดไลน์ <?= htmlspecialchars($lineOaId) ?> เพื่อรับแจ้งเตือนก่อนวันนัด</small>
                            </div>
                        </a>
                    </div>

                    <!-- Add to Google Calendar -->
                    <?php
                        $startDateTime = date('Ymd\THis', strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time));
                        $endDateTime = date('Ymd\THis', strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time . ' +2 hours'));
                        $calTitle = urlencode("นัดตรวจโรงพยาบาลปลวกแดง (คิว: " . $appointment->queue_code . ")");
                        $calDetails = urlencode("ใบนัดตรวจผู้ป่วย: " . $appointment->patient_name . " แผนก: " . ($appointment->department_name ?? '') . " รหัสอ้างอิง: " . $appointment->booking_ref);
                        $calLocation = urlencode("โรงพยาบาลปลวกแดง อ.ปลวกแดง จ.ระยอง");
                        $googleCalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE&text={$calTitle}&dates={$startDateTime}/{$endDateTime}&details={$calDetails}&location={$calLocation}";
                    ?>
                    <div class="col-md-6">
                        <a href="<?= $googleCalUrl ?>" target="_blank" class="btn btn-outline-primary w-100 py-3 rounded-4 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-calendar-plus fs-4"></i>
                            <div class="text-start">
                                <div style="font-size: 0.95rem;">เพิ่มลง Google Calendar</div>
                                <small class="text-muted" style="font-size: 0.75rem;">บันทึกเตือนความจำลงปฏิทินมือถือ</small>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
                    <button type="button" onclick="window.print()" class="btn btn-light border rounded-pill px-4">
                        <i class="bi bi-printer me-1"></i> พิมพ์ใบนัด
                    </button>
                    <a href="<?= URLROOT ?>/appointment" class="btn btn-light border rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> กลับหน้าปฏิทินคิว
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printableTicket, #printableTicket * {
        visibility: visible;
    }
    #printableTicket {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
}
</style>
