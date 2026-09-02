<div class="container my-5">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/donation" class="btn btn-modern-outline btn-sm">
            <i class="bi bi-arrow-left"></i> กลับไปหน้ารวมการบริจาค
        </a>
    </div>

    <div class="row g-5">
        <div class="col-lg-7">
            <div class="glass-card p-4 mb-4">
                <img src="<?= URLROOT ?>/assets/images/donations/<?= $item->image ?: 'default-donation.jpg' ?>" class="img-fluid rounded-4 shadow-sm mb-4 w-100 object-fit-cover" style="max-height: 380px;" alt="<?= htmlspecialchars($item->title) ?>" onerror="this.src='https://placehold.co/800x500?text=Donation+Project'">
                
                <div class="mb-3 d-flex align-items-center gap-3">
                    <?php if ($item->type == 'money'): ?>
                        <span class="badge bg-success text-white px-3 py-2 rounded-pill"><i class="bi bi-cash-stack me-1"></i> ระดมทุนเงินบริจาค</span>
                    <?php elseif ($item->type == 'equipment'): ?>
                        <span class="badge bg-info text-white px-3 py-2 rounded-pill"><i class="bi bi-heart-pulse-fill me-1"></i> อุปกรณ์การแพทย์</span>
                    <?php else: ?>
                        <span class="badge bg-secondary text-white px-3 py-2 rounded-pill"><i class="bi bi-box-seam me-1"></i> สิ่งของบริจาค</span>
                    <?php endif; ?>
                    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> เริ่มโครงการ: <?= date('d M Y', strtotime($item->created_at)) ?></span>
                </div>

                <h2 class="fw-bold text-dark mb-3"><?= htmlspecialchars($item->title) ?></h2>
                
                <div class="text-secondary mb-4" style="line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($item->description)) ?>
                </div>
                
                <?php if ($item->type == 'money' && $item->target_amount > 0): ?>
                    <div class="p-4 bg-light rounded-4 border">
                        <h5 class="fw-bold mb-3 text-dark">ความคืบหน้ายอดบริจาค</h5>
                        <?php $percent = min(100, ($item->current_amount / $item->target_amount) * 100); ?>
                        <div class="progress progress-modern mb-3" style="height: 18px;">
                            <div class="progress-bar progress-bar-modern" role="progressbar" style="width: <?= $percent ?>%;">
                                <?= number_format($percent, 1) ?>%
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="text-muted d-block small">ยอดบริจาคปัจจุบัน</span>
                                <span class="fs-4 fw-bold text-success"><?= number_format($item->current_amount, 2) ?></span> <span class="text-muted small">บาท</span>
                            </div>
                            <div class="text-end">
                                <span class="text-muted d-block small">เป้าหมาย</span>
                                <span class="fs-4 fw-bold text-dark"><?= number_format($item->target_amount, 2) ?></span> <span class="text-muted small">บาท</span>
                            </div>
                        </div>
                    </div>
                <?php elseif ($item->type == 'equipment' && $item->target_quantity > 0): ?>
                    <div class="p-4 bg-light rounded-4 border">
                        <h5 class="fw-bold mb-3 text-dark">ความคืบหน้าจำนวนอุปกรณ์</h5>
                        <?php $percent = min(100, ($item->current_quantity / $item->target_quantity) * 100); ?>
                        <div class="progress progress-modern mb-3" style="height: 18px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $percent ?>%;">
                                <?= number_format($percent, 1) ?>%
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="text-muted d-block small">ได้รับแล้ว</span>
                                <span class="fs-4 fw-bold text-info"><?= number_format($item->current_quantity) ?></span> <span class="text-muted small">ชิ้น</span>
                            </div>
                            <div class="text-end">
                                <span class="text-muted d-block small">เป้าหมาย</span>
                                <span class="fs-4 fw-bold text-dark"><?= number_format($item->target_quantity) ?></span> <span class="text-muted small">ชิ้น</span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Share Project Section -->
                <div class="mt-4 p-4 rounded-4 bg-light border">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                        <div>
                            <h5 class="h6 fw-bold text-dark mb-1"><i class="bi bi-share-fill text-teal me-2"></i>บอกต่อพลังแห่งการให้ (แชร์โครงการนี้)</h5>
                            <small class="text-muted">ร่วมเป็นสะพานบุญส่งต่อโอกาสและรอยยิ้มให้กับผู้ป่วย</small>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <!-- Facebook Share -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(URLROOT . '/donation/show/' . $item->id) ?>" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        
                        <!-- LINE Share -->
                        <a href="https://social-plugins.line.me/lineit/share?url=<?= urlencode(URLROOT . '/donation/show/' . $item->id) ?>&text=<?= urlencode('ขอเชิญร่วมบริจาคโครงการ ' . $item->title . ' โรงพยาบาลปลวกแดง') ?>" target="_blank" class="btn btn-sm rounded-pill px-3 py-2 text-white d-inline-flex align-items-center gap-1" style="background-color: #06c755;">
                            <i class="bi bi-line"></i> LINE
                        </a>

                        <!-- X (Twitter) Share -->
                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode(URLROOT . '/donation/show/' . $item->id) ?>&text=<?= urlencode('ขอเชิญร่วมบริจาคโครงการ ' . $item->title . ' โรงพยาบาลปลวกแดง e-Donation ลดหย่อนภาษีได้ 2 เท่า') ?>" target="_blank" class="btn btn-sm btn-dark rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1">
                            <i class="bi bi-twitter-x"></i> X (Twitter)
                        </a>

                        <!-- Native Mobile Share API -->
                        <button type="button" class="btn btn-sm btn-teal-gradient text-white rounded-pill px-3 py-2" onclick="nativeShareProject('<?= htmlspecialchars(addslashes($item->title)) ?>', '<?= URLROOT ?>/donation/show/<?= $item->id ?>')">
                            <i class="bi bi-share"></i> แชร์ไปยังแอปอื่น
                        </button>

                        <!-- Copy Link Button -->
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2" onclick="copyProjectLink('<?= URLROOT ?>/donation/show/<?= $item->id ?>')">
                            <i class="bi bi-link-45deg"></i> <span id="copyLinkBtnText">คัดลอกลิงก์</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-5">
            <div class="glass-card p-4 p-md-5 sticky-top" style="top: 100px;">
                <div class="text-center mb-4">
                    <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                        <i class="bi bi-heart-fill fs-3"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">แบบฟอร์มร่วมบริจาค</h4>
                    <p class="text-muted small">กรุณากรอกข้อมูลและแนบหลักฐานการโอนเงิน</p>
                </div>
                
                <?php if ($item->status == 'completed' || $item->status == 'inactive'): ?>
                    <div class="text-center py-4">
                        <i class="bi bi-check-circle-fill text-success display-4 mb-3 d-block"></i>
                        <h5 class="fw-bold">ปิดรับบริจาคแล้ว</h5>
                        <p class="text-muted small">รายการนี้ปิดรับบริจาคแล้ว ขอขอบพระคุณทุกท่านที่ร่วมสนับสนุน</p>
                    </div>
                <?php else: ?>
                    <?php if ($item->type == 'money' || $item->type == 'general'): ?>
                    <div class="p-3 rounded-4 bg-light border border-teal-subtle mb-4">
                        <div class="text-center mb-3">
                            <a href="https://epayapp.rd.go.th/rd-edonation/portal/for-donation-unit" target="_blank" title="ตรวจสอบหน่วยรับบริจาค e-Donation กรมสรรพากร" class="d-inline-block text-decoration-none">
                                <img src="<?= URLROOT ?>/assets/images/edonation-badge.svg" alt="e-Donation Logo กรมสรรพากร" class="img-fluid rounded-4 shadow-sm mb-1" style="max-height: 52px;">
                            </a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="small text-muted"><i class="bi bi-bank2 text-teal me-1"></i> ธนาคารกรุงไทย สาขาปลวกแดง</span>
                            <span class="badge bg-success-subtle text-success">ลดหย่อน 2 เท่า</span>
                        </div>
                        <div class="fw-bold text-dark small mb-1">ชื่อบัญชี: เงินบริจาคของโรงพยาบาลปลวกแดง</div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="fs-5 fw-bold font-monospace text-teal">671-9-87195-1</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-0" onclick="copyToClipboard('6719871951', 'คัดลอกเลขบัญชี 671-9-87195-1 เรียบร้อยแล้ว')">
                                <i class="bi bi-copy"></i>
                            </button>
                        </div>
                        
                        <!-- Official QR Image -->
                        <div class="text-center p-2 bg-white rounded-3 border mb-2">
                            <img id="projectQrImage" src="<?= URLROOT ?>/assets/images/donations/official-edonation-qr.png" alt="Official PromptPay e-Donation QR Code" class="img-fluid rounded mb-1" style="max-height: 200px; object-fit: contain;">
                            <div class="small text-muted font-monospace" style="font-size: 0.75rem;" id="projectQrHint">
                                สแกนบริจาคผ่าน Mobile Banking ได้ทุกธนาคาร
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="https://epayapp.rd.go.th/rd-edonation/portal/for-donation-unit" target="_blank" rel="noopener noreferrer" class="text-teal text-decoration-none fw-semibold" style="font-size: 0.75rem;">
                                <i class="bi bi-patch-check-fill text-success me-1"></i> รหัส e-Donation: 0994000164877 <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <form action="<?= URLROOT ?>/donation/store" method="POST" enctype="multipart/form-data">
                        <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="donation_item_id" value="<?= $item->id ?>">
                        
                        <div class="mb-3">
                            <label for="donor_name" class="form-label fw-bold small text-muted">ชื่อ-นามสกุล หรือ นามแฝง <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-modern" id="donor_name" name="donor_name" required placeholder="นายรักสุขภาพ ใจดี">
                        </div>
                        
                        <div class="mb-3">
                            <label for="donor_phone" class="form-label fw-bold small text-muted">เบอร์โทรศัพท์ติดต่อ</label>
                            <input type="text" class="form-control form-control-modern" id="donor_phone" name="donor_phone" placeholder="08X-XXX-XXXX">
                        </div>
                        
                        <div class="mb-3">
                            <label for="donor_email" class="form-label fw-bold small text-muted">อีเมล (สำหรับรับใบเสร็จ/ขอบคุณ)</label>
                            <input type="email" class="form-control form-control-modern" id="donor_email" name="donor_email" placeholder="example@email.com">
                        </div>

                        <?php if ($item->type == 'money' || $item->type == 'general'): ?>
                        <div class="mb-3">
                            <label for="amount" class="form-label fw-bold small text-muted">จำนวนเงินที่บริจาค (บาท) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="1" class="form-control form-control-modern fw-bold text-teal" id="amount" name="amount" required placeholder="1000.00" oninput="updateProjectQr(this.value)">
                            <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-stars text-warning me-1"></i> ระบุยอดเงินเพื่อสร้าง QR Code พร้อมยอดเงินให้อัตโนมัติ</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="payment_slip" class="form-label fw-bold small text-muted">แนบสลิปโอนเงิน <span class="text-danger">*</span></label>
                            <input type="file" class="form-control form-control-modern" id="payment_slip" name="payment_slip" accept="image/*" required>
                        </div>
                        <?php elseif ($item->type == 'equipment'): ?>
                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-bold small text-muted">จำนวนที่บริจาค (ชิ้น) <span class="text-danger">*</span></label>
                            <input type="number" min="1" class="form-control form-control-modern fw-bold text-teal" id="quantity" name="quantity" required placeholder="1">
                        </div>
                        <?php else: ?>
                        <div class="mb-4">
                            <label for="payment_slip" class="form-label fw-bold small text-muted">ภาพถ่ายสิ่งของที่บริจาค (ถ้ามี)</label>
                            <input type="file" class="form-control form-control-modern" id="payment_slip" name="payment_slip" accept="image/*">
                        </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-modern-primary w-100 py-3 fs-6 mb-3">
                            <i class="bi bi-send-fill me-1"></i> ยืนยันแจ้งการบริจาค
                        </button>
                        
                        <a href="<?= URLROOT ?>/donation/track" class="btn btn-outline-secondary w-100 py-2 rounded-pill small">
                            <i class="bi bi-search me-1"></i> ตรวจสอบสถานะการบริจาค (Donor Tracker)
                        </a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text, message) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            alert(message);
        });
    }
}

