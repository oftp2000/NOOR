<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') — Noor Al-Haramain</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
  @include('partials.header')
  <div class="flex">
    @includeWhen(Auth::user()->role==='admin','partials.sidebar-admin')
    @includeWhen(Auth::user()->role==='user','partials.sidebar-user')
    <main class="flex-1 p-6">
      @yield('content')
    </main>
  </div>
  <script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
</body>
</html>
