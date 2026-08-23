<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">จัดการป้ายแบนเนอร์ & สไลเดอร์ (Banner Carousel)</h3>
        <p class="text-muted small mb-0"><i class="bi bi-images me-1"></i> จัดการรูปภาพแบนเนอร์สไลด์หน้าแรก สลับลำดับ และกำหนดความเร็วในการเปลี่ยนภาพ</p>
    </div>
    <a href="<?= URLROOT ?>/admin/banner/create" class="btn btn-modern-primary rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> เพิ่มป้ายแบนเนอร์ใหม่
    </a>
</div>

<!-- Flash Alerts -->
<?php if($msg = \App\Core\Controller::getFlash('banner_success')): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if($msg = \App\Core\Controller::getFlash('banner_error')): ?>
    <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Slider Speed & Animation Settings Bar -->
<div class="card-modern p-4 mb-4" style="background: linear-gradient(135deg, #f8fafc, #ffffff); border: 1.5px solid rgba(13, 148, 136, 0.2);">
    <form action="<?= URLROOT ?>/admin/banner/updateSliderSettings" method="POST" class="row g-3 align-items-center">
        <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

        <div class="col-md-5">
            <label class="form-label fw-bold small text-muted"><i class="bi bi-stopwatch text-primary me-1"></i> ความเร็วในการสลับภาพอัตโนมัติ (Slider Interval)</label>
            <select name="banner_slider_interval" class="form-select form-control-modern">
                <option value="3000" <?= ($slider_interval == '3000') ? 'selected' : '' ?>>3 วินาที (สลับเร็ว)</option>
                <option value="5000" <?= ($slider_interval == '5000') ? 'selected' : '' ?>>5 วินาที (ค่ามาตรฐานแนะนำ)</option>
                <option value="7000" <?= ($slider_interval == '7000') ? 'selected' : '' ?>>7 วินาที (สลับช้า)</option>
                <option value="10000" <?= ($slider_interval == '10000') ? 'selected' : '' ?>>10 วินาที (อ่านสบายตา)</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold small text-muted"><i class="bi bi-magic text-primary me-1"></i> เอฟเฟกต์การสลับรูปภาพ (Transition Effect)</label>
            <select name="banner_transition_effect" class="form-select form-control-modern">
                <option value="fade" <?= ($transition_effect == 'fade') ? 'selected' : '' ?>>Fade (ค่อยๆ จางและสลับภาพ นุ่มนวล)</option>
                <option value="slide" <?= ($transition_effect == 'slide') ? 'selected' : '' ?>>Slide (เลื่อนภาพจากขวาไปซ้าย)</option>
            </select>
        </div>

        <div class="col-md-3 text-md-end pt-md-4">
            <button type="submit" class="btn btn-admin-primary rounded-pill px-4 w-100">
                <i class="bi bi-save me-1"></i> บันทึกการตั้งค่าสไลด์
            </button>
        </div>
    </form>
</div>

<!-- Banner List Table -->
<div class="card-modern">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-images text-primary me-2"></i> รายการแบนเนอร์ทั้งหมด</h5>
        <span class="badge bg-light text-muted border px-3 py-2 rounded-pill">จำนวนทั้งหมด: <?= count($banners) ?> รูป</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern align-middle mb-0">
                <thead>
                    <tr>
                        <th width="12%" class="text-center">สลับลำดับ</th>
                        <th width="20%">รูปภาพพรีวิว</th>
                        <th width="30%">หัวข้อแบนเนอร์ & ลิงก์</th>
                        <th width="15%" class="text-center">สถานะแสดงผล</th>
                        <th width="13%">ผู้สร้าง</th>
                        <th width="10%" class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($banners)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-images display-4 text-muted mb-3 d-block"></i>
                                ยังไม่มีป้ายแบนเนอร์ในระบบ
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($banners as $index => $banner): ?>
                            <tr>
                                <!-- Reorder Buttons (Up & Down) -->
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <form action="<?= URLROOT ?>/admin/banner/move/<?= $banner->id ?>/up" method="POST" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                            <button type="submit" class="btn btn-sm btn-light border rounded-circle p-1" style="width: 32px; height: 32px;" title="เลื่อนขึ้น">
                                                <i class="bi bi-arrow-up text-dark"></i>
                                            </button>
                                        </form>
                                        <span class="badge bg-light text-dark border px-2 py-1 fw-bold"><?= $banner->sort_order ?></span>
                                        <form action="<?= URLROOT ?>/admin/banner/move/<?= $banner->id ?>/down" method="POST" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                            <button type="submit" class="btn btn-sm btn-light border rounded-circle p-1" style="width: 32px; height: 32px;" title="เลื่อนลง">
                                                <i class="bi bi-arrow-down text-dark"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                <!-- Image Preview -->
                                <td>
                                    <div class="rounded-3 overflow-hidden border shadow-sm" style="width: 140px; height: 75px; background: #0f172a;">
                                        <img src="<?= URLROOT ?>/assets/images/banners/<?= $banner->image_file ?>" alt="Banner" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='https://placehold.co/140x75?text=No+Image'">
                                    </div>
                                </td>

                                <!-- Title & Link -->
                                <td>
                                    <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($banner->title) ?></div>
                                    <?php if(!empty($banner->link)): ?>
                                        <a href="<?= htmlspecialchars($banner->link) ?>" target="_blank" class="text-primary small text-truncate d-inline-block" style="max-width: 280px;">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> <?= htmlspecialchars($banner->link) ?>
                                        </a>
                                    <?php else: ?>
                                        <small class="text-muted"><i class="bi bi-dash"></i> ไม่มีลิงก์ปลายทาง</small>
                                    <?php endif; ?>
                                </td>

                                <!-- Toggle Active / Inactive Status Switch -->
                                <td class="text-center">
                                    <form action="<?= URLROOT ?>/admin/banner/toggle/<?= $banner->id ?>" method="POST" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                        <?php if($banner->status == 'active'): ?>
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 py-1 shadow-sm" title="คลิกเพื่อปิดใช้งาน">
                                                <i class="bi bi-check-circle-fill me-1"></i> กำลังแสดงผล
                                            </button>
                                        <?php else: ?>
                                            <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1" title="คลิกเพื่อเปิดแสดงผล">
                                                <i class="bi bi-eye-slash-fill me-1"></i> ปิดใช้งาน
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </td>

                                <!-- Created By -->
                                <td class="text-muted small">
                                    <?= htmlspecialchars($banner->firstname ?? 'Admin') ?>
                                </td>

                                <!-- Actions -->
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="<?= URLROOT ?>/admin/banner/edit/<?= $banner->id ?>" class="btn btn-sm btn-light border rounded-start-3 text-primary" title="แก้ไข">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="<?= URLROOT ?>/admin/banner/delete/<?= $banner->id ?>" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบแบนเนอร์นี้ใช่หรือไม่?');">
                                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                            <button type="submit" class="btn btn-sm btn-light border rounded-end-3 text-danger" title="ลบ">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
