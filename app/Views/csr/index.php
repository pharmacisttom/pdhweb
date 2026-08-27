<div class="csr-page">
    <section class="csr-hero">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="csr-eyebrow"><i class="bi bi-people-fill"></i> PARTNERSHIP FOR COMMUNITY HEALTH</span>
                    <h1>ร่วมสร้างสุขภาพที่ดี<br><span>ให้ชุมชนปลวกแดง</span></h1>
                    <p>โรงพยาบาลปลวกแดงเปิดพื้นที่ให้ภาคธุรกิจร่วมออกแบบกิจกรรม CSR ที่สร้างผลลัพธ์ต่อผู้ป่วย บุคลากร และคนในชุมชนอย่างเป็นรูปธรรม</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#csr-projects" class="btn csr-btn-light rounded-pill px-4 py-3">ดูความร่วมมือของเรา <i class="bi bi-arrow-down ms-1"></i></a>
                        <a href="<?= URLROOT ?>/contact" class="btn csr-btn-outline rounded-pill px-4 py-3">ร่วมเป็นภาคี CSR <i class="bi bi-arrow-up-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="csr-hero-card">
                        <div class="csr-hero-card__icon"><i class="bi bi-heart-pulse-fill"></i></div>
                        <p class="text-uppercase small fw-bold mb-2">OUR SHARED PURPOSE</p>
                        <h2>ทุกความร่วมมือ<br>เปลี่ยนเป็นการดูแล</h2>
                        <div class="csr-hero-card__line"></div>
                        <p class="mb-0">ตั้งแต่การสนับสนุนอุปกรณ์ทางการแพทย์ จนถึงกิจกรรมส่งเสริมสุขภาพ เราพร้อมทำงานร่วมกันอย่างโปร่งใสและมีเป้าหมายเดียวกัน</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="csr-intro py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-4"><span class="csr-section-kicker">WHY PARTNER WITH US</span><h2 class="csr-section-title">ทำ CSR ที่มีความหมายและต่อยอดได้</h2></div>
                <div class="col-lg-8"><p class="lead text-secondary mb-0">เราเชื่อว่าความร่วมมือที่ดีเริ่มจากการรับฟังปัญหาสุขภาพของชุมชน แล้ววางแผนโครงการที่เหมาะสม ติดตามผลได้ และสื่อสารคุณค่าร่วมกันอย่างภาคภูมิใจ</p></div>
            </div>
            <div class="row g-4 mt-2">
                <div class="col-md-4"><article class="csr-value"><i class="bi bi-bullseye"></i><h3>ตรงความต้องการ</h3><p>ร่วมกำหนดเป้าหมายให้สอดคล้องกับผู้ป่วย โรงพยาบาล และชุมชน</p></article></div>
                <div class="col-md-4"><article class="csr-value"><i class="bi bi-clipboard2-pulse"></i><h3>เห็นผลลัพธ์</h3><p>ออกแบบกิจกรรมที่มีผลลัพธ์ชัดเจนและติดตามความก้าวหน้าได้</p></article></div>
                <div class="col-md-4"><article class="csr-value"><i class="bi bi-shield-check"></i><h3>โปร่งใสและร่วมภูมิใจ</h3><p>ประสานงานเป็นระบบ พร้อมเผยแพร่เรื่องราวของความร่วมมืออย่างเหมาะสม</p></article></div>
            </div>
        </div>
    </section>

    <section id="csr-projects" class="csr-projects py-5">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
                <div><span class="csr-section-kicker">OUR PARTNERS IN ACTION</span><h2 class="csr-section-title mb-0">ความร่วมมือที่เกิดขึ้นแล้ว</h2></div>
                <a href="<?= URLROOT ?>/contact" class="csr-text-link">สนใจร่วมโครงการกับเรา <i class="bi bi-arrow-right"></i></a>
            </div>
            <?php if (empty($projects)): ?>
                <div class="csr-empty-state"><i class="bi bi-stars"></i><h3>พื้นที่สำหรับเรื่องราวดี ๆ ของภาคีเครือข่าย</h3><p>โครงการ CSR ที่เผยแพร่แล้วจะแสดงในหน้านี้</p><a href="<?= URLROOT ?>/contact" class="btn btn-primary rounded-pill px-4">ติดต่อร่วมเป็นภาคี CSR</a></div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($projects as $project): ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="csr-project-card h-100">
                            <?php if (!empty($project->image)): ?>
                                <img src="<?= URLROOT ?>/assets/images/csr/<?= rawurlencode($project->image) ?>" alt="<?= htmlspecialchars($project->project_title) ?>" class="csr-project-card__image">
                            <?php else: ?>
                                <div class="csr-project-card__image csr-project-card__placeholder"><i class="bi bi-building-heart"></i></div>
                            <?php endif; ?>
                            <div class="csr-project-card__body">
                                <p class="csr-project-card__company"><i class="bi bi-buildings me-1"></i><?= htmlspecialchars($project->company_name) ?></p>
                                <h3><?= htmlspecialchars($project->project_title) ?></h3>
                                <p><?= htmlspecialchars($project->summary) ?></p>
                                <?php if (!empty($project->contribution)): ?><div class="csr-project-card__impact"><i class="bi bi-heart-fill"></i><?= htmlspecialchars($project->contribution) ?></div><?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center mt-3 small text-secondary">
                                    <span><?= $project->project_date ? date('d/m/Y', strtotime($project->project_date)) : 'ความร่วมมือเพื่อชุมชน' ?></span>
                                    <?php if (!empty($project->website)): ?><a href="<?= htmlspecialchars($project->website) ?>" target="_blank" rel="noopener noreferrer" class="csr-text-link">เยี่ยมชมองค์กร <i class="bi bi-box-arrow-up-right"></i></a><?php endif; ?>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="csr-cta py-5">
        <div class="container"><div class="csr-cta__panel"><div><span class="csr-section-kicker text-white-50">START A MEANINGFUL PARTNERSHIP</span><h2>องค์กรของคุณช่วยสร้าง<br>ความเปลี่ยนแปลงได้</h2><p>พูดคุยกับเราเพื่อออกแบบกิจกรรม CSR ที่เหมาะกับเป้าหมายขององค์กรและความต้องการของชุมชน</p></div><a href="<?= URLROOT ?>/contact" class="btn csr-btn-light rounded-pill px-4 py-3">ติดต่อโรงพยาบาล <i class="bi bi-arrow-up-right ms-1"></i></a></div></div>
    </section>
</div>