function updateProjectQr(amount) {
    const val = parseFloat(amount) || 0;
    fetch(`<?= URLROOT ?>/donation/qr?amount=${val}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const qrImg = document.getElementById('projectQrImage');
                const qrHint = document.getElementById('projectQrHint');
                if (qrImg) qrImg.src = data.qr_image_url;
                if (qrHint) {
                    if (val > 0) {
                        qrHint.innerHTML = `<strong class="text-success">QR ยอด ${data.formatted_amount} บาท</strong> (สแกนเพื่อจ่ายยอดนี้ทันที)`;
                    } else {
                        qrHint.innerText = 'สแกนบริจาคผ่าน Mobile Banking ทุกธนาคาร';
                    }
                }
            }
        });
}

function copyProjectLink(url) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            const btnText = document.getElementById('copyLinkBtnText');
            if (btnText) {
                btnText.innerText = 'คัดลอกแล้ว!';
                setTimeout(() => { btnText.innerText = 'คัดลอกลิงก์'; }, 2000);
            }
        });
    }
}

function nativeShareProject(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title + ' - โรงพยาบาลปลวกแดง',
            text: 'ขอเชิญร่วมบริจาค ' + title + ' โรงพยาบาลปลวกแดง เพื่อส่งต่อโอกาสและรอยยิ้มให้กับผู้ป่วย',
            url: url
        }).catch(() => {});
    } else {
        copyProjectLink(url);
    }
}
</script>
