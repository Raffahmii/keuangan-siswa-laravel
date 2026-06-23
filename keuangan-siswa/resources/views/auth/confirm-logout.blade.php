<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Logout</title>
</head>
<body>

<h2>Konfirmasi Logout</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <label>Masukkan Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Logout</button>
</form>

<br>
<a href="{{ route('dashboard') }}">Batal</a>

</body>
</html>