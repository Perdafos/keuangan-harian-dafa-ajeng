<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        input[type="date"]::-webkit-calendar-picker-indicator { opacity: 0.5; cursor: pointer; }
        /* Remove default outlines and focus styles for custom border implementation */
        input:focus, select:focus { outline: none; box-shadow: none; border-color: black; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased selection:bg-gray-200 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md px-6 py-12">
    <div class="mb-12">
        <a href="{{ route('transaksi.index') }}" class="text-xs uppercase tracking-widest font-semibold text-gray-400 hover:text-black inline-flex items-center mb-8 transition-colors">
            &larr; Kembali
        </a>
        <h2 class="text-4xl font-bold tracking-tight text-black">Tambah Transaksi</h2>
        <p class="text-gray-400 mt-3 text-sm font-medium">Masukkan detail catatan keuangan baru.</p>
    </div>

    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-8">
        @csrf

        <div class="space-y-2 relative">
            <label class="block text-xs uppercase tracking-widest font-semibold text-gray-400">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" required
                class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-gray-200 focus:border-black text-black placeholder-gray-400 transition-colors">
        </div>

        <div class="space-y-2 relative">
            <label class="block text-xs uppercase tracking-widest font-semibold text-gray-400">Keterangan</label>
            <input type="text" name="keterangan" value="{{ old('keterangan') }}" required placeholder="Contoh: Gaji bulanan, Beli kopi"
                class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-gray-200 focus:border-black text-black placeholder-gray-300 transition-colors">
        </div>

        <div class="space-y-2 relative">
            <label class="block text-xs uppercase tracking-widest font-semibold text-gray-400">Jenis Transaksi</label>
            <select name="jenis" required
                class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-gray-200 focus:border-black text-black transition-colors appearance-none cursor-pointer">
                <option value="" disabled selected class="text-gray-300">Pilih jenis</option>
                <option value="masuk" {{ old('jenis') == 'masuk' ? 'selected' : '' }}>Pemasukan</option>
                <option value="keluar" {{ old('jenis') == 'keluar' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
            <!-- Custom select chevron -->
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pt-6 px-2 text-gray-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>

        <div class="space-y-2 relative">
            <label class="block text-xs uppercase tracking-widest font-semibold text-gray-400">Jumlah (Rp)</label>
            <input type="number" name="jumlah" value="{{ old('jumlah') }}" required min="0" placeholder="0"
                class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-gray-200 focus:border-black text-black placeholder-gray-300 transition-colors">
        </div>

        <div class="pt-8">
            <button type="submit" class="w-full py-4 px-4 bg-black hover:bg-gray-700 text-white text-sm font-semibold tracking-wide transition-colors rounded-none">
                Simpan Transaksi
            </button>
        </div>
    </form>
</div>

</body>
</html>
