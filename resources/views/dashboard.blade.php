<x-app-layout>
    <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-gradient-to-b from-[#0b0f10] via-[#111a1d] to-[#0b0f10] text-white px-6">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(56,189,248,0.08),transparent_60%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_80%,rgba(34,197,94,0.08),transparent_60%)]"></div>
        </div>
        <div class="text-center space-y-8 max-w-2xl relative z-10 animate-in fade-in duration-700">
            <div class="flex justify-center">
                <div class="bg-green-500/10 p-5 rounded-full shadow-[0_0_25px_rgba(34,197,94,0.25)] border border-green-400/30">
                    <i data-lucide="music-3" class="w-10 h-10 text-green-400"></i>
                </div>
            </div>
            <h1 class="text-5xl sm:text-6xl font-extrabold tracking-tight leading-tight">
                Chào mừng đến <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-emerald-300 to-teal-400">LofiPlan</span>
            </h1>
            <p class="text-gray-400 text-lg sm:text-base max-w-xl mx-auto leading-relaxed">
                <span class="text-green-400">LofiPlan</span> giúp bạn nghe nhạc thư giãn 🎶, lên kế hoạch công việc 📅 và giữ tinh thần cân bằng trong một không gian yên tĩnh.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10">
                <a href="{{ route('songs.index') }}"
                   class="flex items-center justify-center gap-2 px-8 py-3.5 text-base font-semibold 
                          rounded-xl bg-gradient-to-r from-green-400 via-emerald-500 to-teal-500
                          hover:brightness-110 hover:scale-[1.04] text-black shadow-lg shadow-green-500/20 
                          transition-all duration-200">
                    <i data-lucide="headphones" class="w-5 h-5"></i>
                    Nghe nhạc
                </a>

                <a href="{{ route('todos.index') }}"
                   class="flex items-center justify-center gap-2 px-8 py-3.5 text-base font-semibold 
                          rounded-xl border border-gray-700 text-gray-200 bg-[#141a1d]
                          hover:bg-[#1d272c] hover:text-white hover:border-green-500/50 
                          hover:scale-[1.04] transition-all duration-200 shadow-lg shadow-black/10">
                    <i data-lucide="calendar-check-2" class="w-5 h-5 text-green-400"></i>
                    Lịch công việc
                </a>
            </div>
        </div>
        <div class="absolute bottom-6 text-xs text-gray-500 z-10">
            © {{ date('Y') }} <span class="text-green-400">LofiPlan</span>. Thư giãn, lên kế hoạch, và phát triển bản thân.
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</x-app-layout>
