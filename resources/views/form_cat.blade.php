<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Toko Cat Guna Bangun Jaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen pb-10">

    <div class="w-full h-2 flex">
        <div class="h-full flex-1 bg-red-500"></div>
        <div class="h-full flex-1 bg-blue-500"></div>
        <div class="h-full flex-1 bg-yellow-400"></div>
    </div>

    <div class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <div class="flex items-center space-x-3">
            <div class="bg-indigo-50 p-2 rounded-lg text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 tracking-wide uppercase">GUNA BANGUN JAYA</h1>
                <p class="text-xs text-gray-500">Sistem Informasi Penjualan Cat &bull; Panel Kasir</p>
            </div>
        </div>
        
        <div class="flex items-center space-x-4 bg-slate-50 px-4 py-2 rounded-xl border">
            <div class="text-right">
                <p class="text-xs font-bold text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-[10px] uppercase tracking-wider text-indigo-600 font-semibold">Petugas Kasir</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="border-l pl-3">
                @csrf
                <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-2.5 py-1.5 rounded-lg font-semibold transition duration-200">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-xl border p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-800 border-b pb-4 mb-6">Form Entri Transaksi Cat</h2>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6 flex items-center space-x-2">
                    <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('transaksi.hitung') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Customer</label>
                    <input type="text" name="nama_customer" value="{{ old('nama_customer') }}" required
                           class="w-full border border-gray-300 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Alamat</label>
                    <textarea name="alamat" rows="2" required
                              class="w-full border border-gray-300 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Jenis Cat</label>
                        <select name="jenis_cat" required
                                class="w-full border border-gray-300 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="CATYLAC" {{ old('jenis_cat') == 'CATYLAC' ? 'selected' : '' }}>CATYLAC (Rp 100.000)</option>
                            <option value="Vinilex" {{ old('jenis_cat') == 'Vinilex' ? 'selected' : '' }}>Vinilex (Rp 85.000)</option>
                            <option value="Dulux" {{ old('jenis_cat') == 'Dulux' ? 'selected' : '' }}>Dulux (Rp 150.000)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Jumlah Beli</label>
                        <input type="number" name="jumlah_beli" value="{{ old('jumlah_beli') }}" min="1" required
                               class="w-full border border-gray-300 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Warna Cat</label>
                    <div class="flex flex-wrap gap-4">
                        <label class="flex items-center space-x-2 text-sm text-gray-700 font-medium cursor-pointer">
                            <input type="radio" name="warna_cat" value="Merah" {{ old('warna_cat') == 'Merah' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500"> <span>Merah</span>
                        </label>
                        <label class="flex items-center space-x-2 text-sm text-gray-700 font-medium cursor-pointer">
                            <input type="radio" name="warna_cat" value="Biru" {{ old('warna_cat', 'Biru') == 'Biru' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500"> <span>Biru</span>
                        </label>
                        <label class="flex items-center space-x-2 text-sm text-gray-700 font-medium cursor-pointer">
                            <input type="radio" name="warna_cat" value="Kuning" {{ old('warna_cat') == 'Kuning' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500"> <span>Kuning</span>
                        </label>
                    </div>
                </div>

                <div class="flex space-x-3 pt-3 border-t">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-xl text-xs uppercase tracking-wider shadow transition duration-200">
                        Hitung & Simpan
                    </button>
                    <button type="reset" class="px-5 bg-slate-200 hover:bg-slate-300 text-gray-700 font-bold py-2.5 rounded-xl text-xs uppercase tracking-wider transition duration-200">
                        Batal
                    </button>
                </div>
            </form>

            @if(session('total_harga'))
                <div class="mt-8 bg-indigo-50/70 border border-indigo-100 rounded-2xl p-5 space-y-2">
                    <h3 class="text-sm font-bold text-indigo-900 tracking-wide uppercase mb-2">Rincian Pembayaran</h3>
                    <p class="text-xs text-gray-600">Nama Pelanggan: <span class="font-bold text-gray-800">{{ session('data')['nama_customer'] }}</span></p>
                    <p class="text-xs text-gray-600">Produk Cat: <span class="font-bold text-gray-800">{{ session('data')['jenis_cat'] }} ({{ session('data')['warna_cat'] }})</span></p>
                    <p class="text-xs text-gray-600">Jumlah Pembelian: <span class="font-bold text-gray-800">{{ session('data')['jumlah_beli'] }} Tabung</span></p>
                    <div class="pt-2 border-t border-indigo-200 flex justify-between items-center">
                        <span class="text-xs font-bold text-indigo-900 uppercase">Total Bayar:</span>
                        <span class="text-lg font-black text-indigo-600">Rp {{ number_format(session('total_harga'), 0, ',', '.') }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

</body>
</html>