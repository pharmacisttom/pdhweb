<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">ตั้งค่าระบบ & การเชื่อมต่อ (Settings & Integrations)</h3>
        <p class="text-muted small mb-0"><i class="bi bi-gear-wide-connected me-1"></i> จัดการข้อมูลโรงพยาบาล, เชื่อมต่อ Facebook Page, LINE Official Account (OA) และ API</p>
    </div>
</div>

<!-- Flash Alerts -->
<?php if($msg = \App\Core\Controller::getFlash('settings_success')): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if($msg = \App\Core\Controller::getFlash('settings_warning')): ?>
    <div class="alert alert-warning alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Navigation Tabs -->
<ul class="nav nav-pills modern-pills mb-4" id="settingsTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active rounded-pill px-4 py-2" id="social-tab" data-bs-toggle="pill" data-bs-target="#social" type="button" role="tab">
            <i class="bi bi-share-fill me-2"></i> โซเชียล & LINE OA / FB API
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-pill px-4 py-2" id="hospital-tab" data-bs-toggle="pill" data-bs-target="#hospital" type="button" role="tab">
            <i class="bi bi-hospital me-2"></i> ข้อมูลโรงพยาบาล & การติดต่อ
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-pill px-4 py-2" id="categories-tab" data-bs-toggle="pill" data-bs-target="#categories" type="button" role="tab">
            <i class="bi bi-tags me-2"></i> หมวดหมู่ข่าวสาร
        </button>
    </li>
</ul>

