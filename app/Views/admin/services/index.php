<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">จัดการบริการทางการแพทย์</h1>
    <a href="#" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> เพิ่มบริการใหม่</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>ชื่อบริการ</th>
                        <th>สังกัดกลุ่มงาน</th>
                        <th>เวลาเปิดบริการ</th>
                        <th width="100">สถานะ</th>
                        <th width="150">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($services as $srv): ?>
                    <tr>
                        <td><?= $srv->id ?></td>
                        <td><?= htmlspecialchars($srv->name) ?></td>
                        <td><?= htmlspecialchars($srv->department_name ?? '-') ?></td>
                        <td><?= htmlspecialchars($srv->open_time) ?></td>
                        <td>
                            <?php if($srv->status == 'active'): ?>
                                <span class="badge bg-success-pastel">เปิดใช้งาน</span>
                            <?php else: ?>
                                <span class="badge bg-light text-muted border">ปิดใช้งาน</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
