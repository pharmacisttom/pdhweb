<div class="ita-page-wrapper">
    <!-- Hero Header -->
    <section class="ita-hero-section py-5 position-relative overflow-hidden">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-15 text-white border border-white border-opacity-25 mb-3 shadow-sm">
                        <i class="bi bi-shield-check text-warning"></i>
                        <span class="small fw-semibold">Integrity and Transparency Assessment (ITA / MOIT)</span>
                    </div>
                    <h1 class="display-6 fw-bold text-white mb-2">
                        การประเมินคุณธรรมและความโปร่งใส
                    </h1>
                    <p class="text-white-50 fs-5 mb-3">
                        ศูนย์ข้อมูลการเปิดเผยข้อมูลสาธารณะและการดำเนินงานตามเกณฑ์การประเมิน ITA / MOIT โรงพยาบาลปลวกแดง
                    </p>
                    <div class="d-flex flex-wrap gap-2 text-white-50 small">
                        <span class="d-flex align-items-center gap-1"><i class="bi bi-building text-info"></i> โรงพยาบาลปลวกแดง จ.ระยอง</span>
                        <span class="mx-1">•</span>
                        <span class="d-flex align-items-center gap-1"><i class="bi bi-folder-check text-success"></i> 8 ตัวชี้วัดหลัก 22 MOIT</span>
                        <span class="mx-1">•</span>
                        <span class="d-flex align-items-center gap-1"><i class="bi bi-calendar-check text-warning"></i> ประจำปีงบประมาณ พ.ศ. 2566 - 2569</span>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0 text-lg-end">
                    <div class="ita-hero-stat-card p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-20 d-inline-block text-start text-white shadow-lg">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="rounded-circle bg-success bg-opacity-25 p-3 text-success">
                                <i class="bi bi-patch-check-fill fs-2 text-warning"></i>
                            </div>
                            <div>
                                <div class="text-uppercase small text-white-50">สถานะการเปิดเผยข้อมูล</div>
                                <div class="fs-5 fw-bold text-white">ครบถ้วนและเป็นปัจจุบัน</div>
                            </div>
                        </div>
                        <div class="small text-white-50 border-top border-white border-opacity-15 pt-2">
                            <i class="bi bi-check-circle-fill text-success me-1"></i> รองรับการตรวจประเมิน MOIT1 - MOIT22
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search & Filter Controls -->
            <div class="row mt-4">
                <div class="col-lg-8 mx-auto">
                    <div class="ita-search-box p-2 bg-white rounded-pill shadow-lg d-flex align-items-center gap-2 border">
                        <i class="bi bi-search text-muted ms-3 fs-5"></i>
                        <input type="text" id="itaSearchInput" class="form-control border-0 shadow-none bg-transparent" placeholder="ค้นหาตัวชี้วัด, รหัส MOIT, หัวข้อ, หรือคำสำคัญ เช่น จัดซื้อจัดจ้าง, No Gift Policy, แผนปฏิบัติการ...">
                        <button type="button" id="clearItaSearch" class="btn btn-sm btn-light rounded-circle d-none" title="ล้างการค้นหา">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="ita-hero-bg-shapes"></div>
    </section>

    <!-- Main Content Container -->
    <div class="container py-5">

        <!-- Indicator Quick Jump Bar -->
        <div class="ita-quick-nav-wrapper mb-4 sticky-top-custom">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2 pb-2 border-bottom">
                    <div class="fw-bold text-dark d-flex align-items-center gap-2 small">
                        <i class="bi bi-compass-fill text-primary"></i>
                        <span>เลือกตัวชี้วัด (Quick Jump):</span>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="btnExpandAll">
                            <i class="bi bi-arrows-expand me-1"></i> ขยายทั้งหมด
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="btnCollapseAll">
                            <i class="bi bi-arrows-collapse me-1"></i> ยุบทั้งหมด
                        </button>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2 ita-pill-nav">
                    <a href="#indicator-1" class="btn btn-sm btn-light rounded-pill px-3 py-2 ita-nav-btn"><span class="badge bg-primary text-white me-1">1</span> การเปิดเผยข้อมูล (MOIT 1-2)</a>
                    <a href="#indicator-2" class="btn btn-sm btn-light rounded-pill px-3 py-2 ita-nav-btn"><span class="badge bg-primary text-white me-1">2</span> จัดซื้อจัดจ้าง (MOIT 3-5)</a>
                    <a href="#indicator-3" class="btn btn-sm btn-light rounded-pill px-3 py-2 ita-nav-btn"><span class="badge bg-primary text-white me-1">3</span> ทรัพยากรบุคคล (MOIT 6-8)</a>
                    <a href="#indicator-4" class="btn btn-sm btn-light rounded-pill px-3 py-2 ita-nav-btn"><span class="badge bg-primary text-white me-1">4</span> ส่งเสริมความโปร่งใส (MOIT 9-11)</a>
                    <a href="#indicator-5" class="btn btn-sm btn-light rounded-pill px-3 py-2 ita-nav-btn"><span class="badge bg-primary text-white me-1">5</span> ป้องกันการรับสินบน (MOIT 12-14)</a>
                    <a href="#indicator-6" class="btn btn-sm btn-light rounded-pill px-3 py-2 ita-nav-btn"><span class="badge bg-primary text-white me-1">6</span> การใช้ทรัพย์สินของราชการ</a>
                    <a href="#indicator-7" class="btn btn-sm btn-light rounded-pill px-3 py-2 ita-nav-btn"><span class="badge bg-primary text-white me-1">7</span> ป้องกันการทุจริต (MOIT 15-18)</a>
                    <a href="#indicator-8" class="btn btn-sm btn-light rounded-pill px-3 py-2 ita-nav-btn"><span class="badge bg-primary text-white me-1">8</span> ผลประโยชน์ทับซ้อน (MOIT 18-22)</a>
                </div>
            </div>
        </div>

        <!-- Search Result Alert (Live Filter) -->
        <div id="searchResultCount" class="alert alert-info border-0 rounded-4 d-none mb-4 d-flex align-items-center justify-content-between">
            <div>
                <i class="bi bi-info-circle-fill me-2"></i>
                <span id="searchResultText">ผลการค้นหา</span>
            </div>
            <button type="button" class="btn-close" id="btnDismissSearchAlert" aria-label="Close"></button>
        </div>

        <!-- ========================================================================= -->
        <!-- ตัวชี้วัดที่ 1: การเปิดเผยข้อมูล -->
        <!-- ========================================================================= -->
        <section id="indicator-1" class="ita-indicator-group mb-5">
            <div class="indicator-header d-flex align-items-center gap-3 p-3 rounded-4 text-white mb-3 shadow-sm bg-gradient-teal">
                <div class="indicator-number-badge">01</div>
                <div>
                    <h2 class="h4 mb-0 fw-bold text-white">ตัวชี้วัดที่ 1: การเปิดเผยข้อมูล</h2>
                    <small class="text-white-50">MOIT 1 - MOIT 2 | การวางระบบและเปิดเผยข้อมูลพื้นฐานที่เป็นปัจจุบันของหน่วยงาน</small>
                </div>
            </div>

            <!-- MOIT 1 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 1">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-teal-subtle text-teal-dark px-3 py-2 rounded-pill fw-bold fs-6 border border-teal">MOIT 1</span>
                            <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการกำหนดมาตรการ และวางระบบการเผยแพร่ข้อมูลต่อสาธารณะผ่านเว็บไซต์ ของหน่วยงาน</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="list-group list-group-flush rounded-3 border">
                        <div class="list-group-item list-group-item-action d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 p-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">คำสั่ง / กรอบแนวทางการเผยแพร่ข้อมูลต่อสาธารณะผ่านเว็บไซต์</div>
                                    <div class="small text-muted">มาตรการและระบบการเผยแพร่ข้อมูลต่อสาธารณะผ่านเว็บไซต์ของหน่วยงาน</div>
                                </div>
                            </div>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT1/MOIT1-68-1.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3 text-nowrap">
                                <i class="bi bi-file-earmark-pdf me-1"></i> เปิดเอกสาร (PDF)
                            </a>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 p-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">รายงานผลการกำกับติดตามการเผยแพร่ข้อมูลต่อสาธารณะผ่านเว็บไซต์หน่วยงานปีที่ผ่านมา พ.ศ. 2568</div>
                                    <div class="small text-muted">รายงานสรุปผลการกำกับติดตามและประเมินผลการดำเนินงาน</div>
                                </div>
                            </div>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT1/MOIT1-69.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3 text-nowrap">
                                <i class="bi bi-file-earmark-pdf me-1"></i> เปิดเอกสาร (PDF)
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 2 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 2">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-teal-subtle text-teal-dark px-3 py-2 rounded-pill fw-bold fs-6 border border-teal">MOIT 2</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการเปิดเผยข้อมูลข่าวสารที่เป็นปัจจุบัน</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="accordion accordion-flush rounded-3 border" id="moit2Accordion">
                        
                        <!-- 2.1 ข้อมูลพื้นฐานที่เป็นปัจจุบัน -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingTwoOne">
                                <button class="accordion-button fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoOne" aria-expanded="true">
                                    <i class="bi bi-info-circle-fill text-primary me-2"></i> 2.1 ข้อมูลพื้นฐานที่เป็นปัจจุบัน (โครงสร้าง นโยบาย อำนาจหน้าที่ กฎหมาย)
                                </button>
                            </h4>
                            <div id="collapseTwoOne" class="accordion-collapse collapse show">
                                <div class="accordion-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="8%" class="text-center">ลำดับ</th>
                                                    <th width="62%">รายการข้อมูลพื้นฐาน</th>
                                                    <th width="30%" class="text-center">เอกสาร / ลิงก์ที่เกี่ยวข้อง</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center fw-semibold">1</td>
                                                    <td><strong>ข้อมูลผู้บริหาร</strong> (ทำเนียบคณะผู้บริหารโรงพยาบาลปลวกแดง)</td>
                                                    <td class="text-center">
                                                        <a href="<?= URLROOT ?>/page/executives" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                            <i class="bi bi-box-arrow-up-right me-1"></i> ดูข้อมูลผู้บริหาร
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-semibold">2</td>
                                                    <td><strong>นโยบายของผู้บริหาร</strong> ประจำปีงบประมาณ</td>
                                                    <td class="text-center">
                                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.1.2-69.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                            <i class="bi bi-file-earmark-pdf me-1"></i> เปิดเอกสาร (PDF)
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-semibold">3</td>
                                                    <td><strong>โครงสร้างหน่วยงาน</strong> (โครงสร้างการแบ่งส่วนราชการและภารกิจ)</td>
                                                    <td class="text-center">
                                                        <a href="http://www.pluakdaenghospital.moph.go.th/index.php?mo=10&art=42030975" target="_blank" rel="noopener noreferrer" class="btn btn-outline-info btn-sm rounded-pill px-3">
                                                            <i class="bi bi-diagram-3 me-1"></i> ดูโครงสร้าง
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-semibold">4</td>
                                                    <td><strong>หน้าที่และอำนาจของหน่วยงาน</strong> ตามกฎหมายจัดตั้ง หรือกฎหมายอื่นที่เกี่ยวข้อง</td>
                                                    <td class="text-center">
                                                        <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.1.4.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                            <i class="bi bi-file-earmark-pdf me-1"></i> เปิดเอกสาร (PDF)
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-semibold">5</td>
                                                    <td><strong>กฎหมายที่เกี่ยวข้องกับการดำเนินงาน</strong> หรือการปฏิบัติงานของหน่วยงาน</td>
                                                    <td class="text-center">
                                                        <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.1.5.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                            <i class="bi bi-file-earmark-pdf me-1"></i> เปิดเอกสาร (PDF)
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-semibold">6</td>
                                                    <td><strong>ข่าวประชาสัมพันธ์</strong> การดำเนินงานตามหน้าที่ อำนาจ และภารกิจของหน่วยงาน</td>
                                                    <td class="text-center">
                                                        <a href="<?= URLROOT ?>/news" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                            <i class="bi bi-newspaper me-1"></i> ข่าวประชาสัมพันธ์
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-semibold">7</td>
                                                    <td><strong>ข้อมูลการติดต่อหน่วยงาน</strong> (ที่อยู่ เบอร์โทรศัพท์ แผนที่ อีเมล ช่องทางติดต่อ)</td>
                                                    <td class="text-center">
                                                        <a href="<?= URLROOT ?>/page/about" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                                            <i class="bi bi-geo-alt me-1"></i> ข้อมูลติดต่อ
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-semibold">8</td>
                                                    <td><strong>ช่องทางการรับฟังความคิดเห็น</strong> และรับเรื่องร้องเรียน</td>
                                                    <td class="text-center">
                                                        <a href="<?= URLROOT ?>/complaint" target="_blank" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                                            <i class="bi bi-chat-dots me-1"></i> ช่องทางรับฟัง
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2.2 - 2.6 จริยธรรมและค่านิยม -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingTwoEthics">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoEthics" aria-expanded="false">
                                    <i class="bi bi-award-fill text-warning me-2"></i> 2.2 - 2.6 วิสัยทัศน์ ค่านิยม มาตรฐานทางจริยธรรม และอินโฟกราฟฟิก
                                </button>
                            </h4>
                            <div id="collapseTwoEthics" class="accordion-collapse collapse">
                                <div class="accordion-body p-0">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.2</strong> วิสัยทัศน์ พันธกิจ ค่านิยม MOPH</span>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.2.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.3</strong> พระราชบัญญัติมาตรฐานทางจริยธรรม พ.ศ. 2562</span>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-3-2566.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.4</strong> ประมวลจริยธรรมข้าราชการพลเรือน พ.ศ. 2564</span>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-4-2566.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.5</strong> ข้อกำหนดจริยธรรมเจ้าหน้าที่ของรัฐ สำนักงานปลัดกระทรวงสาธารณสุข พ.ศ. 2564</span>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-5-2566.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.6</strong> อินโฟกราฟฟิกคณะกรรมการจริยธรรม ประจำสำนักงานปลัดกระทรวงสาธารณสุข ชุดปัจจุบัน</span>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/1u343f17sqsk8ko0cg.jpg" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="bi bi-image me-1"></i> รูปภาพ (JPG)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2.7 ยุทธศาสตร์ของประเทศและกระทรวง -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingTwoStrategy">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoStrategy" aria-expanded="false">
                                    <i class="bi bi-flag-fill text-danger me-2"></i> 2.7 ยุทธศาสตร์ของประเทศ โดยรวม และยุทธศาสตร์และแผนระดับชาติ 3 ระดับ
                                </button>
                            </h4>
                            <div id="collapseTwoStrategy" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-7-2566.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-danger btn-sm rounded-pill px-3">
                                            <i class="bi bi-file-earmark-pdf-fill me-1"></i> 2.7 ยุทธศาสตร์ของประเทศ โดยรวม (ดาวน์โหลดเอกสารรวม)
                                        </a>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                                <div class="small fw-bold mb-2">แผนระดับที่ 1: ยุทธศาสตร์ชาติ พ.ศ. 2561-2580</div>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-6.1.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                                <div class="small fw-bold mb-2">แผนแม่บทภายใต้ยุทธศาสตร์ชาติ (พ.ศ. 2566-2580) (ฉบับแก้ไขเพิ่มเติม)</div>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-6.2.1.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                                <div class="small fw-bold mb-2">แผนพัฒนาเศรษฐกิจและสังคมแห่งชาติ ฉบับที่ 13 (พ.ศ. 2566-2570)</div>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-6.2.2.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                                <div class="small fw-bold mb-2">นโยบายและแผนระดับชาติว่าด้วยความมั่นคงแห่งชาติ (พ.ศ. 2566-2570)</div>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-6.2.3.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                                <div class="small fw-bold mb-2">แผนปฏิบัติการด้านการส่งเสริมคุณธรรมแห่งชาติ ระยะที่ 2 (พ.ศ. 2566-2570)</div>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-6.3.22.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                                <div class="small fw-bold mb-2">แผนปฏิบัติการด้านการต่อต้านการทุจริตและประพฤติมิชอบ ระยะที่ 2 (พ.ศ. 2566-2570)</div>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-6.3.22.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                                <div class="small fw-bold mb-2">ยุทธศาสตร์ด้านมาตรฐานทางจริยธรรมและการส่งเสริมจริยธรรมภาครัฐ (พ.ศ. 2565-2570)</div>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-6.3.3.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                                <div class="small fw-bold mb-2">แผนปฏิบัติการด้านการป้องกันปราบปรามการทุจริตและประพฤติมิชอบ และการส่งเสริมคุณธรรม จริยธรรม ของ สธ.</div>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.7.plan2568.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2.8 - 2.11 นโยบาย ยุทธศาสตร์ แผนงาน และงบประมาณ -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingTwoPlans">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoPlans" aria-expanded="false">
                                    <i class="bi bi-calendar3 text-success me-2"></i> 2.8 - 2.11 นโยบาย ยุทธศาสตร์หน่วยงาน แผนปฏิบัติการ และแผนงบประมาณ
                                </button>
                            </h4>
                            <div id="collapseTwoPlans" class="accordion-collapse collapse">
                                <div class="accordion-body p-0">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                                            <div>
                                                <strong>2.8</strong> นโยบายและยุทธศาสตร์ของหน่วยงาน
                                            </div>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.8..pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                                            <div>
                                                <strong>2.9</strong> แผนปฏิบัติการประจำปีของหน่วยงานทุกแผน
                                                <div class="small text-muted"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-9.pdf" target="_blank" class="text-decoration-none">รวมเล่มแผนปฏิบัติการ</a></div>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/plan67-22.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-secondary rounded-pill px-2">ปี 2567</a>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-68-9.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary rounded-pill px-2">ปี 2568</a>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-69-9.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success rounded-pill px-2">ปี 2569</a>
                                            </div>
                                        </div>
                                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                                            <div>
                                                <strong>2.10</strong> รายงานผลการดำเนินงานตามแผนปฏิบัติการประจำปีของหน่วยงาน
                                            </div>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-68-10.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> รายงานผล (ปี 2569)</a>
                                        </div>
                                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                                            <div>
                                                <strong>2.11</strong> แผนการใช้จ่ายงบประมาณประจำปี และผลการใช้จ่ายงบประมาณ
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/plan12.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-secondary rounded-pill px-2">แผนงบ 2567</a>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-68-11.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary rounded-pill px-2">แผนงบ 2568</a>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-69-11.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success rounded-pill px-2">แผนงบ 2569</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2.12 - 2.17 คู่มือและรายงานการจัดการเรื่องร้องเรียน -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingTwoManuals">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoManuals" aria-expanded="false">
                                    <i class="bi bi-book-fill text-info me-2"></i> 2.12 - 2.17 คู่มือการปฏิบัติงาน และรายงานผลการจัดการเรื่องร้องเรียน
                                </button>
                            </h4>
                            <div id="collapseTwoManuals" class="accordion-collapse collapse">
                                <div class="accordion-body p-0">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.12</strong> คู่มือการปฏิบัติงานการร้องเรียนการปฏิบัติงานหรือให้บริการของเจ้าหน้าที่</span>
                                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-12.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.13</strong> คู่มือการปฏิบัติงานการร้องเรียนเรื่องการทุจริตและประพฤติมิชอบ</span>
                                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-13-2566.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.14</strong> คู่มือการปฏิบัติงานตามภารกิจหลักและภารกิจสนับสนุนของหน่วยงาน</span>
                                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.15.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3 bg-light">
                                            <span class="text-muted"><strong>2.15</strong> คู่มือขั้นตอนการให้บริการตาม พ.ร.บ. การอำนวยความสะดวกฯ พ.ศ. 2558 (เฉพาะ สสจ. และ สสอ.)</span>
                                            <span class="badge bg-secondary">ไม่บังคับ รพช.</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.16</strong> รายงานผลการดำเนินการเกี่ยวกับเรื่องร้องเรียนการปฏิบัติงานหรือการให้บริการ</span>
                                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.16.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.17</strong> รายงานผลการดำเนินการเกี่ยวกับเรื่องร้องเรียนการทุจริตและประพฤติมิชอบ</span>
                                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.16.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2.18 ข้อมูลการจัดซื้อจัดจ้าง -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingTwoProcure">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoProcure" aria-expanded="false">
                                    <i class="bi bi-cart-check-fill text-primary me-2"></i> 2.18 ข้อมูลการจัดซื้อจัดจ้าง (การวิเคราะห์ แผน และแนวทางความบริสุทธิ์ใจ)
                                </button>
                            </h4>
                            <div id="collapseTwoProcure" class="accordion-collapse collapse">
                                <div class="accordion-body p-0">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.18.1</strong> การวิเคราะห์ผลการจัดซื้อจัดจ้างและการจัดหาพัสดุประจำปีที่ผ่านมา (ปี 2565)</span>
                                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.18.1.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                                            <div>
                                                <strong>2.18.2</strong> แผนการจัดซื้อจัดจ้างและการจัดหาพัสดุประจำปี
                                                <div class="small text-muted"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/plan66.pdf" target="_blank" class="text-decoration-none">แผนปี 2566</a></div>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.18.2-67.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-secondary rounded-pill px-2">ปี 2567</a>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-68-18.2.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary rounded-pill px-2">ปี 2568</a>
                                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-69-18.3.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success rounded-pill px-2">ปี 2569</a>
                                            </div>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.18.3</strong> ผลการดำเนินการตามแผนการจัดซื้อจัดจ้างและการจัดหาพัสดุประจำปี</span>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2-68-18.3.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <span><strong>2.18.4</strong> ประกาศ สป.สธ. ว่าด้วยแนวทางปฏิบัติงานเพื่อตรวจสอบบุคลากรด้านจัดซื้อจัดจ้าง พ.ศ. 2560 และแบบแสดงความบริสุทธิ์ใจ</span>
                                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT2/MOIT2.18.4.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- ตัวชี้วัดที่ 2: การจัดซื้อจัดจ้างและการจัดหาพัสดุ -->
        <!-- ========================================================================= -->
        <section id="indicator-2" class="ita-indicator-group mb-5">
            <div class="indicator-header d-flex align-items-center gap-3 p-3 rounded-4 text-white mb-3 shadow-sm bg-gradient-blue">
                <div class="indicator-number-badge">02</div>
                <div>
                    <h2 class="h4 mb-0 fw-bold text-white">ตัวชี้วัดที่ 2: การจัดซื้อจัดจ้างและการจัดหาพัสดุ</h2>
                    <small class="text-white-50">MOIT 3 - MOIT 5 | ความโปร่งใสในการจัดซื้อจัดจ้าง รายงานวิเคราะห์ และสรุปผลรายเดือน</small>
                </div>
            </div>

            <!-- MOIT 3 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 3">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold fs-6 border border-primary">MOIT 3</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">รายงานการวิเคราะห์ผลการจัดซื้อจัดจ้างและการจัดหาพัสดุประจำปี</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <div class="small fw-semibold text-muted mb-1">งบประมาณ พ.ศ. 2566</div>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT3/MOIT3-66.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill w-100"><i class="bi bi-file-earmark-pdf me-1"></i> ดาวน์โหลด PDF</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <div class="small fw-semibold text-muted mb-1">งบประมาณ พ.ศ. 2567</div>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT3/moit3-67.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill w-100"><i class="bi bi-file-earmark-pdf me-1"></i> ดาวน์โหลด PDF</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <div class="small fw-semibold text-muted mb-1">งบประมาณ พ.ศ. 2568</div>
                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT3/MOIT3-68.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill w-100"><i class="bi bi-file-earmark-pdf me-1"></i> ดาวน์โหลด PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush rounded-3 border">
                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <span><strong>3.1</strong> บันทึกข้อความรายงานผู้บริหารรับทราบ และขออนุญาตเผยแพร่บนเว็บไซต์</span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT3/MOIT3.1.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item p-3 text-muted small">
                            <strong>3.2</strong> รายงานการวิเคราะห์ผลการจัดซื้อจัดจ้างและการจัดหาพัสดุ ประจำปีงบประมาณ
                        </div>
                        <div class="list-group-item p-3 text-muted small">
                            <strong>3.3</strong> แบบฟอร์มการเผยแพร่ข้อมูลต่อสาธารณะผ่านเว็บไซต์ของหน่วยงาน
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 4 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 4">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold fs-6 border border-primary">MOIT 4</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานวางระบบเพื่อส่งเสริมความโปร่งใสในการจัดซื้อจัดจ้างและการจัดหาพัสดุ ประจำปีงบประมาณ พ.ศ. 2569</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    
                    <!-- ข้อ 1 -->
                    <div class="p-3 border rounded-3 mb-3 bg-light">
                        <h4 class="h6 fw-bold text-primary mb-2">ข้อ 1. ประกาศเผยแพร่แผนการจัดซื้อจัดจ้างและการจัดหาพัสดุ ประจำปีของหน่วยงาน ภายใน 30 วันทำการ</h4>
                        <div class="list-group list-group-flush rounded-3 bg-white border">
                            <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                <span class="small">1. บันทึกข้อความรายงานผู้บริหารรับทราบ และขออนุญาตเผยแพร่</span>
                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-69-1.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                            </div>
                            <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 py-2">
                                <span class="small">2. หนังสือจัดสรรงบประมาณของหน่วยงาน</span>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4.2.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2">หนังสือจัดสรร</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4.2-67P.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2">แจ้งจัดสรร 67 พลาง</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-68-2.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary rounded-pill py-0 px-2">แจ้งจัดสรร 68</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-69.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success rounded-pill py-0 px-2">แจ้งจัดสรร 69</a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                <span class="small">3. แผนการจัดซื้อจัดจ้างและการจัดหาพัสดุ ประจำปีงบประมาณ พ.ศ. 2569 (งบดำเนินงาน และงบลงทุน)</span>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4.3-67.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                <span class="small">4. คำสั่งมอบหมายการปิดประกาศ หรือปลดประกาศ</span>
                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-68-4.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                            </div>
                            <div class="list-group-item py-2 text-muted small">
                                5. แบบฟอร์มการเผยแพร่ข้อมูลต่อสาธารณะผ่านเว็บไซต์ของหน่วยงาน
                            </div>
                        </div>
                    </div>

                    <!-- ข้อ 2 -->
                    <div class="p-3 border rounded-3 mb-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="h6 fw-bold text-primary mb-0">ข้อ 2. รายงานผลของแผนการจัดซื้อจัดจ้างและการจัดหาพัสดุประจำปีตามรอบระยะเวลาที่กำหนด</h4>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-file-earmark-pdf me-1"></i> เอกสารหลัก</a>
                        </div>
                        
                        <!-- รายงานประจำปีต่างๆ -->
                        <div class="table-responsive bg-white rounded-3 border">
                            <table class="table table-sm table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ปีงบประมาณ</th>
                                        <th class="text-center">ไตรมาส 1</th>
                                        <th class="text-center">ไตรมาส 2</th>
                                        <th class="text-center">ไตรมาส 3</th>
                                        <th class="text-center">ไตรมาส 4</th>
                                        <th class="text-center">รอบ 6 เดือน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-semibold">พ.ศ. 2566</td>
                                        <td class="text-center"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4.pdf" target="_blank" class="badge bg-secondary text-decoration-none">Q1</a></td>
                                        <td class="text-center"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4.2.66.TRI2.pdf" target="_blank" class="badge bg-secondary text-decoration-none">Q2</a></td>
                                        <td class="text-center"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4.2.66.TRI3.pdf" target="_blank" class="badge bg-secondary text-decoration-none">Q3</a></td>
                                        <td class="text-center"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-TRI4.pdf" target="_blank" class="badge bg-secondary text-decoration-none">Q4</a></td>
                                        <td class="text-center text-muted">-</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">พ.ศ. 2567</td>
                                        <td class="text-center"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/ReportTRI1-67.pdf" target="_blank" class="badge bg-primary text-decoration-none">Q1</a></td>
                                        <td class="text-center"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/ReportTRI2-67.pdf" target="_blank" class="badge bg-primary text-decoration-none">Q2</a></td>
                                        <td class="text-center"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/ReportTRI3-67.pdf" target="_blank" class="badge bg-primary text-decoration-none">Q3</a></td>
                                        <td class="text-center"><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-67-TRI44.pdf" target="_blank" class="badge bg-primary text-decoration-none">Q4</a></td>
                                        <td class="text-center text-muted">-</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">พ.ศ. 2568</td>
                                        <td class="text-center"><a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-68-4.2.pdf" target="_blank" class="badge bg-info text-dark text-decoration-none">Q1</a></td>
                                        <td class="text-center"><a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-2025-2.pdf" target="_blank" class="badge bg-info text-dark text-decoration-none">Q2</a></td>
                                        <td class="text-center"><a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-68-3.pdf" target="_blank" class="badge bg-info text-dark text-decoration-none">Q3</a></td>
                                        <td class="text-center"><a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4-68-TRI4.pdf" target="_blank" class="badge bg-info text-dark text-decoration-none">Q4</a></td>
                                        <td class="text-center text-muted">-</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">พ.ศ. 2569</td>
                                        <td class="text-center text-muted">-</td>
                                        <td class="text-center text-muted">-</td>
                                        <td class="text-center text-muted">-</td>
                                        <td class="text-center text-muted">-</td>
                                        <td class="text-center"><a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/Report69-6.pdf" target="_blank" class="badge bg-success text-decoration-none">รอบ 6 เดือน</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ข้อ 3 -->
                    <div class="p-3 border rounded-3 bg-light d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                        <div>
                            <h4 class="h6 fw-bold text-primary mb-1">ข้อ 3. การป้องกันผู้ที่มีหน้าที่ดำเนินการในการจัดซื้อจัดจ้างเป็นผู้มีส่วนได้ส่วนเสียกับผู้ยื่นข้อเสนอหรือคู่สัญญา</h4>
                            <div class="small text-muted">แนวทางปฏิบัติงานเพื่อตรวจสอบบุคลากรและแบบแสดงความบริสุทธิ์ใจ</div>
                        </div>
                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT4/MOIT4.3.1.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3 text-nowrap"><i class="bi bi-file-earmark-pdf me-1"></i> ดาวน์โหลด PDF</a>
                    </div>

                </div>
            </div>

            <!-- MOIT 5 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 5">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold fs-6 border border-primary">MOIT 5</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการสรุปผลการจัดซื้อจัดจ้างและการจัดหาพัสดุรายเดือน</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    
                    <!-- ปี 2568 -->
                    <div class="mb-4">
                        <h4 class="h6 fw-bold text-dark mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-calendar2-month text-primary"></i> สรุปผลการจัดซื้อจัดจ้างรายเดือน ประจำปีงบประมาณ พ.ศ. 2568
                        </h4>
                        <div class="row g-2">
                            <!-- Q1 -->
                            <div class="col-md-3">
                                <div class="p-2 border rounded-3 bg-light h-100">
                                    <div class="fw-bold small text-primary mb-1">ไตรมาสที่ 1 (2568)</div>
                                    <div class="d-flex flex-column gap-1">
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-OCT67.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> ต.ค. 67</a>
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-NOV67.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> พ.ย. 67</a>
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-DEC67.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> ธ.ค. 67</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Q2 -->
                            <div class="col-md-3">
                                <div class="p-2 border rounded-3 bg-light h-100">
                                    <div class="fw-bold small text-primary mb-1">ไตรมาสที่ 2 (2568)</div>
                                    <div class="d-flex flex-column gap-1">
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-68-JAN.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> ม.ค. 68</a>
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-68-FEB.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> ก.พ. 68</a>
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-Mar-68.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> มี.ค. 68</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Q3 -->
                            <div class="col-md-3">
                                <div class="p-2 border rounded-3 bg-light h-100">
                                    <div class="fw-bold small text-primary mb-1">ไตรมาสที่ 3 (2568)</div>
                                    <div class="d-flex flex-column gap-1">
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5.Apr68.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> เม.ย. 68</a>
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5.May68.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> พ.ค. 68</a>
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5.June68.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> มิ.ย. 68</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Q4 -->
                            <div class="col-md-3">
                                <div class="p-2 border rounded-3 bg-light h-100">
                                    <div class="fw-bold small text-primary mb-1">ไตรมาสที่ 4 (2568)</div>
                                    <div class="d-flex flex-column gap-1">
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-68-JUL.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> ก.ค. 68</a>
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-68-AUG.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> ส.ค. 68</a>
                                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-68-SEP.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> ก.ย. 68</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ปี 2569 -->
                    <div>
                        <h4 class="h6 fw-bold text-dark mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-calendar2-check text-success"></i> สรุปผลการจัดซื้อจัดจ้างรายเดือน ประจำปีงบประมาณ พ.ศ. 2569
                        </h4>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-69-Oct.pdf" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-file-pdf text-danger me-1"></i> ต.ค. 68</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-69-Nov.pdf" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-file-pdf text-danger me-1"></i> พ.ย. 68</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-69-Dec.pdf" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-file-pdf text-danger me-1"></i> ธ.ค. 68</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-69-Jan.pdf" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-file-pdf text-danger me-1"></i> ม.ค. 69</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-69-Feb.pdf" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-file-pdf text-danger me-1"></i> ก.พ. 69</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT5/MOIT5-69-Mar.pdf" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-file-pdf text-danger me-1"></i> มี.ค. 69</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- ตัวชี้วัดที่ 3: การบริหารและพัฒนาทรัพยากรบุคคล -->
        <!-- ========================================================================= -->
        <section id="indicator-3" class="ita-indicator-group mb-5">
            <div class="indicator-header d-flex align-items-center gap-3 p-3 rounded-4 text-white mb-3 shadow-sm bg-gradient-purple">
                <div class="indicator-number-badge">03</div>
                <div>
                    <h2 class="h4 mb-0 fw-bold text-white">ตัวชี้วัดที่ 3: การบริหารและพัฒนาทรัพยากรบุคคล</h2>
                    <small class="text-white-50">MOIT 6 - MOIT 8 | นโยบายบุคคล การประเมินผลการปฏิบัติราชการ และการอบรมวินัยจริยธรรม</small>
                </div>
            </div>

            <!-- MOIT 6 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 6">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-purple-subtle text-purple px-3 py-2 rounded-pill fw-bold fs-6 border border-purple">MOIT 6</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">ผู้บริหารแสดงนโยบายการบริหารและพัฒนาทรัพยากรบุคคล</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">1. นโยบายการบริหารทรัพยากรบุคคล</h4>
                                <p class="small text-muted mb-3">บันทึกข้อความลงนามนโยบายการบริหารทรัพยากรบุคคลของผู้บริหารสูงสุด</p>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT6/MOIT6.1-67.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> นโยบายบุคคล ปี 2567 (PDF)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT6/MOIT6.1-68.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> นโยบายบุคคล ปี 2568 (PDF)</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">2. แผนการบริหารทรัพยากรบุคคลของหน่วยงาน</h4>
                                <p class="small text-muted mb-3">บันทึกข้อความลงนามแผนการบริหารทรัพยากรบุคคลของหน่วยงาน</p>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT6/MOIT6.2-67.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แผนบริหารบุคคล ปี 2567 (PDF)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT6/MOIT6.2-68.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แผนบริหารบุคคล ปี 2568 (PDF)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 7 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 7">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-purple-subtle text-purple px-3 py-2 rounded-pill fw-bold fs-6 border border-purple">MOIT 7</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการรายงานการประเมินและเกี่ยวกับการประเมินผลการปฏิบัติราชการ ของบุคลากรในหน่วยงาน</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <p class="text-muted small mb-3">การเปิดเผยผลการปฏิบัติราชการ ระดับดีเด่น และระดับดีมาก ในที่เปิดเผยให้ทราบ</p>
                    <div class="list-group list-group-flush rounded-3 border">
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">ประกาศประเมินผลการปฏิบัติราชการ ระดับดีเด่น/ดีมาก <strong>รอบแรก ปี 2566</strong> (1 ต.ค. 65 - 31 มี.ค. 66)</span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT7/MOIT7-66-3.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">ประกาศประเมินผลการปฏิบัติราชการ ระดับดีเด่น/ดีมาก <strong>รอบสอง ปี 2565/2566</strong> (1 เม.ย. 66 - 30 ก.ย. 66)</span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT7/MOIT7-67-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">ประกาศประเมินผลการปฏิบัติราชการ ระดับดีเด่น/ดีมาก <strong>รอบแรก ปี 2567</strong> (1 ต.ค. 66 - 31 มี.ค. 67)</span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT7/MOIT7-67.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">รายงานการประเมินผลการปฏิบัติราชการ ระดับดีเด่น/ดีมาก <strong>ปี 2567 และ ปี 2568</strong></span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT7/MOIT68-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">ประกาศประเมินผลการปฏิบัติราชการ ระดับดีเด่น/ดีมาก <strong>รอบแรก ปี 2568</strong> (1 ต.ค. 67 - 31 มี.ค. 68)</span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT7/MOIT7-OCT67-Mar68.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">ประกาศประเมินผลการปฏิบัติราชการ ระดับดีเด่น/ดีมาก <strong>รอบสอง ปี 2568</strong> (1 เม.ย. 68 - 30 ก.ย. 68)</span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT7/MOIT7-69-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 8 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 8">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-purple-subtle text-purple px-3 py-2 rounded-pill fw-bold fs-6 border border-purple">MOIT 8</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการอบรมให้ความรู้แก่เจ้าหน้าที่เกี่ยวกับการเสริมสร้างจริยธรรม และการรักษาวินัย</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <div class="small fw-semibold text-muted mb-1">การอบรมจริยธรรมและวินัย ปี 2567</div>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT8/MOIT8-67.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <div class="small fw-semibold text-muted mb-1">การอบรมจริยธรรมและวินัย ปี 2568</div>
                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT8/MOIT8-68.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light text-center">
                                <div class="small fw-semibold text-muted mb-1">การอบรมจริยธรรมและวินัย ปี 2569</div>
                                <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT8/MOIT8-69.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border rounded-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold small text-dark">หลักฐานโครงการอบรม รายชื่อผู้เข้าร่วม บันทึกข้อความ ภาพกิจกรรม และแบบฟอร์ม</span>
                            <a href="http://www.pluakdaenghospital.com/private_folder/MOIT8/MOIT8-66.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> ชุดหลักฐานรวม (PDF)</a>
                        </div>
                        <div class="row g-1 small text-muted">
                            <div class="col-md-6">• 1.1 บันทึกข้อความขออนุมัติดำเนินโครงการ & 1.2 โครงการ</div>
                            <div class="col-md-6">• 2. รายชื่อผู้เข้าร่วมการอบรม (On site / On air)</div>
                            <div class="col-md-6">• 3. บันทึกข้อความรายงานผล & 4. รายงานการอบรม</div>
                            <div class="col-md-6">• 5. ภาพกิจกรรม & 6. แบบฟอร์มเผยแพร่ข้อมูล</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- ตัวชี้วัดที่ 4: การส่งเสริมความโปร่งใส -->
        <!-- ========================================================================= -->
        <section id="indicator-4" class="ita-indicator-group mb-5">
            <div class="indicator-header d-flex align-items-center gap-3 p-3 rounded-4 text-white mb-3 shadow-sm bg-gradient-amber">
                <div class="indicator-number-badge">04</div>
                <div>
                    <h2 class="h4 mb-0 fw-bold text-white">ตัวชี้วัดที่ 4: การส่งเสริมความโปร่งใส</h2>
                    <small class="text-white-50">MOIT 9 - MOIT 11 | การจัดการเรื่องร้องเรียน ช่องทางรับฟัง และการมีส่วนร่วมของผู้มีส่วนได้ส่วนเสีย</small>
                </div>
            </div>

            <!-- MOIT 9 & 10 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 9 MOIT 10">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-warning-subtle text-warning-dark px-3 py-2 rounded-pill fw-bold fs-6 border border-warning">MOIT 9 - 10</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีแนวปฏิบัติการจัดการเรื่องร้องเรียน ช่องทางการร้องเรียน และรายงานสรุปผล</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">คู่มือและแนวปฏิบัติการร้องเรียน</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT9/MOIT9-67.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แนวปฏิบัติการจัดการเรื่องร้องเรียน (ปี 2567)</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT9/MOIT9-67.2.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> คู่มือปฏิบัติงานรับเรื่องร้องเรียนทุจริต (PDF)</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">ช่องทางการรับเรื่องร้องเรียน</h4>
                                <p class="small text-muted mb-2">ผ่านระบบออนไลน์, กล่องรับฟังความคิดเห็น, โทรศัพท์ หรือหนังสือราชการ</p>
                                <a href="<?= URLROOT ?>/complaint" target="_blank" class="btn btn-success btn-sm rounded-pill px-3"><i class="bi bi-chat-left-text me-1"></i> ระบบรับเรื่องร้องเรียนออนไลน์</a>
                            </div>
                        </div>
                    </div>

                    <h4 class="h6 fw-bold text-dark mb-2">รายงานสรุปผลการดำเนินงานเรื่องร้องเรียน</h4>
                    <div class="list-group list-group-flush rounded-3 border">
                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span class="small">รายงานสรุปผลเรื่องร้องเรียน รอบ 6 เดือน (1 ต.ค. 66 - 31 มี.ค. 67)</span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT10/MOIT10-67-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span class="small">รายงานสรุปผลเรื่องร้องเรียน รอบ 12 เดือน (1 ต.ค. 66 - 31 ส.ค. 67)</span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT10/MOIT10-67-12.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span class="small">รายงานสรุปผลเรื่องร้องเรียน รอบ 6 เดือน (1 ต.ค. 67 - 31 มี.ค. 68)</span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT10/MOIT10-68-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span class="small">รายงานสรุปผลเรื่องร้องเรียน รอบ 12 เดือน (1 ต.ค. 67 - 30 ก.ย. 68)</span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT10/MOIT10-68-12.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span class="small">รายงานสรุปผลเรื่องร้องเรียน รอบ 6 เดือน (1 ต.ค. 68 - 31 มี.ค. 69)</span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT10/MOIT10-69-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 11 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 11">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-warning-subtle text-warning-dark px-3 py-2 rounded-pill fw-bold fs-6 border border-warning">MOIT 11</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานเปิดโอกาสให้ผู้มีส่วนได้ส่วนเสียมีส่วนร่วมในการดำเนินงานตามภารกิจ</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">โครงการและการมีส่วนร่วม</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT11/MOIT11-66FINAL.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> รายงานรวมการมีส่วนร่วม ปี 2566 (PDF)</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT11/MOIT11-67.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> โครงการ/กิจกรรม ปี 2567 (PDF)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT11/MOIT11-2568.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> โครงการพัฒนาเครือข่ายกำลังคนสุขภาพ (อสม./อสค.) ปี 2568</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">เอกสารหลักฐานประกอบ (ปี 2566)</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT11/MOIT11-66.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill text-start"><i class="bi bi-file-text me-1"></i> 11.1 บันทึกข้อความอนุมัติโครงการ</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT11/MOIT11-66-2.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill text-start"><i class="bi bi-file-text me-1"></i> 11.2 เอกสารโครงการ</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT11/MOIT11-66-3.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill text-start"><i class="bi bi-image me-1"></i> 11.3 ภาพกิจกรรมระบุ วัน เวลา สถานที่</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- ตัวชี้วัดที่ 5: การป้องกันการรับสินบน -->
        <!-- ========================================================================= -->
        <section id="indicator-5" class="ita-indicator-group mb-5">
            <div class="indicator-header d-flex align-items-center gap-3 p-3 rounded-4 text-white mb-3 shadow-sm bg-gradient-rose">
                <div class="indicator-number-badge">05</div>
                <div>
                    <h2 class="h4 mb-0 fw-bold text-white">ตัวชี้วัดที่ 5: การป้องกันการรับสินบน</h2>
                    <small class="text-white-50">MOIT 12 - MOIT 14 | No Gift Policy เกณฑ์จริยธรรมยา/เวชภัณฑ์ และการเบิกจ่ายสวัสดิการข้าราชการ</small>
                </div>
            </div>

            <!-- MOIT 12 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 12">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold fs-6 border border-danger">MOIT 12</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีมาตรการ “การป้องกันการรับสินบน” ที่เป็นระบบ (No Gift Policy)</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">ประกาศเจตนารมณ์ No Gift Policy</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOTI12/MOIT12-66.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> มาตรการรวม ปี 2566 (PDF)</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOTI12/MOIT12-67.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> ประกาศ No Gift Policy ปี 2567 (PDF)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOTI12/MOIT12-68.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> ประกาศ No Gift Policy ปี 2568 (PDF)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOTI12/MOIT12-69.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> ประกาศ No Gift Policy ปี 2569 (PDF)</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">รายงานผลการกำกับติดตาม</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOTI12/MOIT12-67-12.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> รายงานสรุปผลติดตามมาตรการ ปี 2567</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOTI12/MOIT12-68-12.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> รายงานสรุปผลติดตามมาตรการ ปี 2568</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 13 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 13">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold fs-6 border border-danger">MOIT 13</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">เกณฑ์จริยธรรมการจัดซื้อจัดหาและการส่งเสริมการขายยาและเวชภัณฑ์ที่มิใช่ยา</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="list-group list-group-flush rounded-3 border">
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">ประกาศกระทรวงสาธารณสุข เรื่อง เกณฑ์จริยธรรมการจัดซื้อจัดหาและการส่งเสริมการขายยาฯ พ.ศ. 2564</span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT13/09042564.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> ประกาศ สธ. (PDF)</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">แนวทางปฏิบัติของหน่วยงานอย่างเป็นทางการ โดยผู้บริหารสูงสุด <strong>ปีงบประมาณ 2569</strong></span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT13/MOIT13-69.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> แนวทาง ปี 2569 (PDF)</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">หลักฐานการประเมินการดำเนินการตามแนวทางปฏิบัติ ประจำปีงบประมาณ พ.ศ. 2566</span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT13/MOIT13-66.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> หลักฐาน ปี 2566 (PDF)</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">รายงานการดำเนินงานตามแนวทางปฏิบัติของหน่วยงาน ในปีงบประมาณ พ.ศ. 2567 - 2568</span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT13/MOIT13-68-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> รายงานผล (PDF)</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">คำสั่ง ประกาศ หรือข้อสั่งการ มาตรการป้องกันการรับสินบน (ไตรมาส 2-3 และ ไตรมาส 4)</span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT13/MOIT13.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> เอกสารคำสั่ง (PDF)</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 14 (ป้องกันสินบนเบิกจ่ายยา) -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 14">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold fs-6 border border-danger">MOIT 14</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">มาตรการและระบบป้องกันการรับสินบนในกระบวนการเบิกจ่ายยาตามสิทธิสวัสดิการรักษาพยาบาลข้าราชการ</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                <span class="small fw-semibold mb-2">1-3. บันทึกข้อความคำสั่ง ประกาศ และหนังสือแจ้งเวียน</span>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT14/MOIT14.1-3.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF (ข้อ 1-3)</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                <span class="small fw-semibold mb-2">4. ประกาศเจตจำนงสุจริตของผู้บริหาร</span>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT14/MOIT14-4.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF (ข้อ 4)</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                <span class="small fw-semibold mb-2">5. ภาพถ่ายกิจกรรมระบุ วัน เวลา สถานที่จัดกิจกรรม</span>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT14/MOIT14-5.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-download me-1"></i> PDF (ข้อ 5)</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                <span class="small fw-semibold mb-2">6. แบบฟอร์มเผยแพร่ข้อมูล & รายงานไตรมาส 4</span>
                                <div class="d-flex gap-2">
                                    <a href="http://www.pluakdaenghospital.com/private_folder/MOIT14/MOIT14.1.pdf" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-download me-1"></i> แบบฟอร์ม</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT14/MOIT14.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> ไตรมาส 4</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- ตัวชี้วัดที่ 6: ตัวชี้วัดการใช้ทรัพย์สินของราชการ -->
        <!-- ========================================================================= -->
        <section id="indicator-6" class="ita-indicator-group mb-5">
            <div class="indicator-header d-flex align-items-center gap-3 p-3 rounded-4 text-white mb-3 shadow-sm bg-gradient-cyan">
                <div class="indicator-number-badge">06</div>
                <div>
                    <h2 class="h4 mb-0 fw-bold text-white">ตัวชี้วัดที่ 6: การใช้ทรัพย์สินของราชการ</h2>
                    <small class="text-white-50">MOIT 14 | แนวทางปฏิบัติและขั้นตอนการขออนุญาตยืมทรัพย์สินของทางราชการ</small>
                </div>
            </div>

            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 14 การใช้ทรัพย์สินของราชการ">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-info-subtle text-info-emphasis px-3 py-2 rounded-pill fw-bold fs-6 border border-info">ตัวชี้วัดที่ 6</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการจัดทำแนวทางปฏิบัติเกี่ยวกับการใช้ทรัพย์สินของราชการที่ถูกต้อง และมีขั้นตอนการขออนุญาตเพื่อยืมทรัพย์สิน</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="p-3 border rounded-3 bg-light d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-building-gear text-info fs-2"></i>
                            <div>
                                <div class="fw-bold text-dark">แนวทางปฏิบัติเกี่ยวกับการใช้ทรัพย์สินของราชการ และขั้นตอนการขอยืม ประจำปี 2569</div>
                                <div class="small text-muted">แบบฟอร์มการยืม-คืน ทรัพย์สินของทางราชการเพื่อนำไปใช้ปฏิบัติงานในหน่วยงาน</div>
                            </div>
                        </div>
                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT14/MOIT14-69.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3 text-nowrap"><i class="bi bi-file-earmark-pdf me-1"></i> ดาวน์โหลด PDF</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- ตัวชี้วัดที่ 7: ตัวชี้วัดการดำเนินงานเพื่อป้องกันการทุจริต -->
        <!-- ========================================================================= -->
        <section id="indicator-7" class="ita-indicator-group mb-5">
            <div class="indicator-header d-flex align-items-center gap-3 p-3 rounded-4 text-white mb-3 shadow-sm bg-gradient-emerald">
                <div class="indicator-number-badge">07</div>
                <div>
                    <h2 class="h4 mb-0 fw-bold text-white">ตัวชี้วัดที่ 7: การดำเนินงานเพื่อป้องกันการทุจริต</h2>
                    <small class="text-white-50">MOIT 15 - MOIT 18 | ชมรมจริยธรรม แผนป้องกันการทุจริต และการประเมินความเสี่ยง</small>
                </div>
            </div>

            <!-- MOIT 15 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 15">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold fs-6 border border-success">MOIT 15</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">แผนปฏิบัติการป้องกัน ปราบปรามการทุจริตและประพฤติมิชอบ และแผนชมรมจริยธรรม</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">คำสั่งแต่งตั้งและแผนงานประจำปี 2567 - 2568</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT15/MOIT15-68-1.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> คำสั่งแต่งตั้งคณะทำงานขับเคลื่อนชมรมจริยธรรมฯ</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT15/MOIT15-67.pdf" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แผนป้องกันปราบปรามการทุจริต ปี 2567</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT15/MOIT15-68.pdf" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แผนป้องกันปราบปรามการทุจริต ปี 2568</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT15/MOIT15-67-J.pdf" target="_blank" class="btn btn-sm btn-outline-success rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แผนปฏิบัติการส่งเสริมคุณธรรมชมรมจริยธรรม ปี 2567</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT15/MOIT15-68-22.pdf" target="_blank" class="btn btn-sm btn-outline-success rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แผนปฏิบัติการส่งเสริมคุณธรรมชมรมจริยธรรม ปี 2568</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">แผนงานประจำปีงบประมาณ พ.ศ. 2569</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT15/MOIT15-69-1.pdf" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แผนป้องกันปราบปรามการทุจริต ปี 2569</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT15/MOIT15-69-2.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> คำสั่งแต่งตั้งคณะทำงานชมรมจริยธรรมฯ ปี 2569</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT15/MOIT15-69-3.pdf" target="_blank" class="btn btn-sm btn-outline-success rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> แผนปฏิบัติการส่งเสริมคุณธรรมชมรมจริยธรรม ปี 2569</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 16 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 16">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold fs-6 border border-success">MOIT 16</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">รายงานผลการดำเนินงานตามแผนปฏิบัติการป้องกันการทุจริต และแผนชมรมจริยธรรม</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light">
                                <h4 class="h6 fw-bold text-dark mb-2">รายงานผลรอบ 6 เดือน</h4>
                                <div class="d-flex flex-column gap-1">
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-6-67.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> รายงานป้องกันทุจริต 2567 (รอบ 6 เดือน)</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-67J-Mar.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-success me-1"></i> รายงานส่งเสริมคุณธรรม 2567 (รอบ 6 เดือน)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-68-2.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-success me-1"></i> รายงานส่งเสริมคุณธรรม 2568 (รอบ 6 เดือน)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-69-1.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> รายงานป้องกันทุจริต 2569 (รอบ 6 เดือน)</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light">
                                <h4 class="h6 fw-bold text-dark mb-2">รายงานผลรอบ 12 เดือน & กิจกรรมคุณธรรม</h4>
                                <div class="d-flex flex-column gap-1">
                                    <a href="http://www.pluakdaenghospital.com/private_folder/MOIT16/MOIT-16-12.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-success me-1"></i> รายงานส่งเสริมคุณธรรม 2566 (รอบ 12 เดือน)</a>
                                    <a href="http://www.pluakdaenghospital.com/private_folder/MOIT16/MOIT16.66-12.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> รายงานป้องกันทุจริต 2566 (รอบ 12 เดือน)</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16J-12-4.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-success me-1"></i> รายงานส่งเสริมคุณธรรม 2567 (รอบ 12 เดือน)</a>
                                    <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16T-67-12.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> รายงานป้องกันทุจริต 2567 (รอบ 12 เดือน)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-68-12.pdf" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-start"><i class="bi bi-file-pdf text-danger me-1"></i> รายงานป้องกันทุจริต 2568 (รอบ 12 เดือน)</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- กิจกรรมชมรมจิตอาสาและคุณธรรม -->
                    <div class="p-3 border rounded-3 bg-light">
                        <div class="fw-bold small text-dark mb-2"><i class="bi bi-heart-fill text-danger me-1"></i> กิจกรรมขับเคลื่อนชมรม "ปลวกแดงสุจริตจิตอาสา" และคุณธรรมองค์กร (ปี 2569)</div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT16/JITARSA.pdf" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3"><i class="bi bi-people-fill me-1"></i> ชมรม "ปลวกแดงสุจริตจิตอาสา"</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-69-2.pdf" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-journal-check me-1"></i> รายงานผลแผนส่งเสริมคุณธรรม 2569</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-69-3.pdf" target="_blank" class="btn btn-sm btn-outline-info rounded-pill px-3"><i class="bi bi-sun-fill me-1"></i> ชีวิตดีวิถีพอเพียง</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-69-4.pdf" target="_blank" class="btn btn-sm btn-outline-warning rounded-pill px-3"><i class="bi bi-shield-lock me-1"></i> ปฏิญญาคุณธรรม (Do & Don’t)</a>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT16/MOIT16-69-5.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="bi bi-house-heart me-1"></i> กิจกรรมครอบครัวอบอุ่นสรรสร้างคุณธรรม</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 17 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 17">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold fs-6 border border-success">MOIT 17</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการประเมินความเสี่ยงการทุจริต อย่างเป็นระบบ</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="table-responsive bg-white rounded-3 border">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ปีงบประมาณ</th>
                                    <th>รายงานการประชุมจัดทำแผน</th>
                                    <th>รายงานแผนบริหารความเสี่ยงการทุจริต</th>
                                    <th>รายงานผลการดำเนินงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">พ.ศ. 2566</td>
                                    <td><a href="http://www.pluakdaenghospital.com/private_folder/MOIT17/MOIT17.1.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-2"><i class="bi bi-file-pdf text-danger"></i> รายงานประชุม 66</a></td>
                                    <td><a href="http://www.pluakdaenghospital.com/private_folder/MOIT17/MOIT17.3.pdf" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-2"><i class="bi bi-file-pdf"></i> แผนความเสี่ยง 66</a></td>
                                    <td class="text-muted small">-</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">พ.ศ. 2567</td>
                                    <td><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT17/MOIT17-67-1.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-2"><i class="bi bi-file-pdf text-danger"></i> รายงานประชุม 67</a></td>
                                    <td><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT17/MOIT17-67-2.pdf" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-2"><i class="bi bi-file-pdf"></i> แผนความเสี่ยง 67</a></td>
                                    <td><a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT17/MOIT17-67-12.pdf" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-2"><i class="bi bi-file-pdf"></i> ผลดำเนินงาน 67</a></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">พ.ศ. 2568</td>
                                    <td><a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT17/MOIT17-68-1.pdf" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-2"><i class="bi bi-file-pdf text-danger"></i> รายงานประชุม 68</a></td>
                                    <td><a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT17/MOIT17-68-2.pdf" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-2"><i class="bi bi-file-pdf"></i> แผนความเสี่ยง 68</a></td>
                                    <td><a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT17/MOIT17-68-12.pdf" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-2"><i class="bi bi-file-pdf"></i> ผลดำเนินงาน 68</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- MOIT 18 (การปฏิบัติตามมาตรการป้องกันการทุจริต) -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 18 การควบคุมความเสี่ยงการทุจริต">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold fs-6 border border-success">MOIT 18</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการปฏิบัติตามมาตรการป้องกันการทุจริต (การควบคุมความเสี่ยงการทุจริต)</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="http://www.pluakdaenghospital.com/private_folder/MOIT18/MOIT18.pdf" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> มาตรการควบคุมความเสี่ยง (ปี 2566)</a>
                        <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT18/MOIT18-67.pdf" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> มาตรการควบคุมความเสี่ยง ปี 2567</a>
                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT18/MOIT18-68.pdf" target="_blank" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> มาตรการควบคุมความเสี่ยง ปี 2568</a>
                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT18/MOIT18-69.pdf" target="_blank" class="btn btn-outline-success btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> มาตรการควบคุมความเสี่ยง ปี 2569</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- ตัวชี้วัดที่ 8: การป้องกันผลประโยชน์ทับซ้อน -->
        <!-- ========================================================================= -->
        <section id="indicator-8" class="ita-indicator-group mb-5">
            <div class="indicator-header d-flex align-items-center gap-3 p-3 rounded-4 text-white mb-3 shadow-sm bg-gradient-indigo">
                <div class="indicator-number-badge">08</div>
                <div>
                    <h2 class="h4 mb-0 fw-bold text-white">ตัวชี้วัดที่ 8: การป้องกันผลประโยชน์ทับซ้อน</h2>
                    <small class="text-white-50">MOIT 18 - MOIT 22 | การวิเคราะห์ผลประโยชน์ทับซ้อน การเรี่ยไร สิทธิมนุษยชน และป้องกันการล่วงละเมิดทางเพศ</small>
                </div>
            </div>

            <!-- MOIT 18 (วิเคราะห์ผลประโยชน์ทับซ้อน) -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 18 วิเคราะห์ผลประโยชน์ทับซ้อน">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-indigo-subtle text-indigo px-3 py-2 rounded-pill fw-bold fs-6 border border-indigo">MOIT 18</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการวิเคราะห์ความเสี่ยงเกี่ยวกับผลประโยชน์ทับซ้อนประจำปีของหน่วยงาน</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                <span class="small fw-semibold mb-2">1. หนังสือแสดงหลักฐานการจัดการประชุมวิเคราะห์ความเสี่ยงเกี่ยวกับผลประโยชน์ทับซ้อน</span>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT18/MOIT18-1.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-file-earmark-pdf me-1"></i> ดาวน์โหลด PDF</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column justify-content-between">
                                <span class="small fw-semibold mb-2">2. รายงานการวิเคราะห์ความเสี่ยงเกี่ยวกับผลประโยชน์ทับซ้อน และแบบรายงานประเมินความเสี่ยง</span>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT18/MOIT18-2.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill align-self-start"><i class="bi bi-file-earmark-pdf me-1"></i> ดาวน์โหลด PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 19 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 19">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-indigo-subtle text-indigo px-3 py-2 rounded-pill fw-bold fs-6 border border-indigo">MOIT 19</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">รายงานผลการส่งเสริมการปฏิบัติตามประมวลจริยธรรมข้าราชการพลเรือน กรณีการเรี่ยไรและรับของขวัญ</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">งบประมาณ พ.ศ. 2568</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT19/MOIT19-68-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> 1. รายงานผลกรณีการเรี่ยไรและรับของขวัญ ปี 2568 (รอบ 6 เดือน)</a>
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT19/MOIT19-68-12.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> 2. รายงานการเรี่ยไรและรับของขวัญ ปี 2568 (รอบ 12 เดือน)</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <h4 class="h6 fw-bold text-dark mb-2">งบประมาณ พ.ศ. 2569</h4>
                                <div class="d-flex flex-column gap-2">
                                    <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT19/MOIT19-69-6.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-start"><i class="bi bi-file-earmark-pdf me-1"></i> 1. รายงานผลกรณีการเรี่ยไรและรับของขวัญ ปี 2569 (รอบ 6 เดือน)</a>
                                    <div class="p-2 border rounded-pill bg-white text-muted small text-center">2. รายงานรอบ 12 เดือน (รอดำเนินการตามรอบเวลา)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 20 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 20">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-indigo-subtle text-indigo px-3 py-2 rounded-pill fw-bold fs-6 border border-indigo">MOIT 20</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการอบรมให้ความรู้ เรื่อง ผลประโยชน์ทับซ้อน (หลักสูตรต้านทุจริตศึกษา Anti-Corruption Education)</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold small text-dark">การอบรมต้านทุจริตศึกษา ปี 2566</div>
                                    <div class="small text-muted">หลักสูตร Anti-Corruption Education (ฉบับปรับปรุง) พ.ศ. 2565</div>
                                </div>
                                <a href="http://www.pluakdaenghospital.com/private_folder/MOIT20/MOIT20-66.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-nowrap"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold small text-dark">การอบรมต้านทุจริตศึกษา ปี 2567</div>
                                    <div class="small text-muted">หลักสูตร Anti-Corruption Education (ฉบับปรับปรุง) ประจำปี 2567</div>
                                </div>
                                <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT20/MOIT20-67.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill text-nowrap"><i class="bi bi-file-earmark-pdf me-1"></i> PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOIT 21 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 21">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-indigo-subtle text-indigo px-3 py-2 rounded-pill fw-bold fs-6 border border-indigo">MOIT 21</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">หน่วยงานมีการเผยแพร่เจตจำนงสุจริตของการปฏิบัติหน้าที่ราชการ และนโยบายที่เคารพสิทธิมนุษยชนและศักดิ์ศรีของผู้ปฏิบัติงาน</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT21/MOIT21_66.pdf" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> เจตจำนงสุจริตและสิทธิมนุษยชน ปี 2566</a>
                        <a href="http://www.pluakdaenghospital.com/private_folder/MOIT21/MOIT21-66-TRI2.pdf" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="bi bi-image me-1"></i> กิจกรรมประกาศเจตนารมณ์ต่อสาธารณชน (2566)</a>
                        <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT21/MOIT21-67.pdf" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> เจตจำนงสุจริตและสิทธิมนุษยชน ปี 2567</a>
                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT21/MOIT21-68.pdf" target="_blank" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> เจตจำนงสุจริตและสิทธิมนุษยชน ปี 2568</a>
                        <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT21/MOIT21-69.pdf" target="_blank" class="btn btn-outline-success btn-sm rounded-pill px-3"><i class="bi bi-file-earmark-pdf me-1"></i> เจตจำนงสุจริตและสิทธิมนุษยชน ปี 2569</a>
                    </div>
                </div>
            </div>

            <!-- MOIT 22 -->
            <div class="card ita-moit-card border-0 shadow-sm rounded-4 mb-4" data-moit="MOIT 22">
                <div class="card-header bg-white p-3 p-md-4 border-bottom-0 rounded-top-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-indigo-subtle text-indigo px-3 py-2 rounded-pill fw-bold fs-6 border border-indigo">MOIT 22</span>
                        <h3 class="h5 mb-0 fw-bold text-dark">แนวปฏิบัติที่เคารพสิทธิมนุษยชนและศักดิ์ศรีของผู้ปฏิบัติงาน และรายงานการป้องกันปัญหาการล่วงละเมิดหรือคุกคามทางเพศ</h3>
                    </div>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <div class="list-group list-group-flush rounded-3 border">
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">1. แนวปฏิบัติที่เคารพสิทธิมนุษยชนและรายงานการป้องกันการล่วงละเมิดทางเพศในการทำงาน</span>
                            <a href="http://www.pluakdaenghospital.com/private_folder/MOIT22/MOIT22.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">2. รายงานการป้องกันและแก้ไขปัญหาการล่วงละเมิดหรือคุกคามทางเพศในการทำงาน <strong>รอบ 12 เดือน ปี 2566</strong></span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT22/MOIT22-2566-12.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">แนวปฏิบัติที่เคารพสิทธิมนุษยชนและรายงานป้องกันการล่วงละเมิดทางเพศ <strong>ประจำปีงบประมาณ 2567</strong></span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT22/MOIT22-67.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">รายงานการป้องกันและแก้ไขปัญหาการล่วงละเมิดหรือคุกคามทางเพศในการทำงาน <strong>รอบ 12 เดือน ปี 2567</strong></span>
                            <a href="http://www.pluakdaenghospital.moph.go.th/private_folder/MOIT22/MOIT22-67-12.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">รายงานผลการดำเนินงานตามมาตรการป้องกันและแก้ไขปัญหาการล่วงละเมิดหรือคุกคามทางเพศ <strong>รอบ 12 เดือน ปี 2568</strong></span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT22/MOIT22-68-12.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                        <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 p-3">
                            <span class="small">แนวปฏิบัติที่เคารพสิทธิมนุษยชนและศักดิ์ศรีของผู้ปฏิบัติงาน <strong>ประจำปีงบประมาณ 2569</strong></span>
                            <a href="http://pluakdaenghospital.moph.go.th/private_folder/MOIT22/MOIT22.pdf" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill"><i class="bi bi-download me-1"></i> PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<!-- Custom Styling for ITA Portal -->
