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
  @include('partials.sidebar', ['active' => 'obat'])

  <div id="menu-content" class="flex flex-col w-full pb-[30px]">
    <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
      <h1 class="font-extrabold text-[24px]">Edit Data Obat</h1>
      <a href="{{ route('obat.index') }}" class="bg-gray-300 text-black font-bold px-5 py-2 rounded-full hover:shadow-lg transition">Kembali</a>
    </div>

    <div class="p-5">
      <form action="{{ route('obat.update', $obat->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label class="block font-semibold mb-1">Nama Obat</label>
          <input type="text" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1">Kategori</label>
          <input type="text" name="kategori" value="{{ old('kategori', $obat->kategori) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1">Stok</label>
          <input type="number" name="stok" value="{{ old('stok', $obat->stok) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1">Harga</label>
          <input type="number" step="0.01" name="harga" value="{{ old('harga', $obat->harga) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
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
