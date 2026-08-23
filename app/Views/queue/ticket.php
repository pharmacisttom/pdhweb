<div class="container my-5 pb-5">
    <div class="mb-4 text-center">
        <a href="<?= URLROOT ?>/queue/kiosk" class="btn btn-outline-secondary rounded-pill px-3 btn-sm me-2">
            <i class="bi bi-plus-circle me-1"></i> กดรับบัตรคิวใหม่
        </a>
        <a href="<?= URLROOT ?>/queue/display/<?= $queue->department_id ?>" target="_blank" class="btn btn-outline-info rounded-pill px-3 btn-sm">
            <i class="bi bi-tv me-1"></i> ดูจอดิจิทัลเรียกคิว (TV)
        </a>
    </div>

    <!-- Live Called Alert Modal / Banner (Appears when doctor calls this queue) -->
    <div id="callingAlertBanner" class="alert alert-warning border-0 rounded-4 shadow-lg p-4 mb-4 text-center d-none" style="background: linear-gradient(135deg, #f59e0b, #ef4444); color: #ffffff; animation: pulseAlert 1.5s infinite;">
        <i class="bi bi-megaphone-fill display-3 d-block mb-2"></i>
        <h2 class="fw-bold mb-1">🎉 ถึงคิวของท่านแล้ว!</h2>
        <h4 class="mb-2" id="callingCounterNotice">กรุณาติดต่อที่ ห้องตรวจ / ช่องบริการที่ <?= htmlspecialchars($queue->counter_number) ?></h4>
        <small class="text-white-50">กรุณาแสดงหน้าจอนี้ต่อเจ้าหน้าที่ประจำห้องตรวจ</small>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <!-- Digital Smart Ticket Card -->
            <div class="card-modern text-center p-4 p-md-5 overflow-hidden shadow-lg position-relative" style="border-radius: 28px; background: #ffffff;">
                <!-- Hospital Header -->
                <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                    <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="rounded-circle border" width="40" height="40" style="object-fit: cover;">
                    <div class="text-start">
                        <h6 class="fw-bold mb-0 text-dark">โรงพยาบาลปลวกแดง</h6>
                        <small class="text-muted" style="font-size: 0.72rem;">Smart Mobile Queue Ticket</small>
                    </div>
                </div>

                <div class="py-1 px-3 bg-light rounded-pill d-inline-block small text-muted mb-3 border">
                    <i class="bi bi-building me-1 text-primary"></i> แผนก: <strong class="text-dark"><?= htmlspecialchars($queue->department_name ?? 'ตรวจโรคทั่วไป') ?></strong>
                </div>

                <!-- Big Queue Number -->
                <div class="py-2">
                    <small class="text-muted fw-bold text-uppercase d-block mb-1" style="letter-spacing: 0.05em;">หมายเลขคิวของคุณ</small>
                    <div class="display-2 fw-bold text-primary my-1 font-monospace" style="font-size: 4.5rem; letter-spacing: 2px;">
                        <?= htmlspecialchars($queue->queue_number) ?>
                    </div>
                    <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($queue->patient_name) ?></h5>
                    <div id="liveStatusBadge">
                        <?php if($queue->status === 'calling'): ?>
                            <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold fs-6">
                                <i class="bi bi-broadcast me-1"></i> กำลังเรียกตรวจ (ห้อง <?= htmlspecialchars($queue->counter_number) ?>)
                            </span>
                        <?php elseif($queue->status === 'completed'): ?>
                            <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-bold">
                                <i class="bi bi-check2-circle me-1"></i> ตรวจเสร็จสิ้นแล้ว
                            </span>
                        <?php else: ?>
                            <span class="badge bg-primary-light text-primary px-3 py-1 rounded-pill fw-bold">
                                <span class="spinner-grow spinner-grow-sm me-1" style="width: 8px; height: 8px;"></span> รอเรียกตรวจ
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <hr class="my-3 border-dashed">

                <!-- Real-time Waiting Indicator -->
                <div class="row g-2 my-2 text-start">
                    <div class="col-6">
                        <div class="p-3 bg-primary-light rounded-4 border border-primary border-opacity-25 h-100">
                            <small class="text-muted d-block" style="font-size: 0.75rem;">คิวที่รอก่อนหน้า</small>
                            <span class="fs-4 fw-bold text-primary" id="liveAheadCount"><?= $aheadCount ?></span> <small class="text-muted">คิว</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-warning-light rounded-4 border border-warning border-opacity-25 h-100" style="background: #fffbeb;">
                            <small class="text-muted d-block" style="font-size: 0.75rem;">เวลารอโดยประมาณ</small>
                            <span class="fs-4 fw-bold text-warning" id="liveEstimatedMins" style="color: #d97706 !important;">~<?= $estimatedMins ?></span> <small class="text-muted">นาที</small>
                        </div>
                    </div>
                </div>

                <!-- QR Code for Mobile Following & Kiosk Scan -->
                <div class="my-3 p-3 bg-light rounded-4 d-inline-block border shadow-sm">
                    <?php
                        $ticketUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($ticketUrl);
                    ?>
                    <img src="<?= $qrUrl ?>" alt="QR Code" class="img-fluid rounded" width="140" height="140">
                    <small class="d-block text-muted mt-2 fw-medium" style="font-size: 0.75rem;">
                        <i class="bi bi-qr-code-scan me-1 text-primary"></i>สแกนเพื่อติดตามคิวบนมือถือ
                    </small>
                </div>

                <div class="text-muted small mb-3">
                    <i class="bi bi-clock me-1"></i> เวลาที่ออกบัตร: <?= date('d/m/Y H:i น.', strtotime($queue->created_at ?? date('Y-m-d H:i:s'))) ?>
                </div>

                <!-- Connect LINE OA Reminder Button -->
                <div class="mb-3">
                    <a href="<?= htmlspecialchars($lineUrl) ?>" target="_blank" class="btn btn-success w-100 py-2 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-line fs-5"></i>
                        <span>แจ้งเตือนสถานะผ่าน LINE OA</span>
                    </a>
                </div>

                <!-- Print Ticket Button -->
                <div class="d-grid gap-2">
                    <button class="btn btn-light border rounded-pill py-2" onclick="window.print();">
                        <i class="bi bi-printer-fill me-1"></i> พิมพ์บัตรคิว (Print Ticket)
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes pulseAlert {
    0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
    50% { transform: scale(1.02); box-shadow: 0 0 0 15px rgba(245, 158, 11, 0); }
    100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
}

