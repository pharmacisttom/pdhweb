<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">รหัสติดตามข้อร้องเรียน: <strong><?= htmlspecialchars($complaint->tracking_code) ?></strong></p>
    </div>
    <a href="<?= URLROOT ?>/admin/complaint" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> กลับ
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4 bg-white">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-file-text me-2"></i> ข้อมูลการร้องเรียน</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-4 border-bottom pb-3">
                    <h4 class="fw-bold text-dark mb-2"><?= htmlspecialchars($complaint->topic) ?></h4>
                    <div class="text-muted small">
                        รหัสติดตาม: <span class="badge bg-light text-dark border font-monospace px-3 py-1 me-3"><?= htmlspecialchars($complaint->tracking_code) ?></span>
                        <i class="bi bi-clock me-1"></i> วันที่ส่งเรื่อง: <?= date('d/m/Y H:i น.', strtotime($complaint->created_at)) ?>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-secondary mb-2">รายละเอียดข้อร้องเรียน:</h6>
                    <div class="p-3 bg-light rounded-3 border text-dark lh-base">
                        <?= nl2br(htmlspecialchars($complaint->message)) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h6 class="fw-bold text-secondary mb-2">ข้อมูลผู้ส่งเรื่อง:</h6>
                        <?php if($complaint->is_anonymous): ?>
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="badge bg-secondary mb-2"><i class="bi bi-incognito"></i> ไม่ประสงค์ออกนาม</span>
                                <div class="text-muted small">ชื่อที่ระบุในระบบ: <strong><?= htmlspecialchars($complaint->fullname ?: '-') ?></strong></div>
                                <div class="text-muted small">ช่องทางติดต่อ: <strong><?= htmlspecialchars($complaint->contact_info ?: '-') ?></strong></div>
                            </div>
                        <?php else: ?>
                            <div class="p-3 bg-light rounded-3 border">
                                <div><strong>ชื่อ-นามสกุล:</strong> <?= htmlspecialchars($complaint->fullname) ?></div>
                                <div><strong>ช่องทางติดต่อ:</strong> <?= htmlspecialchars($complaint->contact_info) ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
            <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-gear-fill text-primary me-2"></i> จัดการสถานะ</h5>
            
            <form action="<?= URLROOT ?>/admin/complaint/updateStatus/<?= $complaint->id ?>" method="POST">
                <?= \App\Helpers\Security::csrfField() ?>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">สถานะปัจจุบัน</label>
                    <select name="status" class="form-select rounded-3 py-2 fw-semibold">
                        <option value="pending" <?= $complaint->status == 'pending' ? 'selected' : '' ?>>รอรับเรื่อง (Pending)</option>
                        <option value="investigating" <?= $complaint->status == 'investigating' ? 'selected' : '' ?>>กำลังตรวจสอบ (Investigating)</option>
                        <option value="resolved" <?= $complaint->status == 'resolved' ? 'selected' : '' ?>>ดำเนินการแก้ไขแล้ว (Resolved)</option>
                        <option value="rejected" <?= $complaint->status == 'rejected' ? 'selected' : '' ?>>ยุติเรื่อง / ไม่รับดำเนินการ (Rejected)</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-dark">คำตอบกลับจากเจ้าหน้าที่ (แสดงหน้าเว็บเมื่อตรวจสอบสถานะ)</label>
                    <textarea class="form-control rounded-3" name="admin_response" rows="6" placeholder="พิมพ์ข้อความตอบกลับผู้ร้องเรียน..."><?= htmlspecialchars($complaint->admin_response ?? '') ?></textarea>
                    <div class="form-text small text-muted">ผู้ร้องเรียนสามารถนำรหัสติดตามมาดูคำตอบนี้ได้</div>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">
                    <i class="bi bi-save me-1"></i> บันทึกการเปลี่ยนแปลง
                </button>
            </form>
        </div>
    </div>
</div>
