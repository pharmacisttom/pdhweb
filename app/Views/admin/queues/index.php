<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">แผงควบคุมระบบคิวอัจฉริยะ (Smart Queue Station)</h3>
        <p class="text-muted small mb-0"><i class="bi bi-clock-history me-1"></i> ควบคุมการเรียกคิวคนไข้และเชื่อมต่อกับจอทีวีแสดงผลอัตโนมัติ</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= URLROOT ?>/queue/room/1?department_id=<?= $selected_department ?>" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold">
            <i class="bi bi-megaphone-fill me-1"></i> สถานีเรียกคิวห้องตรวจ
        </a>
        <a href="<?= URLROOT ?>/queue/door/1?department_id=<?= $selected_department ?>" target="_blank" class="btn btn-sm btn-warning rounded-pill px-3 fw-bold text-dark">
            <i class="bi bi-tv-fill me-1"></i> จอหน้าห้องตรวจ
        </a>
        <a href="<?= URLROOT ?>/queue/display/<?= $selected_department ?>" target="_blank" class="btn btn-sm btn-outline-info rounded-pill px-3">
            <i class="bi bi-tv me-1"></i> จอทีวีรวมแผนก
        </a>
        <a href="<?= URLROOT ?>/queue/kiosk" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="bi bi-phone me-1"></i> ตู้ Kiosk
        </a>
    </div>
</div>

<!-- Department Filter Tabs -->
<div class="card-modern p-3 mb-4">
    <div class="d-flex flex-wrap gap-2 align-items-center">
        <span class="text-muted fw-bold small me-2"><i class="bi bi-funnel-fill text-primary"></i> เลือกแผนก:</span>
        <?php foreach($departments as $dept): ?>
            <a href="<?= URLROOT ?>/admin/queue?department_id=<?= $dept->id ?>" class="btn btn-sm <?= ($selected_department == $dept->id) ? 'btn-admin-primary' : 'btn-light border' ?> rounded-pill px-3">
                <?= htmlspecialchars($dept->name) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Queue Counter Stats Grid -->
<div class="row g-3 g-md-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label mb-1">คิวที่รอตรวจ (Waiting)</div>
                    <div class="stat-value text-warning"><?= $waitingCount ?></div>
                    <small class="text-muted small">คนไข้ในแผนก</small>
                </div>
                <div class="stat-icon-wrap" style="background: #fef3c7; color: #d97706;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label mb-1">กำลังรับบริการ (Calling)</div>
                    <div class="stat-value text-primary"><?= $callingCount ?></div>
                    <small class="text-success small fw-medium"><i class="bi bi-megaphone-fill me-1"></i> เรียกที่ช่องบริการ</small>
                </div>
                <div class="stat-icon-wrap" style="background: #e0f2fe; color: #0284c7;">
                    <i class="bi bi-broadcast"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label mb-1">ตรวจเสร็จแล้ว (Completed)</div>
                    <div class="stat-value text-success"><?= $completedCount ?></div>
                    <small class="text-muted small">ยอดรวมวันนี้</small>
                </div>
                <div class="stat-icon-wrap" style="background: #d1fae5; color: #10b981;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- One-Click Call Next Station Card -->
<div class="card-modern mb-4 p-4" style="background: linear-gradient(135deg, #f0fdfa, #ffffff); border: 1.5px solid rgba(13, 148, 136, 0.25);">
    <form action="<?= URLROOT ?>/admin/queue/callNext" method="POST" class="row g-3 align-items-center">
        <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="hidden" name="department_id" value="<?= $selected_department ?>">

        <div class="col-lg-3">
            <label class="form-label fw-bold small text-muted">โต๊ะตรวจ / ช่องบริการของคุณ</label>
            <select name="counter_number" class="form-select form-control-modern fw-bold" id="myCounterSelect">
                <option value="1">โต๊ะตรวจที่ 1</option>
                <option value="2">โต๊ะตรวจที่ 2</option>
                <option value="3">ห้องหัตถการ (3)</option>
                <option value="4">ห้องจ่ายยา (4)</option>
            </select>
        </div>

        <div class="col-lg-5">
            <label class="form-label fw-bold small text-muted">กดปุ่มเพื่อเรียกคิวคนไข้คนถัดไป</label>
            <button type="submit" class="btn btn-modern-primary w-100 py-2 fs-5 shadow-sm" <?= ($waitingCount == 0) ? 'disabled' : '' ?>>
                <i class="bi bi-megaphone-fill me-2"></i> เรียกคิวถัดไป (Call Next Queue)
            </button>
        </div>

        <div class="col-lg-4 text-lg-end">
            <!-- Fast Walk-in Ticket Modal Trigger -->
            <label class="form-label fw-bold small text-muted d-block">ออกบัตรคิว Walk-in ด่วน</label>
            <button type="button" class="btn btn-outline-primary py-2 px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#fastTicketModal">
                <i class="bi bi-plus-circle me-1"></i> ออกบัตรคิวด่วน
            </button>
        </div>
    </form>
