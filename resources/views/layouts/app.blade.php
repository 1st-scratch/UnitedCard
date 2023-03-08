<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Saira+Condensed:wght@400;500;600&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@16.1.3/dist/smooth-scroll.polyfills.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <header>
            <!-- <div class="mark">
                 <img src="./images/logo.png" alt="logo"> 
                <div class="logo"><a href="{{ route('login') }}">United</a></div>
            </div> -->
        </header>
        <div class="loader"></div>

        @yield('content')

        {{-- <footer>
            <div class="social-btns">
                <div class="social-btns__item">
                    <img src="{{ asset('images/instagram.png') }}" alt="instagram" />
                </div>
                <div class="social-btns__item">
                    <img src="{{ asset('images/facebook.png') }}" alt="facebook" />
                </div>
                <div class="social-btns__item">
                    <img src="{{ asset('images/twitter.png') }}" alt="twitter" />
                </div>
            </div>
            <div class="footer-links">
                <div class="footer-links__left">
                    <p>合同会社TheFourSeasons</p>
                    <p>〒060-0031</p>
                    <p>北海道札幌市中央区北1条東10丁目15-82-2010</p>
                </div>
                <div class="footer-links__right">
                    <ul>
                        <li><a href="#">よくある質問</a></li>
                        <li><a href="#">お問い合わせ</a></li>
                        <li><a href="#">会社概要</a></li>
                        <li><a href="#">プライバシーポリシー</a></li>
                    </ul>
                </div>
            </div>
        </footer> --}}
    </body>
</html>