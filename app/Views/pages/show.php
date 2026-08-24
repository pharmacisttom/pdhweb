<div class="page-detail-wrapper bg-light min-vh-100 pb-5">
    <!-- Header Hero Section -->
    <div class="page-hero-header py-4 py-md-5 text-white position-relative" style="background: linear-gradient(135deg, #093f35 0%, #0d9488 50%, #0284c7 100%);">
        <div class="container position-relative" style="z-index: 2;">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= URLROOT ?>" class="text-white-50 text-decoration-none"><i class="bi bi-house-door me-1"></i> หน้าแรก</a></li>
                    <li class="breadcrumb-item text-white-50">เกี่ยวกับโรงพยาบาล</li>
                    <li class="breadcrumb-item active text-white" aria-current="page"><?= htmlspecialchars($page->title) ?></li>
                </ol>
            </nav>
            <h1 class="display-6 fw-bold mb-0 text-white"><?= htmlspecialchars($page->title) ?></h1>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container my-4 my-md-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <article class="bg-white p-4 p-md-5 rounded-4 shadow-sm border-0">
                    <div class="page-body-content" style="line-height: 1.85; font-size: 1.05rem;">
                        <?= $page->content ?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
