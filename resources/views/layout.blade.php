<!doctype html>
<html lang="{{\Illuminate\Support\Facades\App::getLocale()}}" dir="ltr">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Digital Exchange">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/images/customs/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/customs/favicon.png')}}" type="image/x-icon">

    @include("includes.head-tags")
    @yield('pages-styles')

    @hasSection('title')
        @hasSection('beforeTitle')
            <title>@yield("title") | 2getherSocial Network</title>
        @else
            @hasSection('afterTitle')
                <title>2getherSocial Network | @yield("title")</title>
            @else
                <title>@yield("title")</title>
            @endif
        @endif
    @else
        <title>2getherSocial Network</title>
    @endif

    @hasSection('id')
        <meta id="@yield('id')">
    @endif

    @if(App::environment() == 'local')
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta name="robots" content="noindex">
    @endif

    @if(Request::input('backsite'))
        <meta name="robots" content="noindex">
    @endif

    @yield("extraMeta")

</head>
<body class="@yield("bodyClass")">
    @yield("content")

    @include("includes.fixed-sections")
    @include("includes.foot-tags")

    @yield('pages-scripts')
</body>
</html>
