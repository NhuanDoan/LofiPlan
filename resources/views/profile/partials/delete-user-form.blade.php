<section class="space-y-6">
    <header>
        <p class="mt-1 text-sm text-gray-300 leading-relaxed">
            Khi bạn xóa tài khoản, tất cả dữ liệu và thông tin liên quan sẽ bị
            <span class="text-red-400 font-semibold">xóa vĩnh viễn</span>.
        </p>
    </header>

    <x-danger-button
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 
               text-white font-semibold rounded-lg shadow-md hover:shadow-red-500/30 
               transition-all duration-200 hover:scale-[1.03] px-6 py-2.5"
    >
        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Xóa tài khoản
    </x-danger-button>
</section>
