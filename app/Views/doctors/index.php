<style>
/* Scoped styles for Doctors Directory */
.hero-header {
    background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
    color: white;
    padding: 80px 0;
    text-align: center;
    margin-top: -76px; /* Offset for navbar */
    margin-bottom: 40px;
}

.doctor-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,.05), 0 2px 4px -1px rgba(0,0,0,.03);
    transition: all 0.3s ease;
}

.doctor-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0,0,0,.1), 0 10px 10px -5px rgba(0,0,0,.04);
}

.doctor-avatar-wrapper {
    width: 140px;
    height: 140px;
    margin: -70px auto 20px;
    border-radius: 50%;
    background: white;
    padding: 6px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,.1);
}

.doctor-avatar {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    background-color: var(--bg-color);
}
</style>

<div class="hero-header">
    <div class="container mt-5">
        <h1 class="display-5 fw-bold mb-3">ทำเนียบแพทย์</h1>
        <p class="lead mb-0 text-white-50">ทีมแพทย์ผู้เชี่ยวชาญของโรงพยาบาลปลวกแดง พร้อมให้การดูแลท่าน</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <!-- Filter (Optional, can be added later) -->
    <div class="row mb-5 justify-content-center mt-4">
        <div class="col-md-8 col-lg-6 text-center">
            <div class="input-group input-group-lg shadow-sm" style="border-radius: 50px; overflow: hidden;">
                <input type="text" class="form-control border-0 px-4" placeholder="ค้นหาชื่อแพทย์ หรือ ความเชี่ยวชาญ...">
                <button class="btn btn-primary px-4" type="button"><i class="bi bi-search"></i> ค้นหา</button>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-5">
        <?php if(empty($doctors)): ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-person-x display-1 text-muted mb-3 d-block"></i>
                <p class="text-muted fs-5">ยังไม่มีข้อมูลแพทย์ในระบบ</p>
            </div>
        <?php else: ?>
            <?php foreach($doctors as $doctor): ?>
                <div class="col-md-6 col-lg-3 mt-5 pt-3">
                    <div class="card doctor-card h-100 text-center">
                        <div class="doctor-avatar-wrapper">
                            <?php if(!empty($doctor->profile_image) && $doctor->profile_image != 'default-doctor.jpg'): ?>
                                <img src="<?= URLROOT ?>/assets/images/doctors/<?= $doctor->profile_image ?>" alt="Doctor" class="doctor-avatar">
                            <?php else: ?>
                                <div class="doctor-avatar d-flex justify-content-center align-items-center">
                                    <i class="bi bi-person-fill text-secondary" style="font-size: 4rem;"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-body px-4 pb-4 pt-0">
                            <h5 class="card-title fw-bold text-dark mb-1"><?= $doctor->prefix ?><?= $doctor->firstname ?> <?= $doctor->lastname ?></h5>
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 my-2 fs-6 fw-medium">
                                <?= $doctor->specialty ?>
                            </span>
                            
                            <p class="card-text text-muted small mt-2 mb-0"><?= $doctor->position ?></p>
                            
                            <?php if(!empty($doctor->biography)): ?>
                                <hr class="my-3 mx-4 opacity-25">
                                <p class="card-text text-muted small text-start px-2 mb-0" style="line-height: 1.6;">
                                    <i class="bi bi-quote fs-5 text-secondary opacity-50"></i>
                                    <?= mb_strimwidth($doctor->biography, 0, 100, '...') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
