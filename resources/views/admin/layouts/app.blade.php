<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sparkout {{ $title??'' }}</title>
    @include('admin.layouts.top_links')
    @yield('custom_styles')
</head>
<body>
    @include('admin.layouts.top_nav')
    @include('admin.layouts.sidebar')
    <main id="main" class="main">
        @yield('content')
    </main>
    @include('admin.layouts.footer')
    @include('admin.layouts.bottom_links')
    <script>
        var baseUrl ="{{ config('app.url') }}";
    </script>
    @yield('scripts')
</body>
</html>