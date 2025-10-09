<x-app-layout>
    <div class="bg-[#0f0f10] min-h-screen text-white py-12">
        <div class="max-w-md mx-auto bg-[#181818] p-8 rounded-2xl shadow-lg border border-[#2a2a2a]">
            
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-green-400 flex items-center gap-2">
                    <i data-lucide="edit-3" class="w-6 h-6"></i>
                    Chỉnh sửa bài hát
                </h2>

                <a href="{{ route('songs.index') }}"
                   class="flex items-center gap-2 px-4 py-2 bg-[#1DB954]/10 text-green-400 rounded-lg hover:bg-[#1DB954]/20 transition-all duration-200">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại
                </a>
            </div>

            <!-- Form -->
            <form action="{{ route('songs.update', $song) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Tên bài hát -->
                <div>
                    <label for="title" class="block mb-2 text-gray-300 font-medium">Tên bài hát</label>
                    <input type="text" id="title" name="title" value="{{ $song->title }}" required
                           class="w-full px-4 py-2 rounded-lg bg-[#121212] border border-[#2a2a2a] focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- Nghệ sĩ -->
                <div>
                    <label for="artist" class="block mb-2 text-gray-300 font-medium">Ca sĩ / Nghệ sĩ</label>
                    <input type="text" id="artist" name="artist" value="{{ $song->artist }}"
                           class="w-full px-4 py-2 rounded-lg bg-[#121212] border border-[#2a2a2a] focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- Buttons -->
                <div class="flex justify-end items-center gap-3 mt-6">
                    <a href="{{ route('songs.index') }}"
                       class="flex items-center gap-1 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition text-gray-200">
                        <i data-lucide="x" class="w-4 h-4"></i> Hủy
                    </a>
                    <button type="submit"
                            class="flex items-center gap-1 px-5 py-2 bg-green-500 hover:bg-green-600 text-black font-semibold rounded-lg transition">
                        <i data-lucide="save" class="w-4 h-4"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lucide icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</x-app-layout>
