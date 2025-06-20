<!DOCTYPE html>
<html>
<head>
    <title>Obat</title>
</head>
<body>
    <nav>
        <a href="{{ route('admin.obat.index') }}">Obat</a> |
        <a href="{{ route('admin.pasien.index') }}">Pasien</a>
    </nav>
    <hr>
    @yield('content')
</body>
</html>
