<style>
/* Scoped styles for the home page hero */
.hero-section {
    background: linear-gradient(135deg, #0f172a, #1e293b), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
    background-size: cover;
    background-position: center;
    background-blend-mode: overlay;
    color: white;
    padding: 120px 0;
    text-align: center;
    margin-top: -76px; /* Offset for navbar if needed, or just leave it */
}

.hero-section h1 {
    font-size: 3.5rem;
    font-weight: 800;
    letter-spacing: -1px;
}

.quick-service-card {
    transition: all 0.3s ease;
    border-radius: 16px;
    border: none;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
}

.quick-service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.quick-service-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 20px;
}
</style>

<?php if(isset($banners) && !empty($banners)): ?>
    <div id="heroCarousel" class="carousel slide mb-5" style="margin-top: -76px;" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach($banners as $index => $banner): ?>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach($banners as $index => $banner): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <?php if(!empty($banner->link)): ?>
                        <a href="<?= htmlspecialchars($banner->link) ?>" class="d-block w-100">
                    <?php endif; ?>
                    
                    <div style="height: 600px; width: 100%; background: url('<?= URLROOT ?>/assets/images/banners/<?= $banner->image_file ?>') center/cover no-repeat;">
                    </div>
                    
                    <?php if(!empty($banner->link)): ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php else: ?>
    <!-- Fallback static hero section if no banners -->
    <div class="hero-section mb-5">
        <div class="container mt-5">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-4" style="font-size: 1rem; background-color: var(--primary-color) !important;">
                <i class="bi bi-shield-check me-1"></i> มาตรฐานการแพทย์ระดับสากล
            </span>
            <h1 class="mb-3">โรงพยาบาลปลวกแดง</h1>
            <p class="lead mb-5" style="max-width: 600px; margin: 0 auto; color: #cbd5e1;">
                "ดูแลด้วยมาตรฐาน ใส่ใจประชาชน" ให้บริการทางการแพทย์อย่างครบวงจร พร้อมด้วยทีมแพทย์ผู้เชี่ยวชาญและเทคโนโลยีที่ทันสมัย
            </p>
            <div>
                <a href="<?= URLROOT ?>/service" class="btn btn-primary btn-lg px-5 py-3 me-sm-3 mb-3 mb-sm-0 fw-bold" style="border-radius: 50px;">
                    ดูบริการของเรา
                </a>
                <a href="<?= URLROOT ?>/doctor" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold" style="border-radius: 50px;">
                    ทำเนียบแพทย์
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container mb-5" style="margin-top: -60px; position: relative; z-index: 10;">
    <div class="row g-4 justify-content-center">
        <!-- Quick Service Cards -->
        <div class="col-6 col-md-3">
            <a href="<?= URLROOT ?>/doctor" class="text-decoration-none">
                <div class="card quick-service-card h-100 py-4 text-center">
                    <div class="quick-service-icon" style="background-color: #ccfbf1;">
                        <i class="bi bi-person-badge display-5" style="color: #0d9488;"></i>
                    </div>
                    <h5 class="card-title text-dark fw-bold mb-0">ค้นหาแพทย์</h5>
                    <p class="text-muted small mt-2 mb-0">ดูตารางออกตรวจ</p>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="<?= URLROOT ?>/clinic" class="text-decoration-none">
                <div class="card quick-service-card h-100 py-4 text-center">
                    <div class="quick-service-icon" style="background-color: #e0f2fe;">
                        <i class="bi bi-hospital display-5" style="color: #0369a1;"></i>
                    </div>
                    <h5 class="card-title text-dark fw-bold mb-0">คลินิกเฉพาะโรค</h5>
                    <p class="text-muted small mt-2 mb-0">คลินิกเบาหวาน, ความดัน, ฯลฯ</p>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="<?= URLROOT ?>/department" class="text-decoration-none">
                <div class="card quick-service-card h-100 py-4 text-center">
                    <div class="quick-service-icon" style="background-color: #fef3c7;">
                        <i class="bi bi-diagram-3 display-5" style="color: #d97706;"></i>
                    </div>
                    <h5 class="card-title text-dark fw-bold mb-0">กลุ่มงานและฝ่าย</h5>
                    <p class="text-muted small mt-2 mb-0">ติดต่อหน่วยงานภายใน</p>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="<?= URLROOT ?>/donation" class="text-decoration-none">
                <div class="card quick-service-card h-100 py-4 text-center">
                    <div class="quick-service-icon" style="background-color: #fee2e2;">
                        <i class="bi bi-box2-heart display-5" style="color: #ef4444;"></i>
                    </div>
                    <h5 class="card-title text-dark fw-bold mb-0">ร่วมบริจาค</h5>
                    <p class="text-muted small mt-2 mb-0">บริจาคเงินและอุปกรณ์</p>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container mb-5 pb-5">
    <?php if(!empty($newsByCategory)): ?>
        <?php foreach($newsByCategory as $catSlug => $category): ?>
            <?php if(!empty($category['items'])): ?>
                <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
                    <h2 class="fw-bold text-dark mb-0"><?= htmlspecialchars($category['name']) ?> <span style="color: var(--primary-color);">.</span></h2>
                    <a href="<?= URLROOT ?>/news?category=<?= $catSlug ?>" class="btn btn-outline-primary rounded-pill px-4">ดูทั้งหมด <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
                
                <div class="row g-4 mb-4">
                    <?php foreach($category['items'] as $news): ?>
                    <div class="col-md-4">
                        <div class="card h-100 quick-service-card overflow-hidden">
                            <?php if(!empty($news->pdf_file) && ($news->cover_image == 'default-news.jpg' || empty($news->cover_image))): ?>
                                <!-- Use PDF.js to render first page as thumbnail -->
                                <div class="pdf-thumbnail-container bg-light d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;" data-pdf-url="<?= URLROOT ?>/assets/docs/news/<?= htmlspecialchars($news->pdf_file) ?>">
                                    <canvas class="pdf-canvas w-100" style="object-fit: cover;"></canvas>
                                </div>
                            <?php else: ?>
                                <img src="<?= URLROOT ?>/assets/images/news/<?= $news->cover_image ?: 'default-news.jpg' ?>" class="card-img-top" alt="<?= htmlspecialchars($news->title) ?>" style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            
                            <div class="card-body p-4">
                                <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill"><?= htmlspecialchars($category['name']) ?></span>
                                <h5 class="card-title fw-bold">
                                    <a href="<?= URLROOT ?>/news/show/<?= $news->slug ?>" class="text-dark text-decoration-none stretched-link">
                                        <?= mb_strimwidth(htmlspecialchars($news->title), 0, 60, '...') ?>
                                    </a>
                                </h5>
                                <p class="card-text text-muted small mt-3 mb-0">
                                    <?= mb_strimwidth(strip_tags($news->summary), 0, 100, '...') ?>
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 px-4 pb-4 pt-0 text-muted small d-flex align-items-center">
                                <i class="bi bi-calendar3 me-2"></i> <?= date('d M Y', strtotime($news->published_at)) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">ข่าวสารล่าสุด <span style="color: var(--primary-color);">.</span></h2>
        </div>
        <div class="col-12 text-center py-5">
            <i class="bi bi-newspaper display-1 text-muted mb-3 d-block"></i>
            <p class="text-muted">ยังไม่มีข่าวสารในขณะนี้</p>
        </div>
    <?php endif; ?>
</div>

<!-- PDF.js for rendering PDF thumbnails -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof pdfjsLib !== 'undefined') {
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';
            
            const pdfContainers = document.querySelectorAll('.pdf-thumbnail-container');
            
            pdfContainers.forEach(container => {
                const url = container.dataset.pdfUrl;
                const canvas = container.querySelector('canvas');
                const ctx = canvas.getContext('2d');
                
                pdfjsLib.getDocument(url).promise.then(function(pdf) {
                    return pdf.getPage(1);
                }).then(function(page) {
                    const viewport = page.getViewport({scale: 1.5});
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    
                    const renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    page.render(renderContext);
                }).catch(function(error) {
                    console.error('Error rendering PDF thumbnail:', error);
                    // Fallback icon if PDF fails to render
                    container.innerHTML = '<i class="bi bi-file-earmark-pdf text-danger" style="font-size: 5rem;"></i>';
                });
            });
        }
    });
</script>
