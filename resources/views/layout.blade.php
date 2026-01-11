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
                    <a class="nav-link" href="/rezisori">rezisori</a>
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
                        <div class="footer-brand">CompanyName</div>
                        <p class="footer-text">Creating amazing experiences and innovative solutions for our customers
                            worldwide.</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-md-6 text-md-end">
                        <ul class="footer-links">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Terms</a></li>
                        </ul>
                    </div>
                </div>

                <div class="copyright text-center">
                    © 2024 CompanyName. All rights reserved.
                </div>
            </div>
        </footer>
    <!-- Footer ------------------------------------------------------------------------------------------------ -->
     <script src="/js/admin.js"></script>
 </body>
</html>