<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Pendaftaran Kpop Mart</title>
</head>
<body>
    <h1>Hai {{ $userName }}, Selamat Datang di Kpop Mart!</h1>

    <p>Terima kasih telah mendaftar. Silakan klik tombol di bawah untuk mengaktifkan akun Anda:</p>
    
    <a href="{{ $verificationUrl }}" 
       style="display: inline-block; padding: 10px 20px; color: #ffffff; background-color: #007bff; border-radius: 5px; text-decoration: none;">
        Verifikasi Akun Saya
    </a>

    <p>Atau salin dan tempel tautan ini di browser Anda:</p>
    <p><a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a></p>

    <p>Jika Anda tidak merasa mendaftar di Kpop Mart, abaikan email ini.</p>
    
    <p>Salam hangat,<br>
    Tim Kpop Mart</p>
</body>
</html>