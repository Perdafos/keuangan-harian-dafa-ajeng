<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Harian</title>
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
</head>
<body class="bg-white text-gray-900 antialiased selection:bg-gray-200">

<div class="max-w-4xl mx-auto px-4 py-12 md:py-20">
    <!-- Header Area -->
    <header class="flex flex-col md:flex-row md:items-end justify-between mb-16 border-b border-gray-200 pb-8 gap-6 md:gap-0">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-black mb-4">Catatan Keuangan</h1>
            @php
                $saldo = $transaksi->where('jenis','masuk')->sum('jumlah') - $transaksi->where('jenis','keluar')->sum('jumlah');
            @endphp
            <div class="text-xs uppercase tracking-widest text-gray-400 font-semibold mb-1">
                Total Saldo
            </div>
            <div class="text-5xl font-semibold tracking-tighter text-black">
                Rp {{ number_format($saldo, 0, ',', '.') }}
            </div>
        </div>
        <div>
            <a href="{{ route('transaksi.create') }}" class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-black hover:bg-gray-800 transition-colors duration-200 rounded-none">
                Tambah Transaksi
            </a>
        </div>
    </header>

    <!-- Transaction List -->
    <main>
        @if($transaksi->isEmpty())
            <div class="text-center py-20 border border-dashed border-gray-200">
                <p class="text-gray-400 text-sm">Belum ada data transaksi.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-black text-xs uppercase tracking-wider text-gray-400">
                            <th class="py-4 font-semibold px-2 w-32">Tanggal</th>
                            <th class="py-4 font-semibold px-2">Keterangan</th>
                            <th class="py-4 font-semibold px-2 w-32">Jenis</th>
                            <th class="py-4 font-semibold text-right px-2 w-40">Jumlah</th>
                            <th class="py-4 font-semibold text-right px-2 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transaksi as $t)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="py-5 px-2 text-sm text-gray-500 whitespace-nowrap tabular-nums">
                                {{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}
                            </td>
                            <td class="py-5 px-2 text-base font-medium text-black">
                                {{ $t->keterangan }}
                            </td>
                            <td class="py-5 px-2">
                                <span class="inline-flex items-center px-2.5 py-1 text-[11px] uppercase tracking-wider font-semibold text-black bg-gray-100">
                                    {{ $t->jenis == 'masuk' ? 'Pemasukan' : 'Pengeluaran' }}
                                </span>
                            </td>
                            <td class="py-5 px-2 text-right whitespace-nowrap tabular-nums">
                                <span class="text-black font-semibold">
                                    {{ $t->jenis == 'masuk' ? '+' : '-' }} Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="py-5 px-2 text-right whitespace-nowrap items-center flex justify-center opacity-50 group-hover:opacity-100 transition-opacity ">
                                <div class="gap-8">
                                    <a href="{{ route('transaksi.edit', $t->id) }}" class="text-xs uppercase tracking-wider font-semibold text-gray-800 hover:text-black transition-colors">Edit</a>
                                    <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs uppercase tracking-wider font-semibold text-gray-800 hover:text-black transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>
</div>

</body>
</html>
