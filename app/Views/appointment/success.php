<div class="container my-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm py-5 px-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                <h2 class="fw-bold mt-4 mb-3"><?= $page_title ?></h2>
                <p class="text-muted lead mb-4">ข้อมูลการนัดหมายของคุณได้ถูกส่งไปยังระบบของโรงพยาบาลแล้ว เจ้าหน้าที่จะทำการตรวจสอบและติดต่อกลับเพื่อยืนยันเวลาที่แน่นอนอีกครั้ง</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="<?= URLROOT ?>" class="btn btn-primary px-4 gap-3">กลับหน้าหลัก</a>
                    <a href="<?= URLROOT ?>/appointment" class="btn btn-outline-secondary px-4">นัดหมายเพิ่มเติม</a>
                </div>
            </div>
        </div>
    </div>
</div>
