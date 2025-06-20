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
      <h1 class="font-extrabold text-[24px]">Data Obat</h1>
      <a href="{{ route('obat.create') }}" class="bg-[#6436F1] text-white font-bold px-5 py-2 rounded-full hover:shadow-lg transition">Tambah Obat</a>
    </div>

    <div class="p-5">
      <table class="min-w-full text-left border border-[#EEEEEE] rounded-xl overflow-hidden shadow-sm">
        <thead class="bg-[#F9FAFB]">
          <tr class="text-[#374151] text-sm font-semibold">
            <th class="p-3">ID</th>
            <th class="p-3">Nama Obat</th>
            <th class="p-3">Kategori</th>
            <th class="p-3">Stok</th>
            <th class="p-3">Harga</th>
            <th class="p-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-sm text-[#4B5563]">
          @foreach ($obat as $item)
            <tr class="border-t border-[#EEEEEE] hover:bg-[#F3F4F6]">
              <td class="p-3">{{ $item->id }}</td>
              <td class="p-3">{{ $item->nama_obat }}</td>
              <td class="p-3">{{ $item->kategori }}</td>
              <td class="p-3">{{ $item->stok }}</td>
              <td class="p-3">Rp{{ number_format($item->harga, 2, ',', '.') }}</td>
              <td class="p-3 flex gap-2">
                <a href="{{ route('obat.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('obat.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
</body>
</html>
