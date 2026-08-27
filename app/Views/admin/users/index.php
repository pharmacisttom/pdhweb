<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">จัดการผู้ใช้งาน</h3>
        <p class="text-muted mb-0">กำหนดบัญชีและบทบาทสำหรับผู้ดูแลระบบ</p>
    </div>
    <a href="<?= url('/admin/users/create') ?>" class="btn btn-primary rounded-pill px-4"><i class="bi bi-person-plus me-1"></i> เพิ่มผู้ใช้งาน</a>
</div>

<?php if ($flash = $this->getFlash('user_success')): ?>
    <div class="alert alert-success"><?= escape($flash['message']) ?></div>
<?php endif; ?>
<?php if ($flash = $this->getFlash('user_error')): ?>
    <div class="alert alert-danger"><?= escape($flash['message']) ?></div>
<?php endif; ?>

<div class="card shadow-sm border-0 rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr><th>ผู้ใช้งาน</th><th>บทบาท</th><th>สถานะ</th><th>เข้าสู่ระบบล่าสุด</th><th class="text-end">จัดการ</th></tr></thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><strong><?= escape($user->username) ?></strong><br><small class="text-muted"><?= escape($user->firstname . ' ' . $user->lastname) ?>, <?= escape($user->email) ?></small></td>
                    <td><?= escape($user->role_name ?? 'ไม่ระบุ') ?></td>
                    <td><span class="badge <?= $user->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= escape($user->status) ?></span></td>
                    <td><?= escape($user->last_login ?? '-') ?></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="<?= url('/admin/users/edit/' . $user->id) ?>">แก้ไข</a>
                        <?php if ((int)$user->id !== (int)$_SESSION['user_id']): ?>
                            <form method="post" action="<?= url('/admin/users/status/' . $user->id) ?>" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="status" value="<?= $user->status === 'active' ? 'inactive' : 'active' ?>">
                                <button class="btn btn-sm btn-outline-secondary" type="submit"><?= $user->status === 'active' ? 'ปิดใช้งาน' : 'เปิดใช้งาน' ?></button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
