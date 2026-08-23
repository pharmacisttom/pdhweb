<!-- Smart Calendar Queue Booking Hero -->
<div class="hero-wrapper py-5 mb-4 text-center">
    <div class="container">
        <div class="section-badge mb-3"><i class="bi bi-calendar-check-fill text-primary"></i> Smart Calendar Queue Booking</div>
        <h1 class="hero-title mb-2">ระบบจองคิวนัดหมายออนไลน์ (จำลองปฏิทินคิว)</h1>
        <p class="hero-subtitle mx-auto" style="max-width: 650px;">
            ตรวจสอบจำนวนโควตาคิวที่เปิดรับและคิวที่จองแล้วในแต่ละวัน พร้อมเลือกช่วงเวลาและรับ QR Code แจ้งเตือนผ่าน LINE OA อัตโนมัติ
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <!-- Flash Messages -->
    <?php if($msg = \App\Core\Controller::getFlash('app_error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $msg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Calendar Month Navigation Bar -->
    <?php
        $thaiMonths = [
            1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน',
            5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม',
            9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'
        ];
        
        $prevMonth = $month - 1;
        $prevYear = $year;
        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }

        $nextMonth = $month + 1;
        $nextYear = $year;
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        $firstDayOfMonth = date('w', strtotime("$year-$month-01"));
        $daysInMonth = date('t', strtotime("$year-$month-01"));
    ?>

    <div class="card-modern p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <a href="<?= URLROOT ?>/appointment?year=<?= $prevYear ?>&month=<?= $prevMonth ?>&department_id=<?= $selected_department ?>" class="btn btn-light border rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <h4 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-calendar-month text-primary me-2"></i><?= $thaiMonths[$month] ?> <?= $year + 543 ?>
                </h4>
                <a href="<?= URLROOT ?>/appointment?year=<?= $nextYear ?>&month=<?= $nextMonth ?>&department_id=<?= $selected_department ?>" class="btn btn-light border rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>

            <!-- Department Filter -->
            <div class="d-flex align-items-center gap-2">
                <label class="small text-muted fw-bold mb-0 text-nowrap">เลือกแผนก:</label>
                <select class="form-select form-control-modern" onchange="location = this.value;">
                    <option value="<?= URLROOT ?>/appointment?year=<?= $year ?>&month=<?= $month ?>">-- ทุกแผนก --</option>
                    <?php foreach($departments as $dept): ?>
                        <option value="<?= URLROOT ?>/appointment?year=<?= $year ?>&month=<?= $month ?>&department_id=<?= $dept->id ?>" <?= ($selected_department == $dept->id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Legend Status -->
        <div class="d-flex flex-wrap gap-3 mt-3 pt-3 border-top small text-muted">
            <div class="d-flex align-items-center gap-1"><span class="badge bg-success rounded-circle p-1"></span> ว่าง (> 20 คิว)</div>
            <div class="d-flex align-items-center gap-1"><span class="badge bg-warning rounded-circle p-1"></span> เหลือน้อย (< 10 คิว)</div>
            <div class="d-flex align-items-center gap-1"><span class="badge bg-danger rounded-circle p-1"></span> เต็มแล้ว (0 คิว)</div>
            <div class="d-flex align-items-center gap-1"><span class="badge bg-secondary rounded-circle p-1"></span> ปิดรับ / วันหยุด</div>
        </div>
    </div>

    <!-- Calendar Table Grid -->
    <div class="card-modern p-0 overflow-hidden mb-5">
        <div class="table-responsive">
            <table class="table table-bordered mb-0 text-center" style="table-layout: fixed;">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 text-danger" style="width: 14.28%;">อาทิตย์</th>
                        <th class="py-3" style="width: 14.28%;">จันทร์</th>
                        <th class="py-3" style="width: 14.28%;">อังคาร</th>
                        <th class="py-3" style="width: 14.28%;">พุธ</th>
                        <th class="py-3" style="width: 14.28%;">พฤหัสบดี</th>
                        <th class="py-3" style="width: 14.28%;">ศุกร์</th>
                        <th class="py-3 text-secondary" style="width: 14.28%;">เสาร์</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $col = 0;
                        // Empty cells before first day
                        for ($i = 0; $i < $firstDayOfMonth; $i++) {
                            echo '<td class="bg-light text-muted p-2" style="height: 105px;"></td>';
                            $col++;
                        }

                        // Days of month
                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                            $dayOfWeek = date('w', strtotime($dateStr));
                            $isWeekend = ($dayOfWeek == 0 || $dayOfWeek == 6);
                            $isPast = (strtotime($dateStr) < strtotime(date('Y-m-d')));
                            
                            $booked = $monthBookings[$dateStr]['total'] ?? 0;
                            $available = max(0, $dailyQuota - $booked);
                            $isFull = ($available <= 0);

                            if ($col % 7 == 0 && $col > 0) {
                                echo '</tr><tr>';
                            }
                            $col++;

                            // Style determination
                            if ($isWeekend || $isPast) {
                                $cellBg = 'bg-light text-muted opacity-50';
                                $statusBadge = '<span class="badge bg-secondary text-white rounded-pill" style="font-size: 0.68rem;">ปิดรับ</span>';
                                $clickable = false;
                            } elseif ($isFull) {
                                $cellBg = 'bg-danger bg-opacity-10';
                                $statusBadge = '<span class="badge bg-danger rounded-pill" style="font-size: 0.68rem;">เต็ม (0/50)</span>';
                                $clickable = false;
                            } elseif ($available <= 10) {
                                $cellBg = 'bg-warning bg-opacity-10';
                                $statusBadge = '<span class="badge bg-warning text-dark rounded-pill" style="font-size: 0.68rem;">เหลือน้อย (' . $available . '/50)</span>';
                                $clickable = true;
                            } else {
                                $cellBg = 'bg-white';
                                $statusBadge = '<span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size: 0.68rem;">ว่าง ' . $available . '/50</span>';
                                $clickable = true;
                            }
                        ?>
                            <td class="<?= $cellBg ?> p-2 align-top position-relative" style="height: 110px; cursor: <?= $clickable ? 'pointer' : 'default' ?>;" <?= $clickable ? 'onclick="selectBookingDate(\'' . $dateStr . '\', ' . $available . ')"' : '' ?>>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold fs-6 <?= ($dateStr === date('Y-m-d')) ? 'badge bg-primary rounded-circle p-1' : 'text-dark' ?>"><?= $day ?></span>
                                    <?php if($clickable): ?>
                                        <i class="bi bi-plus-circle text-primary small d-none d-md-inline"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-2">
                                    <?= $statusBadge ?>
                                </div>
                                <?php if(!$isWeekend && !$isPast): ?>
                                    <div class="small text-muted mt-1" style="font-size: 0.7rem;">
                                        จองแล้ว: <strong class="text-dark"><?= $booked ?></strong>
                                    </div>
                                <?php endif; ?>
                            </td>
                        <?php }

                        // Remaining empty cells
                        while ($col % 7 != 0) {
                            echo '<td class="bg-light text-muted p-2" style="height: 105px;"></td>';
                            $col++;
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Booking Modal Form -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="bookingModalLabel"><i class="bi bi-calendar-check text-primary me-2"></i>จองคิวนัดหมายแพทย์ออนไลน์</h5>
                    <small class="text-muted" id="modalSelectedDateText">วันที่เลือก: -</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="<?= URLROOT ?>/appointment/store" method="POST">
                <div class="modal-body p-4">
                    <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    <input type="hidden" name="appointment_date" id="formAppointmentDate">

                    <!-- Step 1: Select Time Slot (Morning vs Afternoon) -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">1. เลือกช่วงเวลาการตรวจ</label>
                        <div class="row g-3" id="slotSelectorRow">
                            <div class="col-md-6">
                                <label class="w-100">
                                    <input type="radio" name="time_slot" value="morning" class="btn-check" id="slotMorningRadio" checked>
                                    <div class="btn btn-outline-primary w-100 p-3 rounded-4 text-start d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-bold"><i class="bi bi-sun-fill text-warning me-2"></i>ช่วงเช้า</div>
                                            <small class="text-muted">08:30 - 11:30 น.</small>
                                        </div>
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1" id="morningAvailableBadge">โควตา 25 คิว</span>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="w-100">
                                    <input type="radio" name="time_slot" value="afternoon" class="btn-check" id="slotAfternoonRadio">
                                    <div class="btn btn-outline-primary w-100 p-3 rounded-4 text-start d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-bold"><i class="bi bi-moon-stars-fill text-info me-2"></i>ช่วงบ่าย</div>
                                            <small class="text-muted">13:00 - 15:30 น.</small>
                                        </div>
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1" id="afternoonAvailableBadge">โควตา 25 คิว</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Department & Clinic -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">2. แผนกที่ต้องการตรวจ <span class="text-danger">*</span></label>
                            <select name="department_id" class="form-select form-control-modern" required>
                                <?php foreach($departments as $dept): ?>
                                    <option value="<?= $dept->id ?>"><?= htmlspecialchars($dept->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">คลินิกเฉพาะโรค (ทางเลือก)</label>
                            <select name="clinic_id" class="form-select form-control-modern">
                                <option value="">-- ไม่ระบุ / ตรวจทั่วไป --</option>
                                <?php foreach($clinics as $c): ?>
                                    <option value="<?= $c->id ?>"><?= htmlspecialchars($c->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Step 3: Patient Info -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">3. ชื่อ-นามสกุล ผู้รับบริการ <span class="text-danger">*</span></label>
                            <input type="text" name="patient_name" class="form-control form-control-modern" placeholder="เช่น นายสมชาย ใจดี" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">เบอร์โทรศัพท์มือถือ (สำหรับแจ้งเตือน) <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control form-control-modern" placeholder="08X-XXX-XXXX" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">หมายเลขประจำตัวผู้ป่วย (HN) ถ้ามี</label>
                            <input type="text" name="hn_number" class="form-control form-control-modern" placeholder="เช่น 67-001234">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">ระบุแพทย์ที่ต้องการตรวจ (ทางเลือก)</label>
                            <select name="doctor_id" class="form-select form-control-modern">
                                <option value="">-- แพทย์เวรประจำวัน --</option>
                                <?php foreach($doctors as $doc): ?>
                                    <option value="<?= $doc->id ?>"><?= $doc->prefix ?><?= $doc->firstname ?> <?= $doc->lastname ?> (<?= $doc->specialty ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">อาการเบื้องต้น หรือเหตุผลในการนัดตรวจ</label>
                        <textarea name="symptoms" class="form-control form-control-modern" rows="2" placeholder="เช่น มีไข้สูง 3 วัน, ปวดท้องเรื้อรัง, นัดตรวจติดตามเบาหวาน"></textarea>
                    </div>

                    <!-- Notice LINE OA -->
                    <div class="p-3 rounded-4 bg-light border d-flex align-items-center gap-3">
                        <i class="bi bi-line text-success fs-2"></i>
                        <div class="small text-muted">
                            หลังจากบันทึกนัดหมาย ระบบจะออก <strong>ใบนัดดิจิทัลพร้อม QR Code</strong> และท่านสามารถกด <strong>เชื่อมต่อรับแจ้งเตือนความจำผ่าน LINE OA</strong> ได้ทันที
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-modern-primary rounded-pill px-5 shadow">
                        <i class="bi bi-check2-circle me-1"></i> ยืนยันการจองคิวนัดหมาย
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function selectBookingDate(dateStr, availableCount) {
    document.getElementById('formAppointmentDate').value = dateStr;
    
    // Format date in Thai
    const dateObj = new Date(dateStr + 'T00:00:00');
    const thaiDateText = dateObj.toLocaleDateString('th-TH', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    document.getElementById('modalSelectedDateText').innerHTML = 'วันที่เลือก: <strong>' + thaiDateText + '</strong> (ว่าง ' + availableCount + ' คิว)';
    
    // Fetch live slot counts
    fetch('<?= URLROOT ?>/appointment/getSlots?date=' + dateStr)
        .then(res => res.json())
        .then(data => {
            if (data.morning) {
                document.getElementById('morningAvailableBadge').innerText = 'ว่าง ' + data.morning.available + '/' + data.morning.quota + ' คิว';
                if (data.morning.is_full) {
                    document.getElementById('slotMorningRadio').disabled = true;
                    document.getElementById('morningAvailableBadge').className = 'badge bg-danger rounded-pill px-3 py-1';
                    document.getElementById('morningAvailableBadge').innerText = 'เต็มแล้ว';
                } else {
                    document.getElementById('slotMorningRadio').disabled = false;
                    document.getElementById('morningAvailableBadge').className = 'badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1';
                }
            }
            if (data.afternoon) {
                document.getElementById('afternoonAvailableBadge').innerText = 'ว่าง ' + data.afternoon.available + '/' + data.afternoon.quota + ' คิว';
                if (data.afternoon.is_full) {
                    document.getElementById('slotAfternoonRadio').disabled = true;
                    document.getElementById('afternoonAvailableBadge').className = 'badge bg-danger rounded-pill px-3 py-1';
                    document.getElementById('afternoonAvailableBadge').innerText = 'เต็มแล้ว';
                } else {
                    document.getElementById('slotAfternoonRadio').disabled = false;
                    document.getElementById('afternoonAvailableBadge').className = 'badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1';
                }
            }
        })
        .catch(e => console.log(e));

    const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
    modal.show();
}
</script>
