<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dervişoğlu Gıda') }} | {{ $pageTitle }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
</head>
<body>
    <!-- Default navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Dervişoğlu Gıda Ticaret') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if(count($userMenu) > 0)
                @foreach($userMenu as $url => $menuItem)
                    <li class="nav-item {!! ('/'.request()->segment(count(request()->segments())) == $url) ? 'active' : '' !!}">
                        <a class="nav-link" href="{{ $url }}">{{ $menuItem }} {!! ('/'.request()->segment(count(request()->segments())) == $url) ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                    </li>
                @endforeach
            @endif
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Giriş') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Kayıt') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>

        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Arama Yap" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Arama</button>
        </form>

      </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                  <h1 class="display-4">{{$welcoming}}</h1>
                  <p class="lead">{{$welcomeParagraph}}</p>
                  <hr class="my-4">
                  <a class="btn btn-primary btn-lg" href="#" role="button">{{$callToAction}}</a>
                </div>
            </div>  
        </div><!-- end of header row -->
        <div class="row">
            <div class="col-md-3">
               @yield('leftsidebar') 
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>

    </div><!-- end of .container -->
    
    <footer class="section footer-classic context-dark bg-image" style="background: #2d3246;">
        <div class="container">
          <div class="row row-30">
            <div class="col-md-4 col-xl-5">
              <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light" src="{{ asset('images/dervisoglu-logo.png') }}" alt="Dervişoğlu" srcset="{{asset('images/dervisoglu-retina-logo.png')}} 2x"></a>
                <p style="margin-top: 20px;">Dervişoğlu Gıda olarak toptan satışlarımızla Almanya'daki tüm marketlere hizmet verme amacını misyonumuz olarak belirledik. Amacımıza en iyi şekilde hizmet etmek için çalışmaktayız.</p>
                <!-- Rights-->
                <p class="rights"><span>&copy;  </span><span class="copyright-year">{{date('Y')}}</span><span> </span><span>Dervişoğlu</span><span>. </span><span>All Rights Reserved.</span></p>
              </div>
            </div>
            <div class="col-md-4">
              <h5>İletişim Bilgileri</h5>
              <dl class="contact-list">
                <dt>Adres:</dt>
                <dd>Franzstraße 1 62351 Frankfurt am Main</dd>
              </dl>
              <dl class="contact-list">
                <dt>E-mail:</dt>
                <dd><a href="mailto:info@dervisoglu.com">info@dervisoglu.com</a></dd>
              </dl>
              <dl class="contact-list">
                <dt>Telefonlar:</dt>
                <dd>
                    <a href="tel:+49 69 2625 14 50">+49 176 3261 89 29</a> 
                    <br> <a href="tel:#">+49 176 3560 69 39</a>
                </dd>
              </dl>
            </div>
            <div class="col-md-4 col-xl-3">
              <h5>Hızlı Bağlantılar</h5>
              <ul class="nav-list">
                <li><a href="/about">Hakkımızda</a></li>
                <li><a href="/shop">Ürünler</a></li>
                <li><a href="/blog">Blog</a></li>
                <li><a href="/contact">İletişim</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!--
        <div class="row no-gutters social-container">
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-facebook"></span><span>Facebook</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-instagram"></span><span>instagram</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-twitter"></span><span>twitter</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-youtube-play"></span><span>google</span></a></div>
        </div>
        -->
      </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>