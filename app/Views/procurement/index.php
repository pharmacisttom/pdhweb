<div class="procurement-page-wrapper">
    <!-- Hero Header Section -->
    <section class="procurement-hero-section py-4 py-md-5 position-relative overflow-hidden">
        <div class="container position-relative" style="z-index: 2;">
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= URLROOT ?>" class="text-white-50 text-decoration-none"><i class="bi bi-house-door me-1"></i> หน้าแรก</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">ประกาศจัดซื้อจัดจ้าง</li>
                </ol>
            </nav>

            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-15 text-white border border-white border-opacity-25 mb-3 shadow-sm">
                        <i class="bi bi-file-earmark-text-fill text-warning"></i>
                        <span class="small fw-semibold">Procurement & E-Bidding Portal</span>
                    </div>
                    <h1 class="display-6 fw-bold text-white mb-2">
                        ประกาศจัดซื้อจัดจ้าง
                    </h1>
                    <p class="text-white-50 fs-5 mb-0">
                        ศูนย์รวมประกาศจัดซื้อจัดจ้าง แผนการจัดซื้อจัดจ้างประจำปี และสรุปผลการดำเนินการ (สขร.1) โรงพยาบาลปลวกแดง
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <div class="p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-20 d-inline-block text-start text-white shadow-lg">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-warning bg-opacity-25 p-3 text-warning">
                                <i class="bi bi-shield-check fs-2 text-warning"></i>
                            </div>
                            <div>
                                <div class="text-uppercase small text-white-50">ความโปร่งใสและตรวจสอบได้</div>
                                <div class="fs-6 fw-bold text-white">ตาม พ.ร.บ. จัดซื้อจัดจ้างภาครัฐ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="procurement-hero-bg-shapes"></div>
    </section>

    <!-- Main Container -->
    <div class="container py-5">

        <!-- Search & Filter Controls -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
            <div class="row g-3 align-items-center justify-content-between">
                
                <!-- Category Filter Pills -->
                <div class="col-lg-8">
                    <div class="d-flex flex-wrap gap-2" id="procCategoryFilter">
                        <a href="<?= URLROOT ?>/procurement" class="btn btn-sm rounded-pill px-3 <?= empty($selected_category) ? 'btn-primary' : 'btn-outline-secondary' ?>">
                            <i class="bi bi-grid-fill me-1"></i> ทั้งหมด
                        </a>
                        <a href="<?= URLROOT ?>/procurement?category=แผนการจัดซื้อจัดจ้าง" class="btn btn-sm rounded-pill px-3 <?= $selected_category == 'แผนการจัดซื้อจัดจ้าง' ? 'btn-primary' : 'btn-outline-secondary' ?>">
                            <i class="bi bi-calendar-range me-1"></i> แผนการจัดซื้อจัดจ้าง
                        </a>
                        <a href="<?= URLROOT ?>/procurement?category=ประกาศจัดซื้อจัดจ้าง" class="btn btn-sm rounded-pill px-3 <?= $selected_category == 'ประกาศจัดซื้อจัดจ้าง' ? 'btn-primary' : 'btn-outline-secondary' ?>">
                            <i class="bi bi-megaphone-fill me-1"></i> ประกาศจัดซื้อจัดจ้าง
                        </a>
                        <a href="<?= URLROOT ?>/procurement?category=สรุปผลการจัดซื้อจัดจ้าง" class="btn btn-sm rounded-pill px-3 <?= $selected_category == 'สรุปผลการจัดซื้อจัดจ้าง' ? 'btn-primary' : 'btn-outline-secondary' ?>">
                            <i class="bi bi-file-earmark-check-fill me-1"></i> สรุปผลการดำเนินการ (สขร.1)
                        </a>
                    </div>
                </div>

                <!-- Live Search Box -->
                <div class="col-lg-4">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" id="procSearchInput" class="form-control form-control-sm rounded-pill ps-5 py-2" placeholder="พิมพ์ค้นหาชื่อประกาศ, เลขที่ หรือวงเงิน...">
                    </div>
                </div>

            </div>
        </div>

        <!-- Procurement Data Table -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-5">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle" id="procurementTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 py-3" width="14%">วันที่ประกาศ</th>
                            <th class="py-3" width="48%">หัวข้อประกาศ / โครงการ</th>
                            <th class="py-3" width="22%">หมวดหมู่</th>
                            <th class="py-3 text-center" width="16%">เอกสารแนบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($procurements)): ?>
                        <tr id="emptyRow">
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                                ยังไม่มีข้อมูลประกาศในหมวดหมู่นี้
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($procurements as $proc): ?>
                            <tr class="proc-row" data-keywords="<?= htmlspecialchars(strtolower($proc->title . ' ' . $proc->category . ' ' . ($proc->project_budget ?? ''))) ?>">
                                <td class="ps-4">
                                    <div class="fw-bold text-dark font-monospace" style="font-size: 0.88rem;">
                                        <i class="bi bi-calendar3 text-primary me-1"></i>
                                        <?= date('d/m/Y', strtotime($proc->published_at)) ?>
                                    </div>
                                    <?php if(!empty($proc->budget_year)): ?>
                                        <small class="text-muted">ปีงบฯ <?= $proc->budget_year ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark mb-1 lh-base" style="font-size: 0.95rem;">
                                        <?= htmlspecialchars($proc->title) ?>
                                    </div>
                                    <div class="d-flex flex-wrap align-items-center gap-3 small text-muted">
                                        <?php if($proc->project_budget && $proc->project_budget > 0): ?>
                                            <span>
                                                <i class="bi bi-cash-stack text-success me-1"></i>
                                                วงเงินงบประมาณ: <strong class="text-dark">฿<?= number_format($proc->project_budget, 2) ?></strong>
                                            </span>
                                        <?php endif; ?>
                                        <?php if(!empty($proc->method)): ?>
                                            <span>
                                                <i class="bi bi-tag text-secondary me-1"></i>
                                                วิธี: <?= htmlspecialchars($proc->method) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                        $badgeClass = 'bg-primary-subtle text-primary border-primary';
                                        $cat = trim($proc->category);
                                        if (str_contains($cat, 'แผน')) {
                                            $badgeClass = 'bg-info-subtle text-info-emphasis border-info';
                                        } else if (str_contains($cat, 'สรุป') || str_contains($cat, 'ผู้ชนะ')) {
                                            $badgeClass = 'bg-success-subtle text-success border-success';
                                        }
                                    ?>
                                    <span class="badge <?= $badgeClass ?> border border-opacity-25 rounded-pill px-3 py-2 fw-semibold">
                                        <?= htmlspecialchars($cat) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if(!empty($proc->document_url)): ?>
                                        <a href="<?= URLROOT ?>/assets/uploads/procurements/<?= htmlspecialchars($proc->document_url) ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF
                                        </a>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border rounded-pill px-3 py-1">
                                            <i class="bi bi-file-earmark-text me-1"></i> ตามประกาศ
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <tr id="noSearchResultRow" class="d-none">
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-search fs-2 d-block mb-2 text-muted"></i>
                                ไม่พบประกาศที่ตรงกับคำค้นหา
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Procurement Department Contact Footer Box -->
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-md-8">
                    <h3 class="h6 fw-bold text-dark mb-1">
                        <i class="bi bi-building text-primary me-2"></i>กลุ่มงานบริหารทั่วไป (งานพัสดุและจัดซื้อจัดจ้าง) โรงพยาบาลปลวกแดง
                    </h3>
                    <p class="small text-muted mb-0">
                        ติดต่อสอบถามข้อมูลการจัดซื้อจัดจ้าง การขอรับเอกสาร หรือยื่นซองเสนอราคา ในวันและเวลาราชการ
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="tel:033650412" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                        <i class="bi bi-telephone-fill me-1"></i> 033-650-412 (ต่อ 102)
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Custom CSS & Live Search Script -->
<style>
    .procurement-page-wrapper {
        background-color: #f8fafc;
    }
    .procurement-hero-section {
        background: linear-gradient(135deg, #093f35 0%, #0d9488 50%, #0284c7 100%);
        box-shadow: inset 0 -20px 30px rgba(0,0,0,0.12);
    }
    .procurement-hero-bg-shapes {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(circle at 15% 25%, rgba(255,255,255,0.08) 0%, transparent 40%),
                          radial-gradient(circle at 85% 75%, rgba(255,255,255,0.06) 0%, transparent 35%);
        pointer-events: none;
    }
    .proc-row:hover {
        background-color: #f1f5f9;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('procSearchInput');
    const procRows = document.querySelectorAll('.proc-row');
    const noSearchRow = document.getElementById('noSearchResultRow');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            let visibleCount = 0;

            procRows.forEach(row => {
                const keywords = (row.getAttribute('data-keywords') || '').toLowerCase();
                const text = row.textContent.toLowerCase();

                if (query === '' || keywords.includes(query) || text.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (noSearchRow) {
                if (visibleCount === 0 && query !== '') {
                    noSearchRow.classList.remove('d-none');
                } else {
                    noSearchRow.classList.add('d-none');
                }
            }
        });
    }
});
</script>
