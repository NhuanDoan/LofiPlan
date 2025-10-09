<div id="music-player"
    class="fixed bottom-0 left-0 right-0 bg-[#0b0f12]/95 backdrop-blur-md border-t border-white/10 
           px-4 sm:px-8 py-3 sm:py-4 flex flex-col sm:flex-row items-center justify-between gap-4 sm:gap-0 z-50 
           text-white select-none">

    <div class="flex items-center gap-4 w-full sm:w-1/3">
        <img id="player-cover" src="/default-cover.png"
             class="w-12 h-12 sm:w-14 sm:h-14 rounded-lg shadow-md object-cover ring-1 ring-white/10">
        <div class="min-w-0">
            <div id="player-title" class="font-semibold text-white truncate text-sm sm:text-base">
                Chưa phát
            </div>
            <div id="player-artist" class="text-xs sm:text-sm text-gray-400 truncate">
                Không có nghệ sĩ 
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center w-full sm:w-1/3">
        <div class="flex gap-6 items-center mb-2">
            <button id="prev-btn" 
                    class="text-gray-400 hover:text-green-400 transition-all hover:scale-110">
                <i data-lucide="skip-back" class="w-5 h-5"></i>
            </button>

            <button id="play-btn"
                    class="bg-green-500 hover:bg-green-600 text-black rounded-full p-3 sm:p-3.5 
                           transition-all hover:scale-110 shadow-md hover:shadow-green-500/30">
                <i data-lucide="play" id="play-icon" class="w-6 h-6"></i>
                <i data-lucide="pause" id="pause-icon" class="w-6 h-6 hidden"></i>
            </button>

            <button id="next-btn" 
                    class="text-gray-400 hover:text-green-400 transition-all hover:scale-110">
                <i data-lucide="skip-forward" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="flex items-center gap-2 w-full sm:w-64">
            <span id="current-time" class="text-xs text-gray-400 w-8 text-right">0:00</span>
            <input id="progress" type="range" min="0" max="100" value="0"
                   class="flex-1 accent-green-500 cursor-pointer h-1 rounded-lg">
            <span id="total-time" class="text-xs text-gray-400 w-8">0:00</span>
        </div>
    </div>

    <div class="hidden sm:flex items-center justify-end gap-3 w-1/3">
        <i data-lucide="volume-2" class="w-5 h-5 text-gray-400"></i>
        <input id="volume" type="range" min="0" max="1" step="0.01" value="1"
               class="w-28 accent-green-500 cursor-pointer h-1">
    </div>

    <audio id="audio"></audio>
</div>


