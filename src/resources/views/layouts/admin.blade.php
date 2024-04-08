<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}" />
    @yield('css')
</head>
<body class="container">

    @component('components.header')
    @endcomponent
    <main class="main">
        @if(session('error'))
            <div class="message_error">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="message_success">
                {{ session('success') }}
            </div>
        @endif

        @yield('main')
    </main>
</body>
</html>