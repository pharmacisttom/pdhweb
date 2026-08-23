<div class="container my-5">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/clinic" class="btn btn-modern-outline btn-sm">
            <i class="bi bi-arrow-left"></i> กลับไปหน้ารวมคลินิก
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="glass-card p-4 h-100">
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px;">
                    <i class="bi bi-hospital fs-3"></i>
                </div>
                <h3 class="fw-bold text-dark mb-2"><?= htmlspecialchars($clinic->name) ?></h3>
                <span class="badge bg-primary-light text-primary border mb-4 px-3 py-1"><?= htmlspecialchars($clinic->department_name ?? 'แผนกทั่วไป') ?></span>
                
                <p class="text-muted small mb-4" style="line-height: 1.7;"><?= nl2br(htmlspecialchars($clinic->description ?? '')) ?></p>
                
                <div class="pt-3 border-top">
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt-fill text-primary fs-5 mt-n1"></i>
                            <div>
                                <strong class="text-dark d-block">สถานที่ตั้ง:</strong>
                                <span class="text-muted"><?= htmlspecialchars($clinic->location ?: 'อาคารผู้ป่วยนอก') ?></span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="bi bi-telephone-fill text-success fs-5 mt-n1"></i>
                            <div>
                                <strong class="text-dark d-block">เบอร์ติดต่อ:</strong>
                                <span class="text-muted"><?= htmlspecialchars($clinic->phone ?: '038-659-188') ?></span>
                            </div>
                        </li>
                        <?php if(!empty($clinic->note)): ?>
                        <li class="d-flex align-items-start gap-2">
                            <i class="bi bi-info-circle-fill text-warning fs-5 mt-n1"></i>
                            <div>
                                <strong class="text-dark d-block">หมายเหตุ:</strong>
                                <span class="text-muted"><?= htmlspecialchars($clinic->note) ?></span>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="glass-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="fw-bold text-dark mb-0"><i class="bi bi-calendar2-week text-primary me-2"></i> ตารางแพทย์ผู้ออกตรวจ</h4>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                        <span class="pulse-dot me-1"></span> อัปเดตล่าสุด
                    </span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th width="20%">วัน</th>
                                <th width="30%">ช่วงเวลา</th>
                                <th width="50%">แพทย์ผู้ออกตรวจ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($schedules)): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="bi bi-calendar-x display-4 d-block mb-2 text-muted opacity-50"></i>
                                        ยังไม่มีข้อมูลตารางออกตรวจในระบบ
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php 
                                $days = [
                                    0 => 'วันอาทิตย์', 1 => 'วันจันทร์', 2 => 'วันอังคาร', 
                                    3 => 'วันพุธ', 4 => 'วันพฤหัสบดี', 5 => 'วันศุกร์', 6 => 'วันเสาร์'
                                ];
                                foreach($schedules as $schedule): 
                                ?>
                                <tr>
                                    <td class="fw-bold text-dark">
                                        <span class="badge bg-light text-dark border px-2 py-1"><?= $days[$schedule->day_of_week] ?? 'ไม่ระบุ' ?></span>
                                    </td>
                                    <td class="text-muted">
                                        <i class="bi bi-clock me-1 text-primary"></i> <?= substr($schedule->start_time, 0, 5) ?> - <?= substr($schedule->end_time, 0, 5) ?> น.
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">
                                            <?= htmlspecialchars($schedule->prefix ?? '') ?><?= htmlspecialchars($schedule->firstname ?? '') ?> <?= htmlspecialchars($schedule->lastname ?? '') ?>
                                        </div>
                                        <div class="text-muted small"><?= htmlspecialchars($schedule->specialty ?? '') ?></div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
