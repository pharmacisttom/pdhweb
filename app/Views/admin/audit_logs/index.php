<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0"><i class="bi bi-activity me-2 text-primary"></i> ประวัติการทำงาน (Audit Logs)</h5>
        <form action="<?= URLROOT ?>/admin/logs/clear" method="POST" onsubmit="return confirm('ยืนยันการล้างข้อมูล Log ที่เก่ากว่า 90 วัน?');">
            <?= \App\Helpers\Security::csrfField() ?>
            <button type="submit" class="btn btn-warning text-dark fw-bold rounded-pill px-3">
                <i class="bi bi-trash me-1"></i> ล้างข้อมูล Log เก่า (>90 วัน)
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
                        <tr><td colspan="7" class="text-center py-5 text-muted">ไม่พบข้อมูลประวัติการทำงาน</td></tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): 
                            $createdAt = is_object($log) ? $log->created_at : $log['created_at'];
                            $username = is_object($log) ? ($log->username ?? '') : ($log['username'] ?? '');
                            $firstName = is_object($log) ? ($log->first_name ?? '') : ($log['first_name'] ?? '');
                            $lastName = is_object($log) ? ($log->last_name ?? '') : ($log['last_name'] ?? '');
                            $action = is_object($log) ? $log->action : $log['action'];
                            $module = is_object($log) ? $log->module : $log['module'];
                            $recordId = is_object($log) ? ($log->record_id ?? '-') : ($log['record_id'] ?? '-');
                            $ipAddress = is_object($log) ? ($log->ip_address ?? '-') : ($log['ip_address'] ?? '-');
                            $oldData = is_object($log) ? ($log->old_data ?? '') : ($log['old_data'] ?? '');
                            $newData = is_object($log) ? ($log->new_data ?? '') : ($log['new_data'] ?? '');
                        ?>
                            <tr>
                                <td>
                                    <div class="fw-bold font-monospace"><?= date('d/m/Y', strtotime($createdAt)) ?></div>
                                    <small class="text-muted font-monospace"><?= date('H:i:s น.', strtotime($createdAt)) ?></small>
                                </td>
                                <td>
                                    <?php if (!empty($username)): ?>
                                        <div class="fw-bold"><?= htmlspecialchars($firstName . ' ' . $lastName) ?></div>
                                        <small class="text-muted">@<?= htmlspecialchars($username) ?></small>
                                    <?php else: ?>
                                        <span class="text-muted">ระบบ / ไม่ระบุ</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        $actionBadge = 'bg-secondary-subtle text-secondary';
                                        if (strpos($action, 'CREATE') !== false || strpos($action, 'ADD') !== false) $actionBadge = 'bg-success-subtle text-success';
                                        elseif (strpos($action, 'UPDATE') !== false || strpos($action, 'EDIT') !== false) $actionBadge = 'bg-primary-subtle text-primary';
                                        elseif (strpos($action, 'DELETE') !== false || strpos($action, 'CLEAR') !== false) $actionBadge = 'bg-danger-subtle text-danger';
                                    ?>
                                    <span class="badge <?= $actionBadge ?> border rounded-pill px-3 py-1"><?= htmlspecialchars($action) ?></span>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($module) ?></span></td>
                                <td class="font-monospace"><?= htmlspecialchars($recordId ?: '-') ?></td>
                                <td class="font-monospace small text-muted"><?= htmlspecialchars($ipAddress) ?></td>
                                <td>
                                    <?php if (!empty($newData) || !empty($oldData)): ?>
                                        <button class="btn btn-sm btn-outline-info rounded-3" onclick="viewLogDetails(<?= htmlspecialchars(json_encode([
                                            'old' => $oldData,
                                            'new' => $newData
                                        ])) ?>)">
                                            <i class="bi bi-eye me-1"></i> ดูข้อมูล
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
    let text = '';
    if (data.old) text += '=== ข้อมูลเดิม ===\n' + (typeof data.old === 'string' ? data.old : JSON.stringify(data.old, null, 2)) + '\n\n';
    if (data.new) text += '=== ข้อมูลใหม่ ===\n' + (typeof data.new === 'string' ? data.new : JSON.stringify(data.new, null, 2));
    alert(text || 'ไม่มีข้อมูลรายละเอียดเพิ่มเติม');
}
</script>