@media print {
    body * { visibility: hidden; }
    .card-modern, .card-modern * { visibility: visible; }
    .card-modern {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none !important;
        border: 1px solid #ccc !important;
    }
}
</style>

<script>
let currentStatus = "<?= $queue->status ?>";
const queueId = <?= (int)$queue->id ?>;
const queueNum = "<?= htmlspecialchars($queue->queue_number) ?>";

// Web Audio Chime
function playChime() {
    try {
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        const osc1 = audioCtx.createOscillator();
        const osc2 = audioCtx.createOscillator();
        const gain = audioCtx.createGain();

        osc1.type = 'sine';
        osc1.frequency.setValueAtTime(659.25, audioCtx.currentTime); // E5
        osc2.type = 'sine';
        osc2.frequency.setValueAtTime(880.00, audioCtx.currentTime + 0.15); // A5

        gain.gain.setValueAtTime(0.5, audioCtx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.9);

        osc1.connect(gain);
        osc2.connect(gain);
        gain.connect(audioCtx.destination);

        osc1.start();
        osc1.stop(audioCtx.currentTime + 0.3);
        osc2.start(audioCtx.currentTime + 0.15);
        osc2.stop(audioCtx.currentTime + 0.9);
    } catch(e) {
        console.log(e);
    }
}

// Thai Speech Synthesizer on Phone
function announceMyQueue(queueNumber, counterNumber) {
    playChime();
    // Vibrate Phone if supported
    if ('vibrate' in navigator) {
        navigator.vibrate([400, 200, 400, 200, 800]);
    }

    setTimeout(() => {
        if ('speechSynthesis' in window) {
            let spelledNumber = queueNumber.split('').map(c => {
                if (c === 'A') return 'เอ';
                if (c === 'P') return 'พี';
                if (c === 'D') return 'ดี';
                if (c === 'L') return 'แอล';
                if (c === 'R') return 'อาร์';
                if (c === 'E') return 'อี';
                if (c === '-') return 'ขีด';
                if (c === '0') return 'ศูนย์';
                return c;
            }).join(' ');

            const text = 'ขอเชิญหมายเลข ' + spelledNumber + ' ที่ห้องตรวจ ' + counterNumber + ' ค่ะ';
            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = 'th-TH';
            utter.rate = 0.9;
            window.speechSynthesis.speak(utter);
        }
    }, 600);
}

// Auto Polling Ticket Status every 2.5 seconds
function checkTicketLive() {
    fetch('<?= URLROOT ?>/queue/liveTicketStatus/' + queueId)
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                document.getElementById('liveAheadCount').innerText = data.ahead_count;
                document.getElementById('liveEstimatedMins').innerText = '~' + data.estimated_wait_minutes;

                // If status changed to calling
                if (data.status === 'calling' && currentStatus !== 'calling') {
                    currentStatus = 'calling';
                    document.getElementById('callingAlertBanner').classList.remove('d-none');
                    document.getElementById('callingCounterNotice').innerText = 'กรุณาติดต่อที่ ห้องตรวจ / ช่องบริการที่ ' + data.counter_number;
                    document.getElementById('liveStatusBadge').innerHTML = `
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold fs-6">
                            <i class="bi bi-broadcast me-1"></i> กำลังเรียกตรวจ (ห้อง ${data.counter_number})
                        </span>
                    `;
                    announceMyQueue(data.queue_number, data.counter_number);
                } else if (data.status === 'completed' && currentStatus !== 'completed') {
                    currentStatus = 'completed';
                    document.getElementById('callingAlertBanner').classList.add('d-none');
                    document.getElementById('liveStatusBadge').innerHTML = `
                        <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-bold">
                            <i class="bi bi-check2-circle me-1"></i> ตรวจเสร็จสิ้นแล้ว
                        </span>
                    `;
                }
            }
        })
        .catch(err => console.log(err));
}

setInterval(checkTicketLive, 2500);
</script>
