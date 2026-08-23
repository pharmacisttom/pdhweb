<div class="container-fluid py-4 px-md-5 mb-5">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="badge bg-primary px-3 py-1 rounded-pill mb-1">
                <i class="bi bi-hospital me-1"></i> ห้องตรวจที่ <?= htmlspecialchars($room_number) ?>
            </span>
            <h2 class="h3 fw-bold text-dark mb-0">สถานีเรียกคิวประจำห้องตรวจ</h2>
            <small class="text-muted">ควบคุมการเรียกคิวคนไข้ เรียกซ้ำ ตรวจเสร็จสิ้น และส่งต่อ</small>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <!-- Select Room -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle rounded-pill px-3" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-door-open me-1"></i> เปลี่ยนห้อง: ห้อง <?= htmlspecialchars($room_number) ?>
                </button>
                <ul class="dropdown-menu shadow rounded-4 p-2">
                    <?php for($r = 1; $r <= 8; $r++): ?>
                        <li><a class="dropdown-item rounded-3 py-2 <?= ($room_number == $r) ? 'active' : '' ?>" href="<?= URLROOT ?>/queue/room/<?= $r ?>?department_id=<?= $department_id ?>">ห้องตรวจ <?= $r ?></a></li>
                    <?php endfor; ?>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item rounded-3 py-2" href="<?= URLROOT ?>/queue/room/ห้องฟัน1?department_id=<?= $department_id ?>">ห้องทันตกรรม 1</a></li>
                    <li><a class="dropdown-item rounded-3 py-2" href="<?= URLROOT ?>/queue/room/ห้องยา1?department_id=<?= $department_id ?>">ห้องจ่ายยา 1</a></li>
                </ul>
            </div>

            <!-- Open Door Screen in New Window / TV -->
            <a href="<?= URLROOT ?>/queue/door/<?= htmlspecialchars($room_number) ?>?department_id=<?= $department_id ?>" target="_blank" class="btn btn-warning rounded-pill px-4 fw-bold text-dark shadow-sm">
                <i class="bi bi-tv me-1"></i> เปิดจอแสดงคิวหน้าห้อง (Door TV)
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left Column: Current Calling Queue & Control Panel -->
        <div class="col-lg-6">
            <div class="card-modern p-4 p-md-5 mb-4 shadow-lg text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a, #064e3b); color: #ffffff;">
                <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-3">
                    <i class="bi bi-broadcast me-1"></i> กำลังตรวจ ณ ขณะนี้ (Now Serving)
                </span>

                <?php if($currentQueue): ?>
                    <h1 class="display-1 fw-bold text-warning font-monospace mb-2" style="letter-spacing: 2px;">
                        <?= htmlspecialchars($currentQueue->queue_number) ?>
                    </h1>
                    <h4 class="fw-bold text-white mb-1"><?= htmlspecialchars($currentQueue->patient_name) ?></h4>
                    <p class="text-white-50 small mb-4">
                        เรียกเมื่อ: <?= date('H:i:s น.', strtotime($currentQueue->called_at ?? $currentQueue->updated_at)) ?>
                    </p>

                    <!-- Control Buttons -->
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <!-- Recall Voice -->
                        <button type="button" onclick="announceQueue('<?= $currentQueue->queue_number ?>', '<?= $room_number ?>')" class="btn btn-outline-light rounded-pill px-4 py-2 fw-bold">
                            <i class="bi bi-volume-up-fill me-1"></i> ประกาศเรียกซ้ำ (Recall)
                        </button>

                        <!-- Complete -->
                        <form action="<?= URLROOT ?>/queue/callAction" method="POST" class="d-inline">
                            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            <input type="hidden" name="act" value="complete">
                            <input type="hidden" name="room_number" value="<?= htmlspecialchars($room_number) ?>">
                            <input type="hidden" name="department_id" value="<?= $department_id ?>">
                            <input type="hidden" name="queue_id" value="<?= $currentQueue->id ?>">
                            <button type="submit" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow">
                                <i class="bi bi-check2-circle me-1"></i> ตรวจเสร็จสิ้น (Complete)
                            </button>
                        </form>

                        <!-- Skip / Hold -->
                        <form action="<?= URLROOT ?>/queue/callAction" method="POST" class="d-inline">
                            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            <input type="hidden" name="act" value="skip">
                            <input type="hidden" name="room_number" value="<?= htmlspecialchars($room_number) ?>">
                            <input type="hidden" name="department_id" value="<?= $department_id ?>">
                            <input type="hidden" name="queue_id" value="<?= $currentQueue->id ?>">
                            <button type="submit" class="btn btn-outline-danger rounded-pill px-3 py-2">
                                <i class="bi bi-skip-end-fill me-1"></i> พักคิว/ข้ามคิว
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="py-4">
                        <i class="bi bi-door-open fs-1 text-white-50 d-block mb-3"></i>
                        <h4 class="text-white-50 mb-4">ยังไม่มีคิวที่กำลังตรวจในห้องนี้</h4>
                        <div class="p-3 bg-white bg-opacity-10 rounded-4 d-inline-block small text-white-50">
                            กดปุ่ม <strong>[ เรียกคิวถัดไป ]</strong> ด้านล่างเพื่อเริ่มตรวจคนไข้
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Big Call Next Button -->
            <form action="<?= URLROOT ?>/queue/callAction" method="POST">
                <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input type="hidden" name="act" value="call_next">
                <input type="hidden" name="room_number" value="<?= htmlspecialchars($room_number) ?>">
                <input type="hidden" name="department_id" value="<?= $department_id ?>">

                <button type="submit" class="btn btn-primary w-100 py-3 rounded-4 fw-bold fs-5 shadow-lg d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-megaphone-fill fs-4"></i>
                    <span>กดเรียกคิวถัดไป (Call Next Patient)</span>
                </button>
            </form>
        </div>

        <!-- Right Column: Waiting Queue List -->
        <div class="col-lg-6">
            <div class="card-modern p-4 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="bi bi-people-fill text-primary me-2"></i>รายชื่อคิวที่รอตรวจหน้าห้อง (<?= count($waitingQueues) ?> คน)
                    </h5>
                    <button class="btn btn-sm btn-light border rounded-pill px-3" onclick="location.reload();">
                        <i class="bi bi-arrow-clockwise me-1"></i> รีเฟรช
                    </button>
                </div>

                <div class="table-responsive" style="max-height: 520px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>ลำดับ</th>
                                <th>หมายเลขคิว</th>
                                <th>ชื่อผู้ป่วย</th>
                                <th>เวลารอ</th>
                                <th class="text-end">เรียกคิวนี้</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($waitingQueues)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-emoji-smile fs-1 d-block mb-2 text-muted"></i>
                                        ไม่มีคนไข้รอคิวในขณะนี้
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($waitingQueues as $index => $wq): ?>
                                    <tr>
                                        <td><span class="badge bg-light text-dark border"><?= $index + 1 ?></span></td>
                                        <td><strong class="fs-6 text-primary font-monospace"><?= htmlspecialchars($wq->queue_number) ?></strong></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($wq->patient_name) ?></div>
                                            <small class="text-muted"><?= htmlspecialchars($wq->service_type ?? 'ตรวจโรคทั่วไป') ?></small>
                                        </td>
                                        <td class="small text-muted"><?= date('H:i น.', strtotime($wq->created_at)) ?></td>
                                        <td class="text-end">
                                            <form action="<?= URLROOT ?>/queue/callAction" method="POST" class="d-inline">
                                                <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                                                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                                <input type="hidden" name="act" value="call_specific">
                                                <input type="hidden" name="room_number" value="<?= htmlspecialchars($room_number) ?>">
                                                <input type="hidden" name="department_id" value="<?= $department_id ?>">
                                                <input type="hidden" name="queue_id" value="<?= $wq->id ?>">
                                                
                                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                    <i class="bi bi-bell-fill me-1"></i> เรียก
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let audioCtx = null;