<div class="tab-content" id="settingsTabContent">
    <!-- TAB 1: SOCIAL & API INTEGRATION (FB & LINE OA) -->
    <div class="tab-pane fade show active" id="social" role="tabpanel">
        <div class="row g-4">
            <!-- LINE Official Account Settings Card -->
            <div class="col-lg-6">
                <div class="card-modern h-100 p-4">
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                        <div class="p-3 rounded-circle text-white d-flex align-items-center justify-content-center" style="background: #06c755; width: 52px; height: 52px;">
                            <i class="bi bi-line fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">LINE Official Account (LINE OA)</h5>
                            <small class="text-muted">เชื่อมต่อแชทบอท ลิงก์แอดเพื่อน และการแจ้งเตือน</small>
                        </div>
                    </div>

                    <form action="<?= URLROOT ?>/admin/settings/updateSocial" method="POST">
                        <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">LINE Official Account ID</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-at"></i></span>
                                <input type="text" name="line_oa_id" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['line_oa_id'] ?? '@pluakdaenghos') ?>" placeholder="@pluakdaenghos">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">ลิงก์แอดเพื่อน (Add Friend URL)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" name="line_add_friend_url" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['line_add_friend_url'] ?? 'https://page.line.me/pluakdaenghos') ?>" placeholder="https://page.line.me/...">
                            </div>
                            <small class="text-muted" style="font-size: 0.75rem;">ลิงก์สำหรับให้คนไข้กดเพื่อเปิดแอป LINE ทันที</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">ลิงก์รูปภาพ QR Code สำหรับแอดเพื่อน</label>
                            <input type="text" name="line_qr_code_url" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['line_qr_code_url'] ?? '') ?>" placeholder="https://... หรือ /assets/images/line-qr.png">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">LINE Messaging API (Channel Access Token)</label>
                            <textarea name="line_channel_access_token" rows="2" class="form-control form-control-modern font-monospace" placeholder="eyJhbGciOi... (สำหรับระบบส่งข้อความอัตโนมัติ)"><?= htmlspecialchars($settings['line_channel_access_token'] ?? '') ?></textarea>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-admin-primary px-4 rounded-pill">
                                <i class="bi bi-save me-1"></i> บันทึกการตั้งค่า LINE OA
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Facebook Page Integration Card -->
            <div class="col-lg-6">
                <div class="card-modern h-100 p-4">
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                        <div class="p-3 rounded-circle text-white d-flex align-items-center justify-content-center" style="background: #1877f2; width: 52px; height: 52px;">
                            <i class="bi bi-facebook fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Facebook Page & Messenger</h5>
                            <small class="text-muted">เชื่อมต่อแฟนเพจโรงพยาบาลและกล่องข้อความ</small>
                        </div>
                    </div>

                    <form action="<?= URLROOT ?>/admin/settings/updateSocial" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">ลิงก์แฟนเพจ Facebook (Page URL)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-facebook text-primary"></i></span>
                                <input type="url" name="facebook_page_url" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['facebook_page_url'] ?? 'https://www.facebook.com/pluakdaenghospital') ?>" placeholder="https://www.facebook.com/...">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Facebook Page ID / Username</label>
                            <input type="text" name="facebook_page_id" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['facebook_page_id'] ?? 'pluakdaenghospital') ?>" placeholder="pluakdaenghospital">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">ลิงก์แชท Messenger (Direct Chat Link)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-messenger text-primary"></i></span>
                                <input type="url" name="facebook_messenger_url" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['facebook_messenger_url'] ?? 'https://m.me/pluakdaenghospital') ?>" placeholder="https://m.me/...">
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-4 border mb-3">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="bi bi-code-slash text-primary"></i>
                                <span class="fw-bold small text-dark">REST API Endpoint สำหรับโซเชียลมีเดีย:</span>
                            </div>
                            <code class="small text-primary d-block bg-white p-2 rounded border">GET <?= URLROOT ?>/api/social</code>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-admin-primary px-4 rounded-pill">
                                <i class="bi bi-save me-1"></i> บันทึกการตั้งค่า Facebook
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- LINE Notify Integration Card -->
            <div class="col-12">
                <div class="card-modern p-4" style="background: linear-gradient(135deg, #f0fdf4, #ffffff); border: 1.5px solid rgba(16, 185, 129, 0.3);">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="p-2 rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="bi bi-bell-fill fs-5"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-0">ระบบแจ้งเตือนเข้ากลุ่มเจ้าหน้าที่ (LINE Notify)</h5>
                                    <small class="text-muted">แจ้งเตือนอัตโนมัติเมื่อมีเรื่องร้องเรียนใหม่ หรือมีผู้ส่งสลิปบริจาค</small>
                                </div>
                            </div>
                            
                            <form action="<?= URLROOT ?>/admin/settings/updateSocial" method="POST" class="d-flex gap-2">
                                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                <input type="text" name="line_notify_token" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['line_notify_token'] ?? '') ?>" placeholder="ระบุ LINE Notify Token สำหรับกลุ่มเจ้าหน้าที่">
                                <button type="submit" class="btn btn-success text-white rounded-pill px-4 flex-shrink-0">
                                    <i class="bi bi-save me-1"></i> บันทึก Token
                                </button>
                            </form>
                        </div>

                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <form action="<?= URLROOT ?>/admin/settings/testLineNotify" method="POST">
                                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                <input type="hidden" name="token" value="<?= htmlspecialchars($settings['line_notify_token'] ?? '') ?>">
                                <button type="submit" class="btn btn-outline-success rounded-pill px-4 py-2" <?= empty($settings['line_notify_token']) ? 'disabled' : '' ?>>
                                    <i class="bi bi-send-fill me-1"></i> ทดสอบส่งข้อความแจ้งเตือน
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: HOSPITAL PROFILE -->
    <div class="tab-pane fade" id="hospital" role="tabpanel">
        <div class="card-modern p-4">
            <h5 class="fw-bold text-dark mb-4"><i class="bi bi-building-gear me-2 text-primary"></i> ข้อมูลโรงพยาบาลและจุดติดต่อ</h5>
            <form action="<?= URLROOT ?>/admin/settings/updateHospital" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">ชื่อโรงพยาบาล (ภาษาไทย)</label>
                        <input type="text" name="hospital_name_th" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['hospital_name_th'] ?? 'โรงพยาบาลปลวกแดง') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">ชื่อโรงพยาบาล (ภาษาอังกฤษ)</label>
                        <input type="text" name="hospital_name_en" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['hospital_name_en'] ?? 'Pluak Daeng Hospital') ?>" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">เบอร์โทรศัพท์หลัก</label>
                        <input type="text" name="telephone" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['telephone'] ?? '038-659-188') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">สายด่วนฉุกเฉิน (Hotline 24 ชม.)</label>
                        <input type="text" name="emergency_phone" class="form-control form-control-modern text-danger fw-bold" value="<?= htmlspecialchars($settings['emergency_phone'] ?? '1669') ?>">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">อีเมลติดต่อ (Official Email)</label>
                        <input type="email" name="email" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['email'] ?? 'pluakdaenghospital@gmail.com') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">ที่อยู่</label>
                        <input type="text" name="address" class="form-control form-control-modern" value="<?= htmlspecialchars($settings['address'] ?? '111 ม.1 ต.ปลวกแดง อ.ปลวกแดง จ.ระยอง 21140') ?>">
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-admin-primary px-4 rounded-pill">
                        <i class="bi bi-save me-1"></i> บันทึกข้อมูลโรงพยาบาล
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- TAB 3: NEWS CATEGORIES -->
    <div class="tab-pane fade" id="categories" role="tabpanel">
        <div class="card-modern p-4">
            <h5 class="fw-bold text-dark mb-4"><i class="bi bi-tags me-2 text-primary"></i> หมวดหมู่ข่าวสาร & ประชาสัมพันธ์</h5>
            <form action="<?= URLROOT ?>/admin/settings/updateCategories" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                <div id="categoryContainer">
                    <?php if(!empty($news_categories)): ?>
                        <?php foreach($news_categories as $index => $cat): ?>
                            <div class="row mb-3 category-row g-3 align-items-center">
                                <div class="col-md-5">
                                    <label class="form-label small text-muted">รหัสหมวดหมู่ (Slug - ภาษาอังกฤษ)</label>
                                    <input type="text" class="form-control form-control-modern" name="category_slug[]" value="<?= htmlspecialchars($cat['slug']) ?>" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small text-muted">ชื่อหมวดหมู่</label>
                                    <input type="text" class="form-control form-control-modern" name="category_name[]" value="<?= htmlspecialchars($cat['name']) ?>" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-end pt-md-4">
                                    <button type="button" class="btn btn-outline-danger w-100 rounded-3 remove-btn"><i class="bi bi-trash"></i> ลบ</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <button type="button" class="btn btn-outline-primary rounded-pill mb-4" id="addCategoryBtn">
                    <i class="bi bi-plus-circle me-1"></i> เพิ่มหมวดหมู่ใหม่
                </button>

                <div class="text-end">
                    <button type="submit" class="btn btn-admin-primary px-4 rounded-pill">
                        <i class="bi bi-save me-1"></i> บันทึกหมวดหมู่ข่าว
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('categoryContainer');
    const addBtn = document.getElementById('addCategoryBtn');

    if (addBtn && container) {
        addBtn.addEventListener('click', function() {
            const row = document.createElement('div');
            row.className = 'row mb-3 category-row g-3 align-items-center';
            row.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label small text-muted">รหัสหมวดหมู่ (Slug - ภาษาอังกฤษ)</label>
                    <input type="text" class="form-control form-control-modern" name="category_slug[]" placeholder="เช่น jobs" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label small text-muted">ชื่อหมวดหมู่</label>
                    <input type="text" class="form-control form-control-modern" name="category_name[]" placeholder="เช่น ข่าวรับสมัครงาน" required>
                </div>
                <div class="col-md-2 d-flex align-items-end pt-md-4">
                    <button type="button" class="btn btn-outline-danger w-100 rounded-3 remove-btn"><i class="bi bi-trash"></i> ลบ</button>
                </div>
            `;
            container.appendChild(row);
        });

        container.addEventListener('click', function(e) {
            if(e.target.closest('.remove-btn')) {
                e.target.closest('.category-row').remove();
            }
        });
    }
});
</script>
