<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/complaints" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-file-text me-2"></i> ข้อมูลการร้องเรียน</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-4 border-bottom pb-3">
                    <h4 class="fw-bold"><?= $complaint->topic ?></h4>
                    <div class="text-muted small">
                        รหัสติดตาม: <span class="fw-bold text-dark me-3"><?= $complaint->tracking_code ?></span>
                        วันที่ส่งเรื่อง: <?= date('d M Y H:i', strtotime($complaint->created_at)) ?>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-secondary">รายละเอียด:</h6>
                    <div class="p-3 bg-light rounded border">
                        <?= nl2br(htmlspecialchars($complaint->message)) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-secondary">ข้อมูลผู้ติดต่อ:</h6>
                        <?php if($complaint->is_anonymous): ?>
                            <span class="badge bg-secondary"><i class="bi bi-incognito"></i> ไม่ประสงค์ออกนาม</span>
                            <div class="mt-2 text-muted small">ข้อมูลจริงที่ถูกบันทึกไว้ในระบบ (ห้ามเปิดเผย):</div>
                            <div>ชื่อ: <?= $complaint->fullname ?></div>
                            <div>ติดต่อ: <?= $complaint->contact_info ?></div>
                        <?php else: ?>
                            <div><strong>ชื่อ-นามสกุล:</strong> <?= $complaint->fullname ?></div>
                            <div><strong>ช่องทางติดต่อ:</strong> <?= $complaint->contact_info ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0 border-top border-4 border-primary">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-gear-fill text-primary me-2"></i> จัดการสถานะเรื่องร้องเรียน</h5>
                
                <form action="<?= URLROOT ?>/admin/complaints/updateStatus/<?= $complaint->id ?>" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                    <div class="mb-3">
                        <label class="form-label fw-bold">สถานะปัจจุบัน</label>
                        <select name="status" class="form-select fw-bold <?= 
                            $complaint->status == 'pending' ? 'text-warning' : 
                            ($complaint->status == 'investigating' ? 'text-info' : 
                            ($complaint->status == 'resolved' ? 'text-success' : 'text-danger')) 
                        ?>">
                            <option value="pending" <?= $complaint->status == 'pending' ? 'selected' : '' ?>>รอรับเรื่อง</option>
                            <option value="investigating" <?= $complaint->status == 'investigating' ? 'selected' : '' ?>>กำลังตรวจสอบ</option>
                            <option value="resolved" <?= $complaint->status == 'resolved' ? 'selected' : '' ?>>ดำเนินการแก้ไขแล้ว (ยุติเรื่อง)</option>
                            <option value="rejected" <?= $complaint->status == 'rejected' ? 'selected' : '' ?>>ยุติเรื่อง (ไม่รับดำเนินการ)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">คำตอบกลับจากเจ้าหน้าที่ (แสดงหน้าเว็บ)</label>
                        <textarea class="form-control" name="admin_response" rows="6" placeholder="พิมพ์ข้อความตอบกลับผู้ร้องเรียน..."><?= htmlspecialchars($complaint->admin_response) ?></textarea>
                        <div class="form-text">ข้อความนี้จะแสดงให้ผู้ใช้เห็นเมื่อนำ Tracking Code มาค้นหา</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-1"></i> บันทึกการเปลี่ยนแปลง</button>
                </form>
            </div>
        </div>
    </div>
</div>
