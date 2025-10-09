<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>LofiPlan</title>

      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

      <script src="https://unpkg.com/lucide@latest"></script>

      @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="min-h-screen bg-[#0b0f12] dark:bg-[#0a0a0a] text-white flex flex-col justify-center items-center px-6 lg:px-8 relative overflow-hidden font-[Instrument Sans]">

      <div class="absolute inset-0 bg-gradient-to-br from-[#0b0f12] via-[#111927] to-[#0f0f10]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(0,255,163,0.08),transparent_70%)]"></div>
      <div class="absolute -top-40 left-1/2 w-[600px] h-[600px] bg-green-500/20 rounded-full blur-[120px] -translate-x-1/2"></div>

      <header class="absolute top-6 right-0 left-0 flex justify-end w-full max-w-5xl mx-auto text-sm z-10">
          @if (Route::has('login'))
              <nav class="flex items-center gap-4">
                  @auth
                      <a href="{{ url('/dashboard') }}"
                         class="flex items-center gap-2 px-4 py-2 border border-transparent hover:border-green-400/40 rounded-lg text-sm font-medium text-white hover:text-green-400 transition-all duration-150 hover:scale-[1.03]">
                          <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                          Trang chủ
                      </a>
                  @else
                      <a href="{{ route('login') }}"
                         class="flex items-center gap-2 px-4 py-2 text-gray-300 hover:text-green-400 transition-all duration-150 hover:scale-[1.03]">
                          <i data-lucide="log-in" class="w-4 h-4"></i>
                          Đăng nhập
                      </a>

                      @if (Route::has('register'))
                          <a href="{{ route('register') }}"
                             class="flex items-center gap-2 px-4 py-2 border border-green-400/30 text-green-400 hover:bg-green-500/10 rounded-lg transition-all duration-150 hover:scale-[1.03]">
                              <i data-lucide="user-plus" class="w-4 h-4"></i>
                              Đăng ký
                          </a>
                      @endif
                  @endauth
              </nav>
          @endif
      </header>

      <main class="relative z-10 flex flex-col items-center text-center max-w-2xl space-y-8 animate-fade-in">
          <div class="flex justify-center">
              <div class="bg-green-500/10 p-5 rounded-full border border-green-400/30 shadow-lg backdrop-blur-sm">
                  <i data-lucide="music-3" class="w-10 h-10 text-green-400"></i>
              </div>
          </div>

          <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight drop-shadow-[0_0_15px_rgba(0,255,163,0.15)]">
              Chào mừng đến <span class="text-green-400">LofiPlan</span>
          </h1>

          <p class="text-gray-400 text-lg sm:text-base leading-relaxed">
              <span class="text-green-400 font-medium">LofiPlan</span> giúp bạn nghe nhạc thư giãn 
              <i data-lucide="headphones" class="inline w-4 h-4 text-green-400 align-text-bottom"></i>,
              lên kế hoạch công việc 
              <i data-lucide="calendar-check-2" class="inline w-4 h-4 text-blue-400 align-text-bottom"></i>
              và giữ tinh thần cân bằng mỗi ngày 
          </p>

          @auth
              <a href="{{ url('/dashboard') }}"
                 class="flex items-center justify-center gap-2 px-10 py-3 
                        bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 
                        text-black font-semibold rounded-xl shadow-md hover:shadow-green-500/30 
                        transition-all duration-200 hover:scale-[1.05]">
                  <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                  Vào trang chủ
              </a>
          @else
              <div class="flex flex-col sm:flex-row justify-center gap-4 mt-6">
                  <a href="{{ route('login') }}"
                     class="flex items-center justify-center gap-2 px-8 py-3 
                            bg-green-500 hover:bg-green-600 text-black font-semibold rounded-xl 
                            shadow-md hover:shadow-green-400/30 transition-all duration-200 hover:scale-[1.05]">
                      <i data-lucide="log-in" class="w-5 h-5"></i>
                      Đăng nhập
                  </a>

                  <a href="{{ route('register') }}"
                     class="flex items-center justify-center gap-2 px-8 py-3 
                            bg-[#1a1a1a] hover:bg-[#222] text-gray-200 border border-[#2a2a2a] rounded-xl 
                            shadow-md hover:shadow-gray-700/20 transition-all duration-200 hover:scale-[1.05]">
                      <i data-lucide="user-plus" class="w-5 h-5"></i>
                      Đăng ký
                  </a>
              </div>
          @endauth
      </main>

      <footer class="absolute bottom-6 text-xs text-gray-500 z-10">
          © {{ date('Y') }} <span class="text-green-400 font-semibold">LofiPlan</span>. All rights reserved.
      </footer>

      <script>
          lucide.createIcons();
      </script>

      <style>
          @keyframes fade-in {
              from { opacity: 0; transform: translateY(10px); }
              to { opacity: 1; transform: translateY(0); }
          }
          .animate-fade-in {
              animation: fade-in 0.8s ease-out forwards;
          }
      </style>
  </body>
</html>
