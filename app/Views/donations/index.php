<div class="donation-page-wrapper">

    <!-- ========================================================================= -->
    <!-- HERO SECTION : The Endless Giving Campaign (การให้ไม่มีสิ้นสุด) -->
    <!-- ========================================================================= -->
    <section class="donation-hero-section py-5 position-relative overflow-hidden">
        <div class="container position-relative" style="z-index: 2;">
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= URLROOT ?>" class="text-white-50 text-decoration-none"><i class="bi bi-house-door me-1"></i> หน้าแรก</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">ร่วมบริจาค (การให้ไม่มีสิ้นสุด)</li>
                </ol>
            </nav>

            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-7">
                    <!-- Campaign Badge with glowing infinity icon -->
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-white bg-opacity-15 text-white border border-white border-opacity-25 mb-3 shadow-sm infinity-badge">
                        <i class="bi bi-infinity fs-4 text-warning infinity-pulse"></i>
                        <span class="small fw-bold text-uppercase tracking-wider">แคมเปญพิเศษ : "การให้...ไม่มีสิ้นสุด" (The Endless Giving)</span>
                    </div>

                    <h1 class="display-5 fw-bold text-white mb-3 lh-sm">
                        1 การให้ของคุณ...<br>
                        <span class="text-warning text-gradient-gold">ต่อลมหายใจได้ไม่รู้จบ</span>
                    </h1>

                    <p class="text-white-50 fs-5 mb-4 lh-base" style="max-width: 620px;">
                        ร่วมเป็นสะพานบุญส่งต่อความหวัง จัดซื้อเครื่องมือการแพทย์ที่ขาดแคลน ช่วยเหลือผู้ป่วยวิกฤต และสงเคราะห์ผู้ป่วยยากไร้ ณ <strong>โรงพยาบาลปลวกแดง</strong>
                    </p>

                    <!-- Live Key Stat Pills -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-sm-3">
                            <div class="p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-15 text-center">
                                <div class="fs-4 fw-bold text-warning mb-0">฿<?= number_format($totalRaised ?? 0) ?></div>
                                <small class="text-white-50" style="font-size: 0.75rem;">ยอดระดมทุนรวม</small>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-15 text-center">
                                <div class="fs-4 fw-bold text-info mb-0"><?= count($items ?? []) ?> โครงการ</div>
                                <small class="text-white-50" style="font-size: 0.75rem;">โครงการที่เปิดรับ</small>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-15 text-center">
                                <div class="fs-4 fw-bold text-success mb-0">1,280+</div>
                                <small class="text-white-50" style="font-size: 0.75rem;">ผู้ร่วมบริจาค</small>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-15 text-center">
                                <div class="fs-4 fw-bold text-warning mb-0">2 เท่า</div>
                                <small class="text-white-50" style="font-size: 0.75rem;">ลดหย่อนภาษี 200%</small>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Action Buttons -->
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#endlessGivingCalculator" class="btn btn-warning btn-lg rounded-pill px-4 py-3 fw-bold text-dark shadow-lg d-inline-flex align-items-center gap-2">
                            <i class="bi bi-heart-fill text-danger fs-5"></i>
                            <span>ร่วมบริจาคออนไลน์ทันที</span>
                        </a>
                        <a href="#eDonationSection" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold d-inline-flex align-items-center gap-2">
                            <i class="bi bi-qr-code-scan fs-5"></i>
                            <span>สแกน e-Donation</span>
                        </a>
                        <a href="<?= URLROOT ?>/donation/track" class="btn btn-teal-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold d-inline-flex align-items-center gap-2">
                            <i class="bi bi-search fs-5"></i>
                            <span>ติดตามสถานะสลิปบริจาค</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Interactive Endless Giving Card & Tax Deduction Badge -->
                <div class="col-lg-5 text-center">
                    <div class="hero-impact-card p-4 p-md-5 rounded-5 bg-white text-dark shadow-2xl position-relative">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-1 fw-bold">
                                <i class="bi bi-patch-check-fill me-1"></i> e-Donation ลดหย่อน 2 เท่า
                            </span>
                        </div>

                        <div class="infinity-circle-wrap mx-auto mb-3">
                            <div class="infinity-circle-glow">
                                <i class="bi bi-infinity display-3 text-teal"></i>
                            </div>
                        </div>

                        <h3 class="h5 fw-bold text-dark mb-1">พลังแห่งการให้ไม่มีสิ้นสุด</h3>
                        <p class="text-muted small mb-4">
                            ทุกบาทของท่าน เปลี่ยนเป็นลมหายใจและรอยยิ้มของผู้ป่วยโรงพยาบาลปลวกแดง
                        </p>

                        <!-- Quick Bank Details Box -->
                        <div class="p-3 rounded-4 bg-light text-start border mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="small text-muted"><i class="bi bi-bank2 text-primary me-1"></i> ธนาคารกรุงไทย</span>
                                <span class="badge bg-primary-subtle text-primary">สาขาปลวกแดง</span>
                            </div>
                            <div class="fw-bold text-dark small mb-1">ชื่อบัญชี: เงินบริจาคของโรงพยาบาลปลวกแดง</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fs-5 fw-bold font-monospace text-primary" id="bankAccNo">671-9-87195-1</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="copyToClipboard('6719871951', 'คัดลอกเลขบัญชี 671-9-87195-1 เรียบร้อยแล้ว')">
                                    <i class="bi bi-clipboard me-1"></i> คัดลอก
                                </button>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <button type="button" class="btn btn-teal-gradient w-100 py-3 rounded-pill fw-bold text-white shadow" data-bs-toggle="modal" data-bs-target="#quickDonateModal">
                                <i class="bi bi-receipt me-1"></i> แจ้งหลักฐานการบริจาค (แนบสลิป)
                            </button>
                            <a href="<?= URLROOT ?>/donation/track" class="btn btn-outline-secondary w-100 py-2 rounded-pill small">
                                <i class="bi bi-search me-1"></i> ตรวจสอบสถานะการบริจาค (Donor Tracker)
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="donation-hero-bg-shapes"></div>
    </section>

    <!-- ========================================================================= -->
    <!-- GIMMICK SECTION : Interactive "วงล้อแห่งการให้ไม่มีสิ้นสุด" (Impact Calculator) -->
    <!-- ========================================================================= -->
    <section class="py-5" id="endlessGivingCalculator">
        <div class="container">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden" style="background: linear-gradient(135deg, #093f35 0%, #0f766e 50%, #0369a1 100%);">
                <div class="card-body p-4 p-md-5 text-white">
                    <div class="text-center max-w-700 mx-auto mb-4">
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">
                            <i class="bi bi-stars me-1"></i> เลือกระดับพลังแห่งการให้
                        </span>
                        <h2 class="display-6 fw-bold text-white mb-2">คุณอยากส่งต่อพลังแห่งการให้แบบไหน?</h2>
                        <p class="text-white-50 small mb-0">
                            คลิกเลือกจำนวนเงินเพื่อดูผลลัพธ์และความเปลี่ยนแปลงที่คุณมอบให้กับผู้ป่วยได้ทันที
                        </p>
                    </div>

                    <!-- Preset Amount Selector Buttons -->
                    <div class="row g-2 g-md-3 justify-content-center mb-4">
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-outline-light w-100 py-3 rounded-4 btn-amount-preset active" data-amount="100" data-impact="สมทบทุนจัดซื้อเวชภัณฑ์จำเป็นและอุปกรณ์ทำแผลสำหรับผู้ป่วยนอก">
                                <div class="fs-4 fw-bold font-monospace mb-0">100 ฿</div>
                                <small class="d-block opacity-75">เริ่มต้นส่งต่อ</small>
                            </button>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-outline-light w-100 py-3 rounded-4 btn-amount-preset" data-amount="300" data-impact="จัดหาชุดตรวจสุขภาพเบื้องต้นและยารักษาโรคเรื้อรังสำหรับผู้ป่วยยากไร้">
                                <div class="fs-4 fw-bold font-monospace mb-0">300 ฿</div>
                                <small class="d-block opacity-75">เติมเต็มโอกาส</small>
                            </button>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-outline-light w-100 py-3 rounded-4 btn-amount-preset" data-amount="500" data-impact="สนับสนุนออกซิเจนและอุปกรณ์ดูแลผู้ป่วยติดเตียงระยะประคับประคองที่บ้าน">
                                <div class="fs-4 fw-bold font-monospace mb-0">500 ฿</div>
                                <small class="d-block opacity-75">พลังแห่งลมหายใจ</small>
                            </button>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-outline-light w-100 py-3 rounded-4 btn-amount-preset" data-amount="1000" data-impact="สมทบทุนจัดซื้อเครื่องเฝ้าระวังสัญญาณชีพและอุปกรณ์ช่วยชีวิตฉุกเฉิน (ER)">
                                <div class="fs-4 fw-bold font-monospace mb-0">1,000 ฿</div>
                                <small class="d-block opacity-75">ช่วยชีวิตวิกฤต</small>
                            </button>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-outline-light w-100 py-3 rounded-4 btn-amount-preset" data-amount="2500" data-impact="ร่วมสมทบทุนจัดซื้อเครื่องช่วยหายใจสำหรับหอผู้ป่วยวิกฤต (ICU)">
                                <div class="fs-4 fw-bold font-monospace mb-0">2,500 ฿</div>
                                <small class="d-block opacity-75">สร้างปาฏิหาริย์</small>
                            </button>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-outline-light w-100 py-3 rounded-4 btn-amount-preset" data-amount="5000" data-impact="สนับสนุนการพัฒนาศูนย์การแพทย์และเตียงผู้ป่วยระบบไฟฟ้าครบวงจร">
                                <div class="fs-4 fw-bold font-monospace mb-0">5,000 ฿</div>
                                <small class="d-block opacity-75">ผู้เกื้อหนุนรพ.</small>
                            </button>
                        </div>
                    </div>

                    <!-- Dynamic Impact Card -->
                    <div class="card bg-white bg-opacity-10 border border-white border-opacity-25 rounded-4 p-4 text-center max-w-700 mx-auto mb-4 backdrop-blur">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                            <i class="bi bi-heart-pulse-fill text-warning fs-4"></i>
                            <h4 class="h5 fw-bold mb-0 text-white">ผลลัพธ์ที่คุณสร้างได้</h4>
                        </div>
                        <p class="fs-5 text-white fw-semibold mb-0" id="selectedImpactText">
                            สมทบทุนจัดซื้อเวชภัณฑ์จำเป็นและอุปกรณ์ทำแผลสำหรับผู้ป่วยนอก
                        </p>
                    </div>

                    <!-- CTA Buttons inside Impact Section -->
                    <div class="text-center">
                        <button type="button" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold text-dark shadow-lg me-2 mb-2" id="btnDonateThisPreset" data-bs-toggle="modal" data-bs-target="#quickDonateModal">
                            <i class="bi bi-check2-circle me-1"></i> ร่วมบริจาคตามยอดที่เลือก (<span id="btnPresetAmountLabel">100 บาท</span>)
                        </button>
                        <a href="#eDonationSection" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold mb-2" onclick="setQrAmount(currentSelectedAmount)">
                            <i class="bi bi-qr-code me-1"></i> สแกน e-Donation ยอดนี้
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- E-DONATION & TAX DEDUCTION 2X SECTION (DYNAMIC QR GENERATOR) -->
    <!-- ========================================================================= -->
    <section class="py-4 mb-5" id="eDonationSection">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                
                <!-- Left: Official PromptPay / e-Donation QR Card -->
                <div class="col-lg-5">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 p-md-5 text-center bg-white d-flex flex-column justify-content-between">
                        <div>
                            <!-- Official e-Donation Brand Logo & Badge -->
                            <div class="mb-2 text-center">
                                <a href="https://epayapp.rd.go.th/rd-edonation/portal/for-donation-unit" target="_blank" title="ระบบบริจาคอิเล็กทรอนิกส์ (e-Donation) กรมสรรพากร" class="d-inline-block text-decoration-none">
                                    <img src="<?= URLROOT ?>/assets/images/edonation-badge.svg" alt="e-Donation Logo กรมสรรพากร" class="img-fluid rounded-4 shadow-sm hover-scale mb-1" style="max-height: 60px;">
                                </a>
                            </div>

                            <h3 class="h4 fw-bold text-dark mb-1">สแกนบริจาคผ่าน e-Donation</h3>
                            <p class="text-muted small mb-3">
                                สแกนผ่าน Mobile Banking ได้ทุกธนาคาร ข้อมูลส่งตรงถึงระบบกรมสรรพากรเพื่อลดหย่อนภาษี 2 เท่าโดยอัตโนมัติ
                            </p>

                            <!-- Official Bank QR Image Container -->
                            <div class="p-3 bg-light rounded-4 border shadow-sm position-relative d-inline-block mb-3">
                                <img id="officialEdonationQrImg" src="<?= URLROOT ?>/assets/images/donations/official-edonation-qr.png" alt="Official PromptPay e-Donation QR Code" class="img-fluid rounded" style="max-height: 280px; object-fit: contain;">
                            </div>

                            <div class="small fw-bold text-dark mb-1">บัญชีเงินบริจาคของโรงพยาบาลปลวกแดง</div>
                            <div class="small text-muted font-monospace mb-2">ธนาคารกรุงไทย สาขาปลวกแดง • <strong>671-9-87195-1</strong></div>
                            
                            <!-- Portal verification link -->
                            <div class="mb-3">
                                <a href="https://epayapp.rd.go.th/rd-edonation/portal/for-donation-unit" target="_blank" rel="noopener noreferrer" class="text-teal small text-decoration-none fw-semibold d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-patch-check-fill text-success"></i> ตรวจสอบสถานะหน่วยรับบริจาคบนระบบกรมสรรพากร <i class="bi bi-box-arrow-up-right" style="font-size: 0.75rem;"></i>
                                </a>
                            </div>

                            <!-- QR Action Buttons -->
                            <div class="d-flex flex-wrap gap-2 justify-content-center mb-3">
                                <a href="<?= URLROOT ?>/assets/images/donations/official-edonation-qr.png" download="PDH_eDonation_Official_QR.png" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-download me-1"></i> ดาวน์โหลด QR
                                </a>
                                <a href="<?= URLROOT ?>/assets/images/donations/donation-poster.jpg" target="_blank" class="btn btn-sm btn-outline-teal rounded-pill px-3">
                                    <i class="bi bi-file-earmark-image me-1"></i> ดูป้ายประกาศทางการ
                                </a>
                                <button type="button" class="btn btn-sm btn-teal-gradient text-white rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#quickDonateModal">
                                    <i class="bi bi-receipt me-1"></i> แจ้งสลิปออนไลน์
                                </button>
                            </div>
                        </div>

                        <div class="alert alert-success d-flex align-items-center gap-2 p-2 rounded-3 text-start mb-0 small">
                            <i class="bi bi-shield-check fs-4 text-success flex-shrink-0"></i>
                            <div><strong>สิทธิประโยชน์ 2 เท่า:</strong> บุคคลธรรมดาและนิติบุคคล ลดหย่อนภาษีได้ 2 เท่าตามที่จ่ายจริงผ่านระบบ e-Donation</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Bank Transfer Info & Tax Guide -->
                <div class="col-lg-7">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="contact-icon-bubble bg-primary-subtle text-primary">
                                    <i class="bi bi-bank fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="h4 fw-bold text-dark mb-0">ช่องทางการโอนเงินผ่านธนาคาร</h3>
                                    <small class="text-muted">Direct Bank Transfer Channels</small>
                                </div>
                            </div>

                            <!-- Account Details Table -->
                            <div class="p-4 rounded-4 bg-light border mb-4">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <small class="text-muted d-block">ธนาคาร:</small>
                                        <div class="fw-bold text-dark fs-6"><i class="bi bi-building text-primary me-1"></i> ธนาคารกรุงไทย จำกัด (มหาชน)</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-block">สาขา:</small>
                                        <div class="fw-bold text-dark fs-6">สาขาปลวกแดง</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-block">ชื่อบัญชี:</small>
                                        <div class="fw-bold text-primary fs-6">เงินบริจาคของโรงพยาบาลปลวกแดง</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-block">เลขที่บัญชี:</small>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fs-5 fw-bold font-monospace text-primary">671-9-87195-1</span>
                                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-0" onclick="copyToClipboard('6719871951', 'คัดลอกเลขบัญชี 671-9-87195-1 เรียบร้อยแล้ว')">
                                                <i class="bi bi-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 3 Easy Steps to e-Donation Tax Deduction -->
                            <h4 class="h6 fw-bold text-dark mb-3"><i class="bi bi-check2-circle text-success me-1"></i> 3 ขั้นตอนการบริจาคเพื่อลดหย่อนภาษี 2 เท่า:</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 bg-white border h-100">
                                        <div class="badge bg-primary rounded-circle p-2 mb-2">1</div>
                                        <div class="fw-bold small text-dark mb-1">สแกนหรือโอนเงิน</div>
                                        <div class="text-muted" style="font-size: 0.78rem;">โอนเข้าบัญชี หรือสแกน QR ผ่าน Mobile Banking</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 bg-white border h-100">
                                        <div class="badge bg-primary rounded-circle p-2 mb-2">2</div>
                                        <div class="fw-bold small text-dark mb-1">กดยินยอมส่งข้อมูล</div>
                                        <div class="text-muted" style="font-size: 0.78rem;">เลือกยินยอมให้ธนาคารส่งข้อมูลให้กรมสรรพากร (e-Donation)</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 bg-white border h-100">
                                        <div class="badge bg-primary rounded-circle p-2 mb-2">3</div>
                                        <div class="fw-bold small text-dark mb-1">รับสิทธิลดหย่อน 2 เท่า</div>
                                        <div class="text-muted" style="font-size: 0.78rem;">ข้อมูลปรากฏในระบบยื่นภาษีทันที ไม่ต้องเก็บเอกสารใบเสร็จ</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Official LINE Receipt Notification Banner -->
                            <div class="p-3 rounded-4 bg-light border mb-3 d-flex flex-column flex-sm-row align-items-center gap-3">
                                <div class="flex-shrink-0 text-center">
                                    <img src="<?= URLROOT ?>/assets/images/donations/official-line-receipt-qr.png" alt="Official LINE Receipt QR" class="img-fluid rounded-3 border shadow-sm" style="max-width: 90px;">
                                </div>
                                <div class="flex-grow-1 text-center text-sm-start">
                                    <div class="fw-bold text-dark small mb-1">
                                        <i class="bi bi-line text-success fs-5 me-1"></i> โอนปุ๊บ สแกนปั๊บ เพื่อแจ้งออกใบเสร็จ (งานการเงินและบัญชี)
                                    </div>
                                    <p class="text-muted small mb-0" style="font-size: 0.76rem;">
                                        สแกน QR LINE หรือติดต่อขอรับใบเสร็จได้ที่ งานการเงิน ห้องบริหารชั้น 2 อาคารผู้ป่วยนอก ในวันและเวลาราชการ โทร. <strong>033-650-413 ต่อ 101</strong>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                            <button type="button" class="btn btn-teal-gradient text-white rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#quickDonateModal">
                                <i class="bi bi-cloud-arrow-up-fill me-1"></i> แนบสลิปผ่านระบบออนไลน์
                            </button>
                            <a href="<?= URLROOT ?>/donation/track" class="btn btn-outline-teal rounded-pill px-3">
                                <i class="bi bi-search me-1"></i> ติดตามสถานะสลิป
                            </a>
                            <a href="tel:033650413" class="btn btn-outline-secondary rounded-pill px-3">
                                <i class="bi bi-telephone me-1"></i> 033-650-413 ต่อ 101
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- CAMPAIGN PROJECTS SHOWCASE SECTION -->
    <!-- ========================================================================= -->
    <section class="py-5 bg-white border-top border-bottom" id="campaignProjects">
        <div class="container">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
                <div>
                    <span class="badge bg-teal-subtle text-teal px-3 py-1 rounded-pill fw-bold mb-2">
                        <i class="bi bi-heart-pulse-fill me-1"></i> โครงการระดมทุนเพื่อชีวิต
                    </span>
                    <h2 class="display-6 fw-bold text-dark mb-1">โครงการภายใต้แคมเปญการให้ไม่มีสิ้นสุด</h2>
                    <p class="text-muted mb-0">ท่านสามารถเลือกสนับสนุนโครงการทางการแพทย์ที่ต้องการได้โดยตรง</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <button type="button" class="btn btn-outline-primary rounded-pill px-4 fw-semibold" data-bs-toggle="modal" data-bs-target="#quickDonateModal">
                        <i class="bi bi-plus-circle me-1"></i> บริจาคทั่วไปไม่ระบุโครงการ
                    </button>
                </div>
            </div>

            <div class="row g-4">
                <?php if (empty($items)): ?>
                    <div class="col-12 text-center py-5">
                        <div class="p-4 bg-light rounded-4 d-inline-block">
                            <i class="bi bi-box2-heart display-4 text-muted mb-3 d-block"></i>
                            <h5 class="text-muted mb-0">ขณะนี้ยังไม่มีรายการโครงการเปิดรับ</h5>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($items as $item): ?>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden project-card d-flex flex-column">
                            
                            <!-- Project Image Container -->
                            <div class="position-relative overflow-hidden" style="height: 190px; background: linear-gradient(135deg, #0f172a, #134e4a);">
                                <img src="<?= URLROOT ?>/assets/images/donations/<?= $item->image ?: 'default-donation.jpg' ?>" class="w-100 h-100 object-fit-cover project-img" alt="<?= htmlspecialchars($item->title) ?>" onerror="this.src='https://placehold.co/600x400/0d9488/ffffff?text=PDH+Campaign'">
                                
                                <div class="position-absolute top-0 start-0 m-3">
                                    <?php if ($item->type == 'money'): ?>
                                        <span class="badge bg-success text-white px-3 py-1 rounded-pill shadow-sm"><i class="bi bi-cash-stack me-1"></i> ระดมทุน</span>
                                    <?php elseif ($item->type == 'equipment'): ?>
                                        <span class="badge bg-info text-white px-3 py-1 rounded-pill shadow-sm"><i class="bi bi-heart-pulse-fill me-1"></i> อุปกรณ์การแพทย์</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill shadow-sm fw-bold"><i class="bi bi-infinity me-1"></i> การให้ไม่มีสิ้นสุด</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <h3 class="h6 fw-bold text-dark mb-2 line-clamp-2" style="height: 2.8rem; line-height: 1.4;">
                                        <?= htmlspecialchars($item->title) ?>
                                    </h3>
                                    <p class="text-muted small mb-3 line-clamp-3" style="line-height: 1.5; font-size: 0.82rem;">
                                        <?= mb_strimwidth(htmlspecialchars($item->description ?? ''), 0, 110, '...') ?>
                                    </p>
                                </div>

                                <!-- Progress Bar -->
                                <div class="pt-2 border-top">
                                    <?php 
                                        $target = floatval($item->target_amount ?? 0);
                                        $current = floatval($item->current_amount ?? 0);
                                        $percent = ($target > 0) ? min(100, round(($current / $target) * 100, 1)) : 0;
                                    ?>
                                    <div class="d-flex justify-content-between align-items-center small mb-1">
                                        <span class="text-muted" style="font-size: 0.78rem;">ได้รับแล้ว: <strong class="text-teal">฿<?= number_format($current) ?></strong></span>
                                        <span class="fw-bold text-teal" style="font-size: 0.78rem;"><?= $percent ?>%</span>
                                    </div>
                                    <div class="progress mb-2" style="height: 8px; border-radius: 10px; background-color: #e2e8f0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-teal" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="text-end text-muted small mb-3" style="font-size: 0.72rem;">
                                        เป้าหมาย: ฿<?= number_format($target) ?>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-teal-gradient btn-sm rounded-pill fw-bold text-white shadow-sm" onclick="openDonateForProject(<?= $item->id ?>, '<?= htmlspecialchars(addslashes($item->title)) ?>')">
                                            <i class="bi bi-heart-fill me-1"></i> ร่วมบริจาคโครงการนี้
                                        </button>
                                        <div class="d-flex gap-2">
                                            <a href="<?= URLROOT ?>/donation/show/<?= $item->id ?>" class="btn btn-outline-secondary btn-sm rounded-pill flex-grow-1">
                                                รายละเอียด &rarr;
                                            </a>
                                            <button type="button" class="btn btn-outline-teal btn-sm rounded-pill px-3" onclick="openShareModal('<?= htmlspecialchars(addslashes($item->title)) ?>', '<?= URLROOT ?>/donation/show/<?= $item->id ?>')" title="แชร์โครงการนี้">
                                                <i class="bi bi-share"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- WALL OF DONORS (ทำเนียบผู้มีจิตศรัทธา & คำขอบคุณ) -->
    <!-- ========================================================================= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-4 mb-4">
                <div class="col-lg-6">
                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">
                        <i class="bi bi-award-fill me-1"></i> ทำเนียบผู้มีจิตศรัทธา
                    </span>
                    <h2 class="display-6 fw-bold text-dark mb-1">กำแพงเกียรติยศแห่งการให้</h2>
                    <p class="text-muted mb-0">
                        ขอขอบพระคุณทุกน้ำใจและทุกพลังศรัทธาที่ร่วมสร้างสรรค์การให้ที่ไม่มีสิ้นสุด
                    </p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="p-3 rounded-4 bg-white border d-inline-block text-start shadow-sm">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-quote fs-1 text-teal"></i>
                            <div class="small text-muted">
                                <em>"การให้คือการต่อชีวิต และบุญกุศลแห่งการให้จะคุ้มครองท่านและครอบครัวตลอดไป"</em>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Donors Grid -->
            <div class="row g-3">
                <?php if (!empty($recentDonors)): ?>
                    <?php foreach ($recentDonors as $donor): ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white donor-card">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="donor-avatar rounded-circle bg-teal-subtle text-teal d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
                                        <i class="bi bi-heart-fill"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <div class="fw-bold text-dark text-truncate small"><?= htmlspecialchars($donor->donor_name) ?></div>
                                        <div class="text-success fw-bold font-monospace" style="font-size: 0.85rem;">
                                            +฿<?= number_format($donor->amount ?? 0) ?>
                                        </div>
                                        <div class="text-muted text-truncate" style="font-size: 0.72rem;">
                                            <?= htmlspecialchars($donor->item_title) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center text-muted py-4">
                        ร่วมเป็นส่วนหนึ่งในทำเนียบผู้บริจาคคนแรกของแคมเปญนี้
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</div>

<!-- ========================================================================= -->
<!-- MODAL : Quick Donation & Slip Upload Form (แบบฟอร์มร่วมบริจาคและแนบสลิป) -->
<!-- ========================================================================= -->
<div class="modal fade" id="quickDonateModal" tabindex="-1" aria-labelledby="quickDonateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-2xl rounded-5 overflow-hidden">
            
            <div class="modal-header text-white p-4" style="background: linear-gradient(135deg, #093f35 0%, #0d9488 100%);">
                <div>
                    <div class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                        <i class="bi bi-infinity me-1"></i> แคมเปญการให้ไม่มีสิ้นสุด
                    </div>
                    <h5 class="modal-title fw-bold text-white" id="quickDonateModalLabel">แบบฟอร์มร่วมบริจาค & แจ้งหลักฐานการโอนเงิน</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= URLROOT ?>/donation/store" method="POST" enctype="multipart/form-data" id="modalDonationForm">
                <?= \App\Helpers\Security::csrfField() ?>
                
                <div class="modal-body p-4 p-md-5">
                    
                    <!-- Bank Quick Summary Banner inside Modal -->
                    <div class="p-3 rounded-4 bg-light border mb-4 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                        <div>
                            <small class="text-muted d-block">โอนเข้าบัญชี: <strong>ธนาคารกรุงไทย สาขาปลวกแดง</strong></small>
                            <span class="fw-bold text-primary">ชื่อบัญชี: เงินบริจาคของโรงพยาบาลปลวกแดง</span>
                        </div>
                        <div class="text-sm-end">
                            <span class="fs-5 fw-bold font-monospace text-primary">671-9-87195-1</span>
                        </div>
                    </div>

                    <div class="row g-3">
                        
                        <!-- Select Campaign Project -->
                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark">เลือกโครงการที่ต้องการบริจาค <span class="text-danger">*</span></label>
                            <select name="donation_item_id" id="modalDonationItemId" class="form-select rounded-3 py-2 shadow-sm" required>
                                <?php if (!empty($items)): ?>
                                    <?php foreach ($items as $it): ?>
                                        <option value="<?= $it->id ?>"><?= htmlspecialchars($it->title) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Donation Amount -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">จำนวนเงินที่บริจาค (บาท) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">฿</span>
                                <input type="number" name="amount" id="modalDonationAmount" class="form-control rounded-end-3 py-2" placeholder="เช่น 500" min="1" step="any" required>
                            </div>
                        </div>

                        <!-- Donor Full Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">ชื่อ-นามสกุล / องค์กรผู้บริจาค <span class="text-danger">*</span></label>
                            <input type="text" name="donor_name" class="form-control rounded-3 py-2" placeholder="เช่น นายสมชาย ใจดี หรือ บริษัท เอ จำกัด" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">เบอร์โทรศัพท์ติดต่อ <span class="text-danger">*</span></label>
                            <input type="tel" name="donor_phone" class="form-control rounded-3 py-2" placeholder="เช่น 081-234-5678" required>
                        </div>

                        <!-- Email Address -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">อีเมล (เพื่อรับการยืนยัน)</label>
                            <input type="email" name="donor_email" class="form-control rounded-3 py-2" placeholder="example@email.com">
                        </div>

                        <!-- Payment Slip Upload -->
                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark">แนบภาพสลิปหลักฐานการโอนเงิน <span class="text-danger">*</span></label>
                            <input type="file" name="payment_slip" class="form-control rounded-3 py-2" accept="image/*" required>
                            <small class="text-muted" style="font-size: 0.75rem;">รองรับไฟล์ภาพ JPG, PNG, WEBP (ขนาดไม่เกิน 5 MB)</small>
                        </div>

                    </div>

                </div>

                <div class="modal-footer p-4 bg-light border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-teal-gradient rounded-pill px-5 py-2 fw-bold text-white shadow">
                        <i class="bi bi-check-circle-fill me-1"></i> ยืนยันการร่วมบริจาค
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL : Universal Social Share Modal (กล่องแชร์โครงการและแคมเปญ) -->
<!-- ========================================================================= -->
<div class="modal fade" id="shareCampaignModal" tabindex="-1" aria-labelledby="shareCampaignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-5 overflow-hidden">
            <div class="modal-header text-white p-4" style="background: linear-gradient(135deg, #093f35 0%, #0d9488 100%);">
                <div>
                    <h5 class="modal-title fw-bold text-white mb-1" id="shareCampaignModalLabel">
                        <i class="bi bi-share-fill me-2"></i>บอกต่อพลังแห่งการให้
                    </h5>
                    <small class="text-white-50">ร่วมเป็นสะพานบุญส่งต่อโอกาสและรอยยิ้มให้กับผู้ป่วย</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                
                <h6 class="fw-bold text-dark mb-3" id="shareModalItemTitle">แคมเปญการให้ไม่มีสิ้นสุด โรงพยาบาลปลวกแดง</h6>
                
                <!-- Social Share Buttons Grid -->
                <div class="row g-2 mb-4 justify-content-center">
                    <div class="col-4">
                        <a id="shareFbBtn" href="#" target="_blank" class="btn btn-primary w-100 py-3 rounded-4 d-flex flex-column align-items-center gap-1 shadow-sm">
                            <i class="bi bi-facebook fs-3"></i>
                            <span class="small fw-semibold">Facebook</span>
                        </a>
                    </div>
                    <div class="col-4">
                        <a id="shareLineBtn" href="#" target="_blank" class="btn text-white w-100 py-3 rounded-4 d-flex flex-column align-items-center gap-1 shadow-sm" style="background-color: #06c755;">
                            <i class="bi bi-line fs-3"></i>
                            <span class="small fw-semibold">LINE</span>
                        </a>
                    </div>
                    <div class="col-4">
                        <a id="shareTwBtn" href="#" target="_blank" class="btn btn-dark w-100 py-3 rounded-4 d-flex flex-column align-items-center gap-1 shadow-sm">
                            <i class="bi bi-twitter-x fs-3"></i>
                            <span class="small fw-semibold">X (Twitter)</span>
                        </a>
                    </div>
                </div>

                <!-- QR Code for Link -->
                <div class="p-3 bg-light rounded-4 border mb-3 d-inline-block">
                    <img id="shareLinkQrImg" src="" alt="Link QR" class="img-fluid rounded" width="150" height="150">
                    <div class="text-muted small mt-1" style="font-size: 0.72rem;">สแกนเพื่อเปิดหน้านี้บนมือถือ</div>
                </div>

                <!-- Copy Link Input Box -->
                <div class="input-group mb-2">
                    <input type="text" id="shareLinkInput" class="form-control bg-light font-monospace small" readonly>
                    <button class="btn btn-teal-gradient text-white px-3 fw-semibold" type="button" onclick="copyShareInputLink()">
                        <i class="bi bi-clipboard me-1"></i> <span id="copyShareBtnText">คัดลอก</span>
                    </button>
                </div>

                <!-- Native Mobile Share Button -->
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 rounded-pill py-2 mt-2" onclick="triggerNativeShare()">
                    <i class="bi bi-share me-1"></i> แชร์ผ่านแอปพลิเคชันอื่นในเครื่อง
                </button>

            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- CUSTOM STYLING & SCRIPT FOR ENDLESS GIVING -->
<!-- ========================================================================= -->
<style>
    .donation-page-wrapper {
        background-color: #f8fafc;
    }
    .donation-hero-section {
        background: linear-gradient(135deg, #042f2e 0%, #0d9488 50%, #0284c7 100%);
        box-shadow: inset 0 -20px 40px rgba(0,0,0,0.18);
    }
    .donation-hero-bg-shapes {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(circle at 15% 20%, rgba(255,255,255,0.08) 0%, transparent 40%),
                          radial-gradient(circle at 85% 80%, rgba(255,255,255,0.06) 0%, transparent 35%);
        pointer-events: none;
    }
    .infinity-pulse {
        animation: pulseInfinity 2s infinite ease-in-out;
        display: inline-block;
    }
    @keyframes pulseInfinity {
        0% { transform: scale(1); opacity: 0.9; }
        50% { transform: scale(1.18); opacity: 1; filter: drop-shadow(0 0 8px rgba(251, 191, 36, 0.8)); }
        100% { transform: scale(1); opacity: 0.9; }
    }
    .text-gradient-gold {
        background: linear-gradient(90deg, #fbbf24, #fef08a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .infinity-circle-wrap {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f0fdfa, #ccfbf1);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px -5px rgba(13, 148, 136, 0.25);
    }
    .btn-teal-gradient {
        background: linear-gradient(135deg, #0d9488, #0284c7);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-teal-gradient:hover {
        background: linear-gradient(135deg, #0f766e, #0369a1);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px rgba(13, 148, 136, 0.4) !important;
        color: #ffffff;
    }
    .btn-amount-preset {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.25);
        transition: all 0.2s ease;
    }
    .btn-amount-preset:hover, .btn-amount-preset.active {
        background: #ffffff;
        color: #0f766e;
        border-color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    }
    .impact-icon-circle {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .project-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .project-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.12) !important;
    }
    .project-card:hover .project-img {
        transform: scale(1.06);
    }
    .project-img {
        transition: transform 0.4s ease;
    }
    .bg-teal {
        background-color: #0d9488 !important;
    }
    .text-teal {
        color: #0d9488 !important;
    }
    .bg-teal-subtle {
        background-color: #ccfbf1 !important;
    }
    .donor-card {
        transition: transform 0.2s ease;
    }
    .donor-card:hover {
        transform: translateY(-3px);
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .btn-teal-outline-light {
        border: 2px solid rgba(255, 255, 255, 0.7);
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(4px);
        transition: all 0.2s ease;
    }
    .btn-teal-outline-light:hover {
        background: #fff;
        color: #093f35;
    }
    .qr-amount-chip.active {
        background-color: #0d9488 !important;
        color: #fff !important;
        border-color: #0d9488 !important;
    }
    .max-w-300 { max-width: 300px; }
    .max-w-700 { max-width: 700px; }
    .max-w-800 { max-width: 800px; }
</style>

<script>
const BILLER_ID = '0994000164877';
let currentQrAmount = 0;

// TLV Formatter
function tlv(tag, value) {
    const len = value.length.toString().padStart(2, '0');
    return tag + len + value;
}

// CRC16-CCITT for PromptPay QR
function calcCRC16(str) {
    let crc = 0xFFFF;
    for (let i = 0; i < str.length; i++) {
        crc ^= (str.charCodeAt(i) << 8);
        for (let j = 0; j < 8; j++) {
            if ((crc & 0x8000) !== 0) {
                crc = ((crc << 1) ^ 0x1021) & 0xFFFF;
            } else {
                crc = (crc << 1) & 0xFFFF;
            }
        }
    }
    return crc.toString(16).toUpperCase().padStart(4, '0');
}

// Generate Standard PromptPay EMVCo QR String (Tag 29 AnyID)
function generateEDonationQR(amount) {
    const cleanTarget = BILLER_ID.replace(/[^0-9]/g, '');
    let subTag = '';
    if (cleanTarget.length <= 10 && cleanTarget.startsWith('0')) {
        const phone = '0066' + cleanTarget.substring(1);
        subTag = tlv('01', phone);
    } else {
        subTag = tlv('02', cleanTarget);
    }
    
    const tag29Content = tlv('00', 'A000000677010111') + subTag;
    const tag29 = tlv('29', tag29Content);
    const isDynamic = (amount && parseFloat(amount) > 0);
    
    let raw = tlv('00', '01')
            + tlv('01', isDynamic ? '12' : '11')
            + tag29
            + tlv('53', '764'); // THB (Currency Code 764)
            
    if (isDynamic) {
        const formattedAmount = parseFloat(amount).toFixed(2);
        raw += tlv('54', formattedAmount);
    }
    
    raw += tlv('58', 'TH') + '6304';
    return raw + calcCRC16(raw);
}

// Update QR Code visual in real time
function updateQrVisual(amount) {
    currentQrAmount = parseFloat(amount) || 0;
    const qrPayload = generateEDonationQR(currentQrAmount);
    const qrImg = document.getElementById('dynamicQrImage');
    const qrBadge = document.getElementById('qrAmountBadge');
    const downloadBtn = document.getElementById('btnDownloadQr');
    
    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=${encodeURIComponent(qrPayload)}`;
    const downloadUrl = `https://api.qrserver.com/v1/create-qr-code/?size=600x600&data=${encodeURIComponent(qrPayload)}`;
    
    if (qrImg) qrImg.src = qrUrl;
    if (downloadBtn) downloadBtn.href = downloadUrl;
    
    if (qrBadge) {
        if (currentQrAmount > 0) {
            qrBadge.className = 'badge bg-success font-monospace px-3 py-2 rounded-pill fs-6';
            qrBadge.innerHTML = `<i class="bi bi-check-circle-fill me-1"></i> ยอดที่ระบุใน QR: ${currentQrAmount.toLocaleString('th-TH', {minimumFractionDigits: 2})} บาท`;
        } else {
            qrBadge.className = 'badge bg-dark font-monospace px-3 py-2 rounded-pill fs-6';
            qrBadge.innerHTML = `<i class="bi bi-tag-fill text-warning me-1"></i> ยอดใน QR: ระบุยอดเองในแอป`;
        }
    }
}

// Set Preset QR Amount
function setQrAmount(amount) {
    document.querySelectorAll('.qr-amount-chip').forEach(btn => btn.classList.remove('active'));
    const customInput = document.getElementById('customQrAmountInput');
    if (customInput) customInput.value = '';
    
    // Find matching button if any
    const matchingBtn = Array.from(document.querySelectorAll('.qr-amount-chip')).find(btn => {
        return btn.getAttribute('onclick') === `setQrAmount(${amount})`;
    });
    if (matchingBtn) matchingBtn.classList.add('active');
    
    updateQrVisual(amount);
}

// On custom amount input in QR card
function onCustomQrAmountChange(val) {
    document.querySelectorAll('.qr-amount-chip').forEach(btn => btn.classList.remove('active'));
    const amount = parseFloat(val) || 0;
    updateQrVisual(amount);
}

// Open modal with prefilled QR amount
function openDonateWithQrAmount() {
    const modalDonationAmount = document.getElementById('modalDonationAmount');
    if (modalDonationAmount && currentQrAmount > 0) {
        modalDonationAmount.value = currentQrAmount;
    }
    const modal = new bootstrap.Modal(document.getElementById('quickDonateModal'));
    modal.show();
}

document.addEventListener('DOMContentLoaded', function() {
    // Preset Amount Selector Logic
    const presetButtons = document.querySelectorAll('.btn-amount-preset');
    const selectedAmountDisplay = document.getElementById('selectedAmountDisplay');
    const selectedImpactText = document.getElementById('selectedImpactText');
    const modalDonationAmount = document.getElementById('modalDonationAmount');
    const btnPresetAmountLabel = document.getElementById('btnPresetAmountLabel');

    let currentSelectedAmount = 100;

    presetButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            presetButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const amount = this.getAttribute('data-amount');
            const impact = this.getAttribute('data-impact');
            currentSelectedAmount = amount;

            if (selectedAmountDisplay) selectedAmountDisplay.innerText = `${parseInt(amount).toLocaleString()} บาท`;
            if (selectedImpactText) selectedImpactText.innerText = impact;
            if (modalDonationAmount) modalDonationAmount.value = amount;
            if (btnPresetAmountLabel) btnPresetAmountLabel.innerText = `${parseInt(amount).toLocaleString()} บาท`;
        });
    });

    // Preset donate button click
    const btnDonateThisPreset = document.getElementById('btnDonateThisPreset');
    if (btnDonateThisPreset) {
        btnDonateThisPreset.addEventListener('click', function() {
            if (modalDonationAmount) modalDonationAmount.value = currentSelectedAmount;
        });
    }

    // Initialize Default Static QR
    updateQrVisual(0);
});

