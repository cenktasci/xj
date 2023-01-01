<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('https://i.pinimg.com/originals/5b/5d/3b/5b5d3bee096c56241ea69dc617e7fcc8.gif') 50% 50% no-repeat rgb(255, 255, 255);
        }
    </style>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <div id="loader" class="loader"></div>

            {{ $slot }}
        </main>
    </div>
</body>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    function showLoader() {
        $("#loader").css("display", "block");
    }

    function hideLoader() {
        $("#loader").css("display", "none");
    }
</script>
@if (Session::has('errors'))
    qweqweqweq
@endif

@if (session()->has('errors'))
    <script>
        swal.fire({
            title: "{{ __('Error!') }}",
            text: "{{ session('errors') }}",
            type: "error"
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        hideLoader();
    });
</script>

</html>
