<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <meta name="description"
        content="{{ config('app.name') }}: Reliable and modern logistics services, specializing in moving goods and household items with precision and care. Your trusted partner for smooth, efficient, and affordable relocations worldwide." />
    <meta name="author" content="CHISOM OKWUOSA" />
    <meta name="keywords"
        content="logistics company, moving services, household moving, goods transportation, reliable movers, meticulous moving service, affordable relocation, furniture moving, office relocation, professional moving company, global relocation, shipping services, cargo transport, international moving, warehouse logistics, freight services, packing and moving, commercial logistics, relocation experts, secure transport" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta property="og:title" content="{{ config('app.name') }} – Professional Logistics & Moving Services" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:url" content="https://mazmoves.com/" />
    <meta property="og:description"
        content="{{ config('app.name') }} provides reliable logistics and household moving services globally. We specialize in moving goods with precision and care, ensuring smooth, secure, and cost-effective relocations for homes and businesses." />
    <meta property="og:image" content="{{ asset('images/services/european.jpg') }}" />
    <link rel="favicon" href="{{ asset('/images/apple-icon.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicon-16x16.png') }}">
    <title inertia>{{ config('app.name') }} - Swift and efficient movers</title>
    {{-- mapbox --}}
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css" rel="stylesheet" />
    <!-- Scripts -->

    @viteReactRefresh
    @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
    @inertiaHead
    @routes
</head>

<body class="frank-regular antialiased">
    @inertia
</body>

</html>
