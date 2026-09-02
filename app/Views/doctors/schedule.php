<?php
$daysOfWeek = [
    1 => ['name' => 'วันจันทร์', 'en' => 'Monday', 'color' => '#f59e0b', 'bg' => '#fef3c7', 'icon' => 'bi-brightness-high-fill'],
    2 => ['name' => 'วันอังคาร', 'en' => 'Tuesday', 'color' => '#ec4899', 'bg' => '#fce7f3', 'icon' => 'bi-heart-fill'],
    3 => ['name' => 'วันพุธ', 'en' => 'Wednesday', 'color' => '#10b981', 'bg' => '#d1fae5', 'icon' => 'bi-flower1'],
    4 => ['name' => 'วันพฤหัสบดี', 'en' => 'Thursday', 'color' => '#f97316', 'bg' => '#ffedd5', 'icon' => 'bi-sun-fill'],
    5 => ['name' => 'วันศุกร์', 'en' => 'Friday', 'color' => '#06b6d4', 'bg' => '#cffafe', 'icon' => 'bi-water'],
    6 => ['name' => 'วันเสาร์', 'en' => 'Saturday', 'color' => '#8b5cf6', 'bg' => '#ede9fe', 'icon' => 'bi-moon-stars-fill'],
    7 => ['name' => 'วันอาทิตย์', 'en' => 'Sunday', 'color' => '#ef4444', 'bg' => '#fee2e2', 'icon' => 'bi-star-fill']
];
?>

