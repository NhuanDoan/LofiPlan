<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-[#071014] py-10">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Lịch công việc tuần</h1>

                <div class="flex items-center justify-center gap-2 mt-4">
                    <a href="{{ route('todos.index', ['date' => $base->copy()->subWeek()->toDateString()]) }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                                text-gray-700 dark:text-gray-200
                                bg-white dark:bg-gray-800
                                border border-gray-200 dark:border-gray-700
                                rounded-lg shadow-sm
                                hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-600
                                active:scale-[0.98] transition-all duration-150">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            Tuần trước
                    </a>

                    <a href="{{ route('todos.index') }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                                text-gray-700 dark:text-gray-200
                                bg-white dark:bg-gray-800
                                border border-gray-200 dark:border-gray-700
                                rounded-lg shadow-sm
                                hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-600
                                active:scale-[0.98] transition-all duration-150">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            Hôm nay
                    </a>

                    <a href="{{ route('todos.index', ['date' => $base->copy()->addWeek()->toDateString()]) }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                                text-gray-700 dark:text-gray-200
                                bg-white dark:bg-gray-800
                                border border-gray-200 dark:border-gray-700
                                rounded-lg shadow-sm
                                hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-600
                                active:scale-[0.98] transition-all duration-150">
                            Tuần sau
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                     </a>

                    <button id="open-add"
                        class="ml-3 inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium 
                            text-white bg-green-500 dark:bg-green-600 
                            rounded-lg shadow-sm hover:bg-green-600 dark:hover:bg-green-700 
                            active:scale-[0.98] transition-all duration-150">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Thêm công việc
                    </button>
                </div>
            </div>

            <div class="w-full overflow-x-auto">
                <div class="w-full min-w-[2400px] sm:min-w-full border rounded-xl bg-white dark:bg-gray-900 shadow-md">
                    <div class="grid grid-cols-8 gap-0 sticky top-0 z-10">
                        <div class="py-3 px-2 border-r text-center font-semibold 
                                    bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 
                                    flex items-center justify-center">
                            Buổi
                        </div>

                        @foreach($days as $d)
                            @php
                                $thu = $d->locale('vi')->translatedFormat('l');
                                $thuMap = [
                                    'thứ hai' => 'Thứ Hai',
                                    'thứ ba' => 'Thứ Ba',
                                    'thứ tư' => 'Thứ Tư',
                                    'thứ năm' => 'Thứ Năm',
                                    'thứ sáu' => 'Thứ Sáu',
                                    'thứ bảy' => 'Thứ Bảy',
                                    'chủ nhật' => 'Chủ Nhật',
                                ];
                                $isToday = $d->isToday();
                            @endphp

                            <div
                                @if($isToday) aria-current="date" @endif
                                class="py-3 px-4 border-b border-r text-center {{ $isToday ? 'bg-blue-50 dark:bg-blue-900/20' : 'bg-gray-50 dark:bg-gray-800/60' }}">

                                <div class="flex items-center justify-center gap-2">
                                    <div class="{{ $isToday ? 'text-sm font-bold text-blue-600 dark:text-blue-300' : 'text-sm font-bold text-gray-800 dark:text-gray-100' }}">
                                        {{ $thuMap[strtolower($thu)] ?? ucfirst($thu) }}
                                    </div>
                                </div>

                                <div class="{{ $isToday ? 'text-xs text-blue-600 dark:text-blue-300 mt-0.5' : 'text-xs text-gray-500 dark:text-gray-400 mt-0.5' }}">
                                    {{ $d->format('d/m/Y') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @php
                        $shifts = [
                            'morning' => 'Sáng',
                            'afternoon' => 'Chiều',
                            'evening' => 'Tối',
                        ];
                    @endphp

                    @foreach($shifts as $shiftKey => $shiftLabel)
                        <div class="grid grid-cols-8 gap-0 border-t">
                            <div class="flex items-center justify-center px-2 border-r
                                        bg-yellow-50 dark:bg-gray-800 text-center min-h-[80px]
                                        text-gray-700 dark:text-gray-200 font-bold">
                                {{ $shiftLabel }}
                            </div>

                            @foreach($days as $d)
                                @php
                                    $dateKey = $d->toDateString();
                                    $cellTodos = $todos->get($dateKey, collect())->where('shift', $shiftKey);
                                @endphp
                                <div class="py-4 px-4 border-r min-h-[140px] bg-white dark:bg-[#0d1418]">
                                    <div class="space-y-3">
                                        @foreach($cellTodos as $t)
                                            <div 
                                                class="todo-card flex flex-col justify-between h-full min-h-[180px] p-4 rounded-2xl 
                                                    border border-gray-200 dark:border-gray-700 
                                                    bg-gradient-to-br from-white via-sky-50 to-blue-50 
                                                    dark:from-[#0c1418] dark:via-[#0d1820] dark:to-[#111f2a]
                                                    shadow-sm hover:shadow-lg hover:-translate-y-[3px] hover:border-blue-400/50 
                                                    transition-all duration-300 ease-out cursor-pointer min-w-[260px] sm:min-w-0"
                                                data-id="{{ $t->id }}"
                                                data-title="{{ e($t->title) }}"
                                                data-desc="{{ e($t->description) }}"
                                                data-date="{{ $t->date->toDateString() }}"
                                                data-shift="{{ $t->shift }}"
                                                data-done="{{ $t->is_done ? '1' : '0' }}"
                                            >
                                                <div class="flex-1">
                                                    <div class="font-semibold text-[15px] text-gray-800 dark:text-gray-100 mb-1">
                                                        {{ $t->title }}
                                                    </div>

                                                    @if($t->description)
                                                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-1">
                                                            {{ $t->description }}
                                                        </div>
                                                    @endif

                                                    <div class="text-center">
                                                        @if($t->is_done)
                                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 border border-green-400/30 rounded-full text-[12px] font-medium">
                                                                <i data-lucide="check-circle" class="w-4 h-4"></i> Hoàn thành
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-yellow-50 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 border border-yellow-400/30 rounded-full text-[12px] font-medium">
                                                                <i data-lucide="clock-3" class="w-4 h-4"></i> Chưa làm
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="text-[11px] text-gray-400 dark:text-gray-500 mt-3 text-center">
                                                        Thời gian tạo: {{ $t->created_at->format('H:i d/m') }}
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <button
                                                        class="open-detail w-full py-2.5 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 
                                                            active:scale-[0.98] rounded-lg shadow-sm hover:shadow-md transition-all duration-150">
                                                        Xem thêm
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($cellTodos->isEmpty())
                                            <div class="text-xs text-gray-400 text-center py-2 italic">Không có công việc</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div id="modal-add" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-md p-6 relative border border-gray-100 dark:border-gray-700 animate-in fade-in duration-200">
            
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i data-lucide="plus-circle" class="w-5 h-5 text-green-600"></i>
                    Thêm công việc
                </h3>
                <button id="close-add"
                    class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="form-add" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        <i data-lucide="type" class="inline w-4 h-4 mr-1 text-blue-500"></i> Tiêu đề
                    </label>
                    <input name="title" required
                        class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 
                            bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        <i data-lucide="file-text" class="inline w-4 h-4 mr-1 text-purple-500"></i> Mô tả
                    </label>
                    <textarea name="description" rows="3"
                        class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 
                            bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"></textarea>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <i data-lucide="calendar" class="inline w-4 h-4 mr-1 text-amber-500"></i> Ngày
                        </label>
                        <input type="date" name="date" value="{{ \Carbon\Carbon::today()->toDateString() }}"
                            class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 
                                bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <i data-lucide="clock-3" class="inline w-4 h-4 mr-1 text-indigo-500"></i> Buổi
                        </label>
                        <select name="shift"
                            class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 
                                bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            <option value="morning">Sáng</option>
                            <option value="afternoon">Chiều</option>
                            <option value="evening">Tối</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800 mt-4">
                    <button type="button" id="cancel-add"
                        class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-100 dark:bg-gray-800 
                            text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        <i data-lucide="x-circle" class="inline w-4 h-4 mr-1"></i> Hủy
                    </button>
                    <button type="submit"
                        class="px-5 py-2 rounded-lg text-sm font-medium text-white 
                            bg-gradient-to-r from-green-500 to-emerald-600 
                            hover:from-green-600 hover:to-emerald-700 shadow-sm hover:shadow-md 
                            active:scale-[0.98] transition-all">
                        <i data-lucide="save" class="inline w-4 h-4 mr-1"></i> Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-detail" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
        <div class="bg-white dark:bg-[#0b0f16] rounded-2xl w-full max-w-md p-6 border border-gray-200/70 dark:border-gray-800 
            shadow-[0_10px_40px_rgba(0,0,0,0.2)] transition-all duration-300 scale-100"
        >
            <div class="flex items-start justify-between gap-4 mb-5 border-b border-gray-100 dark:border-gray-800 pb-3">
                <div>
                    <h3 id="detail-title" class="text-xl font-semibold text-gray-900 dark:text-gray-100 tracking-tight"></h3>
                    <div id="detail-date" class="text-sm text-gray-500 dark:text-gray-400 mt-1"></div>
                </div>

                <button
                    id="close-detail"
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition"
                >
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div id="detail-desc" class="text-gray-700 dark:text-gray-300 whitespace-pre-line mb-5 leading-relaxed"></div>

            <div id="edit-fields" class="hidden space-y-3 mb-5">
                <input
                    id="edit-title"
                    type="text"
                    class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-xl 
                        bg-gray-50 dark:bg-gray-800/80 text-gray-900 dark:text-gray-100 
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                />
                <textarea
                    id="edit-desc"
                    rows="3"
                    class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-xl 
                        bg-gray-50 dark:bg-gray-800/80 text-gray-900 dark:text-gray-100 
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none"
                ></textarea>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="space-x-2">
                    <button id="toggle-done"
                        class="px-3 py-1.5 rounded-lg text-sm font-medium border border-gray-300 dark:border-gray-700 
                            text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 
                            shadow-sm transition-all active:scale-[0.98]"
                    >
                        <i data-lucide="check-circle" class="inline w-4 h-4 mr-1"></i> Hoàn thành
                    </button>

                    <button id="edit-btn"
                        class="px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm font-medium 
                            hover:bg-blue-700 shadow-sm hover:shadow-md active:scale-[0.97] transition-all"
                    >
                        <i data-lucide="pencil" class="inline w-4 h-4 mr-1"></i> Sửa
                    </button>
                </div>

                <div class="space-x-2">
                    <button id="save-edit"
                        class="hidden px-3 py-1.5 rounded-lg text-sm font-medium 
                            text-white bg-green-600 hover:bg-green-700 
                            shadow-sm hover:shadow-md active:scale-[0.97] 
                            transition-all duration-200 ease-out"
                    >
                        <i data-lucide="save" class="inline w-4 h-4 mr-1"></i> Lưu
                    </button>

                    <button id="delete-btn"
                        class="px-3 py-1.5 bg-red-600 text-white rounded-lg text-sm font-medium 
                            hover:bg-red-700 shadow-sm hover:shadow-md active:scale-[0.97] transition-all"
                    >
                        <i data-lucide="trash-2" class="inline w-4 h-4 mr-1"></i> Xóa
                    </button>
                </div>
            </div>
        </div>
    </div>




    <meta name="csrf-token" content="{{ csrf_token() }}">

    @push('scripts')
    <script>
        (function(){
            const openAdd = document.getElementById('open-add');
            const modalAdd = document.getElementById('modal-add');
            const closeAdd = document.getElementById('close-add');
            const cancelAdd = document.getElementById('cancel-add');
            const formAdd = document.getElementById('form-add');

            const modalDetail = document.getElementById('modal-detail');
            const closeDetail = document.getElementById('close-detail');
            const detailTitle = document.getElementById('detail-title');
            const detailDesc = document.getElementById('detail-desc');
            const detailDate = document.getElementById('detail-date');
            const toggleDoneBtn = document.getElementById('toggle-done');
            const deleteBtn = document.getElementById('delete-btn');

            const editBtn = document.getElementById('edit-btn');
            const saveEditBtn = document.getElementById('save-edit');
            const editFields = document.getElementById('edit-fields');
            const editTitle = document.getElementById('edit-title');
            const editDesc = document.getElementById('edit-desc');

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            openAdd.addEventListener('click', () => {
                modalAdd.classList.remove('hidden');
                modalAdd.classList.add('flex');
            });
            closeAdd.addEventListener('click', () => hideAdd());
            cancelAdd.addEventListener('click', () => hideAdd());
            function hideAdd(){ modalAdd.classList.remove('flex'); modalAdd.classList.add('hidden'); formAdd.reset(); }

            formAdd.addEventListener('submit', async (e) => {
                e.preventDefault();
                const fd = new FormData(formAdd);
                const body = Object.fromEntries(fd.entries());
                const res = await fetch("{{ route('todos.store') }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                });
                if (res.ok) {
                    location.reload();
                } else {
                    const err = await res.json().catch(()=>({}));
                    alert('Thêm thất bại');
                }
            });

            document.addEventListener('click', (ev) => {
                const btn = ev.target.closest('.open-detail');
                const card = ev.target.closest('.todo-card');
                if (btn && card) {
                    openDetailFromCard(card);
                } else if (ev.target.closest('.todo-card') && ev.target.closest('.todo-card').querySelector('.open-detail') === null) {
                    openDetailFromCard(ev.target.closest('.todo-card'));
                }
            });

            function openDetailFromCard(card){
                const id = card.dataset.id;
                const title = card.dataset.title;
                const desc = card.dataset.desc;
                const date = card.dataset.date;
                const done = card.dataset.done === '1';

                detailTitle.textContent = title;
                detailDesc.textContent = desc || '-';
                detailDate.textContent = new Date(date).toLocaleDateString();
                toggleDoneBtn.textContent = done 
                ? 'Đánh dấu chưa hoàn thành' 
                : 'Đánh dấu hoàn thành';

                toggleDoneBtn.className = done
                ? 'px-3 py-1.5 rounded-lg text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 active:scale-[0.98] shadow-sm transition-all duration-200'
                : 'px-3 py-1.5 rounded-lg text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] shadow-sm transition-all duration-200';
                modalDetail.dataset.id = id;

                modalDetail.classList.remove('hidden'); modalDetail.classList.add('flex');
            }

            closeDetail.addEventListener('click', hideDetail);
            function hideDetail(){ modalDetail.classList.remove('flex'); modalDetail.classList.add('hidden'); }

            toggleDoneBtn.addEventListener('click', async () => {
                const id = modalDetail.dataset.id;
                const card = document.querySelector(`.todo-card[data-id="${id}"]`);
                if (!card) return;
                const isDone = card.dataset.done === '1';
                const res = await fetch(`/todos/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ is_done: !isDone })
                });
                if (res.ok) {
                    const json = await res.json();

                    card.dataset.done = json.is_done ? '1' : '0';
                    const badge = card.querySelector('div > div:last-child > div'); 

                    location.reload();
                } else {
                    alert('Cập nhật thất bại');
                }
            });

            deleteBtn.addEventListener('click', async () => {
                if (!confirm('Bạn chắc chắn muốn xóa?')) return;
                const id = modalDetail.dataset.id;
                const res = await fetch(`/todos/${id}`, {
                    method: 'DELETE',
                    headers: {'X-CSRF-TOKEN': csrf, 'Accept': 'application/json'}
                });
                if (res.ok) location.reload();
                else alert('Xóa thất bại');
            });

            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') { hideAdd(); hideDetail(); }
            });
            document.querySelectorAll('#modal-add, #modal-detail').forEach(m => {
                m.addEventListener('click', (ev) => {
                    if (ev.target === m) { m.classList.remove('flex'); m.classList.add('hidden'); }
                });
            });

            editBtn.addEventListener('click', () => {
                editFields.classList.remove('hidden');
                saveEditBtn.classList.remove('hidden');
                editBtn.classList.add('hidden');
                editTitle.value = detailTitle.textContent;
                editDesc.value = detailDesc.textContent === '-' ? '' : detailDesc.textContent;
            });

            saveEditBtn.addEventListener('click', async () => {
                const id = modalDetail.dataset.id;
                const body = {
                    title: editTitle.value.trim(),
                    description: editDesc.value.trim()
                };
                const res = await fetch(`/todos/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(body)
                });
                if (res.ok) {
                    location.reload();
                } else {
                    alert('Cập nhật thất bại!');
                } 
            });
        })();
    </script>
    @endpush
</x-app-layout>
