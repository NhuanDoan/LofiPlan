<x-guest-layout>
    <div class="text-center space-y-5">

        <div class="flex justify-center">
            <div class="bg-green-500/10 p-4 rounded-full border border-green-400/30 shadow-lg inline-flex items-center justify-center">
                <i data-lucide="mail" class="w-8 h-8 text-green-400"></i>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-white">
            Quên mật khẩu?
        </h1>

        <p class="text-gray-400 text-sm leading-relaxed">
            Không sao cả — chỉ cần nhập email của bạn,  
            chúng tôi sẽ gửi liên kết để đặt lại mật khẩu mới.
        </p>

        <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="mt-1 block w-full bg-[#1a1f2e] border border-[#2b3245] text-white rounded-lg focus:ring-green-400 focus:border-green-400 placeholder-gray-500"
                    placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-6 py-2.5 
                           bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 
                           text-black font-semibold rounded-lg shadow-md hover:shadow-green-500/30 
                           transition-all duration-200 hover:scale-[1.03]">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Gửi liên kết đặt lại mật khẩu
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
