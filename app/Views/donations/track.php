<div class="donor-tracker-page py-5 bg-light-subtle">
    <div class="container">
        
        <!-- Tracker Header -->
        <div class="text-center max-w-700 mx-auto mb-5">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-teal-subtle text-teal fw-semibold small mb-3">
                <i class="bi bi-shield-check"></i> ระบบติดตามสถานะการบริจาค (Donor Tracker)
            </div>
            <h1 class="display-6 fw-bold text-dark mb-3">ตรวจสอบสถานะการรับเงินบริจาค</h1>
            <p class="text-muted lead fs-6">
                ท่านสามารถกรอก <strong>รหัสติดตาม (Tracking Code)</strong>, <strong>เบอร์โทรศัพท์</strong> หรือ <strong>อีเมล</strong> ที่ใช้ในการแจ้งบริจาคเพื่อตรวจสอบความคืบหน้าได้ทันที
            </p>
        </div>

        <!-- Search Bar Box -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                    <form action="<?= URLROOT ?>/donation/track" method="GET" class="d-flex flex-column flex-sm-row gap-2">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0 text-teal">
                                <i class="bi bi-search fs-5"></i>
                            </span>
                            <input type="text" name="code" class="form-control border-start-0 ps-0" placeholder="กรอกรหัส PDH-DON-..., เบอร์โทร หรืออีเมล" value="<?= htmlspecialchars($keyword ?? '') ?>" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-teal-gradient px-4 py-3 fw-bold text-white rounded-3">
                            ค้นหาข้อมูล
                        </button>
                    </form>
                    <div class="d-flex flex-wrap align-items-center justify-content-between mt-2 pt-2 border-top px-2 text-muted small">
                        <span><i class="bi bi-lightbulb text-warning me-1"></i> ตัวอย่างรหัส: <code>PDH-DON-20260823-D210</code></span>
                        <a href="<?= URLROOT ?>/donations#eDonationSection" class="text-teal text-decoration-none fw-semibold">
                            <i class="bi bi-qr-code me-1"></i> สแกนบริจาคใหม่
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <?php if ($searched): ?>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="h5 fw-bold text-dark mb-0">
                            <i class="bi bi-list-check text-teal me-2"></i> ผลการค้นหาสำหรับ "<?= htmlspecialchars($keyword) ?>"
                        </h4>
                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">
                            พบ <?= count($results) ?> รายการ
                        </span>
                    </div>

                    <?php if (!empty($results)): ?>
                        <div class="d-flex flex-column gap-4">
                            <?php foreach ($results as $item): ?>
                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                                    
                                    <!-- Card Header -->
                                    <div class="p-4 border-bottom bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="badge bg-teal-subtle text-teal font-monospace px-3 py-1 rounded-pill fw-bold">
                                                    <?= htmlspecialchars($item->tracking_code ?? ('#PDH-' . $item->id)) ?>
                                                </span>
                                                <small class="text-muted"><i class="bi bi-clock me-1"></i> <?= date('d/m/Y H:i น.', strtotime($item->created_at)) ?></small>
                                            </div>
                                            <h3 class="h5 fw-bold text-dark mb-0"><?= htmlspecialchars($item->item_title) ?></h3>
                                        </div>
                                        <div>
                                            <?php if ($item->status === 'approved'): ?>
                                                <span class="badge bg-success text-white px-3 py-2 rounded-pill fs-6 fw-bold">
                                                    <i class="bi bi-check-circle-fill me-1"></i> อนุมัติสมบูรณ์แล้ว
                                                </span>
                                            <?php elseif ($item->status === 'rejected'): ?>
                                                <span class="badge bg-danger text-white px-3 py-2 rounded-pill fs-6 fw-bold">
                                                    <i class="bi bi-x-circle-fill me-1"></i> ปฏิเสธ / สลิปไม่ถูกต้อง
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fs-6 fw-bold">
                                                    <i class="bi bi-hourglass-split me-1"></i> รอดำเนินการตรวจสอบ
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="card-body p-4">
                                        
                                        <!-- Step Progress Timeline -->
                                        <div class="step-tracker-wrapper mb-4 py-2">
                                            <div class="step-tracker-track">
                                                <div class="step-tracker-progress" style="width: <?= $item->status === 'approved' ? '100%' : ($item->status === 'rejected' ? '100%' : '50%') ?>; background: <?= $item->status === 'rejected' ? '#ef4444' : '#0d9488' ?>;"></div>
                                            </div>
                                            <div class="row text-center position-relative">
                                                
                                                <!-- Step 1: Submitted -->
                                                <div class="col-4">
                                                    <div class="step-node active">
                                                        <i class="bi bi-cloud-arrow-up-fill"></i>
                                                    </div>
                                                    <div class="step-label fw-bold text-dark small mt-2">1. แจ้งข้อมูล & แนบสลิป</div>
                                                    <div class="step-desc text-muted" style="font-size: 0.75rem;">รับข้อมูลเข้าระบบแล้ว</div>
                                                </div>

                                                <!-- Step 2: Under Review -->
                                                <div class="col-4">
                                                    <div class="step-node <?= in_array($item->status, ['pending', 'approved', 'rejected']) ? 'active' : '' ?>">
                                                        <i class="bi bi-search"></i>
                                                    </div>
                                                    <div class="step-label fw-bold text-dark small mt-2">2. เจ้าหน้าที่ตรวจสอบ</div>
                                                    <div class="step-desc text-muted" style="font-size: 0.75rem;">เทียบยอดกับ บช.กรุงไทย</div>
                                                </div>

                                                <!-- Step 3: Approved / Completed -->
                                                <div class="col-4">
                                                    <div class="step-node <?= $item->status === 'approved' ? 'active success' : ($item->status === 'rejected' ? 'active danger' : '') ?>">
                                                        <i class="bi <?= $item->status === 'approved' ? 'bi-check-lg' : ($item->status === 'rejected' ? 'bi-x-lg' : 'bi-award') ?>"></i>
                                                    </div>
                                                    <div class="step-label fw-bold text-dark small mt-2">
                                                        <?= $item->status === 'rejected' ? '3. ไม่ผ่านการตรวจสอบ' : '3. บันทึกยอดบริจาค' ?>
                                                    </div>
                                                    <div class="step-desc text-muted" style="font-size: 0.75rem;">
                                                        <?= $item->status === 'approved' ? 'เข้าสู่โครงการและ e-Donation' : ($item->status === 'rejected' ? 'มีข้อความแจ้งเตือน' : 'รอการอนุมัติ') ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Details Grid -->
                                        <div class="row g-3 p-3 rounded-4 bg-light mb-3">
                                            <div class="col-sm-6 col-md-4">
                                                <small class="text-muted d-block">ชื่อผู้ร่วมบริจาค:</small>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($item->donor_name) ?></div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <small class="text-muted d-block">ยอดบริจาค / สิ่งของ:</small>
                                                <?php if (!empty($item->amount)): ?>
                                                    <div class="fw-bold text-success font-monospace fs-5"><?= number_format($item->amount, 2) ?> ฿</div>
                                                <?php elseif (!empty($item->quantity)): ?>
                                                    <div class="fw-bold text-primary font-monospace fs-5"><?= number_format($item->quantity) ?> ชิ้น</div>
                                                <?php else: ?>
                                                    <div class="fw-bold text-muted">-</div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <small class="text-muted d-block">เบอร์โทรติดต่อ:</small>
                                                <div class="fw-semibold text-dark font-monospace"><?= htmlspecialchars($item->donor_phone ?: '-') ?></div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <small class="text-muted d-block">อีเมล:</small>
                                                <div class="text-dark small"><?= htmlspecialchars($item->donor_email ?: '-') ?></div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <small class="text-muted d-block">สลิปการโอน:</small>
                                                <?php if (!empty($item->payment_slip_image)): ?>
                                                    <a href="<?= URLROOT ?>/assets/images/slips/<?= htmlspecialchars($item->payment_slip_image) ?>" target="_blank" class="btn btn-sm btn-outline-teal rounded-pill px-3 mt-1">
                                                        <i class="bi bi-image me-1"></i> ดูภาพสลิปที่แนบ
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted small">ไม่ได้แนบสลิป</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <small class="text-muted d-block">สิทธิลดหย่อนภาษี:</small>
                                                <a href="https://epayapp.rd.go.th/rd-edonation/portal/for-donation-unit" target="_blank" class="badge bg-primary-subtle text-primary mt-1 text-decoration-none" title="ตรวจสอบในระบบ e-Donation กรมสรรพากร">
                                                    <i class="bi bi-patch-check-fill me-1 text-success"></i> e-Donation ลดหย่อน 2 เท่า <i class="bi bi-box-arrow-up-right" style="font-size: 0.65rem;"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Admin Response/Note if any -->
                                        <?php if (!empty($item->admin_note)): ?>
                                            <div class="p-3 rounded-3 <?= $item->status === 'rejected' ? 'bg-danger-subtle border border-danger-subtle text-danger-emphasis' : 'bg-primary-subtle border border-primary-subtle text-primary-emphasis' ?>">
                                                <div class="fw-bold small mb-1">
                                                    <i class="bi bi-chat-left-dots-fill me-1"></i> ข้อความจากเจ้าหน้าที่การเงิน:
                                                </div>
                                                <div class="small"><?= nl2br(htmlspecialchars($item->admin_note)) ?></div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="card border-0 shadow-sm rounded-4 text-center p-5 bg-white">
                            <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle p-4 mb-3 mx-auto" style="width: 80px; height: 80px;">
                                <i class="bi bi-search fs-2"></i>
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-2">ไม่พบข้อมูลการบริจาคตามคำค้นหา</h4>
                            <p class="text-muted small max-w-500 mx-auto mb-4">
                                กรุณาตรวจสอบรหัสติดตาม (Tracking Code), เบอร์โทรศัพท์ หรืออีเมลอีกครั้ง หรือหากเพิ่งทำรายการ กรุณารอสักครู่แล้วค้นหาใหม่อีกครั้ง
                            </p>
                            <div>
                                <a href="<?= URLROOT ?>/donation/track" class="btn btn-outline-secondary rounded-pill px-4">
                                    ล้างการค้นหา
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php else: ?>
            <!-- Default Info Cards & Help Guide -->
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center">
                                <div class="contact-icon-bubble bg-teal-subtle text-teal mx-auto mb-3">
                                    <i class="bi bi-qr-code-scan fs-3"></i>
                                </div>
                                <h5 class="fw-bold text-dark h6 mb-2">1. สแกนโอนเงิน</h5>
                                <p class="text-muted small mb-0">
                                    สแกน e-Donation QR Code หรือโอนเข้าบัญชีธนาคารกรุงไทย 671-9-87195-1
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center">
                                <div class="contact-icon-bubble bg-teal-subtle text-teal mx-auto mb-3">
                                    <i class="bi bi-receipt fs-3"></i>
                                </div>
                                <h5 class="fw-bold text-dark h6 mb-2">2. แนบสลิปรับรหัส</h5>
                                <p class="text-muted small mb-0">
                                    กรอกแบบฟอร์มแจ้งสลิปในเว็บไซต์ จะได้รับรหัสติดตาม เช่น <code>PDH-DON-...</code>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center">
                                <div class="contact-icon-bubble bg-teal-subtle text-teal mx-auto mb-3">
                                    <i class="bi bi-patch-check fs-3"></i>
                                </div>
                                <h5 class="fw-bold text-dark h6 mb-2">3. ติดตามสถานะได้ 24 ชม.</h5>
                                <p class="text-muted small mb-0">
                                    ใช้รหัสติดตามหรือเบอร์โทรค้นหาในหน้านี้ เพื่อดูความคืบหน้าการตรวจสอบยอด
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
.bg-teal-subtle {
    background-color: #ccfbf1 !important;
}
.text-teal {
    color: #0d9488 !important;
}
.btn-teal-gradient {
    background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
    border: none;
    transition: all 0.3s ease;
}
.btn-teal-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(13, 148, 136, 0.3);
}
.btn-outline-teal {
    border: 1px solid #0d9488;
    color: #0d9488;
    background: transparent;
}
.btn-outline-teal:hover {
    background: #0d9488;
    color: #fff;
}
.contact-icon-bubble {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Step Tracker Timeline */
.step-tracker-wrapper {
    position: relative;
    padding: 10px 0;
}
.step-tracker-track {
    position: absolute;
    top: 30px;
    left: 16%;
    right: 16%;
    height: 4px;
    background: #e2e8f0;
    z-index: 1;
}
.step-tracker-progress {
    height: 100%;
    transition: width 0.4s ease;
}
.step-node {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    border: 3px solid #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    font-size: 1.1rem;
    transition: all 0.3s ease;
}
.step-node.active {
    background: #0d9488;
    color: #fff;
    box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.2);
}
.step-node.active.success {
    background: #10b981;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
}
.step-node.active.danger {
    background: #ef4444;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.2);
}
</style>
