<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0 text-gray-800 fw-bold">Dashboard</h1>
    <div class="text-muted small"><i class="bi bi-calendar3 me-1"></i> ภาพรวมระบบ</div>
</div>

<div class="row g-4 mb-4">
    <!-- Stat 1 -->
    <div class="col-xl-4 col-md-6">
        <div class="card h-100 py-2">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-3 bg-info-pastel rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-newspaper text-info fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 0.75rem;">ข่าวสาร</div>
                        <div class="h3 mb-0 fw-bold text-dark"><?= $newsCount ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stat 2 (Doctors) -->
    <div class="col-xl-4 col-md-6">
        <div class="card h-100 py-2">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-3 rounded-circle d-flex align-items-center justify-content-center" style="background-color: #ccfbf1; width: 50px; height: 50px;">
                            <i class="bi bi-heart-pulse fs-5" style="color: var(--primary-color);"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 0.75rem;">จำนวนแพทย์</div>
                        <div class="h3 mb-0 fw-bold text-dark"><?= $doctorCount ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stat 3 (Complaints) -->
    <div class="col-xl-4 col-md-6">
        <div class="card h-100 py-2">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="p-3 bg-warning-pastel rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-exclamation-triangle text-warning fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs fw-bold text-muted text-uppercase mb-1" style="font-size: 0.75rem;">เรื่องร้องเรียน</div>
                        <div class="h3 mb-0 fw-bold text-dark"><?= $pendingComplaintCount ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- News List -->
    <div class="col-lg-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex align-items-center justify-content-between">
                <h6 class="m-0 fw-bold text-dark">ข่าวประชาสัมพันธ์ล่าสุด</h6>
                <a href="<?= URLROOT ?>/admin/news" class="btn btn-sm btn-outline-primary rounded-pill">ดูทั้งหมด</a>
            </div>
            <div class="card-body p-0 mt-3">
                <div class="list-group list-group-flush rounded-bottom">
                    <?php if(empty($latestNews)): ?>
                        <div class="p-4 text-center text-muted">ยังไม่มีข่าวสาร</div>
                    <?php else: ?>
                        <?php foreach($latestNews as $news): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center p-3 border-light hover-bg-light transition-all">
                            <div>
                                <h6 class="mb-1 text-dark fw-semibold" style="font-size: 0.9rem;"><?= mb_strimwidth($news->title, 0, 40, '...') ?></h6>
                                <small class="text-muted"><i class="bi bi-tag me-1"></i> <?= $news->category ?></small>
                            </div>
                            <div>
                                <?php if ($news->status == 'published'): ?>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1" style="font-size: 0.7rem;">เผยแพร่</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-2 py-1" style="font-size: 0.7rem;">ฉบับร่าง</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Frontend Page Preview -->
    <div class="col-lg-8 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 fw-bold text-dark"><i class="bi bi-display me-2 text-primary"></i>ตัวอย่างหน้าเว็บไซต์ (Live Preview)</h6>
                <a href="<?= URLROOT ?>" target="_blank" class="btn btn-sm btn-primary rounded-pill"><i class="bi bi-box-arrow-up-right me-1"></i> เปิดหน้าต่างใหม่</a>
            </div>
            <div class="card-body p-0 bg-light rounded-bottom overflow-hidden position-relative" style="height: 500px;">
                <!-- We use an iframe to preview the frontend home page -->
                <div class="browser-mockup position-absolute w-100 h-100">
                    <div class="browser-header d-flex align-items-center px-3 py-2 bg-dark rounded-top" style="height: 40px;">
                        <div class="d-flex gap-2">
                            <span class="rounded-circle bg-danger" style="width: 12px; height: 12px;"></span>
                            <span class="rounded-circle bg-warning" style="width: 12px; height: 12px;"></span>
                            <span class="rounded-circle bg-success" style="width: 12px; height: 12px;"></span>
                        </div>
                        <div class="mx-auto bg-secondary bg-opacity-25 rounded px-3 py-1 text-white-50 small" style="width: 60%; font-size: 0.75rem;">
                            <?= URLROOT ?>
                        </div>
                    </div>
                    <iframe src="<?= URLROOT ?>" class="w-100 border-0" style="height: calc(100% - 40px);"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

