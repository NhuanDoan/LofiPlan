<x-guest-layout>
    <div class="w-full max-w-md bg-[#111827]/70 backdrop-blur-lg border border-white/10 rounded-2xl shadow-xl p-8 space-y-6">

        <div class="text-center space-y-3">
            <div class="flex justify-center items-center gap-2">
                <i data-lucide="headphones" class="w-6 h-6 text-green-400"></i>
                <h1 class="text-2xl font-bold text-white tracking-tight">
                    Đăng nhập vào <span class="text-green-400">LofiPlan</span>
                </h1>
            </div>
            <p class="text-gray-400 text-sm">
                Thư giãn cùng nhạc 🎧 và sắp xếp công việc của bạn mỗi ngày 📅
            </p>
        </div>

        <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Mật khẩu')" class="text-white" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password"
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center text-gray-400 text-sm">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-600 text-green-500 focus:ring-green-400" name="remember">
                    <span class="ml-2">Ghi nhớ đăng nhập</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-green-400 hover:underline">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-6 py-2.5 
                           bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 
                           text-black font-semibold rounded-lg shadow-md hover:shadow-green-500/30 
                           transition-all duration-200 hover:scale-[1.03]">
                    <i data-lucide="log-in" class="w-4 h-4"></i> Đăng nhập
                </button>
            </div>
        </form>

        <p class="text-center text-gray-400 text-sm mt-4">
            Chưa có tài khoản?
            <a href="{{ route('register') }}" class="text-green-400 hover:underline font-medium">Đăng ký ngay</a>
        </p>
    </div>
</x-guest-layout>
