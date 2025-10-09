<section>
    <header>
        <p class="mt-1 text-sm text-gray-100">
            {{ __("Cập nhật thông tin tài khoản và địa chỉ email của bạn.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="name" value="Họ và tên" class="text-white" />
            <x-text-input 
                id="name" 
                name="name" 
                type="text" 
                class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                       focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                :value="old('name', $user->name)" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Nhập họ và tên của bạn"
            />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Địa chỉ Email" class="text-white" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                       focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                :value="old('email', $user->email)" 
                required 
                autocomplete="username"
                placeholder="you@example.com"
            />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-sm text-gray-400">
                        Địa chỉ email của bạn <span class="text-red-400">chưa được xác minh.</span>
                        <button form="send-verification" 
                                class="underline text-sm text-green-400 hover:text-green-300 transition-colors ml-1">
                            Gửi lại email xác minh
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            Liên kết xác minh mới đã được gửi đến email của bạn.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 
                       text-black font-semibold rounded-lg shadow-md hover:shadow-green-500/30 
                       transition-all duration-200 hover:scale-[1.03]">
                Lưu thay đổi
            </x-primary-button>

            @if (session('status') === 'profile-updated')
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