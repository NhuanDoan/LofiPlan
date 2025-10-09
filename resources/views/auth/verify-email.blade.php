<x-guest-layout>
    <div class="text-center space-y-5">

        <div class="flex justify-center">
            <div class="bg-green-500/10 p-4 rounded-full border border-green-400/30 shadow-lg inline-flex items-center justify-center">
                <i data-lucide="mail-check" class="w-8 h-8 text-green-400"></i>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-white">
            Xác minh địa chỉ email của bạn
        </h1>

        <p class="text-gray-400 text-sm leading-relaxed">
            Cảm ơn bạn đã đăng ký! 
            Trước khi bắt đầu, vui lòng kiểm tra email của bạn và nhấp vào liên kết xác minh.  
            Nếu bạn chưa nhận được email, bạn có thể yêu cầu gửi lại bên dưới.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="p-3 bg-green-500/10 border border-green-400/30 text-green-400 rounded-lg text-sm">
                Liên kết xác minh mới đã được gửi đến email của bạn!
            </div>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="flex items-center justify-center gap-2 px-6 py-2.5 
                           bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 
                           text-black font-semibold rounded-lg shadow-md hover:shadow-green-500/30 
                           transition-all duration-200 hover:scale-[1.03]">
                    <i data-lucide="refresh-ccw" class="w-4 h-4"></i>
                    Gửi lại email xác minh
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-sm text-gray-400 hover:text-red-400 transition-all underline decoration-gray-600 hover:decoration-red-400">
                    Đăng xuất
                </button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</x-guest-layout>
