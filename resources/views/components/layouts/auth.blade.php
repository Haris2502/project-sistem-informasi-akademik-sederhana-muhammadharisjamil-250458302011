<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SIAS' }} </title>
    <link rel="shortcut icon" type="image/x-icon" href="data:image/svg+xml,%3csvg width='200' height='60' viewBox='0 0 200 60' xmlns='http://www.w3.org/2000/svg'%3e%3cg transform='translate(10, 15)'%3e%3cpath d='M15 10 L0 15 L15 20 L30 15 Z' fill='%230ea5e9'/%3e%3crect x='5' y='7' width='20' height='3' fill='%2306b6d4' rx='1'/%3e%3cline x1='25' y1='8' x2='28' y2='5' stroke='%230ea5e9' stroke-width='1.5'/%3e%3ccircle cx='28' cy='4' r='2' fill='%230ea5e9'/%3e%3cpath d='M3 15 L3 22 Q15 26 27 22 L27 15' stroke='%2306b6d4' stroke-width='1.5' fill='none'/%3e%3c/g%3e%3ctext x='55' y='25' font-family='Arial, sans-serif' font-size='24' font-weight='bold' fill='%230ea5e9'%3eSIAS%3c/text%3e%3ctext x='55' y='40' font-family='Arial, sans-serif' font-size='10' fill='%2364748b'%3eSistem Informasi Akademik%3c/text%3e%3c/svg%3e" />
    <link rel="stylesheet" href="{{ asset('dist/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/compiled/css/auth.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    @livewireStyles
</head>
<body>
    <script src="{{ asset('dist/assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        {{ $slot }}
    </div>
    @livewireScripts
    <script>
        document.addEventListener('livewire:navigating', () => {
            NProgress.start();
        });
        document.addEventListener('livewire:navigated', () => {
            NProgress.done();
        });
    </script>
</body>
</html>


