<?php
$isOfficial = $category === 'official_order';
$heading = $isOfficial ? 'หนังสือราชการและคำสั่ง' : 'ศูนย์ดาวน์โหลดเอกสาร';
$description = $isOfficial ? 'รวบรวมหนังสือราชการ คำสั่ง และเอกสารที่เกี่ยวข้อง' : 'เอกสารสำหรับประชาชนและหน่วยงาน ดาวน์โหลดได้ในรูปแบบ PDF';
?>
<section class="py-5" style="background: linear-gradient(180deg, #eff8fb 0, #ffffff 100%); min-height: 65vh;">
    <div class="container">
        <div class="rounded-4 p-4 p-md-5 mb-4 text-white" style="background: linear-gradient(125deg, #0a4b6e, #118f9d);">
            <div class="row align-items-center g-3">
                <div class="col-md-9"><span class="badge rounded-pill text-bg-light text-primary mb-3"><i class="bi bi-file-earmark-pdf me-1"></i> DOCUMENT CENTER</span><h1 class="h2 fw-bold mb-2"><?= $heading ?></h1><p class="mb-0 opacity-75"><?= $description ?></p></div>
                <div class="col-md-3 text-md-end"><i class="bi bi-folder2-open display-4 opacity-75"></i></div>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 mb-4"><a href="<?= URLROOT ?>/downloads" class="btn rounded-pill px-4 <?= !$isOfficial ? 'btn-primary' : 'btn-outline-primary' ?>"><i class="bi bi-download me-1"></i> ดาวน์โหลด</a><a href="<?= URLROOT ?>/official-documents" class="btn rounded-pill px-4 <?= $isOfficial ? 'btn-primary' : 'btn-outline-primary' ?>"><i class="bi bi-journal-text me-1"></i> หนังสือราชการ/คำสั่ง</a></div>
        <?php if (empty($documents)): ?>
            <div class="text-center bg-white rounded-4 shadow-sm p-5"><i class="bi bi-folder-x display-5 text-secondary d-block mb-3"></i><h2 class="h5 fw-bold">ยังไม่มีเอกสารในหมวดนี้</h2><p class="text-secondary mb-0">เอกสารที่เผยแพร่จะแสดงที่หน้านี้</p></div>
        <?php else: ?>
            <div class="row g-3">
                <?php foreach ($documents as $document): ?>
                <div class="col-12"><article class="bg-white rounded-4 shadow-sm border p-3 p-md-4 d-flex flex-column flex-md-row gap-3 align-items-md-center"><div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 54px; height: 54px; background: #fff1f2; color: #dc2626;"><i class="bi bi-file-earmark-pdf fs-3"></i></div><div class="flex-grow-1"><div class="d-flex flex-wrap gap-2 align-items-center mb-1"><span class="badge text-bg-light text-primary border"><?= $isOfficial ? 'หนังสือราชการ/คำสั่ง' : 'ดาวน์โหลด' ?></span><?php if ($document->document_number): ?><small class="text-secondary">เลขที่ <?= htmlspecialchars($document->document_number) ?></small><?php endif; ?></div><h2 class="h5 fw-bold mb-1"><?= htmlspecialchars($document->title) ?></h2><?php if ($document->description): ?><p class="text-secondary small mb-2"><?= htmlspecialchars($document->description) ?></p><?php endif; ?><small class="text-secondary"><i class="bi bi-calendar3 me-1"></i><?= $document->issued_date ? date('d/m/Y', strtotime($document->issued_date)) : date('d/m/Y', strtotime($document->created_at)) ?> <span class="mx-1">|</span> PDF <?= number_format($document->file_size / 1024 / 1024, 2) ?> MB</small></div><a href="<?= URLROOT ?>/assets/docs/documents/<?= rawurlencode($document->file_name) ?>" target="_blank" rel="noopener" class="btn btn-outline-primary rounded-pill px-4 flex-shrink-0"><i class="bi bi-box-arrow-up-right me-1"></i> เปิดเอกสาร</a></article></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
