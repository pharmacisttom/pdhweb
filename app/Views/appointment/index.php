<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary"><?= $page_title ?></h1>
        <p class="lead text-muted">กรอกข้อมูลเพื่อทำการนัดหมายแพทย์ล่วงหน้า</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 p-md-5">
                <form action="<?= URLROOT ?>/appointment/store" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                    
                    <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom">ข้อมูลผู้ป่วย</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="patient_name" class="form-label fw-medium">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-medium">เบอร์โทรศัพท์ติดต่อ <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="hn_number" class="form-label fw-medium">หมายเลขประจำตัวผู้ป่วย (HN) (ถ้ามี)</label>
                        <input type="text" class="form-control" id="hn_number" name="hn_number" placeholder="สำหรับผู้ที่เคยมีประวัติการรักษาแล้ว">
                    </div>

                    <h5 class="fw-bold text-primary mb-3 mt-5 pb-2 border-bottom">ข้อมูลการนัดหมาย</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="department_id" class="form-label fw-medium">กลุ่มงาน/แผนก <span class="text-danger">*</span></label>
                            <select class="form-select" id="department_id" name="department_id" required>
                                <option value="">-- เลือกกลุ่มงาน --</option>
                                <?php foreach($departments as $dept): ?>
                                    <option value="<?= $dept->id ?>"><?= $dept->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="clinic_id" class="form-label fw-medium">คลินิก (ถ้าทราบ)</label>
                            <select class="form-select" id="clinic_id" name="clinic_id">
                                <option value="">-- เลือกคลินิก --</option>
                                <?php foreach($clinics as $clinic): ?>
                                    <option value="<?= $clinic->id ?>"><?= $clinic->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="doctor_id" class="form-label fw-medium">ระบุแพทย์ (ถ้ามี)</label>
                            <select class="form-select" id="doctor_id" name="doctor_id">
                                <option value="">-- ไม่ระบุ --</option>
                                <?php foreach($doctors as $doctor): ?>
                                    <option value="<?= $doctor->id ?>"><?= $doctor->prefix ?><?= $doctor->firstname ?> <?= $doctor->lastname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="appointment_date" class="form-label fw-medium">วันที่ต้องการนัดหมาย <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="symptoms" class="form-label fw-medium">อาการเบื้องต้น</label>
                        <textarea class="form-control" id="symptoms" name="symptoms" rows="3" placeholder="ระบุอาการเจ็บป่วยคร่าวๆ เพื่อให้แพทย์เตรียมการรักษา..."></textarea>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill"><i class="bi bi-calendar-check me-2"></i> ยืนยันการนัดหมาย</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
