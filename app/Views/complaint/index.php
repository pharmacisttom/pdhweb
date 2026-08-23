<!-- Complaint & Feedback Header -->
<div class="hero-wrapper py-5 mb-4 text-center">
    <div class="container">
        <div class="section-badge mb-3"><i class="bi bi-chat-square-quote-fill text-primary"></i> Citizen Voice & Service Improvement</div>
        <h1 class="hero-title mb-2">รับฟังความคิดเห็น & ข้อร้องเรียน</h1>
        <p class="hero-subtitle mx-auto" style="max-width: 600px;">
            โรงพยาบาลปลวกแดงยินดีรับฟังทุกข้อเสนอแนะและข้อร้องเรียน เพื่อนำมาปรับปรุงคุณภาพการบริการให้ดียิ่งขึ้น
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-4 p-md-5">
                
                <div class="d-flex align-items-center justify-content-between p-3 bg-primary-light rounded-4 border border-primary border-opacity-25 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-search text-primary fs-3"></i>
                        <div>
                            <strong class="text-dark d-block">เคยส่งเรื่องแล้วใช่หรือไม่?</strong>
                            <small class="text-muted">ท่านสามารถตรวจสอบสถานะการดำเนินการได้ด้วยรหัสติดตามเรื่อง</small>
                        </div>
                    </div>
                    <a href="<?= URLROOT ?>/complaint/track" class="btn btn-sm btn-modern-primary text-nowrap">
                        ติดตามสถานะ <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <form action="<?= URLROOT ?>/complaint/store" method="POST">
                    <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-person-fill text-primary"></i> ข้อมูลผู้ติดต่อ
                    </h5>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="fullname" class="form-label fw-bold small text-muted">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-modern" id="fullname" name="fullname" required placeholder="นายสมชาย รักสงบ">
                        </div>
                        <div class="col-md-6">
                            <label for="contact_info" class="form-label fw-bold small text-muted">เบอร์โทรศัพท์ หรือ อีเมล <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-modern" id="contact_info" name="contact_info" required placeholder="08X-XXX-XXXX หรือ email@domain.com">
                        </div>
                    </div>
                    
                    <div class="form-check form-switch mb-4 p-3 bg-light rounded-3">
                        <input class="form-check-input ms-0 me-3" type="checkbox" id="is_anonymous" name="is_anonymous" value="1">
                        <label class="form-check-label text-muted small" for="is_anonymous">
                            <strong class="text-dark d-block">ไม่ประสงค์ออกนาม</strong>
                            ข้อมูลชื่อและช่องทางติดต่อของท่านจะถูกปกปิดเป็นความลับสูงสุด
                        </label>
                    </div>

                    <h5 class="fw-bold text-dark mb-3 mt-4 pb-2 border-bottom d-flex align-items-center gap-2">
                        <i class="bi bi-file-text-fill text-primary"></i> รายละเอียดข้อเสนอแนะ / ร้องเรียน
                    </h5>
                    
                    <div class="mb-3">
                        <label for="topic" class="form-label fw-bold small text-muted">หัวข้อเรื่อง <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-modern" id="topic" name="topic" required placeholder="เช่น ข้อเสนอแนะการให้บริการ, ความสะดวกในสถานที่">
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label fw-bold small text-muted">รายละเอียด <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-modern" id="message" name="message" rows="5" required placeholder="โปรดระบุรายละเอียดเหตุการณ์ วันเวลา หรือจุดที่ต้องการให้ปรับปรุง..."></textarea>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-modern-primary btn-lg px-5 py-3 shadow">
                            <i class="bi bi-send-fill me-2"></i> ส่งเรื่องร้องเรียน/ข้อเสนอแนะ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
