<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">จัดการประกาศจัดซื้อจัดจ้าง แผนการจัดซื้อประจำปี และสรุปผล สขร.1</p>
    </div>
    <a href="<?= URLROOT ?>/admin/procurement/create" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-lg me-1"></i> เพิ่มประกาศใหม่
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="12%" class="ps-4">วันที่ประกาศ</th>
                        <th width="40%">หัวข้อประกาศ / โครงการ</th>
                        <th width="20%">หมวดหมู่</th>
                        <th width="10%">สถานะ</th>
                        <th width="18%" class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($procurements)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            ยังไม่มีข้อมูลประกาศจัดซื้อจัดจ้าง
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($procurements as $proc): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-semibold text-dark small font-monospace">
                                    <i class="bi bi-calendar3 text-primary me-1"></i>
                                    <?= date('d/m/Y', strtotime($proc->published_at)) ?>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($proc->title) ?></div>
                                <div class="d-flex flex-wrap gap-2 align-items-center small text-muted">
                                    <?php if($proc->project_budget && $proc->project_budget > 0): ?>
                                        <span class="text-success fw-semibold">
                                            <i class="bi bi-cash-stack me-1"></i>฿<?= number_format($proc->project_budget, 2) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if(!empty($proc->document_url)): ?>
                                        <a href="<?= URLROOT ?>/assets/uploads/procurements/<?= htmlspecialchars($proc->document_url) ?>" target="_blank" class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 text-decoration-none">
                                            <i class="bi bi-file-earmark-pdf me-1"></i> ไฟล์แนบ
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1">
                                    <?= htmlspecialchars($proc->category) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($proc->status == 'active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-1">เผยแพร่</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">ซ่อน/เก็บถาวร</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= URLROOT ?>/admin/procurement/edit/<?= $proc->id ?>" class="btn btn-sm btn-outline-primary rounded-3" title="แก้ไข">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?= URLROOT ?>/admin/procurement/delete/<?= $proc->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบประกาศนี้ใช่หรือไม่?');">
                                        <?= \App\Helpers\Security::csrfField() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="ลบ">
                                            <i class="bi bi-trash"></i>
                                        </button>
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
