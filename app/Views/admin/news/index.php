<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/news/create" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> เขียนข่าวใหม่</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="35%">หัวข้อข่าว</th>
                        <th width="15%">หมวดหมู่</th>
                        <th width="15%">ผู้เขียน</th>
                        <th width="15%">สถานะ</th>
                        <th width="15%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($newsList)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">ไม่มีข้อมูลข่าวสาร</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($newsList as $news): ?>
                        <tr>
                            <td><?= $news->id ?></td>
                            <td class="fw-medium">
                                <?= $news->title ?><br>
                                <small class="text-muted"><i class="bi bi-clock"></i> <?= date('d/m/Y H:i', strtotime($news->created_at)) ?></small>
                            </td>
                            <td><?= ucfirst($news->category) ?></td>
                            <td><?= $news->firstname ?> <?= $news->lastname ?></td>
                            <td>
                                <?php if ($news->status == 'published'): ?>
                                    <span class="badge bg-success-pastel">เผยแพร่แล้ว</span>
                                <?php elseif ($news->status == 'draft'): ?>
                                    <span class="badge bg-warning-pastel text-dark">ฉบับร่าง</span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border">เก็บถาวร</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= URLROOT ?>/admin/news/edit/<?= $news->id ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?= URLROOT ?>/admin/news/delete/<?= $news->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข่าวนี้ใช่หรือไม่?');">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
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
