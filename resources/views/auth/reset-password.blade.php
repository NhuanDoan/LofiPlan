<x-guest-layout>
    <div class="text-center space-y-5">
        <div class="flex justify-center">
            <div class="bg-green-500/10 p-4 rounded-full border border-green-400/30 shadow-lg inline-flex items-center justify-center">
                <i data-lucide="lock-keyhole" class="w-8 h-8 text-green-400"></i>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-white">Đặt lại mật khẩu</h1>
        <p class="text-gray-400 text-sm leading-relaxed">
            Nhập mật khẩu mới để khôi phục quyền truy cập tài khoản của bạn.
        </p>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5 mt-4 text-left">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" type="email" name="email"
                    :value="old('email', $request->email)" required autofocus autocomplete="username"
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                           focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Mật khẩu mới')" class="text-white" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                           focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" class="text-white" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                           focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="Nhập lại mật khẩu" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-6 py-2.5 
                           bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 
                           text-black font-semibold rounded-lg shadow-md hover:shadow-green-500/30 
                           transition-all duration-200 hover:scale-[1.03]">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    Đặt lại mật khẩu
                </button>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-green-400 transition-all">
                    <i data-lucide="arrow-left" class="inline w-4 h-4 align-text-bottom"></i>
                    Quay lại đăng nhập
                </a>
            </div>
        </form>
    </div>

</x-guest-layout>
