<!-- Smart Kiosk Header -->
<div class="hero-wrapper py-5 mb-4 text-center">
    <div class="container">
        <div class="section-badge mb-3"><i class="bi bi-ticket-detailed-fill text-primary"></i> Self-Service Kiosk</div>
        <h1 class="hero-title mb-2">กดรับบัตรคิวออนไลน์ (Smart Kiosk)</h1>
        <p class="hero-subtitle mx-auto" style="max-width: 600px;">
            กรุณาเลือกแผนกและประเภทการตรวจรักษาเพื่อรับหมายเลขคิวดิจิทัล พร้อมรับการแจ้งเตือนและติดตามคิวแบบ Real-time
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-4 p-md-5">
                <form action="<?= URLROOT ?>/queue/getTicket" method="POST">
                    <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                    <div class="text-center mb-4">
                        <div class="p-3 bg-primary-light text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 64px; height: 64px;">
                            <i class="bi bi-ticket-perforated-fill fs-2"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-1">เลือกประเภทบริการทางการแพทย์</h4>
                        <small class="text-muted">ขั้นตอนง่ายๆ เพียงเลือกแผนกและกรอกข้อมูลเบื้องต้น</small>
                    </div>

                    <!-- Step 1: Select Service Category -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark mb-3">1. เลือกประเภทการรักษา</label>
                        <div class="row g-3">
                            <div class="col-6 col-md-4">
                                <label class="w-100 h-100">
                                    <input type="radio" name="service_type" value="general" class="btn-check" checked>
                                    <div class="btn btn-outline-primary w-100 h-100 p-3 rounded-4 d-flex flex-column align-items-center justify-content-center gap-2">
                                        <i class="bi bi-person-lines-fill fs-3"></i>
                                        <span class="fw-bold small">ตรวจโรคทั่วไป (OPD)</span>
                                    </div>
                                </label>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="w-100 h-100">
                                    <input type="radio" name="service_type" value="pediatric" class="btn-check">
                                    <div class="btn btn-outline-primary w-100 h-100 p-3 rounded-4 d-flex flex-column align-items-center justify-content-center gap-2">
                                        <i class="bi bi-emoji-smile-fill fs-3"></i>
                                        <span class="fw-bold small">คลินิกเด็ก (Pediatric)</span>
                                    </div>
                                </label>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="w-100 h-100">
                                    <input type="radio" name="service_type" value="dental" class="btn-check">
                                    <div class="btn btn-outline-primary w-100 h-100 p-3 rounded-4 d-flex flex-column align-items-center justify-content-center gap-2">
                                        <i class="bi bi-heart-pulse-fill fs-3"></i>
                                        <span class="fw-bold small">ทันตกรรม (Dental)</span>
                                    </div>
                                </label>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="w-100 h-100">
                                    <input type="radio" name="service_type" value="lab" class="btn-check">
                                    <div class="btn btn-outline-primary w-100 h-100 p-3 rounded-4 d-flex flex-column align-items-center justify-content-center gap-2">
                                        <i class="bi bi-droplet-fill fs-3"></i>
                                        <span class="fw-bold small">ห้องแล็บ / เจาะเลือด</span>
                                    </div>
                                </label>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="w-100 h-100">
                                    <input type="radio" name="service_type" value="pharmacy" class="btn-check">
                                    <div class="btn btn-outline-primary w-100 h-100 p-3 rounded-4 d-flex flex-column align-items-center justify-content-center gap-2">
                                        <i class="bi bi-capsule fs-3"></i>
                                        <span class="fw-bold small">รับยา / การเงิน</span>
                                    </div>
                                </label>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="w-100 h-100">
                                    <input type="radio" name="service_type" value="emergency" class="btn-check">
                                    <div class="btn btn-outline-danger w-100 h-100 p-3 rounded-4 d-flex flex-column align-items-center justify-content-center gap-2">
                                        <i class="bi bi-ambulance fs-3"></i>
                                        <span class="fw-bold small text-danger">ฉุกเฉิน (Emergency)</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Department Selection -->
                    <div class="mb-4">
                        <label for="department_id" class="form-label fw-bold text-dark">2. เลือกแผนกที่เข้ารับบริการ <span class="text-danger">*</span></label>
                        <select class="form-select form-control-modern" id="department_id" name="department_id" required>
                            <?php foreach($departments as $dept): ?>
                                <option value="<?= $dept->id ?>"><?= htmlspecialchars($dept->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Step 3: Patient Info -->
                    <div class="mb-4">
                        <label for="patient_name" class="form-label fw-bold text-dark">3. ชื่อ-นามสกุล หรือ หมายเลข HN (ถ้ามี)</label>
                        <input type="text" class="form-control form-control-modern" id="patient_name" name="patient_name" placeholder="เช่น นายสมศักดิ์ รักดี (หรือเว้นว่างเพื่อรับสิทธิ์ทั่วไป)">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="form-label fw-bold text-dark">4. เบอร์โทรศัพท์มือถือ (สำหรับรับ SMS แจ้งเตือนเมื่อใกล้ถึงคิว)</label>
                        <input type="text" class="form-control form-control-modern" id="phone" name="phone" placeholder="08X-XXX-XXXX">
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-modern-primary btn-lg w-100 py-3 fs-5 shadow">
                            <i class="bi bi-ticket-perforated-fill me-2"></i> ยืนยันออกบัตรคิว (Get Smart Ticket)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