</div>

<!-- Real-time Queue Management Table -->
<div class="card-modern">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-list-ol text-primary me-2"></i> รายการคิวประจำวัน</h5>
        <button class="btn btn-sm btn-light border rounded-pill" onclick="window.location.reload();">
            <i class="bi bi-arrow-clockwise me-1"></i> รีเฟรชข้อมูล
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern align-middle mb-0">
                <thead>
                    <tr>
                        <th width="15%">หมายเลขคิว</th>
                        <th width="25%">ชื่อผู้รับบริการ</th>
                        <th width="15%">ช่องบริการ</th>
                        <th width="15%">สถานะ</th>
                        <th width="15%">เวลาที่ออกบัตร</th>
                        <th width="15%" class="text-center">จัดการคิว</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($queues)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">ไม่มีรายการคิวในแผนกนี้</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($queues as $q): ?>
                            <tr class="<?= ($q->status === 'calling') ? 'table-warning' : '' ?>">
                                <td class="fw-bold fs-5 text-primary"><?= htmlspecialchars($q->queue_number) ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($q->patient_name) ?></div>
                                    <small class="text-muted"><i class="bi bi-telephone me-1"></i><?= htmlspecialchars($q->phone ?: '-') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-1">
                                        ช่องที่ <?= htmlspecialchars($q->counter_number ?? '1') ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($q->status === 'waiting'): ?>
                                        <span class="badge badge-pastel badge-pastel-warning"><i class="bi bi-hourglass-split"></i> รอเรียก</span>
                                    <?php elseif($q->status === 'calling'): ?>
                                        <span class="badge bg-primary text-white rounded-pill px-3 py-1"><span class="pulse-dot me-1"></span> กำลังเรียก</span>
                                    <?php elseif($q->status === 'completed'): ?>
                                        <span class="badge badge-pastel badge-pastel-success"><i class="bi bi-check-circle"></i> เสร็จสิ้น</span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border">ข้ามคิว</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted small">
                                    <?= date('H:i น.', strtotime($q->created_at)) ?>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            ตัวเลือก
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                            <li>
                                                <form action="<?= URLROOT ?>/admin/queue/action/<?= $q->id ?>" method="POST">
                                                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                                    <input type="hidden" name="department_id" value="<?= $selected_department ?>">
                                                    <input type="hidden" name="act" value="call">
                                                    <input type="hidden" name="counter_number" class="hidden-counter" value="1">
                                                    <button type="submit" class="dropdown-item text-primary"><i class="bi bi-megaphone me-2"></i> เรียกคิวนี้</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?= URLROOT ?>/admin/queue/action/<?= $q->id ?>" method="POST">
                                                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                                    <input type="hidden" name="department_id" value="<?= $selected_department ?>">
                                                    <input type="hidden" name="act" value="complete">
                                                    <button type="submit" class="dropdown-item text-success"><i class="bi bi-check-circle me-2"></i> ตรวจเสร็จสิ้น</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?= URLROOT ?>/admin/queue/action/<?= $q->id ?>" method="POST">
                                                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                                    <input type="hidden" name="department_id" value="<?= $selected_department ?>">
                                                    <input type="hidden" name="act" value="skip">
                                                    <button type="submit" class="dropdown-item text-muted"><i class="bi bi-skip-forward me-2"></i> ข้ามคิว</button>
                                                </form>
                                            </li>
                                        </ul>
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

<!-- Fast Ticket Modal -->
<div class="modal fade" id="fastTicketModal" tabindex="-1" aria-labelledby="fastTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="fastTicketModalLabel"><i class="bi bi-ticket-perforated text-primary me-2"></i>ออกบัตรคิวด่วน (Fast Ticket)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URLROOT ?>/admin/queue/fastTicket" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    <input type="hidden" name="department_id" value="<?= $selected_department ?>">

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">ชื่อ-นามสกุล คนไข้</label>
                        <input type="text" name="patient_name" class="form-control form-control-modern" placeholder="เช่น นายมานะ สุขใจ (หรือเว้นว่างเพื่อรับสิทธิ์ทั่วไป)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">ประเภทบริการ</label>
                        <select name="service_type" class="form-select form-control-modern">
                            <option value="general">ตรวจโรคทั่วไป (OPD - Prefix A)</option>
                            <option value="pediatric">คลินิกเด็ก (Prefix P)</option>
                            <option value="dental">ทันตกรรม (Prefix D)</option>
                            <option value="lab">ห้องแล็บ/เจาะเลือด (Prefix L)</option>
                            <option value="pharmacy">รับยา/การเงิน (Prefix R)</option>
                            <option value="emergency">ฉุกเฉิน (Prefix E)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-4">ออกบัตรคิวทันที</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const counterSelect = document.getElementById('myCounterSelect');
    const hiddenCounters = document.querySelectorAll('.hidden-counter');

    if (counterSelect) {
        counterSelect.addEventListener('change', function() {
            hiddenCounters.forEach(el => el.value = counterSelect.value);
        });
    }
});
</script>
