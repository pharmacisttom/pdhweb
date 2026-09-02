<?php
function formatThaiDate($dateStr) {
    if (empty($dateStr)) return 'ความร่วมมือเพื่อชุมชน';
    $months = [
        1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน',
        5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม',
        9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'
    ];
    $time = strtotime($dateStr);
    $d = date('j', $time);
    $m = $months[(int)date('n', $time)];
    $y = date('Y', $time) + 543;
    return "{$d} {$m} {$y}";
}
?>

<div class="csr-page-wrapper bg-light pb-5">
    
    <!-- Hero Section -->
    <section class="csr-hero-section position-relative text-white py-5 mb-5" style="background: linear-gradient(135deg, #042f2e 0%, #0d9488 50%, #0284c7 100%);">
        <div class="container position-relative py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                        <i class="bi bi-people-fill me-1"></i> PARTNERSHIP FOR COMMUNITY HEALTH
                    </span>
                    <h1 class="display-5 fw-bold text-white mb-3" style="letter-spacing: -0.5px;">
                        พลังความร่วมมือ CSR<br>
                        <span class="text-warning">เพื่อสุขภาพที่ดีของชุมชนปลวกแดง</span>
                    </h1>
                    <p class="lead text-white-75 mb-4 max-w-650" style="color: rgba(255, 255, 255, 0.9);">
                        โรงพยาบาลปลวกแดงขอขอบพระคุณภาคีเครือข่าย ภาคธุรกิจ องค์กร และผู้มีจิตศรัทธาทุกท่าน ที่ร่วมส่งต่อพลังแห่งความเอื้ออาทร สนับสนุนการพัฒนาการแพทย์และยกระดับคุณภาพชีวิตของผู้ป่วย
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#csr-projects-grid" class="btn btn-warning btn-lg rounded-pill px-4 py-3 fw-bold text-dark shadow">
                            <i class="bi bi-images me-1"></i> ชมภาพกิจกรรมความร่วมมือ
                        </a>
                        <a href="<?= URLROOT ?>/contact" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold">
                            <i class="bi bi-envelope-heart me-1"></i> ติดต่อร่วมเป็นภาคี CSR
                        </a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card border-0 rounded-5 shadow-2xl overflow-hidden text-white" style="background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.25) !important;">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-inline-flex p-3 rounded-circle bg-warning text-dark fs-3 mb-3 shadow">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <small class="text-uppercase tracking-wider text-warning fw-bold d-block mb-1">OUR SHARED PURPOSE</small>
                            <h3 class="h4 fw-bold text-white mb-3">ทุกความร่วมมือ เปลี่ยนเป็นการดูแล</h3>
                            <hr class="border-white opacity-25 mb-3">
                            <p class="text-white-75 small mb-4" style="line-height: 1.6;">
                                ตั้งแต่การสนับสนุนอุปกรณ์การแพทย์ เก้าอี้สำนักงาน ยานพาหนะ น้ำดื่ม จนถึงเวชภัณฑ์สำหรับผู้ป่วย เรามุ่งมั่นส่งต่อทุกความช่วยเหลือให้เกิดประโยชน์สูงสุดแก่ประชาชน
                            </p>
                            <div class="row g-2 text-center">
                                <div class="col-6">
                                    <div class="p-2 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10">
                                        <div class="fs-4 fw-bold text-warning font-monospace">100%</div>
                                        <small class="text-white-50" style="font-size: 0.72rem;">ถึงมือผู้ป่วย & รพ.</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10">
                                        <div class="fs-4 fw-bold text-warning font-monospace">2 เท่า</div>
                                        <small class="text-white-50" style="font-size: 0.72rem;">สิทธิลดหย่อนภาษี</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Main Projects Section -->
    <section id="csr-projects-grid" class="container py-4">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
            <div>
                <span class="badge bg-teal-subtle text-teal px-3 py-1 rounded-pill fw-bold small mb-2">
                    <i class="bi bi-patch-check-fill me-1"></i> OUR PARTNERS IN ACTION
                </span>
                <h2 class="display-6 fw-bold text-dark mb-1">เรื่องราวความร่วมมือ & กิจกรรม CSR</h2>
                <p class="text-muted mb-0">ภาพบรรยากาศการส่งมอบและกิจกรรมเพื่อสังคมจากเพจประชาสัมพันธ์ โรงพยาบาลปลวกแดง</p>
            </div>
            <a href="<?= URLROOT ?>/contact" class="btn btn-outline-teal rounded-pill px-4 py-2 fw-semibold">
                <i class="bi bi-chat-heart me-1"></i> สนใจร่วมโครงการกับเรา &rarr;
            </a>
        </div>

        <?php if (empty($projects)): ?>
            <div class="text-center py-5 bg-white rounded-5 shadow-sm p-5">
                <i class="bi bi-stars display-1 text-teal mb-3 d-block"></i>
                <h4 class="fw-bold">พื้นที่สำหรับเรื่องราวดี ๆ ของภาคีเครือข่าย</h4>
                <p class="text-muted">โครงการ CSR ที่เผยแพร่แล้วจะแสดงในหน้านี้</p>
                <a href="<?= URLROOT ?>/contact" class="btn btn-teal-gradient text-white rounded-pill px-4 py-2">ติดต่อร่วมเป็นภาคี CSR</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($projects as $project): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white hover-card d-flex flex-column justify-content-between">
                        
                        <!-- Poster Preview Image (Clickable for full lightbox view) -->
                        <div class="position-relative csr-img-wrap overflow-hidden" style="height: 380px; background: #0b1329; cursor: pointer;" onclick="openPosterModal('<?= URLROOT ?>/assets/images/csr/<?= rawurlencode($project->image) ?>', '<?= htmlspecialchars(addslashes($project->project_title)) ?>', '<?= htmlspecialchars(addslashes($project->company_name)) ?>')">
                            <?php if (!empty($project->image)): ?>
                                <!-- Ambient blurred background -->
                                <img src="<?= URLROOT ?>/assets/images/csr/<?= rawurlencode($project->image) ?>" alt="" class="position-absolute w-100 h-100 object-fit-cover" style="filter: blur(16px); opacity: 0.35; transform: scale(1.15);">
                                <!-- Sharp full poster without any cropping -->
                                <img src="<?= URLROOT ?>/assets/images/csr/<?= rawurlencode($project->image) ?>" alt="<?= htmlspecialchars($project->project_title) ?>" class="position-relative w-100 h-100 object-fit-contain p-2 transition-scale">
                            <?php else: ?>
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white-50">
                                    <i class="bi bi-building-heart display-2"></i>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Overlay Hover Pill -->
                            <div class="position-absolute top-0 end-0 m-3" style="z-index: 2;">
                                <span class="badge bg-dark bg-opacity-75 text-white rounded-pill px-3 py-1 small backdrop-blur">
                                    <i class="bi bi-zoom-in me-1"></i> คลิกดูภาพเต็ม
                                </span>
                            </div>

                            <div class="position-absolute bottom-0 start-0 end-0 p-3 bg-gradient-dark text-white" style="z-index: 2;">
                                <small class="fw-semibold text-warning d-block font-monospace">
                                    <i class="bi bi-calendar3 me-1"></i> <?= formatThaiDate($project->project_date) ?>
                                </small>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <!-- Organization Name Badge -->
                                <div class="mb-2">
                                    <span class="badge bg-primary-subtle text-primary fw-bold text-wrap text-start" style="font-size: 0.78rem; line-height: 1.3;">
                                        <i class="bi bi-buildings-fill me-1"></i> <?= htmlspecialchars($project->company_name) ?>
                                    </span>
                                </div>

                                <!-- Project Title -->
                                <h3 class="h5 fw-bold text-dark mb-2" style="line-height: 1.4;">
                                    <?= htmlspecialchars($project->project_title) ?>
                                </h3>

                                <!-- Summary -->
                                <p class="text-muted small mb-3" style="line-height: 1.6;">
                                    <?= nl2br(htmlspecialchars($project->summary)) ?>
                                </p>
                            </div>

                            <div>
                                <!-- Contribution Highlight Pill -->
                                <?php if (!empty($project->contribution)): ?>
                                <div class="p-2 px-3 rounded-3 bg-teal-subtle text-teal fw-semibold small mb-3 border border-teal-subtle d-flex align-items-center gap-2">
                                    <i class="bi bi-heart-fill text-danger flex-shrink-0"></i>
                                    <span><?= htmlspecialchars($project->contribution) ?></span>
                                </div>
                                <?php endif; ?>

                                <!-- Footer Link / Actions -->
                                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                    <button type="button" class="btn btn-sm btn-outline-teal rounded-pill px-3" onclick="openPosterModal('<?= URLROOT ?>/assets/images/csr/<?= rawurlencode($project->image) ?>', '<?= htmlspecialchars(addslashes($project->project_title)) ?>', '<?= htmlspecialchars(addslashes($project->company_name)) ?>')">
                                        <i class="bi bi-file-earmark-image me-1"></i> ดูโปสเตอร์
                                    </button>
                                    
                                    <?php if (!empty($project->website)): ?>
                                    <a href="<?= htmlspecialchars($project->website) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-link text-decoration-none text-muted p-0">
                                        เว็บไซต์องค์กร <i class="bi bi-box-arrow-up-right ms-1"></i>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                    </article>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </section>

    <!-- CSR Call to Action Banner -->
    <section class="container py-4 mt-4">
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden text-white" style="background: linear-gradient(135deg, #064e3b 0%, #0d9488 60%, #0284c7 100%);">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8 text-start">
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-3">
                            <i class="bi bi-stars me-1"></i> START A MEANINGFUL PARTNERSHIP
                        </span>
                        <h2 class="display-6 fw-bold text-white mb-2">องค์กรของคุณ... ช่วยสร้างความเปลี่ยนแปลงได้</h2>
                        <p class="text-white-75 lead fs-6 mb-0" style="color: rgba(255, 255, 255, 0.9);">
                            ขอเชิญชวนหน่วยงาน บริษัท องค์กร และผู้มีจิตศรัทธา มาร่วมออกแบบกิจกรรม CSR ที่ตอบโจทย์เป้าหมายการพัฒนาที่ยั่งยืน และสร้างรอยยิ้มให้กับผู้ป่วยโรงพยาบาลปลวกแดง
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end text-center">
                        <a href="<?= URLROOT ?>/contact" class="btn btn-warning btn-lg rounded-pill px-4 py-3 fw-bold text-dark shadow-lg">
                            <i class="bi bi-telephone-outbound me-1"></i> ติดต่อร่วมงาน CSR
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Modal : CSR Full Poster Lightbox Modal -->
<div class="modal fade" id="csrPosterModal" tabindex="-1" aria-labelledby="csrPosterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-2xl rounded-5 overflow-hidden">
            <div class="modal-header bg-dark text-white p-3 border-0">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-image text-warning fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold text-white mb-0" id="csrModalTitle">ภาพประชาสัมพันธ์</h6>
                        <small class="text-white-50" id="csrModalSubtitle"></small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center bg-black">
                <img id="csrModalImg" src="" alt="Full Poster" class="img-fluid" style="max-height: 80vh; object-fit: contain;">
            </div>
            <div class="modal-footer bg-dark border-0 p-3 d-flex justify-content-between">
                <span class="text-white-50 small">งานประชาสัมพันธ์ กลุ่มงานบริหารทั่วไป โรงพยาบาลปลวกแดง</span>
                <a id="csrModalDownloadBtn" href="" download class="btn btn-teal-gradient text-white btn-sm rounded-pill px-4">
                    <i class="bi bi-download me-1"></i> บันทึกภาพ
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styling -->
<style>
.bg-gradient-dark {
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.85) 100%);
}
.transition-scale {
    transition: transform 0.4s ease;
}
.csr-img-wrap:hover .transition-scale {
    transform: scale(1.05);
}
.hover-card {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
}
.btn-teal-gradient {
    background: linear-gradient(135deg, #0d9488 0%, #059669 100%) !important;
    color: #ffffff !important;
    border: none !important;
}
.btn-teal-gradient:hover {
    color: #ffffff !important;
    box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4) !important;
}
.btn-outline-teal {
    border: 1.5px solid #0d9488 !important;
    color: #0d9488 !important;
    background: transparent;
}
.btn-outline-teal:hover {
    background: #0d9488 !important;
    color: #ffffff !important;
}
.text-teal {
    color: #0d9488 !important;
}
.bg-teal-subtle {
    background-color: #ccfbf1 !important;
    color: #0f766e !important;
}
.border-teal-subtle {
    border-color: rgba(13, 148, 136, 0.25) !important;
}
.backdrop-blur {
    backdrop-filter: blur(8px);
}
</style>

<script>
function openPosterModal(imgUrl, title, company) {
    const modalImg = document.getElementById('csrModalImg');
    const modalTitle = document.getElementById('csrModalTitle');
    const modalSubtitle = document.getElementById('csrModalSubtitle');
    const downloadBtn = document.getElementById('csrModalDownloadBtn');

    if (modalImg) modalImg.src = imgUrl;
    if (modalTitle) modalTitle.innerText = title;
    if (modalSubtitle) modalSubtitle.innerText = company;
    if (downloadBtn) downloadBtn.href = imgUrl;

    const modal = new bootstrap.Modal(document.getElementById('csrPosterModal'));
    modal.show();
}
</script>
