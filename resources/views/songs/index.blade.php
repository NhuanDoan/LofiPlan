<x-app-layout>
    <div class="bg-[#0f0f10] text-white min-h-screen p-4 pb-36 sm:p-6">
        <div class="max-w-6xl mx-auto">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <h2 class="text-2xl font-bold">🎧 Playlist</h2>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <input id="searchInput" type="text" placeholder="Tìm bài hoặc nghệ sĩ..."
                           class="flex-1 sm:w-64 px-3 py-2 rounded-lg bg-[#121212] text-sm border border-[#252525] focus:outline-none focus:ring-2 focus:ring-green-500" />
                    <a href="{{ route('songs.create') }}"
                       class="bg-green-500 hover:bg-green-600 text-black font-semibold px-4 py-2 rounded-lg text-sm shadow whitespace-nowrap">
                        + Thêm bài
                    </a>
                </div>
            </div>

            <div class="hidden sm:grid grid-cols-12 gap-4 items-center bg-[#181818] text-gray-400 px-6 py-3 border-b border-[#222] rounded-t-lg">
                <div class="col-span-1">Số thứ tự</div>
                <div class="col-span-6">Bài hát</div>
                <div class="col-span-2">Ngày thêm</div>
                <div class="col-span-1 text-right">Thời lượng</div>
                <div class="col-span-2 text-center">Thao tác</div>
            </div>

            <div id="songRows" class="bg-[#0b0b0b] divide-y divide-[#1a1a1a] rounded-b-lg sm:rounded-none">
                @foreach($songs as $i => $song)
                    <div class="song-row grid grid-cols-1 sm:grid-cols-12 sm:gap-4 items-center hover:bg-[#151515] px-4 sm:px-6 py-4 cursor-pointer transition"
                         data-index="{{ $i }}"
                         data-url="{{ Storage::url($song->file_path) }}"
                         data-title="{{ $song->title }}"
                         data-artist="{{ $song->artist }}"
                         data-cover="{{ $song->cover_path ? Storage::url($song->cover_path) : '/default-cover.png' }}"
                         data-duration="{{ $song->duration ?? '' }}">

                        <div class="hidden sm:block col-span-1 text-gray-400 text-center">{{ $i + 1 }}</div>

                        <div class="col-span-6 flex items-center gap-4">
                            <img src="{{ $song->cover_path ? Storage::url($song->cover_path) : '/default-cover.png' }}"
                                 class="w-14 h-14 sm:w-12 sm:h-12 rounded-md object-cover shadow">
                            <div>
                                <div class="text-white font-medium text-base sm:text-sm">{{ $song->title }}</div>
                                <div class="text-xs text-gray-400">{{ $song->artist }}</div>
                            </div>
                        </div>

                        <div class="hidden sm:block col-span-2 text-gray-400 text-sm">
                            {{ $song->created_at->format('Y-m-d') }}
                        </div>

                        <div class="hidden sm:block col-span-1 text-gray-300 text-sm text-center">
                            {{ $song->duration ? gmdate('i:s', $song->duration) : '--' }}
                        </div>

                        <div class="col-span-12 sm:col-span-2 flex sm:justify-center justify-end items-center gap-2 sm:gap-3 mt-2 sm:mt-0">
                            @can('update', $song)
                            <a href="{{ route('songs.edit', $song) }}"
                            class="flex items-center justify-center gap-1 sm:gap-2 w-10 h-10 sm:w-auto sm:px-3 sm:py-1.5 
                                    rounded-md bg-[#1DB954]/10 text-green-400 hover:bg-[#1DB954]/20 
                                    transition-all duration-200 text-sm font-medium shadow-sm">
                                <i data-lucide="pencil" class="w-5 h-5"></i>
                                <span class="hidden sm:inline">Sửa</span>
                            </a>

                            <form action="{{ route('songs.destroy', $song) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc muốn xóa bài này không?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="flex items-center justify-center gap-1 sm:gap-2 w-10 h-10 sm:w-auto sm:px-3 sm:py-1.5 
                                            rounded-md bg-red-500/10 text-red-400 hover:bg-red-500/20 
                                            transition-all duration-200 text-sm font-medium shadow-sm">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    <span class="hidden sm:inline">Xóa</span>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('components.player')
</x-app-layout>
