<div class="container my-5">
    <div class="mb-4 text-center">
        <a href="<?= URLROOT ?>/queue" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> เลือกแผนกอื่น</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Current Calling Queue -->
            <div class="card border-0 shadow text-center mb-5 overflow-hidden">
                <div class="bg-primary text-white py-3">
                    <h3 class="mb-0 fw-bold">คิวที่กำลังรับบริการ (แผนก<?= $department->name ?>)</h3>
                </div>
                <div class="card-body py-5">
                    <?php if($currentQueue): ?>
                        <div class="display-1 fw-bold text-dark mb-3" style="font-size: 7rem;"><?= $currentQueue->queue_number ?></div>
                        <h4 class="text-muted">ชื่อผู้ป่วย: <?= $currentQueue->patient_name ?></h4>
                    <?php else: ?>
                        <div class="display-4 text-muted py-5">ยังไม่มีการเรียกคิวในขณะนี้</div>
                    <?php endif; ?>
                </div>
                <div class="bg-light py-3 border-top">
                    <span class="fs-5">จำนวนคิวที่รอทั้งหมด: <strong class="text-danger"><?= $waitingCount ?></strong> คิว</span>
                </div>
            </div>

            <!-- Full Queue List -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-list-ol text-primary me-2"></i> รายการคิววันนี้</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4" width="25%">หมายเลขคิว</th>
                                    <th width="45%">ชื่อ-นามสกุล</th>
                                    <th width="30%">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($allQueues)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">ยังไม่มีข้อมูลคิวในวันนี้</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($allQueues as $q): ?>
                                        <tr class="<?= $q->status == 'calling' ? 'table-primary' : ($q->status == 'completed' ? 'table-light text-muted' : '') ?>">
                                            <td class="ps-4 fw-bold fs-5"><?= $q->queue_number ?></td>
                                            <td class="align-middle"><?= $q->patient_name ?></td>
                                            <td class="align-middle">
                                                <?php if($q->status == 'waiting'): ?>
                                                    <span class="badge bg-warning text-dark">รอเรียก</span>
                                                <?php elseif($q->status == 'calling'): ?>
                                                    <span class="badge bg-primary">กำลังเรียก</span>
                                                <?php elseif($q->status == 'completed'): ?>
                                                    <span class="badge bg-success">เสร็จสิ้น</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">ข้าม/ยกเลิก</span>
                                                <?php endif; ?>
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

<script>
    // Simple page refresh every 15 seconds to simulate real-time updates
    setTimeout(function(){
        window.location.reload();
    }, 15000);
</script>
