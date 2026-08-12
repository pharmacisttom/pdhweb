<div class="container my-5">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/clinics" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> กลับไปหน้ารวมคลินิก</a>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="fw-bold text-primary mb-3"><?= $clinic->name ?></h3>
                    <span class="badge bg-light text-secondary mb-4"><?= $clinic->department_name ?? 'ทั่วไป' ?></span>
                    
                    <p class="text-muted"><?= nl2br($clinic->description) ?></p>
                    
                    <hr>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <strong><i class="bi bi-geo-alt text-primary me-2"></i> สถานที่ตั้ง:</strong><br>
                            <span class="text-muted ms-4"><?= $clinic->location ?: '-' ?></span>
                        </li>
                        <li class="mb-3">
                            <strong><i class="bi bi-telephone text-primary me-2"></i> เบอร์ติดต่อ:</strong><br>
                            <span class="text-muted ms-4"><?= $clinic->phone ?: '-' ?></span>
                        </li>
                        <?php if($clinic->note): ?>
                        <li>
                            <strong><i class="bi bi-info-circle text-primary me-2"></i> หมายเหตุ:</strong><br>
                            <span class="text-muted ms-4"><?= $clinic->note ?></span>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-dark mb-4"><i class="bi bi-calendar-check text-primary me-2"></i> ตารางออกตรวจ</h4>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="20%">วัน</th>
                                    <th width="30%">เวลา</th>
                                    <th width="50%">แพทย์ผู้ออกตรวจ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($schedules)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">ยังไม่มีข้อมูลตารางออกตรวจ</td>
                                    </tr>
                                <?php else: ?>
                                    <?php 
                                    $days = [
                                        0 => 'อาทิตย์', 1 => 'จันทร์', 2 => 'อังคาร', 
                                        3 => 'พุธ', 4 => 'พฤหัสบดี', 5 => 'ศุกร์', 6 => 'เสาร์'
                                    ];
                                    foreach($schedules as $schedule): 
                                    ?>
                                    <tr>
                                        <td class="fw-medium"><?= $days[$schedule->day_of_week] ?></td>
                                        <td><?= substr($schedule->start_time, 0, 5) ?> - <?= substr($schedule->end_time, 0, 5) ?> น.</td>
                                        <td>
                                            <?= $schedule->prefix ?><?= $schedule->firstname ?> <?= $schedule->lastname ?>
                                            <div class="text-muted small"><?= $schedule->specialty ?></div>
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
</div>
