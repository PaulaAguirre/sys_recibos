<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom:0;
            width: 100%;
            height: 30px;
            background-color:   #e5e7e9;
            color: #636b6f;
            text-align: center;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Emisión de Recibos</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" >
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" >
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Consultora DC
                        </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                                <li><a href="{{url ('/recibos')}}">Recibos</a></li>
                                <li><a href="{{url ('/clientes')}}">Clientes</a></li>
                                <li><a href="{{url ('/users')}}">Usuarios</a></li>

                                <li class=" dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <span>{{ Auth::user()->name }}<span class="caret"></span></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>


                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <div class="footer">
            <div class="pull-right hidden-xs">
                <b>Version. </b><i style="margin-right: 20px">1.0</i>
            </div>
            <strong>Developed by <a href="">DELTAnet SRL</a><span> <img src="{{URL::asset('/img/logo deltanet.png')}}" style="width: 2%"></span> </strong>All rights reserved. <strong>Copyright &copy; 2018.</strong>
        </div>
    </div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    @stack('scripts')

    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
</body>
</html>
