<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/images/favicon-16x16.png')}}">
    <title>{{ config('app.name') }} | Admin dashboard</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
            
    <!-- Nucleo Icons -->
    <link href="{{ asset('myassets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('myassets/css/nucleo-svg.css') }}" rel="stylesheet" />
    {{-- toastr css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>    
    <!-- Main Styling -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('myassets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
    @livewireStyles
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 min-h-75"></div>
    <x-banner />
    <!-- sidenav  -->
    <x-sidebar />
    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        {{ $slot }}
    </main>    
    <!-- plugin for scrollbar  -->
    <script src="{{ asset('myassets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script><!-- plugin for charts  -->
    <script src="{{ asset('myassets/js/plugins/chartjs.min.js') }}" async></script>    
    @stack('scripts')
    <!-- main script file  -->
    <script src="{{asset('myassets/js/argon-dashboard-tailwind.js?v=1.0.1')}}" async></script>
    @livewireScripts
</body>
</html>
