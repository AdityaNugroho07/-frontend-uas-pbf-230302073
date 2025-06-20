<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
<section id="content" class="flex">
    <div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
        <div class="w-full flex flex-col gap-[30px]">
            <img src="{{ asset('images/logo/rumahsakit.png')}}" alt="logo" class="mx-auto w-1/2">
            <ul class="flex flex-col gap-3">
                <li><h3 class="font-bold text-xs text-[#A5ABB2]">Menu</h3></li>
                <li>
                    <a href="{{ route('obat.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] text-white">
                        <img src="{{ asset('images/icons/medicine.png') }}" alt="icon">
                        <p class="font-semibold">Data Obat</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pasien.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 hover:bg-[#2B82FE] transition">
                        <img src="{{ asset('images/icons/user.png') }}" alt="icon">
                        <p class="font-semibold">Data Pasien</p>
                    </a>
                </li>
                <hr>
                <li>
                    <a href="{{ route('login') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 hover:bg-[#2B82FE] transition">
                        <img src="{{ asset('images/icons/security-safe.svg') }}" alt="icon">
                        <p class="font-semibold">Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div id="menu-content" class="flex flex-col w-full pb-[30px]">
        <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
            <h1 class="font-extrabold text-[24px]">Dashboard Rumah Sakit</h1>
        </div>

        <div class="flex flex-col px-5 mt-5 gap-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white shadow rounded-xl p-5 text-center border border-[#EEEEEE]">
                    <p class="text-[#7F8190] text-sm">Total Obat</p>
                    <p class="text-2xl font-bold">{{ $totalObat ?? '0' }}</p>
                </div>
                <div class="bg-white shadow rounded-xl p-5 text-center border border-[#EEEEEE]">
                    <p class="text-[#7F8190] text-sm">Total Pasien</p>
                    <p class="text-2xl font-bold">{{ $totalPasien ?? '0' }}</p>
                </div>
                <div class="bg-white shadow rounded-xl p-5 text-center border border-[#EEEEEE]">
                    <p class="text-[#7F8190] text-sm">Obat Terlaris</p>
                    <p class="text-base font-semibold text-[#2B82FE]">{{ $obatFavorit ?? '-' }}</p>
                </div>
                <div class="bg-white shadow rounded-xl p-5 text-center border border-[#EEEEEE]">
                    <p class="text-[#7F8190] text-sm">Pasien Baru</p>
                    <p class="text-base font-semibold">{{ $pasienBaru ?? '-' }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow border border-[#EEEEEE]">
                <h2 class="text-xl font-bold mb-4">Tentang Sistem Rumah Sakit</h2>
                <p class="text-[#4B5563] leading-relaxed mb-2">
                    Sistem ini digunakan untuk mengelola data <strong>obat</strong> dan <strong>pasien</strong> secara digital.
                </p>
                <p class="text-[#4B5563] leading-relaxed">
                    Fitur utama termasuk pencatatan stok obat, kategori obat, harga, serta manajemen pasien lengkap dengan data alamat, tanggal lahir, dan jenis kelamin.
                </p>
            </div>
        </div>
    </div>
</section>
</body>
</html>
