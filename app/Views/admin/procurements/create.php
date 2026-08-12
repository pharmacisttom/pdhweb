<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/procurements" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/procurements/store" method="POST" enctype="multipart/form-data">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <div class="mb-3">
                <label for="title" class="form-label fw-bold">หัวข้อประกาศ <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg" id="title" name="title" required>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="category" class="form-label fw-bold">หมวดหมู่ <span class="text-danger">*</span></label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="ประกาศจัดซื้อจัดจ้าง">ประกาศจัดซื้อจัดจ้าง</option>
                        <option value="สรุปผลการจัดซื้อจัดจ้าง">สรุปผลการจัดซื้อจัดจ้าง (รายเดือน/ปี)</option>
                        <option value="แผนการจัดซื้อจัดจ้าง">แผนการจัดซื้อจัดจ้าง (ประจำปี)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="project_budget" class="form-label fw-bold">วงเงินงบประมาณ (บาท)</label>
                    <input type="text" class="form-control" id="project_budget" name="project_budget" placeholder="เช่น 500,000.00">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="published_at" class="form-label fw-bold">วันที่ประกาศ <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="published_at" name="published_at" value="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label fw-bold">สถานะ</label>
                    <select class="form-select" id="status" name="status">
                        <option value="active">ใช้งานปกติ (แสดงบนเว็บ)</option>
                        <option value="archived">เก็บถาวร (ซ่อน)</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-4 p-4 bg-light rounded border">
                <label for="document" class="form-label fw-bold"><i class="bi bi-file-earmark-pdf text-danger me-1"></i> อัปโหลดไฟล์เอกสาร (PDF)</label>
                <input class="form-control" type="file" id="document" name="document" accept=".pdf">
                <div class="form-text">รองรับไฟล์ .pdf ขนาดไม่เกิน 10MB</div>
            </div>
            
            <hr>
            <div class="text-end mt-3">
                <a href="<?= URLROOT ?>/admin/procurements" class="btn btn-light me-2">ยกเลิก</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>
