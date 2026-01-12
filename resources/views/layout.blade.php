<!doctype html>
<html lang="lv">
 <head>
 <meta charset="utf-8">
 <title>2. Projekts - {{ $title }}</title>
 <meta name="description" content="Mans 2. Projekts">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
 <body>
    <!-- NAVBAR ------------------------------------------------------------------------------------------------ -->
    <nav>
        <ul>
            @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="/rezisori">Režisori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/filmas">Filmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kategorijas">Kategorijas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Beigt darbu</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">Autentificēties</a>
                </li>
            @endif
        </ul>
    </nav>
    <!-- NAVBAR ------------------------------------------------------------------------------------------------ -->
 @yield('content')
    <!-- Footer ------------------------------------------------------------------------------------------------ -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="footer-brand">2. Darbs</div>
                        <p class="footer-text">Daniels Bērziņš 2ITB</p>
                    </div>
                </div>
            </div>
        </footer>
    <!-- Footer ------------------------------------------------------------------------------------------------ -->
     <script src="/js/admin.js"></script>
 </body>
</html>