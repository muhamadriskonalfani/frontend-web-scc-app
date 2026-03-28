<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SCC APP')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
        }

        .container-fluid {
            height: 100vh;
            padding: 0;
        }
    </style>

    @yield('styles')
    @vite(['resources/js/app.js'])
</head>
<body>
    <!-- CONTENT -->
    <div class="container-fluid">
        @yield('content')
    </div>

    <script>
        feather.replace();
    </script>

    @yield('scripts')
    @include('sweetalert::alert')
</body>
</html>
