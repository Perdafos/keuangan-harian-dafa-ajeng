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
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-white text-gray-900 antialiased selection:bg-gray-200">

    <div class="max-w-4xl mx-auto px-4 py-12 md:py-20">
        <!-- Header Area -->
        <header
            class="flex flex-col md:flex-row md:items-end justify-between mb-16 border-b border-gray-200 pb-8 gap-6 md:gap-0">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-black mb-4">Catatan Keuangan</h1>
                @php
                    $saldo =
                        $transaksi->where('jenis', 'masuk')->sum('jumlah') -
                        $transaksi->where('jenis', 'keluar')->sum('jumlah');
                @endphp
                <div class="text-xs uppercase tracking-widest text-gray-400 font-semibold mb-1">
                    Total Saldo
                </div>
                <div class="text-5xl font-semibold tracking-tighter text-black">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </div>
            </div>
            <div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('transaksi.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-black hover:bg-gray-800 transition-colors duration-200 rounded-none">
                        Tambah Transaksi
                    </a>

                    <div class="relative inline-block text-left">
                        <button type="button"
                            onclick="document.getElementById('profileDropdown').classList.toggle('hidden')"
                            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-black bg-white border-2 border-black hover:bg-gray-50 transition-colors duration-200 rounded-none focus:outline-none">
                            <span class="truncate max-w-[100px] sm:max-w-[150px]">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="profileDropdown"
                            class="hidden absolute right-0 mt-2 w-56 origin-top-right bg-white border-2 border-black focus:outline-none z-50 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                            <div class="px-4 py-4 border-b-2 border-black">
                                <p class="text-[10px] uppercase tracking-wider font-semibold text-gray-400 mb-1">
                                    Informasi Profil</p>
                                <p class="text-sm font-bold text-black truncate block">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-600 truncate block mt-1">{{ auth()->user()->email }}</p>
                            </div>
                            <div>
                                <form action="{{ route('logout') }}" method="POST" class="block w-full m-0">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-3 text-sm font-bold text-black hover:bg-black hover:text-white transition-colors duration-200">
                                        LOGOUT
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- Transaction List -->
        <main>
            @if ($transaksi->isEmpty())
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
                            @foreach ($transaksi as $t)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="py-5 px-2 text-sm text-gray-500 whitespace-nowrap tabular-nums">
                                        {{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}
                                    </td>
                                    <td class="py-5 px-2 text-base font-medium text-black">
                                        {{ $t->keterangan }}
                                    </td>
                                    <td class="py-5 px-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 text-[11px] uppercase tracking-wider font-semibold text-black bg-gray-100">
                                            {{ $t->jenis == 'masuk' ? 'Pemasukan' : 'Pengeluaran' }}
                                        </span>
                                    </td>
                                    <td class="py-5 px-2 text-right whitespace-nowrap tabular-nums">
                                        <span class="text-black font-semibold">
                                            {{ $t->jenis == 'masuk' ? '+' : '-' }} Rp
                                            {{ number_format($t->jumlah, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td
                                        class="py-5 px-2 text-right whitespace-nowrap items-center flex justify-center opacity-50 group-hover:opacity-100 transition-opacity ">
                                        <div class="gap-8">
                                            <a href="{{ route('transaksi.edit', $t->id) }}"
                                                class="text-xs uppercase tracking-wider font-semibold text-gray-800 hover:text-black transition-colors">Edit</a>
                                            <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-xs uppercase tracking-wider font-semibold text-gray-800 hover:text-black transition-colors">Hapus</button>
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

    <script>
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('profileDropdown');
            if (dropdown && !dropdown.classList.contains('hidden')) {
                var button = dropdown.previousElementSibling;
                if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            }
        });
    </script>

</body>

</html>