<style>
    .ita-page-wrapper {
        background-color: #f8fafc;
    }
    .ita-hero-section {
        background: linear-gradient(135deg, #064e3b 0%, #0f766e 50%, #0369a1 100%);
        box-shadow: inset 0 -20px 30px rgba(0,0,0,0.15);
    }
    .ita-hero-bg-shapes {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(circle at 20% 30%, rgba(255,255,255,0.08) 0%, transparent 40%),
                          radial-gradient(circle at 80% 70%, rgba(255,255,255,0.05) 0%, transparent 35%);
        pointer-events: none;
    }
    .ita-search-box {
        max-width: 650px;
        margin: 0 auto;
        background: #ffffff;
    }
    .ita-search-box input:focus {
        box-shadow: none;
    }
    .sticky-top-custom {
        position: sticky;
        top: 80px;
        z-index: 1020;
    }
    .indicator-header {
        border-left: 6px solid rgba(255,255,255,0.6);
    }
    .indicator-number-badge {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1;
        background: rgba(255,255,255,0.2);
        padding: 8px 14px;
        border-radius: 12px;
        backdrop-filter: blur(4px);
    }
    .bg-gradient-teal {
        background: linear-gradient(135deg, #0d9488, #0f766e);
    }
    .bg-gradient-blue {
        background: linear-gradient(135deg, #0284c7, #0369a1);
    }
    .bg-gradient-purple {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
    }
    .bg-gradient-amber {
        background: linear-gradient(135deg, #d97706, #b45309);
    }
    .bg-gradient-rose {
        background: linear-gradient(135deg, #e11d48, #be123c);
    }
    .bg-gradient-cyan {
        background: linear-gradient(135deg, #0891b2, #0e7490);
    }
    .bg-gradient-emerald {
        background: linear-gradient(135deg, #059669, #047857);
    }
    .bg-gradient-indigo {
        background: linear-gradient(135deg, #4f46e5, #4338ca);
    }

    /* Subdued color tags */
    .bg-teal-subtle { background-color: #ccfbf1 !important; }
    .text-teal-dark { color: #0f766e !important; }
    .border-teal { border-color: #99f6e4 !important; }

    .bg-purple-subtle { background-color: #f3e8ff !important; }
    .text-purple { color: #7e22ce !important; }
    .border-purple { border-color: #e9d5ff !important; }

    .bg-warning-subtle { background-color: #fef3c7 !important; }
    .text-warning-dark { color: #b45309 !important; }

    .bg-indigo-subtle { background-color: #e0e7ff !important; }
    .text-indigo { color: #4338ca !important; }
    .border-indigo { border-color: #c7d2fe !important; }

    .ita-moit-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .ita-moit-card:hover {
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08) !important;
    }

    .ita-nav-btn {
        transition: all 0.2s ease;
        font-weight: 500;
    }
    .ita-nav-btn:hover, .ita-nav-btn.active {
        background-color: #0f766e !important;
        color: #ffffff !important;
    }
    .ita-nav-btn:hover .badge, .ita-nav-btn.active .badge {
        background-color: #ffffff !important;
        color: #0f766e !important;
    }
</style>

<!-- Live Search & Interactive Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('itaSearchInput');
    const clearBtn = document.getElementById('clearItaSearch');
    const searchAlert = document.getElementById('searchResultCount');
    const searchResultText = document.getElementById('searchResultText');
    const btnDismissAlert = document.getElementById('btnDismissSearchAlert');
    const moitCards = document.querySelectorAll('.ita-moit-card');
    const indicatorGroups = document.querySelectorAll('.ita-indicator-group');
    const accordions = document.querySelectorAll('.accordion-collapse');

    // Live search filter
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            if (query.length > 0) {
                clearBtn.classList.remove('d-none');
            } else {
                clearBtn.classList.add('d-none');
                searchAlert.classList.add('d-none');
            }

            let matchCount = 0;

            moitCards.forEach(card => {
                const cardText = card.textContent.toLowerCase();
                const moitAttr = (card.getAttribute('data-moit') || '').toLowerCase();
                
                if (cardText.includes(query) || moitAttr.includes(query)) {
                    card.style.display = '';
                    matchCount++;
                    // Auto expand accordions inside matching cards
                    if (query.length > 1) {
                        const accInsides = card.querySelectorAll('.accordion-collapse');
                        accInsides.forEach(acc => {
                            const bsCollapse = bootstrap.Collapse.getOrCreateInstance(acc, { toggle: false });
                            bsCollapse.show();
                        });
                    }
                } else {
                    card.style.display = 'none';
                }
            });

            // Check parent indicator groups
            indicatorGroups.forEach(group => {
                const visibleCards = group.querySelectorAll('.ita-moit-card:not([style*="display: none"])');
                if (visibleCards.length === 0 && query.length > 0) {
                    group.style.display = 'none';
                } else {
                    group.style.display = '';
                }
            });

            // Display count alert
            if (query.length > 0) {
                searchAlert.classList.remove('d-none');
                searchResultText.innerHTML = `พบหัวข้อที่ตรงกับการค้นหา <strong>"${query}"</strong> จำนวน <strong>${matchCount}</strong> รายการ`;
            }
        });

        // Clear search
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
        });

        if (btnDismissAlert) {
            btnDismissAlert.addEventListener('click', function() {
                searchAlert.classList.add('d-none');
            });
        }
    }

    // Expand All / Collapse All
    const btnExpandAll = document.getElementById('btnExpandAll');
    const btnCollapseAll = document.getElementById('btnCollapseAll');

    if (btnExpandAll) {
        btnExpandAll.addEventListener('click', function() {
            accordions.forEach(acc => {
                const bsCollapse = bootstrap.Collapse.getOrCreateInstance(acc, { toggle: false });
                bsCollapse.show();
            });
        });
    }

    if (btnCollapseAll) {
        btnCollapseAll.addEventListener('click', function() {
            accordions.forEach(acc => {
                const bsCollapse = bootstrap.Collapse.getOrCreateInstance(acc, { toggle: false });
                bsCollapse.hide();
            });
        });
    }

    // Smooth scroll for nav pills
    document.querySelectorAll('.ita-nav-btn').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const offset = 140; // Navbar + sticky pill bar height
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Update active pill
                document.querySelectorAll('.ita-nav-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });
});
</script>
