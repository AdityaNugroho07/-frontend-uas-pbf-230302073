<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
  <section id="content" class="flex">
    <div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
      <div class="w-full flex flex-col gap-[30px]">
        <img src="{{ asset('images/logo/logorumahsakit.png')}}" alt="logo" class="mx-auto w-1/2">
        <ul class="flex flex-col gap-3">
          <li><h3 class="font-bold text-xs text-[#A5ABB2]">Menu</h3></li>
          <li>
            <a href="{{ route('obat.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 hover:bg-[#2B82FE] hover:text-white transition-all">
              <img src="{{ asset('images/icons/medicine.svg')}}" alt="icon">
              <p class="font-semibold">Data Obat</p>
            </a>
          </li>
          <li>
            <a href="{{ route('pasien.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] text-white">
              <img src="{{ asset('images/icons/user.png')}}" alt="icon">
              <p class="font-semibold">Data Pasien</p>
            </a>
          </li>
          <hr>
          <li>
            <a href="{{ route('login') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 hover:bg-[#2B82FE] hover:text-white transition-all">
              <img src="{{ asset('images/icons/log-out.svg')}}" alt="icon">
              <p class="font-semibold">Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div id="menu-content" class="flex flex-col w-full pb-[30px]">
      <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
        <h1 class="font-extrabold text-[24px]">Edit Data Pasien</h1>
        <a href="{{ route('pasien.index') }}" class="bg-gray-300 text-black font-bold px-5 py-2 rounded-full hover:shadow-lg transition">Kembali</a>
      </div>

      <div class="p-5">
        <form action="{{ route('pasien.update', $pasien->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
          @csrf
          @method('PUT')
          <div class="mb-4">
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $pasien->nama) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Alamat</label>
            <textarea name="alamat" rows="3" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('alamat', $pasien->alamat) }}</textarea>
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border border-gray-300 rounded px-3 py-2" required>
              <option value="">-- Pilih --</option>
              <option value="laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
          <div class="flex justify-end">
            <button type="submit" class="bg-[#2B82FE] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#1A6FE0] transition">Perbarui</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
