<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary"><?= $page_title ?></h1>
        <p class="lead text-muted">โรงพยาบาลยินดีรับฟังทุกข้อเสนอแนะและข้อร้องเรียน เพื่อนำไปปรับปรุงการให้บริการต่อไป</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 p-md-5">
                
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i> หากท่านเคยส่งเรื่องแล้ว สามารถ <a href="<?= URLROOT ?>/complaint/track" class="fw-bold alert-link">ติดตามสถานะเรื่องร้องเรียนได้ที่นี่</a>
                </div>

                <form action="<?= URLROOT ?>/complaint/store" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                    
                    <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom">ข้อมูลผู้ติดต่อ</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fullname" class="form-label fw-medium">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_info" class="form-label fw-medium">เบอร์โทรศัพท์ หรือ อีเมล <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                        </div>
                    </div>
                    
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="is_anonymous" name="is_anonymous" value="1">
                        <label class="form-check-label text-muted" for="is_anonymous">ไม่ประสงค์ออกนาม (ข้อมูลชื่อและช่องทางติดต่อของท่านจะถูกปกปิดจากผู้ใช้งานทั่วไป)</label>
                    </div>

                    <h5 class="fw-bold text-primary mb-3 mt-4 pb-2 border-bottom">รายละเอียดการร้องเรียน/เสนอแนะ</h5>
                    <div class="mb-3">
                        <label for="topic" class="form-label fw-medium">หัวข้อเรื่อง <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="topic" name="topic" required placeholder="เช่น การให้บริการของเจ้าหน้าที่, สิ่งอำนวยความสะดวก">
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label fw-medium">รายละเอียด <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="message" name="message" rows="5" required placeholder="อธิบายรายละเอียดเหตุการณ์หรือข้อเสนอแนะของท่านอย่างชัดเจน..."></textarea>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill"><i class="bi bi-send me-2"></i> ส่งเรื่องร้องเรียน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
