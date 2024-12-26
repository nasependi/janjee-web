<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('logojanjee/janjee-logo.svg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <title> Janjee </title>
</head>
@stack('css')
<body>
    @include('components.header')
    <main class="main">
        {{ $slot }}
    </main>
    @include('components.footer')

    <!--scorll up button-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-fill scrollup-icon"></i>
    </a>

    @stack('script')
    <script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
