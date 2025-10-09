<x-app-layout>
    <div class="min-h-screen bg-[#0f0f10] text-white py-10 px-4">
        <div class="max-w-2xl mx-auto bg-[#181818] rounded-2xl shadow-xl p-8 border border-[#2a2a2a]">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-green-400">Thêm bài hát mới</h2>
                <a href="{{ route('songs.index') }}"
                   class="flex items-center gap-2 text-sm text-gray-300 hover:text-white transition">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    <span>Quay lại playlist</span>
                </a>
            </div>

            <!-- Thông báo lỗi -->
            @if ($errors->any())
                <div class="bg-red-800/40 border border-red-500 text-red-300 px-4 py-3 rounded mb-4">
                    <strong>Lỗi:</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Tên bài hát -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-1">
                        Tên bài hát <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" required
                           class="w-full rounded-lg bg-[#121212] border border-[#2a2a2a] focus:ring-2 focus:ring-green-500 text-white p-3 placeholder-gray-500"
                           placeholder="Nhập tên bài hát...">
                </div>

                <!-- Nghệ sĩ -->
                <div>
                    <label for="artist" class="block text-sm font-medium text-gray-300 mb-1">Ca sĩ / Nghệ sĩ</label>
                    <input type="text" name="artist" id="artist"
                           class="w-full rounded-lg bg-[#121212] border border-[#2a2a2a] focus:ring-2 focus:ring-green-500 text-white p-3 placeholder-gray-500"
                           placeholder="Nhập tên nghệ sĩ...">
                </div>

                <!-- Upload Audio -->
                <div>
                    <label for="audio" class="block text-sm font-medium text-gray-300 mb-1">
                        File nhạc (MP3/WAV) <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="audio" id="audio" accept="audio/*" required
                           class="w-full text-sm text-gray-300 border border-[#2a2a2a] rounded-lg cursor-pointer bg-[#121212] focus:outline-none 
                                  file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-600 file:text-white hover:file:bg-green-700">
                    <audio id="audio-preview" controls class="mt-3 hidden w-full rounded-lg"></audio>
                    <div id="duration" class="text-gray-400 text-sm mt-1 hidden">Thời lượng: <span id="time-text"></span></div>
                </div>

                <!-- Upload Ảnh bìa -->
                <div>
                    <label for="cover" class="block text-sm font-medium text-gray-300 mb-1">Ảnh bìa (tùy chọn)</label>
                    <input type="file" name="cover" id="cover" accept="image/*"
                           class="w-full text-sm text-gray-300 border border-[#2a2a2a] rounded-lg cursor-pointer bg-[#121212] focus:outline-none 
                                  file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-600 file:text-white hover:file:bg-green-700">
                    <img id="cover-preview" src="" class="hidden mt-3 w-32 h-32 rounded-lg object-cover shadow-md border border-[#2a2a2a]">
                </div>

                <!-- Nút hành động -->
                <div class="flex justify-end items-center gap-3 pt-4 border-t border-[#2a2a2a]">
                    <a href="{{ route('songs.index') }}"
                       class="px-4 py-2 bg-[#2a2a2a] hover:bg-[#3a3a3a] text-gray-200 rounded-lg transition">
                        Hủy
                    </a>
                    <button type="submit"
                            class="px-5 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-white font-semibold shadow-md transition">
                        Lưu bài hát
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    @push('scripts')
        <script>
            lucide.createIcons();

            const audioInput = document.getElementById('audio');
            const audioPreview = document.getElementById('audio-preview');
            const coverInput = document.getElementById('cover');
            const coverPreview = document.getElementById('cover-preview');
            const durationBox = document.getElementById('duration');
            const timeText = document.getElementById('time-text');

            // Preview ảnh bìa
            coverInput.addEventListener('change', e => {
                const file = e.target.files[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    coverPreview.src = url;
                    coverPreview.classList.remove('hidden');
                }
            });

            // Preview nhạc và hiển thị thời lượng
            audioInput.addEventListener('change', e => {
                const file = e.target.files[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    audioPreview.src = url;
                    audioPreview.classList.remove('hidden');
                    audioPreview.addEventListener('loadedmetadata', () => {
                        const minutes = Math.floor(audioPreview.duration / 60);
                        const seconds = Math.floor(audioPreview.duration % 60).toString().padStart(2, '0');
                        timeText.textContent = `${minutes}:${seconds}`;
                        durationBox.classList.remove('hidden');
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
