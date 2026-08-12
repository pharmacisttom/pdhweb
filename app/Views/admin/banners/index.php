<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/banner/create" class="btn btn-primary shadow-sm"><i class="bi bi-plus-lg me-1"></i> เพิ่มป้ายแบนเนอร์</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" width="80">ลำดับ</th>
                        <th width="150">รูปภาพ</th>
                        <th>หัวข้อ (Title)</th>
                        <th>ลิงก์ (Link)</th>
                        <th>สถานะ</th>
                        <th class="text-end pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($banners)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">ไม่พบข้อมูลแบนเนอร์</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($banners as $banner): ?>
                            <tr>
                                <td class="ps-4 text-muted fw-bold"><?= $banner->sort_order ?></td>
                                <td>
                                    <img src="<?= URLROOT ?>/assets/images/banners/<?= $banner->image_file ?>" alt="Banner" class="img-thumbnail" style="max-width: 120px;">
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($banner->title) ?></div>
                                </td>
                                <td>
                                    <?php if(!empty($banner->link)): ?>
                                        <a href="<?= htmlspecialchars($banner->link) ?>" target="_blank" class="text-primary text-truncate d-inline-block" style="max-width: 200px;">
                                            <i class="bi bi-link-45deg"></i> <?= htmlspecialchars($banner->link) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($banner->status == 'active'): ?>
                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">ใช้งาน</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">ปิดการใช้งาน</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group shadow-sm">
                                        <a href="<?= URLROOT ?>/admin/banner/edit/<?= $banner->id ?>" class="btn btn-light btn-sm text-primary"><i class="bi bi-pencil-square"></i></a>
                                        <form action="<?= URLROOT ?>/admin/banner/delete/<?= $banner->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบแบนเนอร์นี้ใช่หรือไม่?');">
                                            <button type="submit" class="btn btn-light btn-sm text-danger"><i class="bi bi-trash"></i></button>
                                        </form>
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
