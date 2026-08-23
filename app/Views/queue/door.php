<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จอแสดงคิวหน้าห้องตรวจที่ <?= htmlspecialchars($room_number) ?> - โรงพยาบาลปลวกแดง</title>
    
    <!-- Fonts & Bootstrap 5 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Prompt:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --bg-dark: #070d18;
            --card-dark: #0f172a;
            --teal-glow: #0d9488;
            --gold-glow: #f59e0b;
        }

        body {
            font-family: 'Prompt', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            min-height: 100vh;
            user-select: none;
        }

        .door-header {
            background: linear-gradient(90deg, #0f172a, #134e4a);
            border-bottom: 2px solid rgba(13, 148, 136, 0.4);
            padding: 16px 30px;
        }

        .huge-room-badge {
            font-size: 2.2rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.02em;
        }

        .current-queue-box {
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            border: 2px solid rgba(245, 158, 11, 0.6);
            border-radius: 32px;
            box-shadow: 0 0 60px rgba(245, 158, 11, 0.25);
            padding: 40px;
            text-align: center;
            position: relative;
            transition: all 0.3s ease;
        }

        .queue-display-number {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 7.5rem;
            font-weight: 800;
            color: #fbbf24;
            letter-spacing: 4px;
            line-height: 1;
            text-shadow: 0 0 35px rgba(251, 191, 36, 0.6);
        }

        .next-queue-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 20px;
            transition: transform 0.2s;
        }

        .pulse-ring {
            animation: ringPulse 2s infinite;
        }

        @keyframes ringPulse {
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
            70% { box-shadow: 0 0 0 30px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }

        /* Sound Enable Floating Toast */
        .sound-prompt-bar {
            background: linear-gradient(90deg, #b45309, #d97706);
            color: #ffffff;
            padding: 12px 24px;
            text-align: center;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s;
        }

        .sound-prompt-bar.active {
            background: linear-gradient(90deg, #065f46, #059669);
        }

        @media (max-width: 768px) {
            .queue-display-number { font-size: 4.5rem; }
            .huge-room-badge { font-size: 1.6rem; }
        }
    </style>
</head>
<body class="d-flex flex-column justify-content-between" onclick="ensureAudioActive()">

    <!-- Sound Activation Prompt Bar -->
    <div id="soundPromptBanner" class="sound-prompt-bar d-flex justify-content-between align-items-center" onclick="enableAudioDirectly(event)">
        <div class="d-flex align-items-center gap-2 mx-auto">
            <i class="bi bi-volume-up-fill fs-5" id="soundPromptIcon"></i>
            <span id="soundPromptText">คลิกที่นี่หรือแตะหน้าจอ 1 ครั้ง เพื่อเปิดระบบเสียงเรียกคิวภาษาไทยอัตโนมัติ</span>
        </div>
        <button class="btn btn-sm btn-light rounded-pill px-3 fw-bold" onclick="testSoundDirectly(event)">
            <i class="bi bi-play-circle-fill me-1"></i> ทดสอบเสียง
        </button>
    </div>

    <!-- Top Header Bar -->
    <div class="door-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="rounded-3 border border-2 border-white" width="50" height="50" style="object-fit: cover;">
            <div>
                <span class="huge-room-badge">ห้องตรวจที่ <?= htmlspecialchars($room_number) ?></span>
                <span class="badge bg-primary text-white rounded-pill px-3 py-1 ms-2 fs-6">
                    <?= htmlspecialchars($department ? $department->name : 'ตรวจโรคทั่วไป') ?>
                </span>
            </div>
        </div>

        <div class="d-flex align-items-center gap-4 text-end">
            <div>
                <div class="small text-white-50" id="liveDateText">วัน...</div>
                <div class="fs-4 fw-bold text-warning font-monospace" id="liveClock">00:00:00</div>
            </div>
            <button class="btn btn-outline-light rounded-circle p-2" onclick="toggleFullScreen(event)" title="เปิดเต็มจอ">
                <i class="bi bi-arrows-fullscreen"></i>
            </button>
        </div>
    </div>

    <!-- Main Live Queue Display Area -->
    <div class="container-fluid px-4 px-md-5 my-auto py-4">
        <div class="row g-4 align-items-center">
            
            <!-- Left Big Box: Current Serving Patient -->
            <div class="col-lg-8">
                <div class="current-queue-box pulse-ring" id="currentBox">
                    <div class="badge bg-warning text-dark px-4 py-2 rounded-pill fw-bold fs-5 mb-4 shadow">
                        <i class="bi bi-broadcast me-2"></i> ขอเชิญหมายเลข (NOW SERVING)
                    </div>

                    <div class="queue-display-number mb-3" id="currentQueueNum">
                        <?= $currentQueue ? htmlspecialchars($currentQueue->queue_number) : '---' ?>
                    </div>

                    <h2 class="fw-bold text-white mb-2" id="currentPatientName">
                        <?= $currentQueue ? htmlspecialchars($currentQueue->patient_name) : 'กำลังรอเรียกคิวตรวจ...' ?>
                    </h2>
                    
                    <p class="text-white-50 fs-5 mb-0" id="currentCalledTime">
                        <?= $currentQueue ? 'เชิญเข้าห้องตรวจที่ ' . htmlspecialchars($room_number) : 'กรุณารอเจ้าหน้าที่เรียกสักครู่' ?>
                    </p>
                </div>
            </div>

            <!-- Right Column: Next Queue in Line -->
            <div class="col-lg-4">
                <div class="p-4 rounded-4" style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255,255,255,0.1);">
                    <h4 class="fw-bold text-white mb-4 d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-clock-history text-info me-2"></i>คิวถัดไป (Next)</span>
                        <span class="badge bg-info bg-opacity-20 text-info rounded-pill px-3 py-1 small">เตรียมตัว</span>
                    </h4>

                    <div id="nextQueuesContainer">
                        <?php if(empty($nextQueues)): ?>
                            <div class="text-center py-4 text-white-50">
                                <i class="bi bi-check-circle fs-1 d-block mb-2"></i>
                                ไม่มีคิวรอเรียกขณะนี้
                            </div>
                        <?php else: ?>
                            <?php foreach($nextQueues as $i => $nq): ?>
                                <div class="next-queue-card mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-white-50 small">ลำดับที่ <?= $i + 1 ?></div>
                                        <h3 class="fw-bold text-warning font-monospace mb-0"><?= htmlspecialchars($nq->queue_number) ?></h3>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold text-white"><?= htmlspecialchars($nq->patient_name) ?></div>
                                        <span class="badge bg-secondary rounded-pill small">เตรียมพบแพทย์</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Audio Activation Banner -->
    <div class="p-3 text-center border-top d-flex justify-content-between align-items-center px-4" style="background: rgba(0,0,0,0.6); font-size: 0.88rem;">
        <span class="text-white-50"><i class="bi bi-info-circle text-warning me-1"></i> ระบบเชื่อมต่อเสียงสังเคราะห์ภาษาไทยอัตโนมัติ (Web Speech API)</span>
        <button class="btn btn-sm btn-outline-light rounded-pill px-3" onclick="testSoundDirectly(event)">
            <i class="bi bi-volume-up me-1"></i> กดฟังเสียงทดสอบ
        </button>
    </div>

    <!-- Audio Chime & Speech Synthesizer Script -->
    <script>
    let lastCalledQueueId = <?= $currentQueue ? $currentQueue->id : 'null' ?>;
    let audioContext = null;
    let audioUnlocked = false;

    // Clock
    function updateClock() {
        const now = new Date();
        document.getElementById('liveClock').innerText = now.toLocaleTimeString('th-TH');
        document.getElementById('liveDateText').innerText = now.toLocaleDateString('th-TH', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Initialize Web Audio Context
    function getAudioContext() {
        if (!audioContext) {
            audioContext = new (window.AudioContext || window.webkitAudioContext)();
        }
        if (audioContext.state === 'suspended') {
            audioContext.resume();
        }
        return audioContext;
    }

    // Web Audio Crystal Ding-Dong Chime
    function playChime() {
        try {
            const ctx = getAudioContext();
            
            // Tone 1: E5 (659.25Hz)
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

            // Tone 2: A5 (880.00Hz)
            const osc2 = ctx.createOscillator();
            const gain2 = ctx.createGain();
            osc2.type = 'sine';
            osc2.frequency.setValueAtTime(880.00, ctx.currentTime + 0.25);
            gain2.gain.setValueAtTime(0.5, ctx.currentTime + 0.25);
            gain2.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 1.2);
            osc2.connect(gain2);
            gain2.connect(ctx.destination);
            osc2.start(ctx.currentTime + 0.25);
            osc2.stop(ctx.currentTime + 1.2);
        } catch(e) {
            console.log("Chime error:", e);
        }
    }

    // Natural Thai Speech Synthesizer
    function speakQueue(queueNumber, roomNumber) {
        ensureAudioActive();
        playChime();

        setTimeout(() => {
            if ('speechSynthesis' in window) {
                // Cancel any stuck speech queue
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

                // Pick Thai voice if available
                const voices = window.speechSynthesis.getVoices();
                const thaiVoice = voices.find(v => v.lang === 'th-TH' || v.lang.includes('th') || v.name.includes('Thai') || v.name.includes('Premwadee') || v.name.includes('Niwat'));
                if (thaiVoice) {
                    utter.voice = thaiVoice;
                }

                window.speechSynthesis.speak(utter);
            }
        }, 600);
    }

    // Unlock Audio Automatically
    function ensureAudioActive() {
        if (!audioUnlocked) {
            audioUnlocked = true;
            getAudioContext();
            
            // Warm up speech synthesis
            if ('speechSynthesis' in window) {
                window.speechSynthesis.resume();
                window.speechSynthesis.getVoices();
            }

            const promptBanner = document.getElementById('soundPromptBanner');
            if (promptBanner) {
                promptBanner.classList.add('active');
                document.getElementById('soundPromptIcon').className = 'bi bi-volume-up-fill text-white fs-5';
                document.getElementById('soundPromptText').innerHTML = '<span class="text-white fw-bold"><i class="bi bi-check-circle-fill me-1"></i> ระบบเสียงเรียกคิวเปิดใช้งานพร้อมทำงาน 100%</span>';
            }
        }
    }

    function enableAudioDirectly(e) {
        if (e) e.stopPropagation();
        ensureAudioActive();
        playChime();
    }

    function testSoundDirectly(e) {
        if (e) e.stopPropagation();
        ensureAudioActive();
        const currentQ = document.getElementById('currentQueueNum').innerText;
        speakQueue((currentQ && currentQ !== '---') ? currentQ : 'A-001', '<?= htmlspecialchars($room_number) ?>');
    }

    // Auto Polling every 2.5 seconds
    function pollDoorStatus() {
        fetch('<?= URLROOT ?>/queue/liveRoomStatus/<?= htmlspecialchars($room_number) ?>?department_id=<?= $department_id ?>')
            .then(res => res.json())
            .then(data => {
                if (data.current_queue) {
                    document.getElementById('currentQueueNum').innerText = data.current_queue.queue_number;
                    document.getElementById('currentPatientName').innerText = data.current_queue.patient_name;
                    document.getElementById('currentCalledTime').innerText = 'เชิญเข้าห้องตรวจที่ <?= htmlspecialchars($room_number) ?>';
                    
                    // If newly called
                    if (lastCalledQueueId !== data.current_queue.id) {
                        lastCalledQueueId = data.current_queue.id;
                        speakQueue(data.current_queue.queue_number, '<?= htmlspecialchars($room_number) ?>');
                    }
                } else {
                    document.getElementById('currentQueueNum').innerText = '---';
                    document.getElementById('currentPatientName').innerText = 'กำลังรอเรียกคิวตรวจ...';
                    document.getElementById('currentCalledTime').innerText = 'กรุณารอเจ้าหน้าที่เรียกสักครู่';
                    lastCalledQueueId = null;
                }

                // Update Next Queues
                let nextHtml = '';
                if (!data.next_queues || data.next_queues.length === 0) {
                    nextHtml = '<div class="text-center py-4 text-white-50"><i class="bi bi-check-circle fs-1 d-block mb-2"></i>ไม่มีคิวรอเรียกขณะนี้</div>';
                } else {
                    data.next_queues.forEach((nq, i) => {
                        nextHtml += `
                            <div class="next-queue-card mb-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small">ลำดับที่ ${i + 1}</div>
                                    <h3 class="fw-bold text-warning font-monospace mb-0">${nq.queue_number}</h3>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold text-white">${nq.patient_name}</div>
                                    <span class="badge bg-secondary rounded-pill small">เตรียมพบแพทย์</span>
                                </div>
                            </div>
                        `;
                    });
                }
                document.getElementById('nextQueuesContainer').innerHTML = nextHtml;
            })
            .catch(err => console.log(err));
    }

    setInterval(pollDoorStatus, 2500);

    function toggleFullScreen(e) {
        if (e) e.stopPropagation();
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }

    // Pre-load speech voices
    if ('speechSynthesis' in window) {
        window.speechSynthesis.onvoiceschanged = () => {
            window.speechSynthesis.getVoices();
        };
    }
    </script>
</body>
</html>
