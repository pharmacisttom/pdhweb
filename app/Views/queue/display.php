<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Queue Display - <?= htmlspecialchars($department->name ?? 'โรงพยาบาลปลวกแดง') ?></title>
    
    <!-- Google Fonts: Prompt & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Prompt:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary: #0d9488;
            --primary-dark: #0f766e;
            --bg-dark: #090d16;
            --bg-card: #131b2e;
            --accent-yellow: #fbbf24;
            --accent-cyan: #38bdf8;
        }

        body {
            font-family: 'Prompt', 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            overflow: hidden;
            height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            user-select: none;
        }

        /* Top TV Header */
        .tv-header {
            background: linear-gradient(90deg, #0f172a, #0f766e);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .tv-brand-logo {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            object-fit: cover;
            border: 2px solid #ffffff;
        }

        /* LED Display Board */
        .calling-board {
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            border: 2px solid rgba(245, 158, 11, 0.4);
            border-radius: 28px;
            box-shadow: 0 0 50px rgba(245, 158, 11, 0.15);
            padding: 32px 24px;
            text-align: center;
            position: relative;
        }

        .calling-number {
            font-size: 8rem;
            font-weight: 800;
            color: var(--accent-yellow);
            line-height: 1.1;
            text-shadow: 0 0 35px rgba(251, 191, 36, 0.5);
            letter-spacing: 2px;
        }

        .calling-counter {
            font-size: 3rem;
            font-weight: 700;
            color: #ffffff;
            background: rgba(13, 148, 136, 0.4);
            border: 1px solid rgba(45, 212, 191, 0.5);
            border-radius: 9999px;
            padding: 8px 32px;
            display: inline-block;
        }

        /* Counter Matrix Cards */
        .counter-card {
            background: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 20px 24px;
            transition: all 0.3s;
        }

        .counter-card.active {
            border-color: rgba(56, 189, 248, 0.5);
            background: rgba(56, 189, 248, 0.08);
        }

        /* Bottom Ticker */
        .ticker-bar {
            background: #020617;
            padding: 12px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            color: #94a3b8;
        }

        .pulse-dot-big {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulseBig 1.8s infinite;
            display: inline-block;
        }

        @keyframes pulseBig {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>
</head>
<body>

    <!-- TV Header -->
    <div class="tv-header">
        <div class="d-flex align-items-center gap-3">
            <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="tv-brand-logo" onerror="this.src='https://placehold.co/52x52?text=PDH'">
            <div>
                <h3 class="mb-0 fw-bold text-white">โรงพยาบาลปลวกแดง</h3>
                <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold">
                    <span class="pulse-dot-big me-1"></span> แผนก<?= htmlspecialchars($department->name ?? 'OPD') ?>
                </span>
            </div>
        </div>

        <div class="d-flex align-items-center gap-4">
            <button class="btn btn-outline-light btn-sm rounded-pill px-3" onclick="toggleFullscreen();" title="กดเพื่อเปิดเต็มจอ">
                <i class="bi bi-arrows-fullscreen me-1"></i> จอเต็ม (Fullscreen)
            </button>
            <button class="btn btn-warning btn-sm rounded-pill px-3 fw-bold" id="soundToggleBtn" onclick="testVoice();">
                <i class="bi bi-volume-up-fill me-1"></i> ทดสอบเสียงเรียก
            </button>
            <div class="text-end">
                <div class="h2 mb-0 fw-bold text-warning" id="clockText"><?= date('H:i:s') ?></div>
                <small class="text-white-50"><?= date('d/m/Y') ?></small>
            </div>
        </div>
    </div>

    <!-- Main TV Body -->
    <div class="container-fluid p-4 flex-grow-1 d-flex flex-column justify-content-between">
        <div class="row g-4 flex-grow-1 align-items-stretch">
            <!-- Big Caller Board (Left 7 Cols) -->
            <div class="col-lg-7 d-flex flex-column">
                <div class="calling-board flex-grow-1 d-flex flex-column justify-content-center">
                    <span class="text-white-50 fw-bold text-uppercase h5 mb-0" style="letter-spacing: 0.1em;">
                        <i class="bi bi-megaphone-fill text-warning me-2"></i> หมายเลขที่กำลังเรียก (NOW CALLING)
                    </span>
                    
                    <?php if($currentQueue): ?>
                        <div class="calling-number my-2" id="currentQueueNumber"><?= htmlspecialchars($currentQueue->queue_number) ?></div>
                        <div>
                            <div class="calling-counter mb-3">
                                <i class="bi bi-door-open-fill me-2"></i> ช่องบริการที่ <?= htmlspecialchars($currentQueue->counter_number ?? '1') ?>
                            </div>
                        </div>
                        <h4 class="text-white-50 fw-light">คุณ <?= htmlspecialchars($currentQueue->patient_name) ?></h4>
                    <?php else: ?>
                        <div class="calling-number my-2 text-white-50" style="font-size: 5rem;" id="currentQueueNumber">---</div>
                        <div class="h3 text-white-50 fw-light">พร้อมให้บริการ / รอเรียกคิว</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Multi-Counter Matrix (Right 5 Cols) -->
            <div class="col-lg-5 d-flex flex-column">
                <div class="card h-100 border-0 bg-transparent">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold text-white mb-0"><i class="bi bi-grid-fill text-info me-2"></i>สถานะแต่ละช่องบริการ</h4>
                        <span class="badge bg-danger px-3 py-2 rounded-pill fs-6">รอตรวจ: <?= $waitingCount ?> คิว</span>
                    </div>

                    <div class="d-flex flex-column gap-3 flex-grow-1">
                        <?php 
                        $counterList = ['1' => 'โต๊ะตรวจที่ 1', '2' => 'โต๊ะตรวจที่ 2', '3' => 'ห้องหัตถการ', '4' => 'ห้องจ่ายยา'];
                        foreach($counterList as $cKey => $cLabel): 
                            $matchedQueue = null;
                            if(!empty($callingCounters)) {
                                foreach($callingCounters as $cq) {
                                    if(($cq->counter_number ?? '1') == $cKey) {
                                        $matchedQueue = $cq;
                                        break;
                                    }
                                }
                            }
                        ?>
                        <div class="counter-card <?= $matchedQueue ? 'active' : '' ?> d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold text-white mb-0"><?= $cLabel ?></h5>
                                <small class="text-white-50"><?= $matchedQueue ? htmlspecialchars($matchedQueue->patient_name) : 'ว่าง / พร้อมให้บริการ' ?></small>
                            </div>
                            <div class="h2 mb-0 fw-bold <?= $matchedQueue ? 'text-warning' : 'text-white-50' ?>">
                                <?= $matchedQueue ? htmlspecialchars($matchedQueue->queue_number) : '-' ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Ticker Bar -->
    <div class="ticker-bar">
        <span class="badge bg-primary px-3 py-2 rounded-pill me-3 text-white fw-bold"><i class="bi bi-info-circle me-1"></i> ประชาสัมพันธ์</span>
        <marquee behavior="scroll" direction="left" scrollamount="6" class="text-white">
            ยินดีต้อนรับสู่โรงพยาบาลปลวกแดง • โปรดเตรียมบัตรประชาชนหรือบัตรคิวของท่านให้พร้อม • หากเกินเวลาเรียกคิวมากกว่า 3 ครั้ง ระบบจะพักคิวอัตโนมัติ • สอบถามข้อมูลเพิ่มเติมติดต่อจุดประชาสัมพันธ์
        </marquee>
    </div>

    <!-- Web Speech Synthesis & Digital Chime Sound Script -->
    <script>
        let audioCtx = null;
        let audioUnlocked = false;

        function getAudioContext() {
            if (!audioCtx) {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
            return audioCtx;
        }

        function ensureAudioActive() {
            if (!audioUnlocked) {
                audioUnlocked = true;
                getAudioContext();
                if ('speechSynthesis' in window) {
                    window.speechSynthesis.resume();
                    window.speechSynthesis.getVoices();
                }
            }
        }

        // Web Audio Digital Chime Generator
        function playChime() {
            try {
                const ctx = getAudioContext();
                
                // First Note: E5 (659.25Hz)
                const osc1 = ctx.createOscillator();
                const gain1 = ctx.createGain();
                osc1.type = 'sine';
                osc1.frequency.setValueAtTime(659.25, ctx.currentTime);
                gain1.gain.setValueAtTime(0.5, ctx.currentTime);
                gain1.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.6);
                osc1.connect(gain1);
                gain1.connect(ctx.destination);
                osc1.start(ctx.currentTime);
                osc1.stop(ctx.currentTime + 0.6);

                // Second Note: A5 (880Hz)
                const osc2 = ctx.createOscillator();
                const gain2 = ctx.createGain();
                osc2.type = 'sine';
                osc2.frequency.setValueAtTime(880, ctx.currentTime + 0.25);
                gain2.gain.setValueAtTime(0.5, ctx.currentTime + 0.25);
                gain2.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 1.2);
                osc2.connect(gain2);
                gain2.connect(ctx.destination);
                osc2.start(ctx.currentTime + 0.25);
                osc2.stop(ctx.currentTime + 1.2);
            } catch (e) {
                console.log("Audio not allowed yet:", e);
            }
        }

        // Thai Voice Speech Announcement
        function announceQueue(queueNumber, counterNumber) {
            ensureAudioActive();
            playChime();
            
            setTimeout(function() {
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

                    const text = `ขอเชิญหมายเลข ${spelledNumber} ที่ช่องบริการหมายเลข ${counterNumber} ค่ะ`;
                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = 'th-TH';
                    utterance.rate = 0.92;
                    utterance.pitch = 1.05;

                    const voices = window.speechSynthesis.getVoices();
                    const thaiVoice = voices.find(v => v.lang === 'th-TH' || v.lang.includes('th') || v.name.includes('Thai') || v.name.includes('Premwadee') || v.name.includes('Niwat'));
                    if (thaiVoice) {
                        utterance.voice = thaiVoice;
                    }

                    window.speechSynthesis.speak(utterance);
                }
            }, 600);
        }

        function testVoice() {
            ensureAudioActive();
            const currentQ = document.getElementById('currentQueueNumber').innerText;
            announceQueue((currentQ && currentQ !== '---') ? currentQ : 'A-001', '1');
        }

        document.addEventListener('click', ensureAudioActive);
        document.addEventListener('touchstart', ensureAudioActive);

        // Pre-load speech voices
        if ('speechSynthesis' in window) {
            window.speechSynthesis.onvoiceschanged = () => {
                window.speechSynthesis.getVoices();
            };
        }

        // Fullscreen Toggle
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(err => {
                    alert(`Error attempting to enable fullscreen: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        }

        // Clock Update
        setInterval(function() {
            const d = new Date();
            document.getElementById('clockText').innerText = d.toTimeString().split(' ')[0];
        }, 1000);

        // Smart polling & auto-refresh
        let lastQueueNumber = "<?= $currentQueue ? $currentQueue->queue_number : '' ?>";
        let lastCalledTime = "<?= $currentQueue ? $currentQueue->called_at : '' ?>";

        setInterval(function() {
            fetch('<?= URLROOT ?>/api/queue')
                .then(res => res.json())
                .then(data => {
                    // Check if new queue is calling
                    if (data && data.queues) {
                        const calling = data.queues.find(q => q.status === 'calling');
                        if (calling && (calling.queue_number !== lastQueueNumber || calling.called_at !== lastCalledTime)) {
                            lastQueueNumber = calling.queue_number;
                            lastCalledTime = calling.called_at;
                            announceQueue(calling.queue_number, calling.counter_number || '1');
                            setTimeout(() => window.location.reload(), 2500);
                        }
                    }
                })
                .catch(e => console.log(e));
        }, 4000);
    </script>
</body>
</html>
