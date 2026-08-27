<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0"><?= escape($page_title) ?></h3>
    <a href="<?= url('/admin/users') ?>" class="btn btn-outline-secondary rounded-pill">กลับ</a>
</div>

<div class="card shadow-sm border-0 rounded-4"><div class="card-body p-4">
    <form method="post" action="<?= $user ? url('/admin/users/update/' . $user->id) : url('/admin/users/create') ?>" autocomplete="off">
        <?= csrf_field() ?>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Username</label><input class="form-control" name="username" required pattern="[A-Za-z0-9_.-]{3,50}" value="<?= escape($user->username ?? '') ?>"></div>
            <div class="col-md-6"><label class="form-label">อีเมล</label><input class="form-control" type="email" name="email" required value="<?= escape($user->email ?? '') ?>"></div>
            <div class="col-md-6"><label class="form-label">ชื่อ</label><input class="form-control" name="firstname" required value="<?= escape($user->firstname ?? '') ?>"></div>
            <div class="col-md-6"><label class="form-label">นามสกุล</label><input class="form-control" name="lastname" required value="<?= escape($user->lastname ?? '') ?>"></div>
            <div class="col-md-6"><label class="form-label">บทบาท</label><select class="form-select" name="role_id" required><?php foreach ($roles as $role): ?><option value="<?= $role->id ?>" <?= (int)($user->role_id ?? 0) === (int)$role->id ? 'selected' : '' ?>><?= escape($role->name) ?></option><?php endforeach; ?></select></div>
            <div class="col-md-6"><label class="form-label">รหัสผ่าน <?= $user ? '<small class="text-muted">(เว้นว่างเพื่อไม่เปลี่ยน)</small>' : '' ?></label><input class="form-control" type="password" name="password" <?= $user ? '' : 'required' ?> minlength="12" autocomplete="new-password"></div>
        </div>
        <button class="btn btn-primary mt-4 px-4" type="submit">บันทึก</button>
    </form>
</div></div>
