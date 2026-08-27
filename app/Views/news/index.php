<style>
/* Scoped styles for News Index */
.hero-header {
    background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
    color: white;
    padding: 80px 0;
    text-align: center;
    margin-top: -76px; /* Offset for navbar */
    margin-bottom: 40px;
}

.news-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,.05), 0 2px 4px -1px rgba(0,0,0,.03);
    transition: all 0.3s ease;
    overflow: hidden;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0,0,0,.1), 0 10px 10px -5px rgba(0,0,0,.04);
}

.news-card-img-wrapper {
    overflow: hidden;
    height: 220px;
}

.news-card-img-wrapper img {
    transition: transform 0.5s ease;
}

.news-card:hover .news-card-img-wrapper img {
    transform: scale(1.05);
}

.hover-primary:hover { color: var(--primary-color) !important; }
</style>

<div class="hero-header">
    <div class="container mt-5">
        <h1 class="display-5 fw-bold mb-3">ข่าวสารและกิจกรรม</h1>
        <p class="lead mb-0 text-white-50">ติดตามข่าวสาร ประชาสัมพันธ์ และกิจกรรมต่างๆ จากโรงพยาบาล</p>
    </div>
</div>

<div class="container mb-4">
    <ul class="nav nav-pills justify-content-center gap-2">
        <li class="nav-item">
            <a class="nav-link rounded-pill px-4 <?= empty($current_category) ? 'active shadow-sm' : 'bg-light text-dark' ?>" href="<?= URLROOT ?>/news">ทั้งหมด</a>
        </li>
        <?php if(!empty($categories)): ?>
            <?php foreach($categories as $cat): ?>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-4 <?= (isset($current_category) && $current_category == $cat['slug']) ? 'active shadow-sm' : 'bg-light text-dark' ?>" href="<?= URLROOT ?>/news?category=<?= $cat['slug'] ?>"><?= htmlspecialchars($cat['name']) ?></a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <?php if (($current_category ?? '') === 'procurement'): ?>
        <div class="alert alert-primary border-0 rounded-4 mt-4 mb-0 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div><i class="bi bi-file-earmark-text-fill me-2"></i><strong>ศูนย์ประกาศจัดซื้อจัดจ้าง</strong><span class="ms-1">ค้นหาและดูเอกสารประกาศตามปีงบประมาณได้ที่นี่</span></div>
            <a href="<?= URLROOT ?>/procurement" class="btn btn-primary rounded-pill px-4 flex-shrink-0"><i class="bi bi-box-arrow-up-right me-1"></i>เปิดศูนย์จัดซื้อจัดจ้าง</a>
        </div>
    <?php endif; ?>
</div>

<div class="container mb-5 pb-5 mt-5">
    <div class="row g-4">
        <?php if(empty($newsList)): ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-newspaper display-1 text-muted mb-3 d-block opacity-50"></i>
                <p class="text-muted fs-5">ยังไม่มีข่าวสารในขณะนี้</p>
            </div>
        <?php else: ?>
            <?php foreach($newsList as $news): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card news-card h-100">
                        <a href="<?= URLROOT ?>/news/<?= $news->slug ?: $news->id ?>" class="d-block news-card-img-wrapper bg-light text-decoration-none">
                            <?php if(!empty($news->pdf_file) && ($news->cover_image == 'default-news.jpg' || empty($news->cover_image))): ?>
                                <!-- Use PDF.js to render first page as thumbnail -->
                                <div class="pdf-thumbnail-container d-flex align-items-center justify-content-center w-100 h-100" data-pdf-url="<?= URLROOT ?>/assets/docs/news/<?= htmlspecialchars($news->pdf_file) ?>">
                                    <canvas class="pdf-canvas w-100 h-100" style="object-fit: cover;"></canvas>
                                </div>
                            <?php elseif(!empty($news->cover_image) && $news->cover_image != 'default-news.jpg'): ?>
                                <img src="<?= URLROOT ?>/assets/images/news/<?= $news->cover_image ?>" class="card-img-top w-100 h-100" alt="<?= htmlspecialchars($news->title) ?>" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                                    <i class="bi bi-newspaper text-secondary opacity-50" style="font-size: 5rem;"></i>
                                </div>
                            <?php endif; ?>
                        </a>
                        
                        <div class="card-body p-4">
                            <?php
                                $cat_name = ucfirst($news->category);
                                if (isset($categories) && !empty($categories)) {
                                    foreach ($categories as $cat) {
                                        if ($cat['slug'] == $news->category) {
                                            $cat_name = $cat['name'];
                                            break;
                                        }
                                    }
                                }
                            ?>
                            <span class="badge bg-primary-subtle text-primary mb-3 shadow-sm px-3 py-2 rounded-pill fw-medium">
                                <?= htmlspecialchars($cat_name) ?>
                            </span>
                            
                            <div class="text-muted small mb-3 d-flex align-items-center">
                                <i class="bi bi-calendar3 me-2 text-primary"></i> <?= date('d M Y', strtotime($news->published_at)) ?>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-3" style="line-height: 1.5;">
                                <a href="<?= URLROOT ?>/news/<?= $news->slug ?: $news->id ?>" class="text-decoration-none text-dark hover-primary">
                                    <?= mb_strimwidth(htmlspecialchars($news->title), 0, 70, '...') ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-0" style="line-height: 1.6;">
                                <?= mb_strimwidth(strip_tags($news->summary), 0, 110, '...') ?>
                            </p>
                            <div class="mt-4">
                                <a href="<?= URLROOT ?>/news/<?= $news->slug ?: $news->id ?>" class="btn btn-outline-primary rounded-pill w-100 fw-semibold">
                                    <i class="bi bi-file-earmark-text me-1"></i>ดูรายละเอียดประกาศ <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
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
                    container.innerHTML = '<i class="bi bi-file-earmark-pdf text-danger" style="font-size: 5rem;"></i>';
                });
            });
        }
    });
</script>
