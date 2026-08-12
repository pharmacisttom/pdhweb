<style>
/* Scoped styles for News Show */
.news-header-bg {
    background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
    color: white;
    padding: 60px 0 100px; /* Extra padding at bottom for overlap */
    margin-top: -76px; /* Offset for navbar */
}

.news-article-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 25px -5px rgba(0,0,0,.05), 0 8px 10px -6px rgba(0,0,0,.01);
    margin-top: -60px; /* Overlap with header */
    background: white;
    overflow: hidden;
}

.news-content {
    line-height: 1.8;
    font-size: 1.1rem;
    color: #334155;
}

.news-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}
</style>

<div class="news-header-bg">
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= URLROOT ?>" class="text-white-50 text-decoration-none">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="<?= URLROOT ?>/news" class="text-white-50 text-decoration-none">ข่าวสาร</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">เนื้อหาข่าว</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <article class="news-article-card p-0">
                <!-- Cover Image -->
                <?php if(!empty($news->cover_image) && $news->cover_image != 'default-news.jpg'): ?>
                    <img src="<?= URLROOT ?>/assets/images/news/<?= $news->cover_image ?>" class="w-100" style="max-height: 500px; object-fit: cover;" alt="<?= htmlspecialchars($news->title) ?>">
                <?php endif; ?>
                
                <div class="p-4 p-md-5">
                    <div class="mb-4">
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
                        <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill fw-medium fs-6"><?= htmlspecialchars($cat_name) ?></span>
                        <h1 class="fw-bold mb-4 text-dark" style="line-height: 1.4; font-size: 2.25rem;"><?= htmlspecialchars($news->title) ?></h1>
                        
                        <div class="d-flex flex-wrap align-items-center text-muted border-top border-bottom py-3">
                            <div class="me-4 mb-2 mb-sm-0">
                                <i class="bi bi-calendar3 me-2 text-primary"></i> 
                                <span class="fw-medium">เผยแพร่เมื่อ:</span> <?= date('d M Y H:i', strtotime($news->published_at)) ?>
                            </div>
                            <div>
                                <i class="bi bi-person-circle me-2 text-primary"></i> 
                                <span class="fw-medium">เขียนโดย:</span> <?= htmlspecialchars($news->firstname) ?> <?= htmlspecialchars($news->lastname) ?>
                            </div>
                        </div>
                    </div>

                    <?php if(!empty($news->summary)): ?>
                        <div class="lead fw-medium text-secondary mb-5 p-4 bg-light rounded" style="border-left: 4px solid var(--primary-color);">
                            <?= nl2br(htmlspecialchars($news->summary)) ?>
                        </div>
                    <?php endif; ?>

                    <div class="news-content">
                        <?= $news->content ?> <!-- Content is expected to be safe HTML from rich text editor -->
                    </div>
                    
                    <?php if(!empty($news->pdf_file)): ?>
                        <div class="mt-5 mb-4">
                            <h4 class="fw-bold text-dark mb-3"><i class="bi bi-file-earmark-pdf text-danger me-2"></i> เอกสารแนบ (PDF)</h4>
                            <div class="ratio ratio-4x3 border rounded shadow-sm">
                                <iframe src="<?= URLROOT ?>/assets/docs/news/<?= htmlspecialchars($news->pdf_file) ?>" title="<?= htmlspecialchars($news->title) ?>" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="p-3 bg-light rounded border border-2 border-primary border-opacity-25 d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-download text-primary fs-3 me-3"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark"><?= htmlspecialchars($news->pdf_file) ?></h6>
                                </div>
                            </div>
                            <a href="<?= URLROOT ?>/assets/docs/news/<?= htmlspecialchars($news->pdf_file) ?>" target="_blank" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                                ดาวน์โหลด
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <hr class="my-5 opacity-25">
                    
                    <div class="text-center">
                        <a href="<?= URLROOT ?>/news" class="btn btn-outline-primary rounded-pill px-5 py-2 fw-bold">
                            <i class="bi bi-arrow-left me-2"></i> กลับไปหน้าข่าวสารทั้งหมด
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
