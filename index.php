<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AKDAM 2026 — Akademi Da'i Al-Hikam | Papan Peringkat Dakwah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Cinzel:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Cinzel"', 'serif'],
                    },
                    colors: {
                        gold: { 300:'#fcd34d',400:'#fbbf24',500:'#f59e0b',600:'#d97706' },
                        royal: { 400:'#60a5fa',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',800:'#1e40af',900:'#1e3a8a',950:'#172554' },
                        violet: { 400:'#a78bfa',500:'#8b5cf6',600:'#7c3aed',700:'#6d28d9',800:'#5b21b6',900:'#4c1d95' }
                    }
                }
            }
        }
    </script>
    <style>
        .rank-card { transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1); }
        @keyframes rankOvertake {
            0% { transform: scale(1.03) translateY(-8px); background-color: rgba(59, 130, 246, 0.25); border-color: rgba(59, 130, 246, 0.9); box-shadow: 0 10px 35px -5px rgba(59, 130, 246, 0.5); }
            50% { transform: scale(1.02) translateY(-4px); background-color: rgba(59, 130, 246, 0.12); }
            100% { transform: scale(1) translateY(0); background-color: rgba(15, 23, 42, 0.6); }
        }
        .animate-overtake { animation: rankOvertake 1.4s ease-in-out forwards; }
        @keyframes badgePulse {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 0 6px rgba(251, 191, 36, 0.8)); }
            50% { transform: scale(1.18); filter: drop-shadow(0 0 16px rgba(251, 191, 36, 1)); }
        }
        .animate-badge { animation: badgePulse 1.1s ease-in-out infinite; }
        @keyframes spotlight {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50% { opacity: 0.55; transform: scale(1.08); }
        }
        .spotlight { animation: spotlight 4s ease-in-out infinite; }
        @keyframes shine {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .text-shine {
            background: linear-gradient(90deg, #60a5fa 0%, #ffffff 20%, #a78bfa 40%, #ffffff 60%, #60a5fa 80%, #8b5cf6 100%);
            background-size: 200% auto;
            -webkit-background-clip: text; background-clip: text; color: transparent;
            animation: shine 4s linear infinite;
        }
        @keyframes onairPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            50% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
        }
        .onair-dot { animation: onairPulse 1.5s ease-in-out infinite; }
        input[type="number"]::-webkit-inner-spin-button, 
        input[type="number"]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type="number"] { -moz-appearance: textfield; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #3b82f6, #8b5cf6); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #60a5fa, #a78bfa); }
        .luxury-border { position: relative; }
        .luxury-border::before {
            content: ''; position: absolute; inset: 0; border-radius: inherit; padding: 1px;
            background: linear-gradient(135deg, rgba(139,92,246,0.5), rgba(59,130,246,0.5), rgba(139,92,246,0.5));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude; pointer-events: none;
        }
        .stage-pattern {
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(30, 64, 175, 0.2) 0%, transparent 60%);
        }
        .logo-glow {
            filter: drop-shadow(0 0 25px rgba(139, 92, 246, 0.6)) drop-shadow(0 0 50px rgba(59, 130, 246, 0.4));
        }
        .logo-glow-sm {
            filter: drop-shadow(0 0 18px rgba(139, 92, 246, 0.5)) drop-shadow(0 0 35px rgba(59, 130, 246, 0.3));
        }
        /* Input hanya-baca (read-only) — tetap terlihat jelas tapi terkunci */
        .input-locked {
            background-color: rgba(15, 23, 42, 0.4) !important;
            color: rgba(100, 116, 139, 0.7) !important;
            cursor: not-allowed;
            border-color: rgba(51, 65, 85, 0.5) !important;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col selection:bg-royal-500 selection:text-white">

    <!-- ==================== LOGIN SCREEN ==================== -->
    <div id="loginScreen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950 px-4 overflow-hidden">
        <div class="absolute inset-0 stage-pattern"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-royal-500/15 rounded-full blur-[120px] spotlight"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-violet-500/10 rounded-full blur-[120px]"></div>

        <i class="fa-solid fa-star absolute top-20 left-20 text-violet-400/30 text-2xl animate-pulse"></i>
        <i class="fa-solid fa-star absolute top-40 right-32 text-royal-400/30 text-lg animate-pulse" style="animation-delay: 1s"></i>
        <i class="fa-solid fa-star absolute bottom-32 left-40 text-royal-400/30 text-xl animate-pulse" style="animation-delay: 2s"></i>
        <i class="fa-solid fa-star absolute bottom-20 right-20 text-violet-500/30 text-3xl animate-pulse" style="animation-delay: 0.5s"></i>

        <div class="bg-slate-900/70 border border-royal-500/30 rounded-3xl w-full max-w-md p-8 shadow-[0_0_60px_-15px_rgba(59,130,246,0.5)] backdrop-blur-2xl space-y-6 relative z-10 luxury-border">
            
            <div class="text-center space-y-3 relative z-10">
                <div class="relative inline-block">
                    <div class="absolute inset-0 bg-royal-500/40 blur-2xl rounded-full"></div>
                    <img src="logo-akdam.png" alt="Logo AKDAM 2026" class="relative w-44 h-44 sm:w-48 sm:h-48 mx-auto object-contain logo-glow">
                </div>
                <div>
                    <p class="font-display text-2xl sm:text-3xl font-extrabold text-shine leading-tight">AKDAM 2026</p>
                    <h1 class="font-display text-[10px] tracking-[0.4em] text-royal-300/80 mb-1">AKADEMI DA'I AL-HIKAM</h1>
                    <div class="flex items-center justify-center gap-2 mt-1.5">
                        <span class="h-px w-8 bg-gradient-to-r from-transparent to-royal-500/60"></span>
                        <i class="fa-solid fa-crown text-violet-400 text-xs"></i>
                        <span class="h-px w-8 bg-gradient-to-l from-transparent to-royal-500/60"></span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">Papan Peringkat & Penilaian Dakwah</p>
                </div>
            </div>

            <!-- PILIHAN LOGIN -->
            <div class="grid grid-cols-3 gap-1.5 bg-slate-950/80 p-1.5 rounded-2xl border border-royal-500/20 relative z-10">
                <button type="button" onclick="setLoginTab('juri1')" id="tabLoginJuri1" class="py-2.5 rounded-xl text-[10px] sm:text-xs font-bold transition-all bg-gradient-to-r from-royal-600 to-royal-500 text-white shadow-lg shadow-royal-600/40">
                    <i class="fa-solid fa-microphone mr-0.5"></i> Juri 1
                </button>
                <button type="button" onclick="setLoginTab('juri2')" id="tabLoginJuri2" class="py-2.5 rounded-xl text-[10px] sm:text-xs font-bold transition-all text-slate-400 hover:text-royal-300">
                    <i class="fa-solid fa-book mr-0.5"></i> Juri 2
                </button>
                <button type="button" onclick="setLoginTab('juri3')" id="tabLoginJuri3" class="py-2.5 rounded-xl text-[10px] sm:text-xs font-bold transition-all text-slate-400 hover:text-royal-300">
                    <i class="fa-solid fa-masks-theater mr-0.5"></i> Juri 3
                </button>
                <button type="button" onclick="setLoginTab('admin')" id="tabLoginAdmin" class="py-2.5 rounded-xl text-[10px] sm:text-xs font-bold transition-all text-slate-400 hover:text-royal-300">
                    <i class="fa-solid fa-user-shield mr-0.5"></i> Admin
                </button>
                <button type="button" onclick="setLoginTab('monitor')" id="tabLoginMonitor" class="py-2.5 rounded-xl text-[10px] sm:text-xs font-bold transition-all text-slate-400 hover:text-royal-300 col-span-2">
                    <i class="fa-solid fa-tv mr-0.5"></i> Layar Monitor
                </button>
            </div>

            <form onsubmit="handleLogin(event)" class="space-y-4 relative z-10">
                <div>
                    <label class="block text-xs font-semibold text-royal-200/80 mb-1.5">
                        <i class="fa-solid fa-key mr-1"></i> Kode Akses / Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-royal-500/60">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="loginPassword" required placeholder="Masukkan Kode Akses" class="w-full bg-slate-950 border border-royal-500/20 rounded-xl pl-10 pr-4 py-3 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-royal-400 focus:ring-2 focus:ring-royal-500/30 transition-all">
                    </div>
                    <div id="loginHint" class="text-[11px] text-slate-500 mt-2 p-2 rounded-lg bg-slate-950/50 border border-slate-800">
                        <span class="text-royal-400 font-bold">Juri 1:</span> <code class="text-slate-300">JURI1</code> — 
                        <span class="text-royal-400 font-bold">Juri 2:</span> <code class="text-slate-300">JURI2</code> — 
                        <span class="text-royal-400 font-bold">Juri 3:</span> <code class="text-slate-300">JURI3</code><br>
                        <span class="text-royal-400 font-bold">Admin:</span> <code class="text-slate-300">AKDAM2026</code> — 
                        <span class="text-royal-400 font-bold">Monitor:</span> <code class="text-slate-300">AKDAM2026</code>
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-violet-700 via-violet-600 to-royal-600 hover:from-violet-600 hover:via-violet-500 hover:to-royal-500 text-white font-bold rounded-xl shadow-lg shadow-violet-900/50 transition-all text-sm flex items-center justify-center gap-2 border border-violet-400/40">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk Aplikasi
                </button>
            </form>

            <p class="text-center text-[10px] text-slate-500 font-display tracking-widest relative z-10">★ OFFICIAL RANKING SYSTEM ★</p>
        </div>
    </div>

    <!-- ==================== MAIN APP ==================== -->
    <div id="mainAppContainer" class="hidden flex-1 flex flex-col">
        <header class="bg-slate-900/80 backdrop-blur-xl border-b border-royal-500/20 sticky top-0 z-40 relative overflow-hidden">
            <div class="absolute inset-0 stage-pattern opacity-50"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-24 flex items-center justify-between relative z-10">
                <div class="flex items-center space-x-3.5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-royal-500/40 blur-xl rounded-full"></div>
                        <img src="logo-akdam.png" alt="Logo AKDAM" class="relative w-16 h-16 sm:w-20 sm:h-20 object-contain logo-glow-sm">
                    </div>
                    <div>
                        <h1 class="font-display text-base sm:text-lg font-extrabold text-shine tracking-wide">AKDAM 2026</h1>
                        <p id="appRoleSubtitle" class="text-[11px] text-slate-400 font-medium tracking-wide">Panel Juri</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span id="roleBadge" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-royal-500/10 border border-royal-500/40 text-royal-300 text-xs font-bold">
                        <i class="fa-solid fa-shield-halved"></i> Juri
                    </span>
                    <button onclick="logoutApp()" class="px-3.5 py-2 bg-slate-800/80 hover:bg-rose-900/40 hover:text-rose-400 text-slate-300 text-xs font-bold rounded-xl border border-slate-700 transition-all flex items-center gap-1.5">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </button>
                </div>
            </div>
        </header>

        <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-8 relative">

            <!-- ==================== VIEW JURI (1/2/3/ADMIN) ==================== -->
            <div id="viewJuri" class="space-y-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-royal-950/60 via-slate-900/40 to-violet-950/40 border border-royal-500/20 rounded-3xl p-6 backdrop-blur-md relative overflow-hidden luxury-border">
                    <div class="absolute -top-20 -right-20 w-52 h-52 bg-royal-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-20 -left-20 w-52 h-52 bg-violet-500/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-red-500/20 border border-red-500/40">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full onair-dot"></span>
                                <span id="juriPanelLabel" class="text-[10px] font-bold text-red-300 tracking-widest">JURI PANEL</span>
                            </span>
                        </div>
                        <h2 class="font-display text-lg sm:text-xl font-extrabold text-slate-100 flex items-center gap-2.5">
                            <i id="juriPanelIcon" class="fa-solid fa-sliders text-royal-400"></i>
                            <span id="juriPanelTitle">Kontrol Penilaian Juri</span>
                        </h2>
                        <p id="juriPanelDesc" class="text-xs text-slate-400 mt-1">Ketik poin langsung ke dalam kotak nilai.</p>
                    </div>
                    <div class="flex items-center gap-2.5 w-full sm:w-auto relative z-10">
                        <button id="btnAddPeserta" onclick="openParticipantModal()" class="hidden w-full sm:w-auto px-4 py-2.5 bg-gradient-to-r from-royal-600 to-violet-600 hover:from-royal-500 hover:to-violet-500 text-white text-xs sm:text-sm font-bold rounded-xl shadow-lg shadow-violet-900/40 transition-all flex items-center justify-center gap-2 border border-violet-400/30">
                            <i class="fa-solid fa-user-plus"></i> Tambah Peserta
                        </button>
                        <button id="btnReset" onclick="resetAllData()" class="hidden px-3.5 py-2.5 bg-slate-800/80 hover:bg-rose-900/40 hover:text-rose-400 text-slate-300 text-xs sm:text-sm font-bold rounded-xl border border-slate-700 transition-all" title="Reset Data Database">
                            <i class="fa-solid fa-rotate-right"></i>
                        </button>
                    </div>
                </div>

                <div id="juriParticipantsListContainer" class="space-y-4"></div>
            </div>

            <!-- ==================== VIEW MONITOR ==================== -->
            <div id="viewMonitor" class="space-y-8 hidden">
                <div class="bg-gradient-to-br from-slate-900/80 via-royal-950/30 to-slate-900/80 border border-royal-500/20 rounded-3xl p-6 sm:p-8 shadow-[0_0_60px_-15px_rgba(59,130,246,0.3)] backdrop-blur-md space-y-6 relative overflow-hidden luxury-border">
                    <div class="absolute -top-32 -right-32 w-72 h-72 bg-royal-500/10 rounded-full blur-3xl spotlight"></div>
                    <div class="absolute -bottom-32 -left-32 w-72 h-72 bg-violet-500/10 rounded-full blur-3xl"></div>
                    
                    <i class="fa-solid fa-star absolute top-6 right-6 text-violet-400/20 text-xl animate-pulse"></i>
                    <i class="fa-solid fa-star absolute bottom-6 left-6 text-royal-400/20 text-lg animate-pulse" style="animation-delay: 1s"></i>
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-royal-500/20 pb-5 relative z-10">
                        <div class="flex items-center gap-4">
                            <img src="logo-akdam.png" alt="Logo AKDAM" class="w-20 h-20 sm:w-24 sm:h-24 object-contain logo-glow-sm hidden sm:block">
                            <div>
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-red-500/20 border border-red-500/40">
                                        <span class="w-2 h-2 bg-red-500 rounded-full onair-dot"></span>
                                        <span class="text-[10px] font-black text-red-300 tracking-[0.2em]">ON AIR</span>
                                    </span>
                                    <span class="text-[10px] font-bold text-royal-300/80 tracking-widest font-display">★ LIVE MONITOR ★</span>
                                </div>
                                <h3 class="font-display text-xl font-extrabold text-slate-100 flex items-center gap-2.5">
                                    <i class="fa-solid fa-tv text-royal-400"></i> Peringkat Peserta Dakwah
                                </h3>
                                <p class="text-xs text-slate-400 mt-0.5">Sinkronisasi otomatis & berurut instan untuk layar proyektor.</p>
                            </div>
                        </div>
                        <span class="text-xs text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
                            <i class="fa-solid fa-signal text-[10px] animate-pulse"></i> LIVE SYNC
                        </span>
                    </div>
                    <div id="monitorListContainer" class="space-y-4 relative z-10"></div>
                </div>
            </div>

        </main>

        <footer class="border-t border-royal-500/10 py-4 mt-4 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
                <p class="font-display text-[10px] tracking-[0.3em] text-slate-500">
                    <i class="fa-solid fa-star text-violet-500/40 mx-2"></i>
                    AKDAM 2026 — AKADEMI DA'I AL-HIKAM
                    <i class="fa-solid fa-star text-violet-500/40 mx-2"></i>
                </p>
            </div>
        </footer>
    </div>

    <!-- Modal Tambah Peserta -->
    <div id="participantModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/90 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="bg-slate-900 border border-royal-500/30 rounded-3xl w-full max-w-md p-6 sm:p-8 shadow-[0_0_60px_-15px_rgba(59,130,246,0.5)] transform scale-95 transition-transform duration-300 relative overflow-hidden luxury-border">
            <div class="absolute -top-24 -right-24 w-52 h-52 bg-royal-500/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-52 h-52 bg-violet-500/10 rounded-full blur-3xl"></div>
            
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-royal-500/20 relative z-10">
                <div>
                    <p class="font-display text-[9px] tracking-[0.3em] text-royal-400/70 mb-0.5">AKDAM 2026</p>
                    <h3 class="font-display text-base font-bold text-slate-100 flex items-center gap-2.5">
                        <i class="fa-solid fa-user-plus text-royal-400"></i> Tambah Peserta Baru
                    </h3>
                </div>
                <button onclick="closeParticipantModal()" class="text-slate-400 hover:text-royal-300 transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form onsubmit="handleSaveParticipant(event)" class="space-y-4 relative z-10">
                <div>
                    <label class="block text-xs font-semibold text-royal-200/80 mb-1.5">Nama Lengkap Peserta</label>
                    <input type="text" id="inputName" required placeholder="Contoh: Ust. Ahmad Fauzan" class="w-full bg-slate-950 border border-royal-500/20 rounded-xl px-4 py-3 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-royal-400 focus:ring-2 focus:ring-royal-500/30 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-royal-200/80 mb-1.5">Asal Instansi</label>
                    <input type="text" id="inputCategory" required placeholder="Contoh: Jakarta" class="w-full bg-slate-950 border border-royal-500/20 rounded-xl px-4 py-3 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-royal-400 focus:ring-2 focus:ring-royal-500/30 transition-all">
                </div>
                
                <div class="grid grid-cols-3 gap-3 pt-2">
                    <div>
                        <label class="block text-[11px] font-semibold text-royal-200/80 mb-1">Artikulasi</label>
                        <input type="number" id="inputArtikulasi" value="80" min="0" max="100" required class="w-full bg-slate-950 border border-royal-500/20 rounded-xl px-3 py-2.5 text-sm text-royal-400 font-bold focus:outline-none focus:border-royal-400 focus:ring-2 focus:ring-royal-500/30 text-center transition-all">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-royal-200/80 mb-1">Materi</label>
                        <input type="number" id="inputMateri" value="80" min="0" max="100" required class="w-full bg-slate-950 border border-royal-500/20 rounded-xl px-3 py-2.5 text-sm text-royal-400 font-bold focus:outline-none focus:border-royal-400 focus:ring-2 focus:ring-royal-500/30 text-center transition-all">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-royal-200/80 mb-1">Panggung</label>
                        <input type="number" id="inputPanggung" value="80" min="0" max="100" required class="w-full bg-slate-950 border border-royal-500/20 rounded-xl px-3 py-2.5 text-sm text-royal-400 font-bold focus:outline-none focus:border-royal-400 focus:ring-2 focus:ring-royal-500/30 text-center transition-all">
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-royal-500/20">
                    <button type="button" onclick="closeParticipantModal()" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs sm:text-sm font-semibold rounded-xl transition-all">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-royal-600 to-violet-600 hover:from-royal-500 hover:to-violet-500 text-white text-xs sm:text-sm font-bold rounded-xl shadow-lg shadow-violet-900/40 transition-all border border-violet-400/30">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-5 right-5 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-slate-900 border border-royal-500/40 text-slate-100 px-4 py-3 rounded-2xl shadow-2xl shadow-royal-900/30 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-royal-500/20 text-royal-400 flex items-center justify-center text-sm">
                <i class="fa-solid fa-check"></i>
            </div>
            <div>
                <p id="toastTitle" class="text-xs font-bold text-royal-300">Berhasil</p>
                <p id="toastMsg" class="text-sm text-slate-100">Perubahan disimpan.</p>
            </div>
        </div>
    </div>

    <script>
        // ============================================================
        // SISTEM LOGIN MULTI-ROLE
        // ============================================================
        // JURI1     → Hanya bisa nilai ARTIKULASI
        // JURI2     → Hanya bisa nilai MATERI
        // JURI3     → Hanya bisa nilai PANGGUNG
        // AKDAM2026 (admin)   → Bisa nilai SEMUA + tambah/hapus peserta
        // AKDAM2026 (monitor) → Hanya lihat peringkat
        // ============================================================
        const ROLE_ACCESS = {
            juri1:   { pass: 'JURI1',     aspect: 'artikulasi', label: 'Juri 1 — Artikulasi', icon: 'fa-microphone',    color: 'royal' },
            juri2:   { pass: 'JURI2',     aspect: 'materi',     label: 'Juri 2 — Materi',     icon: 'fa-book',          color: 'violet' },
            juri3:   { pass: 'JURI3',     aspect: 'panggung',   label: 'Juri 3 — Panggung',   icon: 'fa-masks-theater', color: 'royal' },
            admin:   { pass: 'AKDAM2026', aspect: 'all',        label: 'Admin — Full Akses',  icon: 'fa-user-shield',   color: 'violet' },
            monitor: { pass: 'AKDAM2026', aspect: 'none',       label: 'Live Monitor',        icon: 'fa-tv',            color: 'royal' }
        };

        let participants = [];
        let currentLoginTab = 'juri1';
        let currentUserRole = localStorage.getItem('dakwah_current_role') || null;
        let currentAspect = localStorage.getItem('dakwah_current_aspect') || 'all';
        let previousRanks = {};
        let syncInterval;
        let isEditing = false;

        // ============ FETCH DATA ============
        async function fetchParticipants() {
            if (isEditing) return;
            try {
                const response = await fetch('api.php?action=get');
                const newData = await response.json();
                if (JSON.stringify(newData) !== JSON.stringify(participants)) {
                    const oldSorted = getSortedParticipants();
                    oldSorted.forEach((item, idx) => { previousRanks[item.id] = idx + 1; });
                    participants = newData;
                    renderApp();
                }
            } catch (error) { console.error("Gagal menarik data:", error); }
        }

        function calculateTotal(p) {
            return (Number(p.artikulasi)||0) + (Number(p.materi)||0) + (Number(p.panggung)||0);
        }

        function getSortedParticipants() {
            return [...participants].map(p => ({ ...p, total: calculateTotal(p) })).sort((a, b) => b.total - a.total);
        }
        function getFixedParticipants() {
            return [...participants].map(p => ({ ...p, total: calculateTotal(p) })).sort((a, b) => parseInt(a.id) - parseInt(b.id));
        }

        // ============ LOGIN TABS ============
        function setLoginTab(tab) {
            currentLoginTab = tab;
            const tabs = {
                juri1:   'tabLoginJuri1',
                juri2:   'tabLoginJuri2',
                juri3:   'tabLoginJuri3',
                admin:   'tabLoginAdmin',
                monitor: 'tabLoginMonitor'
            };
            Object.keys(tabs).forEach(key => {
                const el = document.getElementById(tabs[key]);
                if (key === tab) {
                    el.className = "py-2.5 rounded-xl text-[10px] sm:text-xs font-bold transition-all bg-gradient-to-r from-royal-600 to-royal-500 text-white shadow-lg shadow-royal-600/40" + (key === 'monitor' ? ' col-span-2' : '');
                } else {
                    el.className = "py-2.5 rounded-xl text-[10px] sm:text-xs font-bold transition-all text-slate-400 hover:text-royal-300" + (key === 'monitor' ? ' col-span-2' : '');
                }
            });
        }

        // ============ LOGIN HANDLER ============
        function handleLogin(e) {
            e.preventDefault();
            const passwordInput = document.getElementById('loginPassword').value.trim();
            const access = ROLE_ACCESS[currentLoginTab];
            if (!access) { showToast('Error', 'Role tidak dikenal'); return; }

            if (passwordInput === access.pass) {
                currentUserRole = currentLoginTab;
                currentAspect = access.aspect;
                localStorage.setItem('dakwah_current_role', currentUserRole);
                localStorage.setItem('dakwah_current_aspect', currentAspect);
                initAppSession();
            } else {
                showToast('Login Gagal', `Kode akses ${access.label} salah!`);
            }
        }

        function logoutApp() {
            currentUserRole = null;
            currentAspect = 'all';
            localStorage.removeItem('dakwah_current_role');
            localStorage.removeItem('dakwah_current_aspect');
            document.getElementById('mainAppContainer').classList.add('hidden');
            document.getElementById('loginScreen').classList.remove('hidden');
            document.getElementById('loginPassword').value = '';
            clearInterval(syncInterval);
        }

        // ============ INIT SESSION ============
        function initAppSession() {
            document.getElementById('loginScreen').classList.add('hidden');
            document.getElementById('mainAppContainer').classList.remove('hidden');

            const viewJuri = document.getElementById('viewJuri');
            const viewMonitor = document.getElementById('viewMonitor');
            const roleSubtitle = document.getElementById('appRoleSubtitle');
            const roleBadge = document.getElementById('roleBadge');
            const juriPanelLabel = document.getElementById('juriPanelLabel');
            const juriPanelTitle = document.getElementById('juriPanelTitle');
            const juriPanelDesc  = document.getElementById('juriPanelDesc');
            const juriPanelIcon  = document.getElementById('juriPanelIcon');
            const btnAddPeserta  = document.getElementById('btnAddPeserta');
            const btnReset       = document.getElementById('btnReset');

            const access = ROLE_ACCESS[currentUserRole];

            if (currentUserRole === 'monitor') {
                // === MONITOR ===
                viewJuri.classList.add('hidden');
                viewMonitor.classList.remove('hidden');
                roleSubtitle.innerText = "Live Monitor — Akademi Da'i Al-Hikam";
                roleBadge.innerHTML = `<i class="fa-solid fa-tv"></i> Live Monitor`;
            } else {
                // === JURI 1/2/3/ADMIN ===
                viewJuri.classList.remove('hidden');
                viewMonitor.classList.add('hidden');
                roleSubtitle.innerText = access.label;
                roleBadge.innerHTML = `<i class="fa-solid ${access.icon}"></i> ${access.label}`;
                juriPanelLabel.innerText = access.label.toUpperCase();
                juriPanelTitle.innerText = access.label;
                juriPanelIcon.className = `fa-solid ${access.icon} text-royal-400`;

                // Tampilkan tombol tambah/hapus hanya untuk ADMIN
                if (currentUserRole === 'admin') {
                    btnAddPeserta.classList.remove('hidden');
                    btnReset.classList.remove('hidden');
                    juriPanelDesc.innerText = "Anda bisa menilai SEMUA aspek (artikulasi, materi, panggung) dan mengelola peserta.";
                } else if (currentUserRole === 'juri1') {
                    juriPanelDesc.innerText = "Anda hanya bisa menilai ASPEK ARTIKULASI. Aspek lain dikunci.";
                } else if (currentUserRole === 'juri2') {
                    juriPanelDesc.innerText = "Anda hanya bisa menilai ASPEK MATERI. Aspek lain dikunci.";
                } else if (currentUserRole === 'juri3') {
                    juriPanelDesc.innerText = "Anda hanya bisa menilai ASPEK PANGGUNG. Aspek lain dikunci.";
                }
            }

            fetchParticipants();
            syncInterval = setInterval(fetchParticipants, 1500);
        }

        function renderApp() {
            if (currentUserRole === 'monitor') {
                renderMonitor();
            } else {
                renderJuriList();
            }
        }

        // ============ CEK APAKAH FIELD BOLEH DIEDIT ============
        function canEdit(aspect) {
            if (currentUserRole === 'admin') return true;
            return currentAspect === aspect;
        }

        // ============ RENDER PANEL JURI ============
        function renderJuriList() {
            const container = document.getElementById('juriParticipantsListContainer');
            const fixedList = getFixedParticipants();
            const sortedList = getSortedParticipants();

            if (fixedList.length === 0) {
                container.innerHTML = `<div class="text-center py-16 bg-slate-900/30 border border-royal-500/20 rounded-2xl text-slate-500 text-sm">
                    <i class="fa-solid fa-star text-royal-500/30 text-3xl mb-3 block"></i>
                    Belum ada peserta terdaftar.
                </div>`;
                return;
            }

            let html = '';
            fixedList.forEach((p) => {
                const currentRank = sortedList.findIndex(sp => sp.id === p.id) + 1;

                let rankBadge = `<span class="w-9 h-9 rounded-xl bg-slate-800 text-slate-300 font-extrabold flex items-center justify-center text-xs border border-slate-700" title="Peringkat Saat Ini">#${currentRank}</span>`;
                if (currentRank === 1) rankBadge = `<span class="w-9 h-9 rounded-xl bg-gradient-to-br from-gold-400 to-gold-600 text-slate-900 font-extrabold flex items-center justify-center text-xs border border-gold-300 shadow-lg shadow-gold-900/40 animate-badge"><i class="fa-solid fa-trophy"></i></span>`;

                // Input Artikulasi
                const artEditable = canEdit('artikulasi');
                const artInput = artEditable
                    ? `<input type="number" value="${p.artikulasi}" min="0" max="100" 
                        onfocus="isEditing = true" 
                        onblur="updateScoreDirectly('${p.id}', 'artikulasi', this.value)"
                        class="w-full bg-slate-950 border border-slate-700 rounded-lg px-2 py-1.5 text-lg text-royal-400 font-black focus:outline-none focus:border-royal-400 focus:ring-2 focus:ring-royal-500/30 transition-all text-center">`
                    : `<input type="text" value="${p.artikulasi}" readonly class="input-locked w-full border rounded-lg px-2 py-1.5 text-lg font-black text-center">`;

                // Input Materi
                const matEditable = canEdit('materi');
                const matInput = matEditable
                    ? `<input type="number" value="${p.materi}" min="0" max="100" 
                        onfocus="isEditing = true" 
                        onblur="updateScoreDirectly('${p.id}', 'materi', this.value)"
                        class="w-full bg-slate-950 border border-slate-700 rounded-lg px-2 py-1.5 text-lg text-violet-400 font-black focus:outline-none focus:border-violet-400 focus:ring-2 focus:ring-violet-500/30 transition-all text-center">`
                    : `<input type="text" value="${p.materi}" readonly class="input-locked w-full border rounded-lg px-2 py-1.5 text-lg font-black text-center">`;

                // Input Panggung
                const pagEditable = canEdit('panggung');
                const pagInput = pagEditable
                    ? `<input type="number" value="${p.panggung}" min="0" max="100" 
                        onfocus="isEditing = true" 
                        onblur="updateScoreDirectly('${p.id}', 'panggung', this.value)"
                        class="w-full bg-slate-950 border border-slate-700 rounded-lg px-2 py-1.5 text-lg text-royal-400 font-black focus:outline-none focus:border-royal-400 focus:ring-2 focus:ring-royal-500/30 transition-all text-center">`
                    : `<input type="text" value="${p.panggung}" readonly class="input-locked w-full border rounded-lg px-2 py-1.5 text-lg font-black text-center">`;

                // Label dengan tanda 🔓 atau 🔒
                const lockIcon = (editable) => editable 
                    ? `<i class="fa-solid fa-lock-open text-emerald-400/60 text-[9px] ml-1"></i>` 
                    : `<i class="fa-solid fa-lock text-slate-600 text-[9px] ml-1"></i>`;

                html += `
                    <div class="bg-slate-900/60 border border-royal-500/15 hover:border-royal-500/50 rounded-2xl p-4 sm:p-5 flex flex-col gap-4 backdrop-blur-sm transition-all luxury-border">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div>${rankBadge}</div>
                                <div>
                                    <h4 class="font-bold text-slate-100 text-sm sm:text-base flex items-center gap-2">
                                        ${p.name}
                                        ${currentRank === 1 ? '<span class="px-2 py-0.5 rounded text-[10px] bg-gradient-to-r from-gold-500 to-gold-600 text-slate-900 font-black border border-gold-300">★ JUARA 1</span>' : ''}
                                    </h4>
                                    <p class="text-xs text-slate-400">${p.category}</p>
                                </div>
                            </div>
                            ${currentUserRole === 'admin' ? `
                            <div>
                                <button onclick="deleteParticipant('${p.id}')" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-rose-900/40 text-slate-400 hover:text-rose-400 text-xs font-semibold flex items-center gap-1.5 transition-colors">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </div>` : ''}
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-3 bg-slate-950/60 p-4 rounded-2xl border border-royal-500/15 items-center">
                            
                            <div class="bg-slate-900/80 p-2.5 rounded-xl border border-slate-800 flex flex-col gap-1.5">
                                <label class="text-[10px] font-bold text-royal-300/70 uppercase text-center tracking-wider">
                                    <i class="fa-solid fa-microphone mr-1"></i> Artikulasi ${lockIcon(artEditable)}
                                </label>
                                ${artInput}
                            </div>

                            <div class="bg-slate-900/80 p-2.5 rounded-xl border border-slate-800 flex flex-col gap-1.5">
                                <label class="text-[10px] font-bold text-violet-300/70 uppercase text-center tracking-wider">
                                    <i class="fa-solid fa-book mr-1"></i> Materi ${lockIcon(matEditable)}
                                </label>
                                ${matInput}
                            </div>

                            <div class="bg-slate-900/80 p-2.5 rounded-xl border border-slate-800 flex flex-col gap-1.5">
                                <label class="text-[10px] font-bold text-royal-300/70 uppercase text-center tracking-wider">
                                    <i class="fa-solid fa-masks-theater mr-1"></i> Panggung ${lockIcon(pagEditable)}
                                </label>
                                ${pagInput}
                            </div>

                            <div class="bg-gradient-to-br from-royal-950/60 to-violet-950/40 border border-royal-500/40 p-3 h-full rounded-xl flex flex-col items-center justify-center text-center gap-1 shadow-lg shadow-royal-900/20">
                                <span class="text-[10px] font-bold text-royal-300 uppercase tracking-widest">Total</span>
                                <span class="text-2xl font-black text-royal-300 leading-none drop-shadow">${p.total}</span>
                            </div>

                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        // ============ RENDER MONITOR ============
        function renderMonitor() {
            const listContainer = document.getElementById('monitorListContainer');
            const sorted = getSortedParticipants();

            if (sorted.length === 0) {
                listContainer.innerHTML = `<div class="text-center py-8 text-slate-500 text-sm">Belum ada peserta.</div>`;
                return;
            }

            let listHtml = '';
            sorted.forEach((p, index) => {
                const currentRank = index + 1;
                const prevRank = previousRanks[p.id];
                let movementBadge = '';
                let cardAnimClass = 'rank-card bg-slate-900/60 border border-royal-500/15 hover:border-royal-500/50 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 backdrop-blur-sm luxury-border';

                if (prevRank !== undefined && currentRank < prevRank) {
                    movementBadge = `<span class="inline-flex items-center gap-1 text-[10px] font-bold text-royal-300 bg-royal-500/15 px-2.5 py-0.5 rounded-full border border-royal-500/40 ml-2 animate-bounce"><i class="fa-solid fa-arrow-up"></i> Naik dari #${prevRank}</span>`;
                    cardAnimClass += ' animate-overtake';
                }

                let rankBadge = `<span class="w-10 h-10 rounded-xl bg-slate-800 text-slate-300 font-extrabold flex items-center justify-center text-xs border border-slate-700">#${currentRank}</span>`;
                if (currentRank === 1) rankBadge = `<span class="w-10 h-10 rounded-xl bg-gradient-to-br from-gold-300 via-gold-400 to-gold-600 text-slate-900 font-black flex items-center justify-center text-base border-2 border-gold-200 shadow-[0_0_20px_rgba(251,191,36,0.6)] animate-badge"><i class="fa-solid fa-trophy"></i></span>`;
                else if (currentRank === 2) rankBadge = `<span class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-200 to-slate-400 text-slate-800 font-black flex items-center justify-center text-sm border-2 border-slate-100">2</span>`;
                else if (currentRank === 3) rankBadge = `<span class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-800 text-white font-black flex items-center justify-center text-sm border-2 border-amber-300">3</span>`;

                listHtml += `
                    <div class="${cardAnimClass}">
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div>${rankBadge}</div>
                            <div>
                                <h4 class="font-bold text-slate-100 text-sm sm:text-base flex items-center flex-wrap gap-1.5">
                                    ${p.name}
                                    ${currentRank === 1 ? '<span class="px-2 py-0.5 rounded text-[10px] bg-gradient-to-r from-gold-400 to-gold-600 text-slate-900 font-black border border-gold-300">★ JUARA 1</span>' : ''}
                                    ${movementBadge}
                                </h4>
                                <p class="text-xs text-slate-400">${p.category}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
                            <div class="text-[11px] text-slate-400 flex gap-3 bg-slate-950/80 px-3 py-2 rounded-xl border border-slate-800">
                                <div><i class="fa-solid fa-microphone text-royal-400/60"></i> <span class="font-bold text-royal-200">${p.artikulasi}</span></div>
                                <div><i class="fa-solid fa-book text-violet-400/60"></i> <span class="font-bold text-violet-200">${p.materi}</span></div>
                                <div><i class="fa-solid fa-masks-theater text-royal-400/60"></i> <span class="font-bold text-royal-200">${p.panggung}</span></div>
                            </div>
                            <div class="bg-gradient-to-br from-royal-950/60 to-violet-950/40 border border-royal-500/50 px-4 py-2 rounded-xl text-royal-300 font-black text-lg shadow-lg shadow-royal-900/30">
                                ${p.total}
                            </div>
                        </div>
                    </div>
                `;
            });

            listContainer.innerHTML = listHtml;
        }

        // ============ UPDATE NILAI (HANYA ASPEK YANG DIIZINKAN) ============
        async function updateScoreDirectly(id, aspectKey, newValue) {
            if (currentUserRole === 'monitor') return;
            // Cek apakah juri ini boleh mengedit aspek tersebut
            if (currentUserRole !== 'admin' && currentAspect !== aspectKey) {
                showToast('Akses Ditolak', `Anda tidak berhak menilai ${aspectKey}!`);
                renderApp(); // refresh supaya nilai kembali
                return;
            }

            isEditing = false;
            const target = participants.find(p => p.id == id);
            if (target) {
                let parsedValue = parseInt(newValue);
                if (isNaN(parsedValue)) parsedValue = 0;
                parsedValue = Math.max(0, Math.min(100, parsedValue));
                target[aspectKey] = parsedValue;
                
                await fetch('api.php?action=update', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id: target.id,
                        artikulasi: target.artikulasi,
                        materi: target.materi,
                        panggung: target.panggung
                    })
                });

                renderApp();
                showToast('Nilai Tersimpan', `${target.name} (${aspectKey}: ${parsedValue})`);
            }
        }

        // ============ MODAL TAMBAH PESERTA (HANYA ADMIN) ============
        function openParticipantModal() {
            if (currentUserRole !== 'admin') return;
            document.getElementById('participantModal').classList.remove('opacity-0', 'pointer-events-none');
            document.getElementById('inputName').value = '';
            document.getElementById('inputCategory').value = '';
            document.getElementById('inputArtikulasi').value = '80';
            document.getElementById('inputMateri').value = '80';
            document.getElementById('inputPanggung').value = '80';
        }

        function closeParticipantModal() {
            document.getElementById('participantModal').classList.add('opacity-0', 'pointer-events-none');
        }

        async function handleSaveParticipant(e) {
            e.preventDefault();
            if (currentUserRole !== 'admin') return;

            const data = {
                name: document.getElementById('inputName').value.trim(),
                category: document.getElementById('inputCategory').value.trim(),
                artikulasi: parseInt(document.getElementById('inputArtikulasi').value) || 0,
                materi: parseInt(document.getElementById('inputMateri').value) || 0,
                panggung: parseInt(document.getElementById('inputPanggung').value) || 0
            };

            const res = await fetch('api.php?action=add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            if (res.ok) {
                await fetchParticipants();
                closeParticipantModal();
                showToast('Peserta Ditambahkan', `${data.name} berhasil masuk.`);
            }
        }

        async function deleteParticipant(id) {
            if (currentUserRole !== 'admin') return;
            const target = participants.find(p => p.id == id);
            if (target && confirm(`Yakin ingin menghapus peserta "${target.name}"?`)) {
                await fetch('api.php?action=delete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: target.id })
                });
                delete previousRanks[id];
                await fetchParticipants();
                showToast('Dihapus', `${target.name} dihapus dari daftar.`);
            }
        }

        async function resetAllData() {
            if (currentUserRole !== 'admin') return;
            if (confirm('Atur ulang semua data? Ini akan MENGHAPUS SEMUA DATA di Database.')) {
                await fetch('api.php?action=reset');
                participants = [];
                previousRanks = {};
                renderApp();
                showToast('Database Direset', 'Semua data telah dikosongkan.');
            }
        }

        function showToast(title, msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastTitle').innerText = title;
            document.getElementById('toastMsg').innerText = msg;
            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => { toast.classList.add('translate-y-20', 'opacity-0'); }, 3000);
        }

        window.onload = function() {
            if (currentUserRole && ROLE_ACCESS[currentUserRole]) {
                currentAspect = ROLE_ACCESS[currentUserRole].aspect;
                initAppSession();
            } else {
                setLoginTab('juri1');
            }
        };
    </script>
</body>
</html>