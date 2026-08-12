<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary"><?= $page_title ?></h1>
        <p class="lead text-muted">ตรวจสอบความคืบหน้าเรื่องร้องเรียนของท่านผ่าน Tracking Code</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 mb-5">
                <form action="<?= URLROOT ?>/complaint/track" method="GET" class="d-flex gap-2">
                    <input type="text" class="form-control form-control-lg" name="code" placeholder="กรอกรหัสติดตาม (เช่น PDH-20231015-ABCD)" value="<?= htmlspecialchars($tracking_code) ?>" required>
                    <button type="submit" class="btn btn-primary btn-lg px-4"><i class="bi bi-search"></i> ค้นหา</button>
                </form>
            </div>

            <?php if(!empty($tracking_code)): ?>
                <?php if($complaint): ?>
                    <div class="card border-0 shadow-sm border-top border-4 border-primary">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                <div>
                                    <h5 class="fw-bold mb-1"><?= $complaint->topic ?></h5>
                                    <div class="text-muted small">วันที่รับเรื่อง: <?= date('d M Y H:i', strtotime($complaint->created_at)) ?></div>
                                </div>
                                <div>
                                    <?php if ($complaint->status == 'pending'): ?>
                                        <span class="badge bg-warning text-dark fs-6 px-3 py-2">รอรับเรื่อง</span>
                                    <?php elseif ($complaint->status == 'investigating'): ?>
                                        <span class="badge bg-info text-dark fs-6 px-3 py-2">กำลังตรวจสอบ</span>
                                    <?php elseif ($complaint->status == 'resolved'): ?>
                                        <span class="badge bg-success fs-6 px-3 py-2">ดำเนินการแก้ไขแล้ว</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger fs-6 px-3 py-2">ยุติเรื่อง</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h6 class="fw-bold text-muted">รายละเอียดการร้องเรียน:</h6>
                                <p class="bg-light p-3 rounded"><?= nl2br(htmlspecialchars($complaint->message)) ?></p>
                            </div>

                            <?php if(!empty($complaint->admin_response)): ?>
                            <div class="mb-0">
                                <h6 class="fw-bold text-primary"><i class="bi bi-reply-fill"></i> การตอบกลับจากเจ้าหน้าที่:</h6>
                                <div class="bg-primary bg-opacity-10 text-dark p-3 rounded border border-primary border-opacity-25">
                                    <?= nl2br(htmlspecialchars($complaint->admin_response)) ?>
                                </div>
                                <div class="text-end text-muted small mt-2">อัปเดตล่าสุด: <?= date('d M Y H:i', strtotime($complaint->updated_at)) ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger text-center p-4">
                        <i class="bi bi-exclamation-triangle-fill fs-3 d-block mb-2"></i>
                        <strong>ไม่พบข้อมูล!</strong> ไม่พบรหัสติดตาม "<?= htmlspecialchars($tracking_code) ?>" ในระบบ กรุณาตรวจสอบรหัสอีกครั้ง
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
