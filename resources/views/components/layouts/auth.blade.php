<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HYMA' }}</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-7 col-12 d-lg-block">
            <div id="auth-left" class="d-flex justify-content-center align-items-center h-100">
                @yield('content')
                {{ $slot ?? '' }}
            </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
            <div id="auth-right" class="d-flex justify-content-center align-items-center h-100">
                <img src="assets/images/logo/logo-hyma-completo.png" alt="LOGO">
            </div>
        </div>
    </div>
</div>
</body>
<script src="/assets/js/bootstrap.js"></script>
<script src="/assets/js/app.js"></script>
</html>