function openDonateForProject(itemId, itemTitle) {
    const modalSelect = document.getElementById('modalDonationItemId');
    if (modalSelect) {
        modalSelect.value = itemId;
    }
    const modal = new bootstrap.Modal(document.getElementById('quickDonateModal'));
    modal.show();
}

let activeShareTitle = '';
let activeShareUrl = '';

function openShareModal(title, url) {
    activeShareTitle = title || 'แคมเปญการให้ไม่มีสิ้นสุด โรงพยาบาลปลวกแดง';
    activeShareUrl = url || window.location.href;

    const titleEl = document.getElementById('shareModalItemTitle');
    const inputEl = document.getElementById('shareLinkInput');
    const qrEl = document.getElementById('shareLinkQrImg');
    const fbBtn = document.getElementById('shareFbBtn');
    const lineBtn = document.getElementById('shareLineBtn');
    const twBtn = document.getElementById('shareTwBtn');

    if (titleEl) titleEl.innerText = activeShareTitle;
    if (inputEl) inputEl.value = activeShareUrl;
    if (qrEl) qrEl.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(activeShareUrl)}`;

    if (fbBtn) fbBtn.href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(activeShareUrl)}`;
    if (lineBtn) lineBtn.href = `https://social-plugins.line.me/lineit/share?url=${encodeURIComponent(activeShareUrl)}&text=${encodeURIComponent('ขอเชิญร่วมบริจาค ' + activeShareTitle)}`;
    if (twBtn) twBtn.href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(activeShareUrl)}&text=${encodeURIComponent('ขอเชิญร่วมบริจาค ' + activeShareTitle + ' e-Donation ลดหย่อนภาษีได้ 2 เท่า')}`;

    const shareModal = new bootstrap.Modal(document.getElementById('shareCampaignModal'));
    shareModal.show();
}

function copyShareInputLink() {
    const input = document.getElementById('shareLinkInput');
    if (input && navigator.clipboard) {
        navigator.clipboard.writeText(input.value).then(() => {
            const btnText = document.getElementById('copyShareBtnText');
            if (btnText) {
                btnText.innerText = 'คัดลอกแล้ว!';
                setTimeout(() => { btnText.innerText = 'คัดลอก'; }, 2000);
            }
        });
    }
}

function triggerNativeShare() {
    if (navigator.share) {
        navigator.share({
            title: activeShareTitle,
            text: 'ขอเชิญร่วมบริจาค ' + activeShareTitle + ' โรงพยาบาลปลวกแดง ลดหย่อนภาษีได้ 2 เท่าผ่านระบบ e-Donation',
            url: activeShareUrl
        }).catch(() => {});
    } else {
        copyShareInputLink();
    }
}
</script>
