<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary"><?= $page_title ?></h1>
        <p class="lead text-muted">ศูนย์รวมประกาศจัดซื้อจัดจ้าง แผนการจัดซื้อจัดจ้าง และสรุปผลการดำเนินการของโรงพยาบาล</p>
    </div>

    <!-- Filter/Tabs -->
    <ul class="nav nav-pills justify-content-center mb-4">
        <li class="nav-item">
            <a class="nav-link <?= empty($selected_category) ? 'active' : '' ?>" href="<?= URLROOT ?>/procurement">ทั้งหมด</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $selected_category == 'แผนการจัดซื้อจัดจ้าง' ? 'active' : '' ?>" href="<?= URLROOT ?>/procurement?category=แผนการจัดซื้อจัดจ้าง">แผนการจัดซื้อจัดจ้าง</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $selected_category == 'ประกาศจัดซื้อจัดจ้าง' ? 'active' : '' ?>" href="<?= URLROOT ?>/procurement?category=ประกาศจัดซื้อจัดจ้าง">ประกาศจัดซื้อจัดจ้าง</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $selected_category == 'สรุปผลการจัดซื้อจัดจ้าง' ? 'active' : '' ?>" href="<?= URLROOT ?>/procurement?category=สรุปผลการจัดซื้อจัดจ้าง">สรุปผลการดำเนินการ</a>
        </li>
    </ul>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" width="15%">วันที่ประกาศ</th>
                            <th width="45%">หัวข้อประกาศ</th>
                            <th width="20%">หมวดหมู่</th>
                            <th width="20%" class="text-center">ดาวน์โหลดเอกสาร</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($procurements)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">ยังไม่มีข้อมูลประกาศในหมวดหมู่นี้</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($procurements as $proc): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-medium text-dark"><?= date('d/m/Y', strtotime($proc->published_at)) ?></div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary mb-1"><?= $proc->title ?></div>
                                    <?php if($proc->project_budget): ?>
                                        <div class="small text-muted">วงเงินงบประมาณ: <?= number_format($proc->project_budget, 2) ?> บาท</div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= $proc->category ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if($proc->document_url): ?>
                                        <a href="<?= URLROOT ?>/assets/uploads/procurements/<?= $proc->document_url ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> ดาวน์โหลด</a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
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
