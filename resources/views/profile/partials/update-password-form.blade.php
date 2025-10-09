<section>
    <header>
        <p class="mt-1 text-sm text-gray-100">
            {{ __('Hãy đảm bảo tài khoản của bạn luôn an toàn bằng cách sử dụng mật khẩu mạnh và bảo mật.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Mật khẩu hiện tại" class="text-white" />
            <x-text-input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                       focus:ring-green-400 focus:border-green-400 placeholder-gray-500" 
                placeholder="Nhập mật khẩu hiện tại"
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Mật khẩu mới" class="text-white" />
            <x-text-input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                       focus:ring-green-400 focus:border-green-400 placeholder-gray-500" 
                placeholder="Nhập mật khẩu mới"
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Xác nhận mật khẩu" class="text-white" />
            <x-text-input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                       focus:ring-green-400 focus:border-green-400 placeholder-gray-500" 
                placeholder="Nhập lại mật khẩu mới"
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 
                       text-black font-semibold rounded-lg shadow-md hover:shadow-green-500/30 
                       transition-all duration-200 hover:scale-[1.03]">
                Lưu thay đổi
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >
                    Đã lưu.
                </p>
            @endif
        </div>
    </form>
</section>