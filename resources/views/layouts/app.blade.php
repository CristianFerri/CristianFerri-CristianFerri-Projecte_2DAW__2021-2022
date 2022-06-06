<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/fontAwesome/fontAwesome.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #fff;
        }

        .icon-user {
            font-size: 3em;
            position: absolute;
            top: -35%;
            left: 100%;
            transition: .3s ease-in-out;
        }

        .fixed-top {
            z-index: 10;
        }

        main {
            min-height: 85vh;
        }

        .container {
            margin-top: 3rem !important;
        }

        .icon-user:hover {
            font-size: 3.2em;
            position: absolute;
            top: -40%;
            left: 100%;
        }

    </style>
</head>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm" id="navbar">
            <div class="container-fluid" style="margin-top: 0 !important;">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/Ask4urTicket.png') }}" alt="Ask4urTicket" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cinema_showCines') }}">Reserva tu entrada</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="{{ route('soporte') }}">Soporte</a>
                        </li>
                    </ul>
                </div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                    @if (Auth::user()->image)
                                        <img class="image rounded-circle" src="/storage/{{ Auth::user()->image }}"
                                            alt="profile_image" style="width: 40px;height: 40px;  margin: 0px; ">
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown">
                                    <div>
                                        <img class="image rounded-circle" src="/storage/{{ Auth::user()->image }}"
                                            alt="profile_image" style="width: 70px;height: 70px;  margin: 0px; ">
                                    </div>
                                    <div>
                                        <p class="fw-bold fs-3 mb-0">{{ Auth::user()->username }}</p>
                                        <hr>
                                    </div>
                                    @if (Auth::user()->admin == true)
                                        <a class="dropdown-item" href="{{ route('adminMenu') }}">ADMIN RIGHTS</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('myAccount') }}">Mi cuenta</a>
                                    <a class="dropdown-item" href="{{ route('myPrivacy') }}">Privacidad</a>
                                    <a class="dropdown-item" href="{{ route('myOrders') }}">Mis pedidos</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/Ask4urTicket.png') }}" alt="Ask4urTicket" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cinema_showCines') }}">Reserva tu entrada</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="{{ route('soporte') }}">Soporte</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                    @if (Auth::user()->image)
                                        <img class="image rounded-circle" src="/storage/{{ Auth::user()->image }}"
                                            alt="profile_image" style="width: 40px;height: 40px;  margin: 0px; ">
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown">
                                    <div>
                                        <img class="image rounded-circle" src="/storage/{{ Auth::user()->image }}"
                                            alt="profile_image" style="width: 70px;height: 70px;  margin: 0px; ">
                                    </div>
                                    <div>
                                        <p class="fw-bold fs-3 mb-0">{{ Auth::user()->username }}</p>
                                        <hr>
                                    </div>
                                    @if (Auth::user()->admin == true)
                                        <a class="dropdown-item" href="{{ route('adminMenu') }}">ADMIN RIGHTS</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('myAccount') }}">Mi cuenta</a>
                                    <a class="dropdown-item" href="{{ route('myPrivacy') }}">Privacidad</a>
                                    <a class="dropdown-item" href="{{ route('myOrders') }}">Mis pedidos</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
        <footer>
            <div class="footer">
                <div class="bubbles">
                    <div class="bubble"
                        style="--size:3.599242256252892rem; --distance:9.03222929905092rem; --position:84.08647966700718%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.1749244893056594s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.17210744392784rem; --distance:7.851878963217241rem; --position:30.41487492245046%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.120755514331528s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.374333179860115rem; --distance:8.589758033392558rem; --position:61.58043295120997%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.953642902721373s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.4015110704444647rem; --distance:8.788692388417912rem; --position:20.32415060586914%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.9258264895307664s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.9916734584538167rem; --distance:6.346319973212056rem; --position:64.88932223899734%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.3488325545889266s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.429068443803793rem; --distance:6.848971965772923rem; --position:49.557193938099346%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.6638034990646906s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.215577529579571rem; --distance:7.779436902795202rem; --position:11.18606310674123%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.7825226562699985s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.346872023975132rem; --distance:8.883774181052498rem; --position:-3.4660232768488908%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.3791630130037853s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.1656620356282215rem; --distance:7.294391588812229rem; --position:49.38440462323014%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.0913459232843663s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.0426001220545267rem; --distance:7.512061077730881rem; --position:65.84557596938913%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.738055755976634s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.5436310535947415rem; --distance:7.94347155248071rem; --position:86.61038726366023%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.041078032115144s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.180452763323853rem; --distance:7.785904520212371rem; --position:93.55103847867926%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.5965499051629934s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.6170660953659004rem; --distance:7.368527287036937rem; --position:14.289128727653765%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.747117695709949s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.20010023132137rem; --distance:8.945535629845441rem; --position:20.464236706640072%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.838410693397272s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.019545393440718rem; --distance:9.226021476834092rem; --position:-4.682768979413671%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.065350250188555s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.340429912574281rem; --distance:8.056392010411315rem; --position:21.685866988807586%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.8855619659979843s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.483038887981516rem; --distance:9.208836739750065rem; --position:30.67407104963108%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.657303357365555s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.6931569101503676rem; --distance:9.101633666079485rem; --position:80.91253512038766%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.4763930761122013s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.253156285260003rem; --distance:6.487286664359275rem; --position:91.0650187268975%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.291269740560057s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.304503370862484rem; --distance:6.108539076104501rem; --position:102.1090923843126%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.6993426478239115s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.2117753598053884rem; --distance:9.079886349073742rem; --position:102.21823556353932%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.4963090824092737s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.961103885300057rem; --distance:7.734754288594568rem; --position:21.756785718340232%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.0158079079143905s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.2887268213035306rem; --distance:8.874882771641811rem; --position:87.473953876978%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.3173092419303836s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.3264282641598557rem; --distance:6.974918846249515rem; --position:73.35789291884885%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.6803844902777816s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.1677998890939305rem; --distance:9.674984318387565rem; --position:59.54054253671545%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.6142092763480167s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.7577161993719175rem; --distance:7.619332002964972rem; --position:92.03688111361146%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.295646278814347s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.8116171593510746rem; --distance:6.696793904049508rem; --position:75.1877369063033%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.702335450087601s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.270923273554124rem; --distance:7.694718190983888rem; --position:97.71982166913459%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.8165897306760868s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.090433463739986rem; --distance:7.938799294371773rem; --position:21.03121724961033%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.8629282538114253s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.127484249932915rem; --distance:8.586995727949922rem; --position:33.174425418211705%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.8781549531784516s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.275416307803818rem; --distance:7.39442108753005rem; --position:46.58617477025404%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.347871478312051s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.1337503402229316rem; --distance:7.679427533321344rem; --position:15.631508359785904%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.4143053718761576s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.9465863130136976rem; --distance:8.055539030807182rem; --position:77.81877426471911%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.047243778000144s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.7367832283958515rem; --distance:6.416546798337725rem; --position:86.52429807077067%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.5192616902394285s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.281399200521686rem; --distance:6.370158209974737rem; --position:80.97084055619163%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.6491835270364157s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.6581052288238105rem; --distance:7.258836227633254rem; --position:44.610315774361865%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.509599671215854s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.491645866022723rem; --distance:7.006089981980264rem; --position:-1.0498354415006572%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.5035365661772917s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.7108302326787515rem; --distance:7.1160845353763165rem; --position:-1.0068601145614386%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.349168755932818s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.6282676637628333rem; --distance:8.65332161528292rem; --position:4.738984905678873%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.794795012644704s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.4360278469437704rem; --distance:9.796915675257061rem; --position:91.31913558048876%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.3218368082637317s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.480383439212243rem; --distance:8.81321168601318rem; --position:48.35889663862576%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.3190998875632323s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.3125684398693673rem; --distance:7.268171515206472rem; --position:15.954142888854712%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.1887543393504836s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.024633358762726rem; --distance:7.912005252937271rem; --position:67.79325699949257%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.4653121696123277s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.819006049486595rem; --distance:9.308796815854905rem; --position:8.315145627904833%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.696525168995958s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.9261405036251658rem; --distance:6.16457481852591rem; --position:30.76376587437447%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.962896495551406s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.6414135196499604rem; --distance:9.165971206178rem; --position:78.98079295503516%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.3369142508155605s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.928309772461319rem; --distance:8.80553156839553rem; --position:-2.0043425484350674%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.4642141182537745s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.694504157679573rem; --distance:6.12110367575854rem; --position:7.938998409031512%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.285772426218781s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.324826309400442rem; --distance:7.348011326222544rem; --position:61.77369190884343%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.499727019132558s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.16863505666653rem; --distance:9.225156179317636rem; --position:69.82259670118185%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.320890359029699s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.137483033392549rem; --distance:6.436308373132416rem; --position:-3.035500921817482%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.8357411559036994s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.563918803966674rem; --distance:7.604004589582092rem; --position:23.860898993178072%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.9872285752561276s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.777105066106367rem; --distance:9.96231005055359rem; --position:14.003537152159598%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.9895237215202695s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.98572593657675rem; --distance:9.404843494922739rem; --position:57.68209620520993%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.2141832046559107s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.4928154772839815rem; --distance:6.850361918188498rem; --position:101.1305947138877%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.6694872304232633s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.5990159052344586rem; --distance:8.816886439221001rem; --position:103.43935607665863%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.3780924473412504s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.410896443050989rem; --distance:7.7199190933754185rem; --position:45.34453637918293%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.321799001789481s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.2574718938310205rem; --distance:7.514269995758208rem; --position:69.0545826999234%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.3438435493802796s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.084210736403808rem; --distance:8.12970394115475rem; --position:80.37240802574973%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.6796063661096583s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.9327689674331285rem; --distance:8.964090021305195rem; --position:71.35046767365453%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.9869806954605296s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.261734227200966rem; --distance:7.443026994936882rem; --position:65.67852110556224%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.9852598085839026s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.3141696892879136rem; --distance:6.449931842829714rem; --position:58.47213468256573%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.3593545216527243s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.731540275598294rem; --distance:9.88983201210687rem; --position:18.921317089807804%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.2856705572748925s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.4042384760678015rem; --distance:7.561521944826108rem; --position:8.636636571295863%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.2828609302712524s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.294502300541016rem; --distance:7.505451602314782rem; --position:23.11518041067763%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.566908614815282s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.94953152484533rem; --distance:6.041921598805972rem; --position:66.79831992821683%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.1765279792845345s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.4722684535033403rem; --distance:6.936201906378365rem; --position:25.658997576179846%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.9457262460892335s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.1638303648031876rem; --distance:8.471570218680029rem; --position:56.11069576159934%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.077785315651392s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.043339398308001rem; --distance:7.144948606292903rem; --position:98.37986771952693%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.583083289378171s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.952763614736627rem; --distance:6.926143432253218rem; --position:56.71069097449426%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.7247576995027893s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.657624117448491rem; --distance:9.846866370887572rem; --position:2.536628053309702%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.6810982886135717s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.469956176622502rem; --distance:8.20918441632768rem; --position:75.88267836858476%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.968096590288576s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.3611508860154515rem; --distance:8.600864310772284rem; --position:12.016704066056924%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.1746094672193057s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.750829205429303rem; --distance:7.387562629953656rem; --position:12.266092944234234%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.8157906412043436s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.100251490852055rem; --distance:6.917256393856118rem; --position:33.414822364762344%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.841840496366248s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.79932837999636rem; --distance:6.517984378730616rem; --position:69.70901935344315%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.94040329963137s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.3619020745021873rem; --distance:7.919930379067919rem; --position:41.57290675821155%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.0407171836851123s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.443334872356418rem; --distance:6.0260631307212815rem; --position:10.405033733782421%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.4925155252156372s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.855031615169598rem; --distance:7.358524738347011rem; --position:32.58030399546087%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.9311907075272323s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.5528220475998493rem; --distance:6.858995740605141rem; --position:49.69163637128876%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.4981668324302304s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.903245877081412rem; --distance:9.865140172326342rem; --position:44.23218796093475%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.444724217075782s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.539452076081797rem; --distance:9.642948723024467rem; --position:20.106994080647308%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.7319348823997007s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.1086841136548893rem; --distance:7.312818913268098rem; --position:37.63784872244155%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.9443042896772456s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.073214363289608rem; --distance:9.47827798673349rem; --position:49.25566740856777%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.9364351256636088s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.3733472791729007rem; --distance:7.258440585250658rem; --position:27.640580584006315%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.2826522315020346s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.5956716825454977rem; --distance:6.752056930355953rem; --position:78.45568789322209%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.0369132752427395s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.0550259328567133rem; --distance:9.278069896565276rem; --position:-0.9925443945855639%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.7179865619587695s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.054509942503805rem; --distance:9.73073576087879rem; --position:40.72345207419795%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.4928471879715044s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.7141212994294825rem; --distance:6.180571006957647rem; --position:27.009098413051504%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.4383290608011037s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.9883671412143737rem; --distance:8.503959490179966rem; --position:2.8914992811445472%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.4977119243132995s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.125414265634747rem; --distance:9.415983522635003rem; --position:31.474739347103792%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.9923054416781705s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.265040954554138rem; --distance:7.977409276123449rem; --position:11.284006833111793%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.156117641897719s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.045364019602476rem; --distance:8.934056957917438rem; --position:24.284160878863222%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.502218835962721s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.626605907031177rem; --distance:9.555542371911965rem; --position:52.11179395406652%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.8041491364481193s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.5386248046643525rem; --distance:7.007735857566873rem; --position:79.96747607795422%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.6624038552976885s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.247229176830741rem; --distance:8.795015651694285rem; --position:80.1588321157658%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.1996467809185787s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.4915703906924787rem; --distance:9.25840501198rem; --position:74.32830378983118%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.839629320521206s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.803620617672042rem; --distance:7.235457463247601rem; --position:50.26525660269598%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.4549735839608777s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.649749481838242rem; --distance:8.410219091752978rem; --position:62.85716621395663%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.7065526713690735s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.897711795783387rem; --distance:9.80121639419934rem; --position:-4.474878639472813%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.8490749414250436s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.891107954890887rem; --distance:6.519463756291639rem; --position:92.15986639116961%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.778466466520034s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.961760811945836rem; --distance:9.254559424495131rem; --position:68.49322949941944%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.7130799968780073s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.9759328923904844rem; --distance:9.369232436688272rem; --position:79.24876469142148%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.4267484502291965s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.669743101302238rem; --distance:7.328932779489646rem; --position:6.736707172964092%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.7854340680918765s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.2783622935517247rem; --distance:9.010690431975227rem; --position:99.40043005558789%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.8059328877001866s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.104246252216803rem; --distance:7.218209468672381rem; --position:102.7151339008336%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.9371898092921898s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.185485136138356rem; --distance:9.267543876923085rem; --position:51.40256684551308%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.729992121809872s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.903076222042885rem; --distance:8.251063921818908rem; --position:69.76989041364853%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.103893077231405s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.269606756955474rem; --distance:8.549026487733135rem; --position:82.14271418470364%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.4294068615316937s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.61353744420372rem; --distance:8.763775053107775rem; --position:73.40188408311674%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.6230304488749363s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.078868705656725rem; --distance:9.224490890144443rem; --position:16.383050402015304%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.9234615462078333s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.170216229072638rem; --distance:9.83464743521327rem; --position:98.35795360246283%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.4851902898067353s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.8480993882844583rem; --distance:7.447959342905392rem; --position:-4.730639973286688%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.1391730595558696s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.18502704361697rem; --distance:6.618192191403504rem; --position:36.81875832346159%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.925774023805047s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.464487455829807rem; --distance:9.53145696553824rem; --position:57.56674377058158%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.851257753442651s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.784360174644443rem; --distance:7.689365714314671rem; --position:20.785769186925243%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.6088035366701106s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.6637649788923943rem; --distance:9.638191966910851rem; --position:66.25867062280767%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.925473731952514s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.076148532415894rem; --distance:9.477347456201397rem; --position:94.4451679364705%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.823644601043635s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.622689055199855rem; --distance:7.119913118160294rem; --position:25.043383975404705%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.439532696886876s;">
                    </div>
                    <div class="bubble"
                        style="--size:5.896124368712632rem; --distance:8.936094751467643rem; --position:44.21638616569351%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.062415338556057s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.4421805323932535rem; --distance:8.330636409290435rem; --position:96.43163872691524%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.2222495408123257s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.591385086093205rem; --distance:8.724554821768244rem; --position:103.31363873279668%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.3918047396781104s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.1121915968268565rem; --distance:8.395997606805881rem; --position:72.85396678768805%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.8936777407145664s;">
                    </div>
                    <div class="bubble"
                        style="--size:2.967442794989349rem; --distance:8.927098015057032rem; --position:41.27438448187359%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.806728187404792s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.610487252079986rem; --distance:9.480741080980398rem; --position:60.50288640978212%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.708211550108718s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.754806700459061rem; --distance:7.111374582693156rem; --position:65.32174753270597%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.9284816731284242s;">
                    </div>
                    <div class="bubble"
                        style="--size:4.423944171116107rem; --distance:8.995520983467514rem; --position:94.15304941003104%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-3.4123379515444556s;">
                    </div>
                    <div class="bubble"
                        style="--size:3.5602618402987565rem; --distance:6.86823457582356rem; --position:65.13941601794082%; --time:<?php echo rand(45, 85) / 11; ?>s; --delay:-2.6683992518266635s;">
                    </div>
                </div>
                <div class="content">
                    <div>
                        <a href="#">Politica de privacidad</a>
                        <a href="#">Aviso Legal</a>
                        <a href="#">Politica de cookies</a>
                    </div>
                    <div>
                        <a href="/myAccount">Mi cuenta</a>
                        <a href="/support">Soporte</a>
                    </div>
                    <div style="color: #fff;">
                        <i>España, Islas Baleares, 91582</i>
                        <i>Cruz Baja</i>
                        <i>Carrer Velázquez, 7, 92º D</i>
                        <i>+34 622 66 3105</i>
                        <i>ask4urticket@movies.es</i>
                    </div>
                </div>
            </div>
            <svg style="position:fixed; top:100vh">
                <defs>
                    <filter id="blob">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9"
                            result="blob"></feColorMatrix>
                        <!--feComposite(in="SourceGraphic" in2="blob" operator="atop") //After reviewing this after years I can't remember why I added this but it isn't necessary for the blob effect-->
                    </filter>
                </defs>
            </svg>
        </footer>
    </div>
</body>

<script>
    window.addEventListener('scroll', function() {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        var navbar = document.querySelector('#navbar');
        if (scrollTop >= 250) {
            navbar.classList.add('fixed-top');
        } else {
            navbar.classList.remove('fixed-top');
        }
    }, false);
</script>

</html>
