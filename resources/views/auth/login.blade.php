<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Cat Guna Bangun Jaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-white/20 relative overflow-hidden">
        
        <!-- Akses Dekorasi Warna-Warni Khas Toko Cat (Merah, Biru, Kuning) -->
        <div class="absolute top-0 left-0 w-full h-2 flex">
            <div class="h-full flex-1 bg-red-500"></div>
            <div class="h-full flex-1 bg-blue-500"></div>
            <div class="h-full flex-1 bg-yellow-400"></div>
        </div>

        <!-- Header Tema Toko Cat -->
        <div class="text-center mb-8">
            <div class="inline-block bg-indigo-50 p-3 rounded-full mb-3">
                <!-- Icon Ember Cat / Palet (Menggunakan SVG Simple) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-indigo-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122l9.37-9.445a2.25 2.25 0 113.182 3.182l-10.4 10.5a2.25 2.25 0 01-3.182 0l-5.45-5.45a2.25 2.25 0 113.181-3.182l4.3 4.3z" />
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-gray-800 tracking-wider uppercase">Guna Bangun Jaya</h2>
            <p class="text-xs text-gray-500 font-medium mt-1 uppercase tracking-widest text-indigo-600">Sistem Informasi Penjualan Cat</p>
        </div>

        <!-- Validasi Error Jika Gagal Login -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-lg mb-5 flex items-start space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-red-500 shrink-0 mt-0.5">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
                <p class="text-xs text-red-700 font-medium">{{ $errors->first() }}</p>
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login.proses') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Email Pengguna / Staff</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-sm" 
                           >
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi</label>
                <input type="password" name="password" 
                       class="w-full border border-gray-300 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-sm" 
                       >
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center text-gray-600 font-medium cursor-pointer">
                    <input type="checkbox" name="remember" class="mr-1.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4"> Ingat Sesi Saya
                </label>
                <span class="text-gray-400">v1.0</span>
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-indigo-500/20 transition duration-300 uppercase tracking-wider text-xs mt-2">
                Masuk ke Aplikasi
            </button>
        </form>

        <!-- Footer Hak Cipta -->
        <div class="text-center mt-8 border-t border-gray-100 pt-4 text-[11px] text-gray-400 font-medium">
            &copy; 2026 Toko Cat Guna Bangun Jaya. All rights reserved.
        </div>
    </div>

</body>
</html>