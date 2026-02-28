<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gallery-thumb { cursor:pointer; border:1px solid #ddd; border-radius:4px; }
        .gallery-thumb.active { border-color:#ff9900; box-shadow:0 0 0 2px rgba(255,153,0,.25); }
        .zoom-wrapper { overflow:hidden; border:1px solid #eee; }
        .zoom-wrapper img { transition: transform .2s ease; }
        .zoom-wrapper:hover img { transform: scale(1.25); }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Shaker Affiliate</a>
        @auth
            <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-outline-light btn-sm">Logout</button></form>
        @endauth
    </div>
</nav>
<main class="container pb-5">@yield('content')</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
