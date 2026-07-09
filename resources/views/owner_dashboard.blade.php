<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - Toko Cat Guna Bangun Jaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

    <div class="w-full h-2 flex">
        <div class="h-full flex-1 bg-red-500"></div>
        <div class="h-full flex-1 bg-blue-500"></div>
        <div class="h-full flex-1 bg-yellow-400"></div>
    </div>

    <div class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <div class="flex items-center space-x-3">
            <div class="bg-indigo-600 p-2 rounded-lg text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 tracking-wide uppercase">GUNA BANGUN JAYA</h1>
                <p class="text-xs text-gray-500">Sistem Informasi Penjualan Cat &bull; Panel Owner (Pemilik Toko)</p>
            </div>
        </div>
        
        <div class="flex items-center space-x-4 bg-slate-50 px-4 py-2 rounded-xl border">
            <div class="text-right">
                <p class="text-xs font-bold text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-[10px] uppercase tracking-wider text-amber-600 font-bold">Owner / Direktur</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="border-l pl-3">
                @csrf
                <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-2.5 py-1.5 rounded-lg font-semibold transition duration-200">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 space-y-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                <p class="text-xs uppercase tracking-widest font-semibold opacity-80">Total Omset Penjualan</p>
                <p class="text-3xl font-black mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                <p class="text-[11px] opacity-70 mt-3">* Akumulasi dari seluruh transaksi tercatat di database</p>
            </div>
            <div class="bg-white border rounded-2xl shadow-sm p-6 flex justify-between items-center">
                <div>
                    <p class="text-xs uppercase tracking-wider font-bold text-gray-400">Total Transaksi</p>
                    <p class="text-3xl font-black mt-1 text-gray-800">{{ $semuaTransaksi->count() }} Kali</p>
                </div>
                <div class="bg-indigo-50 p-4 rounded-xl text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797-2.101c.727 0 1.348.509 1.495 1.223l.67 3.217m-1.28-3.217a6.002 6.002 0 00-11.455 0M19.5 8.25c0-1.657-1.343-3-3-3s-3 1.343-3 3 1.343 3 3 3 3-1.343 3-3zm-7.4-3.15a.75.75 0 00-1.05 1.05A8.96 8.96 0 0112 10.5a8.96 8.96 0 01-.45 2.85.75.75 0 001.05 1.05c1.17-.43 2.19-1.24 2.91-2.27a8.948 8.948 0 011.64-1.63z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h3 class="font-bold text-gray-800 uppercase tracking-wide text-sm">Log Laporan Riwayat Transaksi Masuk</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-[10px] font-bold uppercase text-gray-500 border-b tracking-wider">
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Customer</th>
                            <th class="px-6 py-3">Alamat</th>
                            <th class="px-6 py-3">Produk Cat</th>
                            <th class="px-6 py-3 text-center">Jumlah</th>
                            <th class="px-6 py-3 text-right">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-xs text-gray-700 font-medium">
                        @forelse($semuaTransaksi as $key => $item)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-gray-400">{{ $key + 1 }}</td>
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $item->nama_customer }}</td>
                                <td class="px-6 py-4 text-gray-500 max-w-xs truncate">{{ $item->alamat }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-slate-100 px-2 py-1 rounded text-gray-800 font-semibold border">{{ $item->jenis_cat }}</span>
                                    <span class="text-gray-400 font-normal ml-1">({{ $item->warna_cat }})</span>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-800 font-bold">{{ $item->jumlah_beli }}</td>
                                <td class="px-6 py-4 text-right text-indigo-600 font-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400 font-normal">Belum ada data transaksi penjualan cat yang tersimpan di sistem.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>