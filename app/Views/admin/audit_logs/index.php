<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0"><i data-lucide="activity" class="me-2 text-primary"></i> ประวัติการทำงาน (Audit Logs)</h5>
        <form action="<?= url('/admin/logs/clear') ?>" method="POST" onsubmit="event.preventDefault(); confirmDelete(this, 'ยืนยันการล้างข้อมูลขยะ?', 'ระบบจะลบข้อมูล Log ที่เก่ากว่า 90 วัน เพื่อให้ระบบทำงานไวขึ้น!');">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-warning text-dark fw-bold">
                <i data-lucide="trash-2" style="width:18px;"></i> ล้างข้อมูล Log เก่า (>90 วัน)
            </button>
        </form>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="15%">วันเวลา</th>
                        <th width="15%">ผู้ใช้งาน</th>
                        <th width="15%">การทำงาน</th>
                        <th width="15%">โมดูล</th>
                        <th width="10%">ไอดีอ้างอิง</th>
                        <th width="15%">IP Address</th>
                        <th width="15%">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logs)): ?>
                        <tr><td colspan="7" class="text-center text-muted">ไม่พบข้อมูลประวัติการทำงาน</td></tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?= date('d/m/Y', strtotime($log['created_at'])) ?></div>
                                    <small class="text-muted"><?= date('H:i:s', strtotime($log['created_at'])) ?></small>
                                </td>
                                <td>
                                    <?php if ($log['username']): ?>
                                        <div class="fw-bold"><?= escape($log['first_name'] . ' ' . $log['last_name']) ?></div>
                                        <small class="text-muted">@<?= escape($log['username']) ?></small>
                                    <?php else: ?>
                                        <span class="text-muted">ระบบ/ไม่ระบุ</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        $actionBadge = 'bg-secondary';
                                        if (strpos($log['action'], 'CREATE') !== false || strpos($log['action'], 'ADD') !== false) $actionBadge = 'bg-success';
                                        elseif (strpos($log['action'], 'UPDATE') !== false || strpos($log['action'], 'EDIT') !== false) $actionBadge = 'bg-primary';
                                        elseif (strpos($log['action'], 'DELETE') !== false || strpos($log['action'], 'CLEAR') !== false) $actionBadge = 'bg-danger';
                                    ?>
                                    <span class="badge <?= $actionBadge ?>"><?= escape($log['action']) ?></span>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= escape($log['module']) ?></span></td>
                                <td><?= escape($log['record_id'] ?? '-') ?></td>
                                <td><small class="text-muted"><?= escape($log['ip_address']) ?></small></td>
                                <td>
                                    <?php if ($log['new_data'] || $log['old_data']): ?>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewLogDetails(<?= htmlspecialchars(json_encode([
                                            'old' => $log['old_data'],
                                            'new' => $log['new_data']
                                        ])) ?>)">
                                            ดูข้อมูล
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
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

<script>
function viewLogDetails(data) {
    let html = '';
    
    try {
        let oldData = data.old ? (typeof data.old === 'string' ? JSON.parse(data.old) : data.old) : null;
        let newData = data.new ? (typeof data.new === 'string' ? JSON.parse(data.new) : data.new) : null;
        
        if (oldData) {
            html += '<div class="text-start mb-3"><strong>ข้อมูลเดิม:</strong><pre class="bg-light p-2 rounded text-muted mt-1" style="font-size: 12px; white-space: pre-wrap;">' + JSON.stringify(oldData, null, 2) + '</pre></div>';
        }
        
        if (newData) {
            html += '<div class="text-start"><strong>ข้อมูลใหม่:</strong><pre class="bg-light p-2 rounded text-muted mt-1" style="font-size: 12px; white-space: pre-wrap;">' + JSON.stringify(newData, null, 2) + '</pre></div>';
        }
    } catch (e) {
        html = '<div class="text-start"><strong>ข้อมูลดิบ:</strong><br><small class="text-muted">' + (data.new || data.old || 'ไม่มีข้อมูล') + '</small></div>';
    }
    
    Swal.fire({
        title: 'รายละเอียดข้อมูล',
        html: html,
        width: 600,
        confirmButtonText: 'ปิดหน้าต่าง'
    });
}
</script>
