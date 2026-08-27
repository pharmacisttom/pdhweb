<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><?= $page_title ?></h2>
    <a href="<?= URLROOT ?>/admin/donationitem" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> กลับ</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= URLROOT ?>/admin/donationitem/create" method="POST" enctype="multipart/form-data">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <div class="row mb-3">
                <div class="col-md-4 mb-3 text-center">
                    <img id="image-preview" src="<?= URLROOT ?>/assets/images/donations/default-donation.jpg" alt="Preview" class="img-thumbnail mb-2" style="max-height: 200px; object-fit: cover;">
                    <div>
                        <label for="image" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-image"></i> เลือกรูปภาพ
                        </label>
                        <input type="file" id="image" name="image" class="d-none" accept="image/*" onchange="previewImage(this);">
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">หัวข้อรับบริจาค <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">ประเภท</label>
                        <select class="form-select" id="type" name="type" onchange="toggleTargets()">
                            <option value="general">ทั่วไป (ไม่ระบุเป้าหมาย)</option>
                            <option value="money">รับเงินบริจาค (ระบุยอด)</option>
                            <option value="equipment">อุปกรณ์การแพทย์ (ระบุจำนวน)</option>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3 target-field" id="target-money-div" style="display: none;">
                            <label for="target_amount" class="form-label fw-bold">ยอดเงินเป้าหมาย (บาท)</label>
                            <input type="number" step="0.01" class="form-control" id="target_amount" name="target_amount">
                        </div>
                        <div class="col-md-6 mb-3 target-field" id="target-equipment-div" style="display: none;">
                            <label for="target_quantity" class="form-label fw-bold">จำนวนอุปกรณ์เป้าหมาย (ชิ้น/คัน/เครื่อง)</label>
                            <input type="number" class="form-control" id="target_quantity" name="target_quantity">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold">รายละเอียด</label>
                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
            </div>
            
            <div class="mb-4">
                <label for="status" class="form-label fw-bold">สถานะ</label>
                <select class="form-select w-25" id="status" name="status">
                    <option value="active">เปิดรับบริจาค</option>
                    <option value="inactive">ระงับชั่วคราว</option>
                    <option value="completed">ปิดรับบริจาค (ครบแล้ว)</option>
                </select>
            </div>
            
            <hr>
            <div class="text-end mt-3">
                <a href="<?= URLROOT ?>/admin/donationitem" class="btn btn-light me-2">ยกเลิก</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function toggleTargets() {
    var type = document.getElementById('type').value;
    document.getElementById('target-money-div').style.display = 'none';
    document.getElementById('target-equipment-div').style.display = 'none';
    
    if (type === 'money') {
        document.getElementById('target-money-div').style.display = 'block';
    } else if (type === 'equipment') {
        document.getElementById('target-equipment-div').style.display = 'block';
    }
}

// init toggle
toggleTargets();
</script>