function getAudioContext() {
    if (!audioCtx) {
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }
    if (audioCtx.state === 'suspended') {
        audioCtx.resume();
    }
    return audioCtx;
}

// Web Audio Chime & Thai Speech Synthesizer
function playChime() {
    try {
        const ctx = getAudioContext();
        const osc1 = ctx.createOscillator();
        const gain1 = ctx.createGain();
        osc1.type = 'sine';
        osc1.frequency.setValueAtTime(659.25, ctx.currentTime); // E5
        gain1.gain.setValueAtTime(0.5, ctx.currentTime);
        gain1.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.6);
        osc1.connect(gain1);
        gain1.connect(ctx.destination);
        osc1.start(ctx.currentTime);
        osc1.stop(ctx.currentTime + 0.6);

        const osc2 = ctx.createOscillator();
        const gain2 = ctx.createGain();
        osc2.type = 'sine';
        osc2.frequency.setValueAtTime(880.00, ctx.currentTime + 0.25); // A5
        gain2.gain.setValueAtTime(0.5, ctx.currentTime + 0.25);
        gain2.exponentialRampToValueAtTime(0.001, ctx.currentTime + 1.2);
        osc2.connect(gain2);
        gain2.connect(ctx.destination);
        osc2.start(ctx.currentTime + 0.25);
        osc2.stop(ctx.currentTime + 1.2);
    } catch(e) {
        console.log("Audio chime error:", e);
    }
}

function announceQueue(queueNumber, roomNumber) {
    playChime();
    setTimeout(() => {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();

            let spelledNumber = queueNumber.split('').map(c => {
                if (c === 'A' || c === 'a') return 'เอ';
                if (c === 'P' || c === 'p') return 'พี';
                if (c === 'D' || c === 'd') return 'ดี';
                if (c === 'L' || c === 'l') return 'แอล';
                if (c === 'R' || c === 'r') return 'อาร์';
                if (c === 'E' || c === 'e') return 'อี';
                if (c === '-') return 'ขีด';
                if (c === '0') return 'ศูนย์';
                return c;
            }).join(' ');

            const text = 'ขอเชิญหมายเลข ' + spelledNumber + ' ที่ห้องตรวจ ' + roomNumber + ' ค่ะ';
            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = 'th-TH';
            utter.rate = 0.92;
            utter.pitch = 1.05;

            const voices = window.speechSynthesis.getVoices();
            const thaiVoice = voices.find(v => v.lang === 'th-TH' || v.lang.includes('th') || v.name.includes('Thai') || v.name.includes('Premwadee') || v.name.includes('Niwat'));
            if (thaiVoice) {
                utter.voice = thaiVoice;
            }

            window.speechSynthesis.speak(utter);
        }
    }, 600);
}

// Pre-load speech voices
if ('speechSynthesis' in window) {
    window.speechSynthesis.onvoiceschanged = () => {
        window.speechSynthesis.getVoices();
    };
}
</script>