<div class="doctor-schedule-page bg-light pb-5">
    
    <!-- Hero Header -->
    <section class="schedule-hero py-5 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #042f2e 0%, #0d9488 50%, #0284c7 100%);">
        <div class="container position-relative py-3">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                        <i class="bi bi-calendar2-week-fill me-1"></i> OUTPATIENT CLINICS & TIMETABLE
                    </span>
                    <h1 class="display-5 fw-bold text-white mb-2">
                        ตารางออกตรวจแพทย์
                    </h1>
                    <p class="lead fs-6 text-white-75 mb-4 max-w-650" style="color: rgba(255, 255, 255, 0.9);">
                        ตรวจสอบวัน เวลา และห้องตรวจของแพทย์ผู้เชี่ยวชาญ โรงพยาบาลปลวกแดง ให้บริการตรวจรักษาผู้ป่วยนอกและคลินิกเฉพาะโรคอย่างมีมาตรฐาน
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= URLROOT ?>/appointment" class="btn btn-warning rounded-pill px-4 py-2 fw-bold text-dark shadow">
                            <i class="bi bi-calendar-plus me-1"></i> จองคิวนัดหมายออนไลน์
                        </a>
                        <a href="<?= URLROOT ?>/doctors" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-person-lines-fill me-1"></i> ดูทำเนียบแพทย์
                        </a>
                        <button type="button" class="btn btn-light bg-opacity-25 text-white border-0 rounded-pill px-3 py-2 d-none d-md-inline-flex align-items-center gap-1" onclick="window.print()">
                            <i class="bi bi-printer me-1"></i> พิมพ์ตารางตรวจ
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 text-center d-none d-lg-block">
                    <div class="p-4 rounded-5 bg-white bg-opacity-10 border border-white border-opacity-25 shadow-xl text-white">
                        <i class="bi bi-hospital display-3 text-warning mb-2 d-block"></i>
                        <h5 class="fw-bold mb-1">งานบริการผู้ป่วยนอก (OPD)</h5>
                        <small class="text-white-75 d-block mb-3">จันทร์ - ศุกร์ 08:30 - 16:30 น.</small>
                        <div class="p-2 rounded-4 bg-white text-dark small fw-bold">
                            <i class="bi bi-telephone-fill text-success me-1"></i> โทร. 033-650-413
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Container -->
    <div class="container py-4">
        
        <!-- Live Instant Search & Filter Bar -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 p-3 bg-white">
            <div class="row g-3 align-items-center">
                <div class="col-md-6 col-lg-7">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0 ps-3 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" id="scheduleSearchInput" class="form-control bg-light border-0 py-2" placeholder="ค้นหาชื่อแพทย์, คลินิก, แผนก, หรือห้องตรวจ..." onkeyup="filterSchedules()">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="d-flex justify-content-md-end gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 active" id="viewModeDayBtn" onclick="switchViewMode('day')">
                            <i class="bi bi-calendar-day me-1"></i> ตามวัน
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="viewModeClinicBtn" onclick="switchViewMode('clinic')">
                            <i class="bi bi-hospital me-1"></i> ตามคลินิก
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="viewModeDoctorBtn" onclick="switchViewMode('doctor')">
                            <i class="bi bi-person-badge me-1"></i> ตามรายชื่อแพทย์
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- VIEW 1: BY DAY OF WEEK (DEFAULT)           -->
        <!-- ========================================== -->
        <div id="viewByDaySection">
            
            <!-- Day Selector Pills -->
            <div class="d-flex flex-wrap gap-2 mb-4">
                <button type="button" class="btn btn-outline-teal rounded-pill px-3 py-2 fw-semibold day-filter-btn <?= ($currentDay > 5) ? 'active' : '' ?>" data-day="all" onclick="filterByDay('all', this)">
                    <i class="bi bi-calendar-week me-1"></i> ทั้งสัปดาห์ (จันทร์-ศุกร์)
                </button>
                <?php foreach ($daysOfWeek as $dNum => $dInfo): if ($dNum > 5) continue; ?>
                    <?php $isToday = ($currentDay === $dNum); ?>
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-3 py-2 fw-semibold day-filter-btn <?= ($isToday && $currentDay <= 5) ? 'active' : '' ?>" data-day="<?= $dNum ?>" onclick="filterByDay('<?= $dNum ?>', this)">
                        <i class="bi <?= $dInfo['icon'] ?> me-1" style="color: <?= $dInfo['color'] ?>;"></i>
                        <?= $dInfo['name'] ?>
                        <?php if ($isToday): ?>
                            <span class="badge bg-warning text-dark ms-1 px-2 py-1 rounded-pill" style="font-size: 0.65rem;">วันนี้</span>
                        <?php endif; ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Schedules Grid by Day -->
            <div class="row g-4" id="daysContainer">
                <?php foreach ($daysOfWeek as $dNum => $dInfo): if ($dNum > 5) continue; ?>
                    <?php 
                        $daySlots = $schedulesByDay[$dNum] ?? []; 
                        $isToday = ($currentDay === $dNum);
                    ?>
                    <div class="col-12 day-block-card" data-day-num="<?= $dNum ?>">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-2">
                            
                            <!-- Day Header -->
                            <div class="card-header border-0 py-3 px-4 d-flex justify-content-between align-items-center" style="background: <?= $dInfo['bg'] ?>;">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="p-2 rounded-circle bg-white shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; color: <?= $dInfo['color'] ?>;">
                                        <i class="bi <?= $dInfo['icon'] ?> fs-5"></i>
                                    </span>
                                    <div>
                                        <h4 class="h5 fw-bold mb-0 text-dark"><?= $dInfo['name'] ?> <span class="text-muted small fw-normal">(<?= $dInfo['en'] ?>)</span></h4>
                                        <small class="text-muted">คลินิกเปิดทำการ 08:30 - 16:30 น.</small>
                                    </div>
                                </div>
                                <?php if ($isToday): ?>
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm">
                                        <i class="bi bi-clock-history me-1"></i> เปิดตรวจวันนี้
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-white text-muted px-3 py-1 rounded-pill small border">
                                        <?= count($daySlots) ?> คลินิก
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Day Body : Slots -->
                            <div class="card-body p-3 p-md-4">
                                <?php if (empty($daySlots)): ?>
                                    <div class="text-center py-4 text-muted">
                                        <i class="bi bi-calendar-x fs-2 d-block mb-1"></i>
                                        ไม่มีตารางตรวจแพทย์ในวันนี้
                                    </div>
                                <?php else: ?>
                                    <div class="row g-3">
                                        <?php foreach ($daySlots as $slot): ?>
                                        <div class="col-md-6 col-lg-4 schedule-item-card" data-search-text="<?= htmlspecialchars(strtolower($slot->prefix . $slot->firstname . ' ' . $slot->lastname . ' ' . $slot->specialty . ' ' . $slot->clinic_name . ' ' . $slot->clinic_location)) ?>">
                                            <div class="p-3 rounded-4 border bg-light h-100 d-flex flex-column justify-content-between hover-shadow transition-all">
                                                <div>
                                                    <!-- Time & Room -->
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="badge bg-teal-subtle text-teal fw-bold px-2 py-1 rounded-pill small">
                                                            <i class="bi bi-clock me-1"></i> <?= date('H:i', strtotime($slot->start_time)) ?> - <?= date('H:i', strtotime($slot->end_time)) ?> น.
                                                        </span>
                                                        <small class="text-muted font-monospace" style="font-size: 0.75rem;">
                                                            <i class="bi bi-geo-alt-fill text-danger me-1"></i><?= htmlspecialchars($slot->clinic_location ?: 'OPD') ?>
                                                        </small>
                                                    </div>

                                                    <!-- Clinic Name -->
                                                    <h6 class="fw-bold text-dark mb-2">
                                                        <a href="<?= URLROOT ?>/clinic/show/<?= $slot->clinic_id ?>" class="text-dark text-decoration-none hover-teal">
                                                            <?= htmlspecialchars($slot->clinic_name) ?>
                                                        </a>
                                                    </h6>

                                                    <!-- Doctor Profile -->
                                                    <div class="d-flex align-items-center gap-3 p-2 bg-white rounded-3 border border-light mb-2">
                                                        <div class="rounded-circle overflow-hidden bg-teal text-white d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 46px; height: 46px;">
                                                            <?php if (!empty($slot->profile_image)): ?>
                                                                <img src="<?= URLROOT ?>/assets/images/doctors/<?= rawurlencode($slot->profile_image) ?>" alt="<?= htmlspecialchars($slot->firstname) ?>" class="w-100 h-100 object-fit-cover">
                                                            <?php else: ?>
                                                                <i class="bi bi-person-fill fs-4"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="overflow-hidden">
                                                            <div class="fw-bold text-dark text-truncate" style="font-size: 0.9rem;">
                                                                <?= htmlspecialchars($slot->prefix . $slot->firstname . ' ' . $slot->lastname) ?>
                                                            </div>
                                                            <small class="text-teal fw-semibold d-block text-truncate" style="font-size: 0.78rem;">
                                                                <?= htmlspecialchars($slot->specialty ?: 'แพทย์เวชปฏิบัติ') ?>
                                                            </small>
                                                        </div>
                                                    </div>

                                                    <?php if (!empty($slot->note)): ?>
                                                        <small class="text-muted d-block mb-2" style="font-size: 0.75rem;">
                                                            <i class="bi bi-info-circle me-1"></i><?= htmlspecialchars($slot->note) ?>
                                                        </small>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                                                    <a href="<?= URLROOT ?>/appointment" class="btn btn-sm btn-outline-teal rounded-pill px-3 py-1 fw-semibold w-100 text-center" style="font-size: 0.8rem;">
                                                        <i class="bi bi-calendar-check me-1"></i> นัดหมายตรวจคลินิกนี้
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- VIEW 2: BY CLINIC                         -->
        <!-- ========================================== -->
        <div id="viewByClinicSection" style="display: none;">
            <div class="row g-4">
                <?php foreach ($schedulesByClinic as $cId => $cData): ?>
                <div class="col-lg-6 clinic-group-card" data-search-text="<?= htmlspecialchars(strtolower($cData['clinic_name'] . ' ' . $cData['clinic_location'])) ?>">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                        <div class="card-header bg-teal text-white py-3 px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold mb-0"><?= htmlspecialchars($cData['clinic_name']) ?></h5>
                                <small class="text-white-75"><i class="bi bi-geo-alt me-1"></i><?= htmlspecialchars($cData['clinic_location'] ?: 'อาคารผู้ป่วยนอก') ?></small>
                            </div>
                            <a href="<?= URLROOT ?>/clinic/show/<?= $cId ?>" class="btn btn-sm btn-light rounded-pill px-3 text-teal fw-bold">
                                ข้อมูลคลินิก &rarr;
                            </a>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>วันตรวจ</th>
                                            <th>เวลา</th>
                                            <th>แพทย์ผู้ตรวจ</th>
                                            <th>นัดหมาย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cData['slots'] as $sSlot): ?>
                                        <tr>
                                            <td>
                                                <span class="badge rounded-pill px-2 py-1" style="background: <?= $daysOfWeek[$sSlot->day_of_week]['bg'] ?>; color: <?= $daysOfWeek[$sSlot->day_of_week]['color'] ?>; font-weight: bold;">
                                                    <?= $daysOfWeek[$sSlot->day_of_week]['name'] ?>
                                                </span>
                                            </td>
                                            <td class="font-monospace text-dark fw-semibold">
                                                <?= date('H:i', strtotime($sSlot->start_time)) ?>-<?= date('H:i', strtotime($sSlot->end_time)) ?>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($sSlot->prefix . $sSlot->firstname . ' ' . $sSlot->lastname) ?></div>
                                                <small class="text-muted"><?= htmlspecialchars($sSlot->specialty) ?></small>
                                            </td>
                                            <td>
                                                <a href="<?= URLROOT ?>/appointment" class="btn btn-sm btn-outline-teal rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                                    จองคิว
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- VIEW 3: BY DOCTOR                         -->
        <!-- ========================================== -->
        <div id="viewByDoctorSection" style="display: none;">
            <div class="row g-4">
                <?php foreach ($schedulesByDoctor as $docId => $dGroup): ?>
                <?php $doc = $dGroup['doctor']; ?>
                <div class="col-md-6 col-lg-4 doctor-group-card" data-search-text="<?= htmlspecialchars(strtolower($doc->prefix . $doc->firstname . ' ' . $doc->lastname . ' ' . $doc->specialty)) ?>">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white d-flex flex-column justify-content-between hover-shadow">
                        <div class="p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle overflow-hidden bg-teal text-white d-flex align-items-center justify-content-center shadow" style="width: 60px; height: 60px;">
                                    <?php if (!empty($doc->profile_image)): ?>
                                        <img src="<?= URLROOT ?>/assets/images/doctors/<?= rawurlencode($doc->profile_image) ?>" alt="<?= htmlspecialchars($doc->firstname) ?>" class="w-100 h-100 object-fit-cover">
                                    <?php else: ?>
                                        <i class="bi bi-person-fill fs-2"></i>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-0"><?= htmlspecialchars($doc->prefix . $doc->firstname . ' ' . $doc->lastname) ?></h5>
                                    <span class="badge bg-teal-subtle text-teal fw-semibold mt-1"><?= htmlspecialchars($doc->specialty ?: 'แพทย์เวชปฏิบัติ') ?></span>
                                </div>
                            </div>

                            <h6 class="small fw-bold text-muted text-uppercase mb-2"><i class="bi bi-calendar-week me-1"></i> ตารางออกตรวจประจำสัปดาห์:</h6>
                            <div class="list-group list-group-flush rounded-3 border">
                                <?php foreach ($dGroup['slots'] as $dSlot): ?>
                                <div class="list-group-item p-2 d-flex justify-content-between align-items-center small">
                                    <div>
                                        <span class="fw-bold text-dark"><?= $daysOfWeek[$dSlot->day_of_week]['name'] ?></span>
                                        <span class="text-muted d-block" style="font-size: 0.75rem;"><?= htmlspecialchars($dSlot->clinic_name) ?></span>
                                    </div>
                                    <span class="badge bg-light text-dark font-monospace border">
                                        <?= date('H:i', strtotime($dSlot->start_time)) ?> - <?= date('H:i', strtotime($dSlot->end_time)) ?>
                                    </span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="p-3 bg-light border-top text-center">
                            <a href="<?= URLROOT ?>/appointment" class="btn btn-teal-gradient text-white btn-sm rounded-pill px-4 fw-semibold w-100">
                                <i class="bi bi-calendar-plus me-1"></i> นัดหมายแพทย์ท่านนี้
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <!-- Appointment Banner Bottom -->
    <section class="container py-4 mt-3">
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden text-white" style="background: linear-gradient(135deg, #0f766e 0%, #0284c7 100%);">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-3">
                            <i class="bi bi-clock-history me-1"></i> FAST TRACK APPOINTMENT
                        </span>
                        <h2 class="display-6 fw-bold text-white mb-2">นัดหมายตรวจล่วงหน้า สะดวก รวดเร็ว</h2>
                        <p class="text-white-75 mb-0" style="color: rgba(255, 255, 255, 0.9);">
                            ลดเวลารอคอยที่โรงพยาบาลด้วยระบบนัดหมายออนไลน์ พร้อมรับบัตรนัดและ SMS แจ้งเตือนวันตรวจ
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end text-center">
                        <a href="<?= URLROOT ?>/appointment" class="btn btn-warning btn-lg rounded-pill px-4 py-3 fw-bold text-dark shadow-lg">
                            <i class="bi bi-calendar-check-fill me-1"></i> จองคิวออนไลน์ทันที
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Custom CSS & Print Styles -->
<style>
.btn-teal-gradient {
    background: linear-gradient(135deg, #0d9488 0%, #059669 100%) !important;
    color: #ffffff !important;
    border: none !important;
}
.btn-outline-teal {
    border: 1.5px solid #0d9488 !important;
    color: #0d9488 !important;
    background: transparent;
}
.btn-outline-teal:hover, .btn-outline-teal.active {
    background: #0d9488 !important;
    color: #ffffff !important;
}
.text-teal {
    color: #0d9488 !important;
}
.bg-teal {
    background-color: #0d9488 !important;
}
.bg-teal-subtle {
    background-color: #ccfbf1 !important;
    color: #0f766e !important;
}
.hover-teal:hover {
    color: #0d9488 !important;
}
.hover-shadow {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hover-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
}

@media print {
    .schedule-hero, .btn, .input-group, #viewModeDayBtn, #viewModeClinicBtn, #viewModeDoctorBtn, .day-filter-btn {
        display: none !important;
    }
    .doctor-schedule-page {
        background: #fff !important;
        padding: 0 !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
        page-break-inside: avoid;
    }
}
</style>

<script>
function switchViewMode(mode) {
    document.getElementById('viewByDaySection').style.display = (mode === 'day') ? 'block' : 'none';
    document.getElementById('viewByClinicSection').style.display = (mode === 'clinic') ? 'block' : 'none';
    document.getElementById('viewByDoctorSection').style.display = (mode === 'doctor') ? 'block' : 'none';

    document.getElementById('viewModeDayBtn').classList.toggle('active', mode === 'day');
    document.getElementById('viewModeClinicBtn').classList.toggle('active', mode === 'clinic');
    document.getElementById('viewModeDoctorBtn').classList.toggle('active', mode === 'doctor');
}

function filterByDay(day, btn) {
    document.querySelectorAll('.day-filter-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');

    const dayBlocks = document.querySelectorAll('.day-block-card');
    dayBlocks.forEach(block => {
        if (day === 'all' || block.getAttribute('data-day-num') === day) {
            block.style.display = 'block';
        } else {
            block.style.display = 'none';
        }
    });
}

function filterSchedules() {
    const query = document.getElementById('scheduleSearchInput').value.toLowerCase().trim();
    
    // Filter day view items
    document.querySelectorAll('.schedule-item-card').forEach(card => {
        const text = card.getAttribute('data-search-text') || '';
        card.style.display = (query === '' || text.includes(query)) ? 'block' : 'none';
    });

    // Filter clinic view items
    document.querySelectorAll('.clinic-group-card').forEach(card => {
        const text = card.getAttribute('data-search-text') || '';
        card.style.display = (query === '' || text.includes(query)) ? 'block' : 'none';
    });

    // Filter doctor view items
    document.querySelectorAll('.doctor-group-card').forEach(card => {
        const text = card.getAttribute('data-search-text') || '';
        card.style.display = (query === '' || text.includes(query)) ? 'block' : 'none';
    });
}
</script>
