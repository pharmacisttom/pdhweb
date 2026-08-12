<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <article class="bg-white p-4 p-md-5 rounded shadow-sm border border-light">
                <h1 class="fw-bold mb-4 text-primary pb-3 border-bottom"><?= $page->title ?></h1>
                
                <div class="page-content" style="line-height: 1.8; font-size: 1.05rem;">
                    <?= $page->content ?> <!-- Assuming content contains valid HTML from WYSIWYG editor -->
                </div>
            </article>
        </div>
    </div>
</div>
