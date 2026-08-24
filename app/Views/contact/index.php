<div class="contact-page-wrapper">
    <!-- Breadcrumb & Hero Header -->
    <section class="contact-hero-section py-4 py-md-5 position-relative overflow-hidden">
        <div class="container position-relative" style="z-index: 2;">
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= URLROOT ?>" class="text-white-50 text-decoration-none"><i class="bi bi-house-door me-1"></i> หน้าแรก</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">ติดต่อเรา</li>
                </ol>
            </nav>

            <div class="row align-items-center justify-content-between">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-15 text-white border border-white border-opacity-25 mb-3 shadow-sm">
                        <i class="bi bi-geo-alt-fill text-warning"></i>
                        <span class="small fw-semibold">Pluak Daeng Hospital Contact Center</span>
                    </div>
                    <h1 class="display-6 fw-bold text-white mb-2">
                        ติดต่อเรา
                    </h1>
                    <p class="text-white-50 fs-5 mb-0">
                        โรงพยาบาลปลวกแดง พร้อมให้บริการและอำนวยความสะดวกแก่ประชาชนและผู้รับบริการทุกท่าน
                    </p>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0 text-lg-end">
                    <div class="p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-20 d-inline-block text-start text-white shadow-lg">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-danger bg-opacity-25 p-3 text-danger">
                                <i class="bi bi-telephone-fill text-danger fs-2"></i>
                            </div>
                            <div>
                                <div class="text-uppercase small text-white-50">สายด่วนฉุกเฉิน 24 ชั่วโมง</div>
                                <a href="tel:1669" class="fs-4 fw-bold text-white text-decoration-none d-block">โทร 1669</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-hero-bg-shapes"></div>
    </section>

    <!-- Main Container -->
    <div class="container py-5">
        
        <!-- Contact Cards Row -->
        <div class="row g-4 mb-5">
            
            <!-- Location & Address Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 contact-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="contact-icon-bubble bg-teal-subtle text-teal">
                            <i class="bi bi-geo-alt-fill fs-3"></i>
                        </div>
                        <div>
                            <h2 class="h5 fw-bold text-dark mb-0">ที่ตั้งหน่วยงาน</h2>
                            <small class="text-muted">Hospital Location</small>
                        </div>
                    </div>
                    <p class="text-secondary mb-2 lh-base">
                        <strong>272 หมู่ 1</strong> ถนนเทศบาล 8 ต.ปลวกแดง อ.ปลวกแดง จ.ระยอง 21140
                    </p>
                    <div class="mb-3 p-2 bg-light rounded-3 small">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted"><i class="bi bi-geo-fill text-danger me-1"></i> พิกัด GPS:</span>
                            <span class="font-monospace fw-bold text-dark">12.969940, 101.218922</span>
                        </div>
                        <div class="text-muted text-end" style="font-size: 0.78rem;">
                            ความสูงจากระดับน้ำทะเล 57 ม.
                        </div>
                    </div>
                    <div class="mt-auto d-flex flex-wrap gap-2 pt-2 border-top">
                        <a href="https://www.google.com/maps?q=12.969940,101.218922" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="bi bi-map me-1"></i> ดูบน Google Maps
                        </a>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3" onclick="copyToClipboard('12.969940, 101.218922', 'คัดลอกพิกัด GPS เรียบร้อยแล้ว')">
                            <i class="bi bi-clipboard me-1"></i> คัดลอกพิกัด GPS
                        </button>
                    </div>
                </div>
            </div>

            <!-- Direct Phone Lines Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 contact-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="contact-icon-bubble bg-primary-subtle text-primary">
                            <i class="bi bi-telephone-outbound-fill fs-3"></i>
                        </div>
                        <div>
                            <h2 class="h5 fw-bold text-dark mb-0">หมายเลขโทรศัพท์หลัก</h2>
                            <small class="text-muted">Direct Phone Lines</small>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2 mb-3">
                        <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                            <span class="small fw-semibold text-dark"><i class="bi bi-hospital text-primary me-1"></i> เบอร์โรงพยาบาล:</span>
                            <a href="tel:033650413" class="fw-bold text-primary text-decoration-none">033-650-413</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                            <span class="small fw-semibold text-dark"><i class="bi bi-briefcase text-secondary me-1"></i> กลุ่มงานบริหารฯ / Fax:</span>
                            <a href="tel:033650412" class="fw-bold text-dark text-decoration-none">033-650-412</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                            <span class="small fw-semibold text-dark"><i class="bi bi-shield-check text-success me-1"></i> กลุ่มงานประกันฯ / Fax:</span>
                            <a href="tel:033650405" class="fw-bold text-dark text-decoration-none">033-650-405</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                            <span class="small fw-semibold text-dark"><i class="bi bi-bandaid text-info me-1"></i> กลุ่มงานทันตกรรม:</span>
                            <a href="tel:033650406" class="fw-bold text-dark text-decoration-none">033-650-406</a>
                        </div>
                    </div>
                    <div class="mt-auto pt-2 border-top small text-muted">
                        <i class="bi bi-clock me-1"></i> บริการในวันและเวลาราชการ (ฉุกเฉินตลอด 24 ชม.)
                    </div>
                </div>
            </div>

            <!-- Online & Digital Channels Card -->
            <div class="col-lg-4 col-md-12">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 contact-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="contact-icon-bubble bg-info-subtle text-info">
                            <i class="bi bi-globe2 fs-3"></i>
                        </div>
                        <div>
                            <h2 class="h5 fw-bold text-dark mb-0">ช่องทางออนไลน์ & อีเมล</h2>
                            <small class="text-muted">Digital & Email Channels</small>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2 mb-3">
                        <div class="p-2 rounded-3 bg-light">
                            <div class="small text-muted mb-1"><i class="bi bi-envelope-fill text-danger me-1"></i> อีเมลทางการ:</div>
                            <a href="mailto:pluakdaenghp.102@gmail.com" class="fw-bold text-dark text-break text-decoration-none">pluakdaenghp.102@gmail.com</a>
                        </div>
                        <div class="p-2 rounded-3 bg-light">
                            <div class="small text-muted mb-1"><i class="bi bi-browser-chrome text-primary me-1"></i> เว็บไซต์หลัก:</div>
                            <a href="http://www.pluakdaenghospital.moph.go.th/" target="_blank" rel="noopener noreferrer" class="fw-bold text-primary text-break text-decoration-none">www.pluakdaenghospital.moph.go.th</a>
                        </div>
                        <div class="d-flex gap-2 mt-1">
                            <a href="https://page.line.me/pluakdaenghos" target="_blank" class="btn btn-sm btn-outline-success rounded-pill flex-fill"><i class="bi bi-line me-1"></i> LINE OA</a>
                            <a href="https://www.facebook.com/pluakdaenghospital" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill flex-fill"><i class="bi bi-facebook me-1"></i> Facebook</a>
                        </div>
                    </div>
                    <div class="mt-auto pt-2 border-top">
                        <a href="<?= URLROOT ?>/complaint" class="btn btn-outline-dark btn-sm rounded-pill w-100">
                            <i class="bi bi-chat-heart me-1"></i> ระบบรับฟังความคิดเห็น/ร้องเรียน
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- ========================================================================= -->
        <!-- เบอร์ติดต่อภายใน (Internal Extension Numbers) -->
        <!-- ========================================================================= -->
        <section class="internal-extensions-section mb-5" id="extensionsSection">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-navy p-4 text-white">
                    <div class="row align-items-center justify-content-between g-3">
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 bg-white bg-opacity-15 p-2 px-3 fs-3">
                                    <i class="bi bi-telephone-forward-fill text-warning"></i>
                                </div>
                                <div>
                                    <h2 class="h4 mb-0 fw-bold text-white">เบอร์ติดต่อภายใน (Internal Extensions)</h2>
                                    <small class="text-white-50">กดเบอร์โรงพยาบาล <strong>033-650-413</strong> แล้วกดหมายเลขต่อภายในที่ต้องการ</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Extension Search Input -->
                            <div class="ext-search-box p-1 px-3 bg-white rounded-pill d-flex align-items-center gap-2 shadow-sm">
                                <i class="bi bi-search text-muted fs-6"></i>
                                <input type="text" id="extSearchInput" class="form-control border-0 shadow-none bg-transparent form-control-sm py-2" placeholder="ค้นหาแผนก, ห้องตรวจ, หรือเลขเบอร์ต่อ เช่น 101, ฉุกเฉิน, ทันตกรรม, LAB...">
                                <button type="button" id="clearExtSearch" class="btn btn-sm btn-light rounded-circle d-none" title="ล้างการค้นหา">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Filter Tabs -->
                <div class="card-body p-3 p-md-4 border-bottom bg-light">
                    <div class="d-flex flex-wrap align-items-center gap-2" id="extCategoryFilter">
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 active" data-cat="all">ทั้งหมด (31 หมายเลข)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-cat="admin">บริหาร & ธุรการ & การเงิน</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-cat="opd">ห้องตรวจ & บริการผู้ป่วยนอก (OPD)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-cat="emergency">ฉุกเฉิน & ผู้ป่วยใน & วิกฤต (ER/IPD/ICU)</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-cat="support">สนับสนุนบริการ & สุขภาพชุมชน</button>
                    </div>
                </div>

                <!-- Extensions Table / Grid View -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle" id="extensionsTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%" class="ps-4">เบอร์ต่อภายใน</th>
                                    <th width="50%">ชื่อหน่วยงาน / ห้องปฏิบัติงาน</th>
                                    <th width="20%">หมวดหมู่งาน</th>
                                    <th width="15%" class="text-center pe-4">การทำงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- 101 -->
                                <tr class="ext-item" data-cat="admin" data-keywords="101 บริหาร การเงิน บัญชี การเงินและบัญชี">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">101</span></td>
                                    <td><div class="fw-bold text-dark">บริหาร (การเงินฯ)</div><div class="small text-muted">กลุ่มงานบริหารทั่วไป งานการเงินและบัญชี</div></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary border">บริหาร & การเงิน</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('101', 'คัดลอกเบอร์ต่อ 101 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 102 -->
                                <tr class="ext-item" data-cat="admin" data-keywords="102 บริหาร ธุรการ สารบรรณ เอกสาร">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">102</span></td>
                                    <td><div class="fw-bold text-dark">บริหาร (ธุรการ)</div><div class="small text-muted">งานสารบรรณ ธุรการ และรับ-ส่งเอกสารราชการ</div></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary border">บริหาร & การเงิน</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('102', 'คัดลอกเบอร์ต่อ 102 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 103 -->
                                <tr class="ext-item" data-cat="support" data-keywords="103 โภชนาการ ic ควบคุมการติดเชื้อ อาหารผู้ป่วย">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">103</span></td>
                                    <td><div class="fw-bold text-dark">โภชนาการ / IC</div><div class="small text-muted">งานโภชนาการ และงานควบคุมและป้องกันการติดเชื้อในโรงพยาบาล</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('103', 'คัดลอกเบอร์ต่อ 103 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 105 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="105 ห้องบัตร ประชาสัมพันธ์ ทำบัตร ลงทะเบียน opd">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">105</span></td>
                                    <td><div class="fw-bold text-dark">ห้องบัตร / ประชาสัมพันธ์</div><div class="small text-muted">เวชระเบียน ลงทะเบียนผู้ป่วย และประชาสัมพันธ์ข้อมูลบริการ</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('105', 'คัดลอกเบอร์ต่อ 105 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 106 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="106 คัดกรอง ห้องตรวจโรค ซักประวัติ วัดความดัน">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">106</span></td>
                                    <td><div class="fw-bold text-dark">คัดกรอง / ห้องตรวจโรค</div><div class="small text-muted">จุดคัดกรองสัญญาณชีพ ซักประวัติ และห้องตรวจโรคทั่วไป</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('106', 'คัดลอกเบอร์ต่อ 106 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 107 -->
                                <tr class="ext-item" data-cat="support" data-keywords="107 ห้องชันสูตร lab แล็บ เจาะเลือด ตรวจเลือด ตรวจปัสสาวะ">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">107</span></td>
                                    <td><div class="fw-bold text-dark">ห้องชันสูตร LAB</div><div class="small text-muted">กลุ่มงานเทคนิคการแพทย์ บริการตรวจวิเคราะห์ทางห้องปฏิบัติการ</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('107', 'คัดลอกเบอร์ต่อ 107 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 109 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="109 ห้องจ่ายยา เภสัชกรรม ยา รับยา">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">109</span></td>
                                    <td><div class="fw-bold text-dark">ห้องจ่ายยา</div><div class="small text-muted">กลุ่มงานเภสัชกรรมและคุ้มครองผู้บริโภค (ห้องจ่ายยาผู้ป่วยนอก)</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('109', 'คัดลอกเบอร์ต่อ 109 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 110 -->
                                <tr class="ext-item" data-cat="emergency" data-keywords="110 ห้องฉุกเฉิน er อุบัติเหตุ ฉุกเฉิน救急 24ชม">
                                    <td class="ps-4"><span class="badge bg-danger px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">110</span></td>
                                    <td><div class="fw-bold text-danger">ห้องฉุกเฉิน ER</div><div class="small text-muted">กลุ่มงานอุบัติเหตุและฉุกเฉิน บริการช่วยเหลือผู้ป่วยฉุกเฉิน 24 ชม.</div></td>
                                    <td><span class="badge bg-danger-subtle text-danger border">ฉุกเฉิน & วิกฤต</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2" onclick="copyToClipboard('110', 'คัดลอกเบอร์ต่อห้องฉุกเฉิน 110 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 111 -->
                                <tr class="ext-item" data-cat="emergency" data-keywords="111 ห้องคลอด คลอด ทำคลอด ทารกแรกเกิด">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">111</span></td>
                                    <td><div class="fw-bold text-dark">ห้องคลอด</div><div class="small text-muted">บริการดูแลการคลอดบุตรและทารกแรกเกิด</div></td>
                                    <td><span class="badge bg-danger-subtle text-danger border">ฉุกเฉิน & ผู้ป่วยใน</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('111', 'คัดลอกเบอร์ต่อ 111 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 112 -->
                                <tr class="ext-item" data-cat="admin" data-keywords="112 ห้องศูนย์ประกัน สิทธิ์ บัตรทอง ประกันสังคม ข้าราชการ พรบ">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">112</span></td>
                                    <td><div class="fw-bold text-dark">ห้องศูนย์ประกันฯ</div><div class="small text-muted">งานประกันสุขภาพ ตรวจสอบสิทธิ บัตรทอง ประกันสังคม และ พ.ร.บ.</div></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary border">บริหาร & ประกัน</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('112', 'คัดลอกเบอร์ต่อ 112 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 113 -->
                                <tr class="ext-item" data-cat="support" data-keywords="113 ห้องเอกซเรย์ xray รังสีวิทยา ฟิล์ม">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">113</span></td>
                                    <td><div class="fw-bold text-dark">ห้องเอกซเรย์</div><div class="small text-muted">กลุ่มงานรังสีวิทยา บริการตรวจทางรังสีเอกซเรย์</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('113', 'คัดลอกเบอร์ต่อ 113 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 115 -->
                                <tr class="ext-item" data-cat="support" data-keywords="115 ห้องสุขภาพจิต จิตเวช จิตวิทยา ซึมเศร้า ปรึกษา">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">115</span></td>
                                    <td><div class="fw-bold text-dark">ห้องสุขภาพจิต</div><div class="small text-muted">บริการให้คำปรึกษาและดูแลผู้มีปัญหาสุขภาพจิตและจิตเวช</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('115', 'คัดลอกเบอร์ต่อ 115 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 116 -->
                                <tr class="ext-item" data-cat="support" data-keywords="116 งานยาเสพติด สุรา บุหรี่ บำบัด เลิกบุหรี่">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">116</span></td>
                                    <td><div class="fw-bold text-dark">งานยาเสพติด สุรา บุหรี่</div><div class="small text-muted">คลินิกบำบัดรักษาและฟื้นฟูผู้ติดยาเสพติด สุรา และบุหรี่</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('116', 'คัดลอกเบอร์ต่อ 116 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 118 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="118 แพทย์แผนไทย นวด ประคบ สมุนไพร ฝังเข็ม">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">118</span></td>
                                    <td><div class="fw-bold text-dark">แพทย์แผนไทย</div><div class="small text-muted">บริการตรวจรักษาด้วยการแพทย์แผนไทยและการแพทย์ทางเลือก นวดประคบสมุนไพร</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('118', 'คัดลอกเบอร์ต่อ 118 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 119 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="119 ห้องเบาหวาน ncd ความดัน ไตเรื้อรัง โรคไม่ติดต่อ">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">119</span></td>
                                    <td><div class="fw-bold text-dark">ห้องเบาหวาน</div><div class="small text-muted">คลินิกโรคไม่ติดต่อเรื้อรัง (NCDs) เบาหวาน ความดันโลหิตสูง</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('119', 'คัดลอกเบอร์ต่อ 119 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 120 -->
                                <tr class="ext-item" data-cat="emergency" data-keywords="120 ห้องผู้ป่วยใน ipd ตึกผู้ป่วยใน นอนรพ">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">120</span></td>
                                    <td><div class="fw-bold text-dark">ห้องผู้ป่วยใน IPD</div><div class="small text-muted">หอผู้ป่วยใน บริการดูแลรักษาผู้ป่วยที่ต้องพักรักษาตัวในโรงพยาบาล</div></td>
                                    <td><span class="badge bg-danger-subtle text-danger border">ผู้ป่วยใน IPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('120', 'คัดลอกเบอร์ต่อ 120 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 137 -->
                                <tr class="ext-item" data-cat="support" data-keywords="137 เวรเปล เข็นเปล รถเข็น เคลื่อนย้ายผู้ป่วย">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">137</span></td>
                                    <td><div class="fw-bold text-dark">เวรเปล</div><div class="small text-muted">หน่วยบริการเคลื่อนย้ายผู้ป่วยและบริการรถเข็น/เตียงนอน</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('137', 'คัดลอกเบอร์ต่อ 137 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 138 -->
                                <tr class="ext-item" data-cat="support" data-keywords="138 ห้องหลังหลอด จ่ายกลาง เครื่องมือแพทย์ สเตอไรด์">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">138</span></td>
                                    <td><div class="fw-bold text-dark">ห้องหลังหลอด</div><div class="small text-muted">หน่วยงานสนับสนุนบริการทางการแพทย์</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('138', 'คัดลอกเบอร์ต่อ 138 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 139 -->
                                <tr class="ext-item" data-cat="support" data-keywords="139 ห้องศูนย์ชีวิตใหม่ ชีวิตใหม่ ฟื้นฟู">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">139</span></td>
                                    <td><div class="fw-bold text-dark">ห้องศูนย์ชีวิตใหม่</div><div class="small text-muted">บริการดูแลและฟื้นฟูสุขภาวะชุมชน</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('139', 'คัดลอกเบอร์ต่อ 139 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 140 -->
                                <tr class="ext-item" data-cat="support" data-keywords="140 ห้องแสงตะวัน แสงตะวัน">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">140</span></td>
                                    <td><div class="fw-bold text-dark">ห้องแสงตะวัน</div><div class="small text-muted">หน่วยบริการให้คำปรึกษาและดูแลต่อเนื่อง</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('140', 'คัดลอกเบอร์ต่อ 140 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 141 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="141 admit center ศูนย์รับผู้ป่วยใน ครองเตียง ส่งต่อนอนรพ">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">141</span></td>
                                    <td><div class="fw-bold text-dark">Admit Center</div><div class="small text-muted">ศูนย์บริหารจัดการเตียงและประสานการรับผู้ป่วยไว้รักษาในโรงพยาบาล</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('141', 'คัดลอกเบอร์ต่อ 141 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 150 -->
                                <tr class="ext-item" data-cat="support" data-keywords="150 ossc oscc ศูนย์พึ่งได้ ความรุนแรง คุ้มครองเด็กสตรี">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">150</span></td>
                                    <td><div class="fw-bold text-dark">OSCC (ศูนย์พึ่งได้)</div><div class="small text-muted">ศูนย์ช่วยเหลือเด็ก สตรี และผู้ถูกกระทำด้วยความรุนแรงในครอบครัว (One Stop Crisis Center)</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('150', 'คัดลอกเบอร์ต่อ 150 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 151 -->
                                <tr class="ext-item" data-cat="emergency" data-keywords="151 ห้อง icu วิกฤต ไอซียู ผู้ป่วยหนัก">
                                    <td class="ps-4"><span class="badge bg-danger px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">151</span></td>
                                    <td><div class="fw-bold text-danger">ห้อง ICU</div><div class="small text-muted">หอผู้ป่วยหนัก (Intensive Care Unit) การดูแลรักษาผู้ป่วยวิกฤตตลอด 24 ชม.</div></td>
                                    <td><span class="badge bg-danger-subtle text-danger border">ฉุกเฉิน & วิกฤต</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2" onclick="copyToClipboard('151', 'คัดลอกเบอร์ต่อ 151 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 190 -->
                                <tr class="ext-item" data-cat="admin" data-keywords="190 ห้องเก็บเงิน การเงิน ชำระเงิน ใบเสร็จ">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">190</span></td>
                                    <td><div class="fw-bold text-dark">ห้องเก็บเงิน</div><div class="small text-muted">จุดรับชำระเงินค่ารักษาพยาบาลและออกใบเสร็จรับเงิน</div></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary border">บริหาร & การเงิน</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('190', 'คัดลอกเบอร์ต่อ 190 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 199 -->
                                <tr class="ext-item" data-cat="emergency" data-keywords="199 ห้องฉุกเฉิน er กู้ชีพ อุบัติเหตุ">
                                    <td class="ps-4"><span class="badge bg-danger px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">199</span></td>
                                    <td><div class="fw-bold text-danger">ห้องฉุกเฉิน ER (จุดประสานงาน/กู้ชีพ)</div><div class="small text-muted">ศูนย์ประสานงานอุบัติเหตุและส่งต่อผู้ป่วยฉุกเฉิน</div></td>
                                    <td><span class="badge bg-danger-subtle text-danger border">ฉุกเฉิน & วิกฤต</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2" onclick="copyToClipboard('199', 'คัดลอกเบอร์ต่อ 199 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 218 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="218 ห้องกายภาพ กายภาพบำบัด ฟื้นฟูสมรรถภาพ">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">218</span></td>
                                    <td><div class="fw-bold text-dark">ห้องกายภาพ</div><div class="small text-muted">กลุ่มงานกายภาพบำบัดและฟื้นฟูสมรรถภาพทางการแพทย์</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('218', 'คัดลอกเบอร์ต่อ 218 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 221 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="221 ห้องทันตกรรม ฟัน อุดฟัน ถอนฟัน ขูดหินปูน หมอฟัน">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">221</span></td>
                                    <td><div class="fw-bold text-dark">ห้องทันตกรรม</div><div class="small text-muted">กลุ่มงานทันตกรรม บริการตรวจรักษาฟัน ขูดหินปูน อุดฟัน ถอนฟัน ผ่าฟันคุด</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('221', 'คัดลอกเบอร์ต่อ 221 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 231 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="231 ห้องฝากครรภ์ anc ตั้งครรภ์ ฝากท้อง แม่และเด็ก">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">231</span></td>
                                    <td><div class="fw-bold text-dark">ห้องฝากครรภ์ ANC</div><div class="small text-muted">คลินิกฝากครรภ์และอนามัยแม่และเด็ก (Antenatal Care)</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('231', 'คัดลอกเบอร์ต่อ 231 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 233 -->
                                <tr class="ext-item" data-cat="support" data-keywords="233 บริการด้านปฐมภูมิและองค์รวม ชุมชน ปฐมภูมิ สุขภาพชุมชน">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">233</span></td>
                                    <td><div class="fw-bold text-dark">บริการด้านปฐมภูมิและองค์รวม</div><div class="small text-muted">กลุ่มงานบริการด้านปฐมภูมิและองค์รวม บริการสุขภาพระดับชุมชน</div></td>
                                    <td><span class="badge bg-info-subtle text-info-emphasis border">สนับสนุนบริการ</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('233', 'คัดลอกเบอร์ต่อ 233 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 234 -->
                                <tr class="ext-item" data-cat="opd" data-keywords="234 เวชปฏิบัติครอบครัว หมอครอบครัว หมอประจำบ้าน">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">234</span></td>
                                    <td><div class="fw-bold text-dark">เวชปฏิบัติครอบครัว</div><div class="small text-muted">คลินิกหมอครอบครัวและการดูแลสุขภาพแบบองค์รวม</div></td>
                                    <td><span class="badge bg-primary-subtle text-primary border">ห้องตรวจ & OPD</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('234', 'คัดลอกเบอร์ต่อ 234 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                                <!-- 242 -->
                                <tr class="ext-item" data-cat="admin" data-keywords="242 เลขาหน้าห้องผู้อำนวยการ ผอ ผู้อำนวยการ นัดหมายผอ">
                                    <td class="ps-4"><span class="badge bg-primary px-3 py-2 fs-6 rounded-pill fw-bold font-monospace">242</span></td>
                                    <td><div class="fw-bold text-dark">เลขาหน้าห้องผู้อำนวยการ</div><div class="small text-muted">งานประสานงานและนัดหมายผู้อำนวยการโรงพยาบาลปลวกแดง</div></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary border">บริหาร & การเงิน</span></td>
                                    <td class="text-center pe-4"><button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="copyToClipboard('242', 'คัดลอกเบอร์ต่อ 242 แล้ว')"><i class="bi bi-clipboard me-1"></i> คัดลอก</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- No Results Notice -->
                    <div id="noExtResults" class="text-center py-5 text-muted d-none">
                        <i class="bi bi-telephone-x fs-1 text-secondary mb-2 d-block"></i>
                        <h4 class="h6 fw-bold">ไม่พบเบอร์ต่อภายในที่ตรงกับคำค้นหา</h4>
                        <p class="small mb-0">กรุณาลองค้นหาด้วยคำอื่น หรือกดเบอร์กลาง 033-650-413 เพื่อติดต่อเจ้าหน้าที่ประชาสัมพันธ์</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- Smart GPS Navigation Hub (ระบบนำทางอัจฉริยะสู่ รพ.ปลวกแดง) -->
        <!-- ========================================================================= -->
        <section class="smart-navigation-section mb-5" id="smartNavigation">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background: linear-gradient(145deg, #093f35 0%, #0d9488 60%, #0369a1 100%);">
                <div class="card-body p-4 p-md-5 text-white position-relative">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-7">
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-20 text-white border border-white border-opacity-25 mb-3 shadow-sm">
                                <i class="bi bi-compass-fill text-warning"></i>
                                <span class="small fw-semibold">Smart GPS Navigation System</span>
                            </div>
                            <h2 class="display-6 fw-bold mb-2 text-white">ระบบนำทางสู่โรงพยาบาลปลวกแดง</h2>
                            <p class="text-white-50 fs-5 mb-4">
                                เชื่อมต่อ Google Maps, Apple Maps และ Waze นำทางแบบ Turn-by-Turn สดจากตำแหน่งของคุณ สู่โรงพยาบาลปลวกแดงอย่างแม่นยำ
                            </p>

                            <!-- Live Geolocation & Distance Widget -->
                            <div class="p-3 rounded-4 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-20 mb-4">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-geo-alt-fill text-danger fs-4"></i>
                                        <div>
                                            <div class="fw-bold text-white small" id="geoStatusTitle">ตำแหน่งปัจจุบันของคุณ:</div>
                                            <div class="text-white-50 small font-monospace" id="geoStatusCoords">กดปุ่มเพื่อตรวจจับพิกัดและคำนวณระยะทาง</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm text-nowrap fw-bold text-teal" id="btnDetectLocation">
                                        <i class="bi bi-crosshair me-1"></i> ตรวจจับตำแหน่งของฉัน
                                    </button>
                                </div>

                                <!-- Calculated Distance & ETA Display -->
                                <div id="distanceEtaBlock" class="d-none pt-3 mt-2 border-top border-white border-opacity-15">
                                    <div class="row text-center g-2">
                                        <div class="col-6">
                                            <div class="p-2 rounded-3 bg-white bg-opacity-15">
                                                <div class="small text-white-50">ระยะทางโดยประมาณ</div>
                                                <div class="fs-4 fw-bold text-warning" id="calculatedDistance">- กม.</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-2 rounded-3 bg-white bg-opacity-15">
                                                <div class="small text-white-50">เวลาเดินทางโดยประมาณ</div>
                                                <div class="fs-4 fw-bold text-info" id="calculatedEta">- นาที</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Travel Mode & Quick Destination Selector -->
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <label class="form-label text-white-50 small mb-1 fw-semibold"><i class="bi bi-car-front-fill me-1 text-warning"></i> ยานพาหนะเดินทาง:</label>
                                    <select class="form-select form-select-sm rounded-pill border-0 shadow-sm" id="navTravelMode">
                                        <option value="driving" selected>🚗 รถยนต์ส่วนบุคคล (Driving)</option>
                                        <option value="two-wheeler">🏍️ รถมอเตอร์ไซค์ (Motorcycle)</option>
                                        <option value="transit">🚌 รถโดยสารสาธารณะ (Transit)</option>
                                        <option value="walking">🚶 เดินเท้า (Walking)</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label text-white-50 small mb-1 fw-semibold"><i class="bi bi-pin-map-fill me-1 text-danger"></i> จุดหมายในโรงพยาบาล:</label>
                                    <select class="form-select form-select-sm rounded-pill border-0 shadow-sm" id="navDestinationPoint">
                                        <option value="12.969940,101.218922" selected>🏥 อาคารผู้ป่วยนอก (OPD) / ประตูหน้า</option>
                                        <option value="12.969940,101.218922">🚨 อาคารอุบัติเหตุและฉุกเฉิน (ER 24 ชม.)</option>
                                        <option value="12.970200,101.218500">🅿️ ลานจอดรถผู้รับบริการและญาติ</option>
                                        <option value="12.969800,101.219200">🛌 อาคารผู้ป่วยใน (IPD)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Main Launch Navigation Button -->
                            <div class="d-flex flex-wrap gap-2">
                                <a href="https://www.google.com/maps/dir/?api=1&destination=12.969940,101.218922&travelmode=driving" target="_blank" rel="noopener noreferrer" class="btn btn-warning btn-lg rounded-pill px-4 fw-bold shadow d-inline-flex align-items-center gap-2" id="btnLaunchGoogleMaps">
                                    <i class="bi bi-cursor-fill fs-5"></i>
                                    <span>เปิด Google Maps นำทางทันที</span>
                                </a>
                                <a href="https://maps.apple.com/?daddr=12.969940,101.218922&dirflg=d" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light btn-lg rounded-pill px-3 d-inline-flex align-items-center gap-2" id="btnLaunchAppleMaps" title="สำหรับผู้ใช้อุปกรณ์ Apple (iPhone/iPad/CarPlay)">
                                    <i class="bi bi-apple fs-5"></i>
                                    <span>Apple Maps</span>
                                </a>
                                <a href="https://waze.com/ul?ll=12.969940,101.218922&navigate=yes" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light btn-lg rounded-pill px-3 d-inline-flex align-items-center gap-2" id="btnLaunchWaze" title="นำทางด้วย Waze">
                                    <i class="bi bi-geo-alt fs-5"></i>
                                    <span>Waze</span>
                                </a>
                            </div>

                        </div>

                        <!-- Right Column: QR Code for Mobile Navigation & GPS Summary -->
                        <div class="col-lg-5 text-center">
                            <div class="p-4 rounded-4 bg-white text-dark shadow-lg d-inline-block text-center w-100" style="max-width: 360px;">
                                <div class="fw-bold fs-6 mb-1 text-primary">
                                    <i class="bi bi-qr-code-scan me-1"></i> สแกนเพื่อนำทางบนมือถือ
                                </div>
                                <p class="small text-muted mb-3">
                                    สแกน QR Code ด้วยกล้องสมาร์ทโฟน เพื่อเปิดระบบนำทางบนรถยนต์ / Google Maps ทันที
                                </p>
                                
                                <!-- Dynamic QR Code Image Container -->
                                <div class="p-2 bg-light rounded-3 d-inline-block border mb-3">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https%3A%2F%2Fwww.google.com%2Fmaps%2Fdir%2F%3Fapi%3D1%26destination%3D12.969940%2C101.218922" alt="Google Maps QR Code" class="img-fluid rounded" width="180" height="180" id="navQrCodeImg">
                                </div>

                                <div class="p-2 rounded-3 bg-light text-start small border">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">ละติจูด (Lat):</span>
                                        <span class="fw-bold font-monospace">12.969940</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">ลองจิจูด (Lng):</span>
                                        <span class="fw-bold font-monospace">101.218922</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">ระดับความสูง:</span>
                                        <span class="fw-bold text-success">57 ม. จากระดับน้ำทะเล</span>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill w-100 mt-3" onclick="copyToClipboard('https://www.google.com/maps/dir/?api=1&destination=12.969940,101.218922', 'คัดลอกลิงก์นำทาง Google Maps เรียบร้อยแล้ว')">
                                    <i class="bi bi-link-45deg me-1"></i> คัดลอกลิงก์นำทาง
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- Interactive Google Map Section -->
        <!-- ========================================================================= -->
        <section class="map-section">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-bottom-0">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="contact-icon-bubble bg-danger-subtle text-danger">
                                <i class="bi bi-map-fill fs-3"></i>
                            </div>
                            <div>
                                <h2 class="h5 fw-bold text-dark mb-0">แผนที่และการเดินทาง</h2>
                                <small class="text-muted">พิกัด GPS: <strong class="text-danger">12.969940, 101.218922</strong> (ความสูง 57 ม.)</small>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3 shadow-sm" onclick="copyToClipboard('12.969940, 101.218922', 'คัดลอกพิกัด GPS เรียบร้อยแล้ว')">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> คัดลอกพิกัด GPS
                            </button>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=12.969940,101.218922&travelmode=driving" target="_blank" rel="noopener noreferrer" class="btn btn-danger btn-sm rounded-pill px-4 shadow-sm">
                                <i class="bi bi-cursor-fill me-1"></i> นำทางด้วย Google Maps
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <!-- Google Maps Iframe Embed with exact GPS coordinates -->
                    <div class="ratio ratio-21x9" style="min-height: 420px;">
                        <iframe 
                            src="https://maps.google.com/maps?q=12.969940,101.218922&hl=th&z=17&output=embed" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="แผนที่โรงพยาบาลปลวกแดง พิกัด 12.969940, 101.218922">
                        </iframe>
                    </div>
                </div>
                <div class="card-footer bg-light p-3 px-4 border-0">
                    <div class="row align-items-center small text-muted g-2">
                        <div class="col-md-8">
                            <i class="bi bi-info-circle text-primary me-1"></i>
                            โรงพยาบาลปลวกแดง ตั้งอยู่เลขที่ 272 หมู่ 1 ถนนเทศบาล 8 ตำบลปลวกแดง อำเภอปลวกแดง จังหวัดระยอง 21140 (พิกัด GPS: 12.969940, 101.218922)
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="tel:033650413" class="text-decoration-none fw-semibold text-primary">
                                <i class="bi bi-telephone-fill me-1"></i> โทรสอบถามเส้นทาง: 033-650-413
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<!-- Copy Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div id="copyToast" class="toast align-items-center text-bg-dark border-0 rounded-4 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <span id="toastMessage">คัดลอกข้อมูลเรียบร้อยแล้ว</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Custom CSS for Contact Page -->
<style>
    .contact-page-wrapper {
        background-color: #f8fafc;
    }
    .contact-hero-section {
        background: linear-gradient(135deg, #093f35 0%, #0d9488 50%, #0284c7 100%);
        box-shadow: inset 0 -20px 30px rgba(0,0,0,0.12);
    }
    .contact-hero-bg-shapes {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(circle at 15% 25%, rgba(255,255,255,0.08) 0%, transparent 40%),
                          radial-gradient(circle at 85% 75%, rgba(255,255,255,0.06) 0%, transparent 35%);
        pointer-events: none;
    }
    .contact-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .contact-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 28px -6px rgba(15, 23, 42, 0.08) !important;
    }
    .contact-icon-bubble {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .bg-teal { background-color: #0d9488 !important; }
    .text-teal { color: #0d9488 !important; }
    .bg-teal-subtle { background-color: #ccfbf1 !important; }

    .bg-gradient-navy {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }

    .ext-search-box {
        max-width: 420px;
        margin-left: auto;
    }
</style>

<!-- Interactive Script for Live Extension Search & Copy -->
<script>
function copyToClipboard(text, message) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(showToast).catch(fallbackCopy);
    } else {
        fallbackCopy();
    }

    function fallbackCopy() {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            showToast();
        } catch (err) {
            console.error('Unable to copy', err);
        }
        document.body.removeChild(textArea);
    }

    function showToast() {
        const toastEl = document.getElementById('copyToast');
        const toastMsg = document.getElementById('toastMessage');
        if (toastEl && toastMsg) {
            toastMsg.innerText = message || 'คัดลอกข้อมูลเรียบร้อยแล้ว';
            const toast = new bootstrap.Toast(toastEl, { delay: 2500 });
            toast.show();
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const extSearchInput = document.getElementById('extSearchInput');
    const clearExtBtn = document.getElementById('clearExtSearch');
    const extRows = document.querySelectorAll('.ext-item');
    const noResults = document.getElementById('noExtResults');
    const filterButtons = document.querySelectorAll('#extCategoryFilter button');

    let currentCategory = 'all';

    function filterExtensions() {
        const query = (extSearchInput ? extSearchInput.value : '').trim().toLowerCase();
        let visibleCount = 0;

        extRows.forEach(row => {
            const cat = row.getAttribute('data-cat');
            const keywords = (row.getAttribute('data-keywords') || '').toLowerCase();
            const textContent = row.textContent.toLowerCase();

            const matchCat = (currentCategory === 'all' || cat === currentCategory);
            const matchQuery = (query === '' || keywords.includes(query) || textContent.includes(query));

            if (matchCat && matchQuery) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (noResults) {
            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        }
    }

    if (extSearchInput) {
        extSearchInput.addEventListener('input', function() {
            if (this.value.trim().length > 0) {
                clearExtBtn.classList.remove('d-none');
            } else {
                clearExtBtn.classList.add('d-none');
            }
            filterExtensions();
        });

        clearExtBtn.addEventListener('click', function() {
            extSearchInput.value = '';
            extSearchInput.dispatchEvent(new Event('input'));
            extSearchInput.focus();
        });
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            filterButtons.forEach(b => {
                b.classList.remove('btn-primary', 'active');
                b.classList.add('btn-outline-secondary');
            });
            this.classList.remove('btn-outline-secondary');
            this.classList.add('btn-primary', 'active');

            currentCategory = this.getAttribute('data-cat');
            filterExtensions();
        });
    });

    // =========================================================================
    // SMART GPS NAVIGATION SYSTEM JAVASCRIPT
    // =========================================================================
    const btnDetectLocation = document.getElementById('btnDetectLocation');
    const geoStatusTitle = document.getElementById('geoStatusTitle');
    const geoStatusCoords = document.getElementById('geoStatusCoords');
    const distanceEtaBlock = document.getElementById('distanceEtaBlock');
    const calculatedDistance = document.getElementById('calculatedDistance');
    const calculatedEta = document.getElementById('calculatedEta');
    const navTravelMode = document.getElementById('navTravelMode');
    const navDestinationPoint = document.getElementById('navDestinationPoint');
    const btnLaunchGoogleMaps = document.getElementById('btnLaunchGoogleMaps');
    const btnLaunchAppleMaps = document.getElementById('btnLaunchAppleMaps');
    const btnLaunchWaze = document.getElementById('btnLaunchWaze');
    const navQrCodeImg = document.getElementById('navQrCodeImg');

    let userCoordinates = null; // { lat: number, lng: number }

    // Pluak Daeng Hospital Default Coordinates
    const hospitalLat = 12.969940;
    const hospitalLng = 101.218922;

    // Calculate Distance between 2 coordinates (Haversine formula in KM)
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Earth radius in km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = 
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    // Estimate Travel Time based on mode and distance
    function calculateEstimatedTime(distanceKm, mode) {
        let speedKmh = 45; // default driving speed in mixed traffic
        if (mode === 'two-wheeler') speedKmh = 40;
        else if (mode === 'transit') speedKmh = 25;
        else if (mode === 'walking') speedKmh = 4.5;

        const timeHours = distanceKm / speedKmh;
        const totalMinutes = Math.round(timeHours * 60);

        if (totalMinutes < 60) {
            return `${Math.max(1, totalMinutes)} นาที`;
        } else {
            const hours = Math.floor(totalMinutes / 60);
            const mins = totalMinutes % 60;
            return `${hours} ชม. ${mins > 0 ? mins + ' นาที' : ''}`;
        }
    }

    // Update Navigation URLs
    function updateNavigationLinks() {
        const dest = (navDestinationPoint ? navDestinationPoint.value : `${hospitalLat},${hospitalLng}`);
        const mode = (navTravelMode ? navTravelMode.value : 'driving');

        let googleUrl = '';
        if (userCoordinates) {
            googleUrl = `https://www.google.com/maps/dir/?api=1&origin=${userCoordinates.lat},${userCoordinates.lng}&destination=${dest}&travelmode=${mode}`;
        } else {
            googleUrl = `https://www.google.com/maps/dir/?api=1&destination=${dest}&travelmode=${mode}`;
        }

        if (btnLaunchGoogleMaps) {
            btnLaunchGoogleMaps.href = googleUrl;
        }

        // Apple Maps
        let appleMode = 'd';
        if (mode === 'walking') appleMode = 'w';
        else if (mode === 'transit') appleMode = 'r';
        const appleUrl = `https://maps.apple.com/?daddr=${dest}&dirflg=${appleMode}`;
        if (btnLaunchAppleMaps) {
            btnLaunchAppleMaps.href = appleUrl;
        }

        // Waze
        const wazeUrl = `https://waze.com/ul?ll=${dest}&navigate=yes`;
        if (btnLaunchWaze) {
            btnLaunchWaze.href = wazeUrl;
        }

        // QR Code
        if (navQrCodeImg) {
            navQrCodeImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=${encodeURIComponent(googleUrl)}`;
        }

        // Recalculate ETA if user coordinates are known
        if (userCoordinates) {
            const destParts = dest.split(',');
            const dLat = parseFloat(destParts[0]);
            const dLng = parseFloat(destParts[1]);
            const dist = calculateDistance(userCoordinates.lat, userCoordinates.lng, dLat, dLng);
            
            if (calculatedDistance) calculatedDistance.innerText = `${dist.toFixed(1)} กม.`;
            if (calculatedEta) calculatedEta.innerText = calculateEstimatedTime(dist, mode);
        }
    }

    // Geolocation trigger
    if (btnDetectLocation) {
        btnDetectLocation.addEventListener('click', function() {
            if (!navigator.geolocation) {
                alert('เบราว์เซอร์ของคุณไม่รองรับการตรวจจับตำแหน่ง GPS');
                return;
            }

            btnDetectLocation.disabled = true;
            btnDetectLocation.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> กำลังตรวจจับ...';
            if (geoStatusTitle) geoStatusTitle.innerText = 'กำลังระบุตำแหน่งดาวเทียม GPS...';

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    userCoordinates = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    btnDetectLocation.disabled = false;
                    btnDetectLocation.innerHTML = '<i class="bi bi-check2-circle me-1 text-success"></i> ตรวจจับสำเร็จ';
                    btnDetectLocation.classList.remove('text-teal');
                    btnDetectLocation.classList.add('text-success');

                    if (geoStatusTitle) geoStatusTitle.innerText = '📍 ตรวจพบตำแหน่งปัจจุบันของคุณแล้ว:';
                    if (geoStatusCoords) geoStatusCoords.innerText = `พิกัด ${userCoordinates.lat.toFixed(6)}, ${userCoordinates.lng.toFixed(6)}`;

                    if (distanceEtaBlock) distanceEtaBlock.classList.remove('d-none');

                    updateNavigationLinks();
                },
                function(error) {
                    btnDetectLocation.disabled = false;
                    btnDetectLocation.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i> ลองใหม่อีกครั้ง';
                    if (geoStatusTitle) geoStatusTitle.innerText = 'ไม่สามารถระบุพิกัดได้';
                    if (geoStatusCoords) geoStatusCoords.innerText = 'กรุณาอนุญาตการเข้าถึง Location ในเบราว์เซอร์ของท่าน';
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        });
    }

    if (navTravelMode) {
        navTravelMode.addEventListener('change', updateNavigationLinks);
    }
    if (navDestinationPoint) {
        navDestinationPoint.addEventListener('change', updateNavigationLinks);
    }
});
</script>
