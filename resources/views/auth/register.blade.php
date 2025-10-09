<x-guest-layout>
    <div class="w-full max-w-md bg-[#111827]/70 backdrop-blur-lg border border-white/10 rounded-2xl shadow-xl p-8 space-y-6">
        
        <div class="text-center space-y-3">
            <div class="flex justify-center items-center gap-2">
                <i data-lucide="user-plus" class="w-6 h-6 text-green-400"></i>
                <h1 class="text-2xl font-bold text-white tracking-tight">
                    Tạo tài khoản <span class="text-green-400">LofiPlan</span>
                </h1>
            </div>
            <p class="text-gray-400 text-sm">
                Quản lý công việc, nghe nhạc và thư giãn cùng bạn 🎧
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Tên người dùng')" class="text-white" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                            focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="Nguyễn Văn A" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                            focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Mật khẩu')" class="text-white" />
                <x-text-input id="password" type="password" name="password" required
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                            focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" class="text-white" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg 
                            focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
            </div>

            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('login') }}" class="text-sm text-green-400 hover:underline">
                    Đã có tài khoản?
                </a>

                <button type="submit"
                    class="flex items-center justify-center gap-2 px-6 py-2.5 
                            bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 
                            text-black font-semibold rounded-lg shadow-md hover:shadow-green-500/30 
                            transition-all duration-200 hover:scale-[1.03]">
                    <i data-lucide="user-check" class="w-4 h-4"></i>
                    Đăng ký
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
