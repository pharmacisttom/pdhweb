<div class="container py-5 my-md-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            
            <!-- Success Animation & Hero Card -->
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden text-center position-relative">
                
                <!-- Decorative Top Banner -->
                <div class="p-4 p-md-5 text-white position-relative" style="background: linear-gradient(135deg, #093f35 0%, #0d9488 50%, #0284c7 100%);">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white text-teal rounded-circle shadow-lg p-3" style="width: 85px; height: 85px;">
                            <i class="bi bi-heart-fill fs-1 text-danger animate-pulse"></i>
                        </div>
                    </div>
                    
                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">
                        <i class="bi bi-patch-check-fill me-1"></i> ได้รับข้อมูลการร่วมบริจาคเรียบร้อยแล้ว
                    </span>
                    <h1 class="h3 fw-bold text-white mb-2">ขอขอบพระคุณในจิตศรัทธาอันยิ่งใหญ่</h1>
                    <p class="text-white-50 small mb-0 max-w-500 mx-auto">
                        ทุกการส่งต่อของท่านช่วยเติมเต็มโอกาสและรอยยิ้มให้กับผู้ป่วย โรงพยาบาลปลวกแดง
                    </p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    
                    <!-- Tracking Code Box -->
                    <div class="p-4 rounded-4 bg-light border border-teal-subtle mb-4 text-start position-relative">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                            <div>
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">รหัสติดตามการบริจาค (Tracking Code)</small>
                                <div class="fs-3 fw-bold font-monospace text-teal" id="trackingCodeText"><?= htmlspecialchars($donation->tracking_code) ?></div>
                            </div>
                            <button type="button" class="btn btn-teal-outline btn-sm rounded-pill px-3 py-2" onclick="copyTrackingCode('<?= htmlspecialchars($donation->tracking_code) ?>')">
                                <i class="bi bi-clipboard me-1"></i> <span id="copyBtnText">คัดลอกรหัส</span>
                            </button>
                        </div>
                        <div class="small text-muted">
                            <i class="bi bi-info-circle text-teal me-1"></i> ท่านสามารถนำรหัสนี้ หรือเบอร์โทรศัพท์ไปตรวจสอบความคืบหน้าการรับเรื่องได้ตลอด 24 ชม.
                        </div>
                    </div>

                    <!-- Donation Summary Details -->
                    <div class="text-start mb-4">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-file-earmark-text text-teal me-2"></i> สรุปข้อมูลการแจ้งบริจาค</h5>
                        
                        <div class="list-group list-group-flush rounded-3 border">
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted small">ชื่อผู้ร่วมบริจาค:</span>
                                <span class="fw-bold text-dark"><?= htmlspecialchars($donation->donor_name) ?></span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted small">โครงการที่สนับสนุน:</span>
                                <span class="fw-semibold text-teal"><?= htmlspecialchars($donation->item_title ?? 'โครงการทั่วไป') ?></span>
                            </div>
                            <?php if (!empty($donation->amount)): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted small">ยอดเงินบริจาค:</span>
                                <span class="fs-5 fw-bold text-success font-monospace"><?= number_format($donation->amount, 2) ?> บาท</span>
                            </div>
                            <?php elseif (!empty($donation->quantity)): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted small">จำนวนสิ่งของ:</span>
                                <span class="fs-5 fw-bold text-primary font-monospace"><?= number_format($donation->quantity) ?> ชิ้น</span>
                            </div>
                            <?php endif; ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted small">สถานะปัจจุบัน:</span>
                                <div>
                                    <?php if ($donation->status === 'approved'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-bold">
                                            <i class="bi bi-check-circle-fill me-1"></i> อนุมัติเรียบร้อยแล้ว
                                        </span>
                                    <?php elseif ($donation->status === 'rejected'): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-bold">
                                            <i class="bi bi-x-circle-fill me-1"></i> ปฏิเสธ / ขอข้อมูลเพิ่ม
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2 rounded-pill fw-bold">
                                            <i class="bi bi-hourglass-split me-1"></i> รอดำเนินการตรวจสอบสลิป
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted small">วันที่แจ้งข้อมูล:</span>
                                <span class="text-dark small font-monospace"><?= date('d/m/Y H:i น.', strtotime($donation->created_at)) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Steps Info Banner -->
                    <div class="alert alert-light border rounded-4 text-start p-3 mb-4">
                        <div class="d-flex gap-3">
                            <div class="fs-3 text-teal"><i class="bi bi-shield-check"></i></div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">ขั้นตอนถัดไปของเจ้าหน้าที่</h6>
                                <p class="text-muted small mb-0">
                                    เจ้าหน้าที่การเงินจะทำการตรวจสอบสลิปการโอนเงินกับรายการบัญชีธนาคารกรุงไทย เมื่อตรวจสอบถูกต้อง ระบบจะอัปเดตยอดสะสมเข้าโครงการ และข้อมูลการลดหย่อนภาษี e-Donation จะส่งตรงถึงกรมสรรพากรโดยอัตโนมัติ
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Share Kindness / Social Invite Banner -->
                    <div class="p-4 rounded-4 bg-teal-subtle text-start mb-4 border border-teal-subtle">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                            <div>
                                <h6 class="fw-bold text-dark mb-1"><i class="bi bi-share-fill text-teal me-2"></i>ร่วมเป็นสะพานบุญ บอกต่อพลังแห่งการให้</h6>
                                <small class="text-muted">ชวนเพื่อนและครอบครัวมาร่วมสร้างรอยยิ้มให้กับผู้ป่วย</small>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(URLROOT . '/donations') ?>" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1">
                                <i class="bi bi-facebook"></i> แชร์ Facebook
                            </a>
                            <a href="https://social-plugins.line.me/lineit/share?url=<?= urlencode(URLROOT . '/donations') ?>&text=<?= urlencode('ผม/ดิฉันได้ร่วมบริจาคให้กับโรงพยาบาลปลวกแดง ขอเชิญชวนทุกท่านมาร่วมส่งต่อพลังแห่งการให้ด้วยกันครับ/ค่ะ') ?>" target="_blank" class="btn btn-sm rounded-pill px-3 py-2 text-white d-inline-flex align-items-center gap-1" style="background-color: #06c755;">
                                <i class="bi bi-line"></i> แชร์ทาง LINE
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(URLROOT . '/donations') ?>&text=<?= urlencode('ร่วมบริจาคสมทบทุนโรงพยาบาลปลวกแดง e-Donation ลดหย่อนภาษีได้ 2 เท่า') ?>" target="_blank" class="btn btn-sm btn-dark rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1">
                                <i class="bi bi-twitter-x"></i> X (Twitter)
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary bg-white rounded-pill px-3 py-2" onclick="copyCampaignLink('<?= URLROOT ?>/donations')">
                                <i class="bi bi-link-45deg"></i> <span id="copyCampBtnText">คัดลอกลิงก์</span>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center pt-2">
                        <a href="<?= URLROOT ?>/donation/track?code=<?= urlencode($donation->tracking_code) ?>" class="btn btn-teal-gradient rounded-pill px-4 py-3 fw-bold text-white shadow-sm">
                            <i class="bi bi-search me-1"></i> ติดตามสถานะสลิปรายการนี้
                        </a>
                        <a href="<?= URLROOT ?>/donations" class="btn btn-outline-secondary rounded-pill px-4 py-3 fw-semibold">
                            <i class="bi bi-arrow-left me-1"></i> กลับหน้าหลักการบริจาค
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
.btn-teal-gradient {
    background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
    border: none;
    transition: all 0.3s ease;
}
.btn-teal-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(13, 148, 136, 0.35) !important;
}
.btn-teal-outline {
    border: 1px solid #0d9488;
    color: #0d9488;
    background: transparent;
    transition: all 0.2s ease;
}
.btn-teal-outline:hover {
    background: #0d9488;
    color: #fff;
}
.text-teal {
    color: #0d9488 !important;
}
.border-teal-subtle {
    border-color: rgba(13, 148, 136, 0.25) !important;
}
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); }
}
.animate-pulse {
    animation: pulse 2s infinite ease-in-out;
}
</style>

<script>
function copyTrackingCode(code) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(code).then(() => {
            const btnText = document.getElementById('copyBtnText');
            if (btnText) {
                btnText.textContent = 'คัดลอกสำเร็จ!';
                setTimeout(() => { btnText.textContent = 'คัดลอกรหัส'; }, 2500);
            }
        });
    }
}

function copyCampaignLink(url) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            const btnText = document.getElementById('copyCampBtnText');
            if (btnText) {
                btnText.textContent = 'คัดลอกแล้ว!';
                setTimeout(() => { btnText.textContent = 'คัดลอกลิงก์'; }, 2000);
            }
        });
    }
}
</script>
