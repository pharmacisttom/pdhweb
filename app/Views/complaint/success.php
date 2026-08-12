<div class="container my-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm py-5 px-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                <h2 class="fw-bold mt-4 mb-3"><?= $page_title ?></h2>
                <p class="text-muted lead mb-4">ขอบคุณสำหรับข้อมูลของท่าน ทางโรงพยาบาลได้รับเรื่องเรียบร้อยแล้ว และจะดำเนินการตรวจสอบโดยเร็วที่สุด</p>
                
                <div class="bg-light p-4 rounded mb-4 border">
                    <p class="mb-1 text-muted">รหัสสำหรับติดตามสถานะของท่านคือ</p>
                    <h3 class="fw-bold text-primary mb-0 user-select-all"><?= $tracking_code ?></h3>
                    <small class="text-danger mt-2 d-block">* โปรดบันทึกรหัสนี้ไว้ เพื่อใช้ตรวจสอบสถานะการดำเนินการในภายหลัง</small>
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="<?= URLROOT ?>" class="btn btn-primary px-4 gap-3">กลับหน้าหลัก</a>
                    <a href="<?= URLROOT ?>/complaint/track?code=<?= $tracking_code ?>" class="btn btn-outline-secondary px-4">ดูสถานะทันที</a>
                </div>
            </div>
        </div>
    </div>
</div>
