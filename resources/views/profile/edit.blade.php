<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-400 leading-tight flex items-center gap-2">
            <i data-lucide="user-circle" class="w-5 h-5 text-green-400"></i>
            {{ __('Hồ sơ cá nhân') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-[#0b0f12] min-h-screen text-white">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">
   
            <div class="p-6 bg-[#111827]/70 backdrop-blur-lg border border-white/10 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-green-400 mb-4 flex items-center gap-2">
                    <i data-lucide="id-card" class="w-5 h-5"></i> Thông tin cá nhân
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 bg-[#111827]/70 backdrop-blur-lg border border-white/10 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-green-400 mb-4 flex items-center gap-2">
                    <i data-lucide="key-round" class="w-5 h-5"></i> Đổi mật khẩu
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 bg-[#111827]/70 backdrop-blur-lg border border-red-500/30 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-red-400 mb-4 flex items-center gap-2">
                    <i data-lucide="trash-2" class="w-5 h-5"></i> Xóa tài khoản
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}"
          class="p-6 bg-[#111827] text-white rounded-2xl border border-white/10 backdrop-blur-lg shadow-2xl">
        @csrf
        @method('delete')

        <h2 class="text-lg font-semibold text-red-400 flex items-center gap-2">
            <i data-lucide="alert-triangle" class="w-5 h-5"></i>
            Bạn có chắc muốn xóa tài khoản?
        </h2>

        <p class="mt-2 text-sm text-gray-400 leading-relaxed">
            Khi xác nhận, toàn bộ dữ liệu của bạn sẽ bị <span class="text-red-400">xóa vĩnh viễn</span> và 
            không thể khôi phục. Nhập mật khẩu để xác nhận.
        </p>

        <div class="mt-6">
            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg
                       focus:ring-red-500 focus:border-red-500 placeholder-gray-500"
                placeholder="Nhập mật khẩu của bạn"
            />
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <x-secondary-button
                x-on:click="$dispatch('close')"
                class="bg-[#1a1f2e] border border-gray-600 text-gray-300 hover:bg-gray-700 hover:text-white 
                       rounded-lg transition-all duration-200 px-5 py-2"
            >
                Hủy
            </x-secondary-button>

            <x-danger-button
                class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 
                       text-white font-semibold rounded-lg shadow-md hover:shadow-red-500/30 
                       transition-all duration-200 hover:scale-[1.03] px-6 py-2"
            >
                Xóa tài khoản
            </x-danger-button>
        </div>
    </form>
</x-modal>
