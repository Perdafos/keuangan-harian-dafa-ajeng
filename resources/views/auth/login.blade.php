<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Keuangan Harian</title>
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
<body class="bg-white text-gray-900 antialiased h-screen flex items-center justify-center selection:bg-gray-200">

<div class="max-w-md w-full px-6 py-12 md:py-16">
    <div class="text-center mb-10 border-b border-gray-200 pb-8">
        <h1 class="text-3xl font-bold tracking-tight text-black mb-2">Masuk</h1>
        <p class="text-sm text-gray-500">Silakan login ke akun Anda</p>
    </div>

    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
        @csrf

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-none bg-green-50" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-none bg-red-50" role="alert">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label for="email" class="block text-xs uppercase tracking-wider font-semibold text-gray-400 mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                class="w-full px-4 py-3 border-2 border-gray-200 bg-transparent text-black text-sm transition-colors focus:outline-none focus:border-black placeholder-gray-300"
                placeholder="nama@email.com">
        </div>

        <div>
            <label for="password" class="block text-xs uppercase tracking-wider font-semibold text-gray-400 mb-2">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-3 border-2 border-gray-200 bg-transparent text-black text-sm transition-colors focus:outline-none focus:border-black placeholder-gray-300"
                placeholder="••••••••">
        </div>

        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-4 text-sm font-semibold text-white bg-black hover:bg-gray-800 transition-colors duration-200 mt-2">
            MASUK
        </button>

        <div class="text-center mt-6 text-sm text-gray-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-black hover:underline transition-colors">Daftar sekarang</a>
        </div>
    </form>
</div>

</body>
</html>
