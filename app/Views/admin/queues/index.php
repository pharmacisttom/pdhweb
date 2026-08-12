<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    
    <form action="" method="GET" class="d-flex align-items-center">
        <label for="department_id" class="me-2 fw-bold text-nowrap">เลือกแผนก:</label>
        <select name="department_id" id="department_id" class="form-select w-auto" onchange="this.form.submit()">
            <?php foreach($departments as $dept): ?>
                <option value="<?= $dept->id ?>" <?= $selected_department == $dept->id ? 'selected' : '' ?>><?= $dept->name ?></option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> ออกคิวใหม่</h5>
            </div>
            <div class="card-body">
                <form action="<?= URLROOT ?>/admin/queues/store" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                    <input type="hidden" name="department_id" value="<?= $selected_department ?>">
                    
                    <div class="mb-3">
                        <label for="queue_number" class="form-label fw-bold">หมายเลขคิว <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="queue_number" name="queue_number" required placeholder="เช่น A001, B023">
                    </div>
                    
                    <div class="mb-3">
                        <label for="patient_name" class="form-label fw-bold">ชื่อผู้ป่วย <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">บันทึกคิว</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">หมายเลขคิว</th>
                                <th>ชื่อผู้ป่วย</th>
                                <th>สถานะ</th>
                                <th>เวลาที่ออกคิว</th>
                                <th>จัดการสถานะ (เรียกคิว)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($queues)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">ยังไม่มีคิวในแผนกนี้สำหรับวันนี้</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($queues as $q): ?>
                                <tr class="<?= $q->status == 'calling' ? 'table-primary border-primary border-2' : '' ?>">
                                    <td class="ps-4 fw-bold fs-5 text-primary"><?= $q->queue_number ?></td>
                                    <td class="fw-medium"><?= $q->patient_name ?></td>
                                    <td>
                                        <?php if($q->status == 'waiting'): ?>
                                            <span class="badge bg-warning-pastel text-dark">รอเรียก</span>
                                        <?php elseif($q->status == 'calling'): ?>
                                            <span class="badge bg-info-pastel">กำลังเรียก</span>
                                        <?php elseif($q->status == 'completed'): ?>
                                            <span class="badge bg-success-pastel">เสร็จสิ้น</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted border">ข้าม/ยกเลิก</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-muted small"><?= date('H:i', strtotime($q->created_at)) ?> น.</td>
                                    <td>
                                        <form action="<?= URLROOT ?>/admin/queues/updateStatus/<?= $q->id ?>" method="POST" class="d-inline">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                                            <input type="hidden" name="department_id" value="<?= $selected_department ?>">
                                            <div class="btn-group btn-group-sm">
                                                <button type="submit" name="status" value="waiting" class="btn btn-outline-warning text-dark" title="รอเรียก"><i class="bi bi-clock"></i></button>
                                                <button type="submit" name="status" value="calling" class="btn btn-outline-primary" title="เรียกคิวนี้"><i class="bi bi-megaphone"></i> เรียก</button>
                                                <button type="submit" name="status" value="completed" class="btn btn-outline-success" title="เสร็จสิ้น"><i class="bi bi-check-lg"></i></button>
                                                <button type="submit" name="status" value="skipped" class="btn btn-outline-secondary" title="ข้าม"><i class="bi bi-x-lg"></i></button>
                                            </div>
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
    </div>
</div>
