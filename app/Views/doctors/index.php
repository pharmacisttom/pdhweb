<!-- Doctor Directory Header -->
<div class="hero-wrapper py-5 mb-4 text-center">
    <div class="container">
        <div class="section-badge mb-3"><i class="bi bi-people-fill text-primary"></i> Medical Specialists</div>
        <h1 class="hero-title mb-2">ทำเนียบแพทย์ & ผู้เชี่ยวชาญ</h1>
        <p class="hero-subtitle mx-auto" style="max-width: 600px;">
            ทีมแพทย์ผู้เชี่ยวชาญหลากหลายสาขาของโรงพยาบาลปลวกแดง พร้อมให้คำปรึกษาและรักษาด้วยมาตรฐานระดับสูง
        </p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <!-- Live Search & Filter Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="glass-card p-3 shadow-md">
                <div class="row g-2">
                    <div class="col-md-7">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 text-muted ps-3">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" id="doctorSearchInput" class="form-control border-0 shadow-none ps-2" placeholder="ค้นหาด้วยชื่อแพทย์ หรือสาขาความเชี่ยวชาญ...">
                        </div>
                    </div>
                    <div class="col-md-5 d-flex gap-2">
                        <select id="specialtyFilter" class="form-select border-0 bg-light rounded-pill shadow-none">
                            <option value="">ทุกสาขาความเชี่ยวชาญ</option>
                            <option value="อายุรกรรม">อายุรกรรม</option>
                            <option value="ศัลยกรรม">ศัลยกรรม</option>
                            <option value="กุมารเวชกรรม">กุมารเวชกรรม (เด็ก)</option>
                            <option value="สูตินรีเวชกรรม">สูตินรีเวชกรรม</option>
                            <option value="ออร์โธปิดิกส์">กระดูกและข้อ (ออร์โธปิดิกส์)</option>
                            <option value="ทันตกรรม">ทันตกรรม</option>
                            <option value="เวชศาสตร์ครอบครัว">เวชศาสตร์ครอบครัว</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Doctor Cards Grid -->
    <div class="row g-4" id="doctorCardsContainer">
        <?php if(empty($doctors)): ?>
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded-4 shadow-sm d-inline-block">
                    <i class="bi bi-person-x display-4 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted mb-0">ยังไม่มีข้อมูลแพทย์ในระบบ</h5>
                </div>
            </div>
        <?php else: ?>
            <?php foreach($doctors as $doctor): ?>
                <div class="col-md-6 col-lg-3 doctor-item" data-name="<?= htmlspecialchars($doctor->firstname . ' ' . $doctor->lastname) ?>" data-specialty="<?= htmlspecialchars($doctor->specialty ?? '') ?>">
                    <div class="doctor-card">
                        <div class="doctor-img-wrap">
                            <?php if(!empty($doctor->profile_image) && $doctor->profile_image != 'default-doctor.jpg'): ?>
                                <img src="<?= URLROOT ?>/assets/images/doctors/<?= $doctor->profile_image ?>" alt="<?= htmlspecialchars($doctor->firstname) ?>" onerror="this.src='https://placehold.co/400x500?text=Doctor'">
                            <?php else: ?>
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-secondary">
                                    <i class="bi bi-person-circle display-1 opacity-25"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div class="doctor-status-badge">
                                <span class="pulse-dot"></span> พร้อมให้บริการ
                            </div>
                        </div>

                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 fw-semibold small align-self-start mb-2">
                                <?= htmlspecialchars($doctor->specialty ?: 'แพทย์ทั่วไป') ?>
                            </span>

                            <h5 class="fw-bold text-dark mb-1">
                                <?= htmlspecialchars($doctor->prefix) ?><?= htmlspecialchars($doctor->firstname) ?> <?= htmlspecialchars($doctor->lastname) ?>
                            </h5>
                            
                            <p class="text-muted small mb-3">
                                <?= htmlspecialchars($doctor->position ?: 'แพทย์ประจำโรงพยาบาล') ?>
                            </p>

                            <?php if(!empty($doctor->biography)): ?>
                                <p class="text-muted small mb-3 flex-grow-1" style="font-size: 0.82rem; line-height: 1.5;">
                                    <?= mb_strimwidth(htmlspecialchars($doctor->biography), 0, 80, '...') ?>
                                </p>
                            <?php endif; ?>

                            <div class="pt-3 border-top mt-auto">
                                <a href="<?= URLROOT ?>/clinic" class="btn btn-sm btn-modern-outline w-100 justify-content-center">
                                    <i class="bi bi-calendar-event"></i> ดูตารางออกตรวจ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Client-side Fast Live Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('doctorSearchInput');
    const specialtyFilter = document.getElementById('specialtyFilter');
    const items = document.querySelectorAll('.doctor-item');

    function filterDoctors() {
        const query = searchInput.value.toLowerCase().trim();
        const spec = specialtyFilter.value.toLowerCase().trim();

        items.forEach(item => {
            const name = (item.dataset.name || '').toLowerCase();
            const specialty = (item.dataset.specialty || '').toLowerCase();

            const matchesQuery = !query || name.includes(query) || specialty.includes(query);
            const matchesSpec = !spec || specialty.includes(spec);

            if (matchesQuery && matchesSpec) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    if (searchInput) searchInput.addEventListener('input', filterDoctors);
    if (specialtyFilter) specialtyFilter.addEventListener('change', filterDoctors);
});
</script>
