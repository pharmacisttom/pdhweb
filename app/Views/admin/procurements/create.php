<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1"><?= $page_title ?></h3>
        <p class="text-muted small mb-0">เพิ่มประกาศจัดซื้อจัดจ้าง แผนการจัดซื้อ หรือสรุปผล สขร.1</p>
    </div>
    <a href="<?= URLROOT ?>/admin/procurement" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> กลับ
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
    <form action="<?= URLROOT ?>/admin/procurement/create" method="POST" enctype="multipart/form-data">
        <?= \App\Helpers\Security::csrfField() ?>

        <div class="row g-4">
            
            <!-- Title -->
            <div class="col-12">
                <label class="form-label fw-bold small text-dark">หัวข้อประกาศจัดซื้อจัดจ้าง <span class="text-danger">*</span></label>
                <input type="text" class="form-control rounded-3 py-2" name="title" placeholder="เช่น ประกวดราคาซื้อครุภัณฑ์ทางการแพทย์..." required>
            </div>
            
            <!-- Category -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">หมวดหมู่ <span class="text-danger">*</span></label>
                <select class="form-select rounded-3 py-2" name="category" required>
                    <option value="ประกาศจัดซื้อจัดจ้าง" selected>ประกาศจัดซื้อจัดจ้าง</option>
                    <option value="แผนการจัดซื้อจัดจ้าง">แผนการจัดซื้อจัดจ้าง (ประจำปี)</option>
                    <option value="สรุปผลการจัดซื้อจัดจ้าง">สรุปผลการดำเนินการ (สขร.1)</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">ปีงบประมาณ <span class="text-danger">*</span></label>
                <input type="number" min="2500" max="2600" class="form-control rounded-3 py-2" name="budget_year" value="<?= date('Y') + 543 ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">วิธีจัดหา</label>
                <input type="text" class="form-control rounded-3 py-2" name="method" placeholder="เช่น e-bidding, คัดเลือก, เฉพาะเจาะจง">
            </div>

            <!-- Budget -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">วงเงินงบประมาณ (บาท)</label>
                <input type="text" class="form-control rounded-3 py-2" name="project_budget" placeholder="เช่น 500,000.00">
            </div>

            <!-- Published Date -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">วันที่ประกาศ <span class="text-danger">*</span></label>
                <input type="date" class="form-control rounded-3 py-2" name="published_at" value="<?= date('Y-m-d') ?>" required>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label fw-bold small text-dark">สถานะ</label>
                <select class="form-select rounded-3 py-2" name="status">
                    <option value="active" selected>ใช้งานปกติ (แสดงบนเว็บ)</option>
                    <option value="archived">เก็บถาวร (ซ่อน)</option>
                </select>
            </div>
            
            <!-- Document Attachment -->
            <div class="col-12">
                <div class="p-4 bg-light rounded-4 border">
                    <label class="form-label fw-bold small text-dark"><i class="bi bi-file-earmark-pdf text-danger me-1"></i> ไฟล์เอกสารแนบ (PDF)</label>
                    <input class="form-control rounded-3 py-2 bg-white" type="file" name="document" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip">
                    <div class="form-text small">รองรับไฟล์ .pdf, .docx, .xlsx ขนาดไม่เกิน 10MB</div>
                </div>
            </div>
            
        </div>

        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
            <a href="<?= URLROOT ?>/admin/procurement" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                <i class="bi bi-check-circle-fill me-1"></i> บันทึกประกาศ
            </button>
        </div>
    </form>
</div>
