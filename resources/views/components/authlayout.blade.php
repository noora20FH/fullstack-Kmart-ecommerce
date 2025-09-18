<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-white" style="font-family: 'Poppins', sans-serif;">

    <div class="container-fluid p-0 min-vh-100 d-flex flex-row overflow-hidden">
        <!-- Sisi Kiri (Ilustrasi) -->
        <div class="col-md-6 d-none d-md-flex p-5 text-white text-center d-flex flex-column justify-content-center align-items-center" style="background-color: #7B68EE;">
            <div>
                <img src="{{ asset('image/kpop-web-logo.png') }}" alt="I love K-Pop" class="img-fluid mb-3" style="max-width: 80%;">
                <h1 class="display-5 fw-bold">Selamat Datang di K-Pop Mart</h1>
                <p class="lead mt-3 opacity-75">Toko online terpercaya untuk semua kebutuhan merchandise K-Pop resmi. Dapatkan koleksi terbaik dari idola favoritmu.</p>
            </div>
        </div>

        <!-- Sisi Kanan (Form Login) -->
        <div class="col-12 col-md-6 bg-white p-4 d-flex flex-column justify-content-center align-items-center">
            {{$slot}}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>