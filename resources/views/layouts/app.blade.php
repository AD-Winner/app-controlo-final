<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


     {{-- <script src="{{ asset('js/refresh.js') }}"></script> --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>

    <!-- Fonts -->
    <link href="{{asset('fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- link of Bootsrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{asset('bootstrap-4.4.1-dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Data Tables links --->
    <link href="{{ asset('datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     {{-- SCRIPTS DES DIAGRAMMES --}}
     <script src="{{ asset('chart.js/chart.min.js') }}"></script>

</head>
<body>
    <div id="app">

        @auth <!-- Somente autenticados pode ver bara de navegação-->
        <nav class="navbar navbar-expand-md navbar-light bg-light  shadow-sm">
            <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'GTAPE') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav me-auto">
                        @role('admin')
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'home') active font-weight-bold active text-primary @endif"
                                 href=" {{ route('home') }}"> <i class="fas fa-fw fa-tachometer-alt"></i>  {{ __('Dashboard') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  @if(\Route::current()->getName() == 'user.index') active font-weight-bold active text-primary @endif"
                                href=" {{ route('user.index') }}">
                                    <i class="fas fa-users"></i>  {{ __('Utilizadores') }}</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link @if(\Route::current()->getName() == 'role.index') active font-weight-bold active text-primary @endif"
                                href="{{ route('role.index') }}">  <i class="fas fa-user"></i> {{ __('Perfis') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'permission.index') active font-weight-bold active text-primary @endif"
                                    href="{{ route('permission.index') }}">
                                    <i class="fas fa-edit"></i> {{ __('Permissões') }}</a>
                            </li>
                        @endrole
                        @role('supervisor')
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'home') active font-weight-bold active text-primary    @endif" href=" {{ route('home')}} "> <i class="fas fa-fw fa-tachometer-alt"></i>  {{ __('Dashboard') }}</a>
                            </li>
                        @endrole

                        @role('coordenador-regional')
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'home') active font-weight-bold active text-primary    @endif " href=" {{ route('home') }} "> <i class="fas fa-fw fa-tachometer-alt"></i>  {{ __('Dashboard') }}</a>
                            </li>
                        @endrole
                        @role('coordenador-provincia')
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'home') active font-weight-bold active text-primary    @endif" href=" {{ route('home') }} "> <i class="fas fa-fw fa-tachometer-alt"></i>  {{ __('Dashboard') }}</a>
                            </li>
                        @endrole
                        @role('coordenador-nacional')
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'home') active font-weight-bold active text-primary    @endif " href=" {{ route('home') }} "> <i class="fas fa-fw fa-tachometer-alt"></i>  {{ __('Dashboard') }}</a>
                            </li>
                        @endrole
                    </ul>



                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ms-auto">
                        @role('admin')
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'provincia.index') active font-weight-bold active text-primary    @endif " href="{{ route('provincia.index') }}"> <i class="fa fa-info"></i>  {{ __('Provincias') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'regioes.index') active font-weight-bold active text-primary   @endif " href="{{ route('regioes.index') }}"> <i class="fa fa-info"></i>  {{ __('Regiões') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'circulo.index') active font-weight-bold active text-primary   @endif" href="{{ route('circulo.index') }}"> <i class="fa fa-info"></i>  {{ __('Circulos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() === 'sector.index') font-weight-bold active text-primary   @endif " href="{{ route('sector.index') }}"><i class="fa fa-info"></i> {{ __('Sectores') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'recenseamento.index') active font-weight-bold active text-primary   @endif " href="{{ route('recenseamento.index') }}">  <i class="fa fa-street-view"></i> {{ __('Recenseamentos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'kit.index' ) active  font-weight-bold active text-primary   @endif "
                                    href="{{ route('kit.index') }}"><i class="fa fa-suitcase"></i> {{ __('Kits') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'recenseado.index' ) active font-weight-bold active text-primary   @endif"
                                    href="{{ route('recenseado.index') }}"><i class="fa fa-id-card"></i> {{ __('Recenseados') }}</a>
                            </li>
                        @endrole
                        {{--  --}}
                        @role('coordenador-nacional')
                            <li class="nav-item">
                                <a class="nav-link @if (\Route::current()->getName() == 'coordenador.nacional.kits' ) active font-weight-bold text-primary @endif "
                                    href=" {{ route('coordenador.nacional.kits') }} ">
                                    {{-- <i class="fa fa-puzzle-piece"></i> --}}
                                    <i class="fa fa-suitcase"></i>
                                        {{ __('Kits') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(\Route::current()->getName() == 'coordenador.nacional.recenseados' ) active font-weight-bold active text-primary   @endif"
                                 href=" {{ route('coordenador.nacional.recenseados')}} ">
                                    {{-- <i class="fa fa-street-view"></i> --}}
                                    <i class="fa fa-id-card"></i>
                                    {{ __('Recenseados') }}
                                </a>
                            </li>
                        @endrole
                        {{-- Links para coordenador de provincia --}}
                        @role('coordenador-provincia')
                        <li class="nav-item">
                            <a class="nav-link @if (\Route::current()->getName() == 'coordenador.provincial.kits' ) active font-weight-bold text-primary @endif "

                            href=" {{ route('coordenador.provincial.kits')}} ">
                                <i class="fa fa-suitcase"></i>
                                {{-- <i class="fa fa-puzzle-piece"></i> --}}
                                    {{ __('Kits') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (\Route::current()->getName() == 'coordenador.provincial.recenseados' ) active font-weight-bold text-primary @endif "

                                    href="{{ route('coordenador.provincial.recenseados')}} ">
                                        <i class="fa fa-id-card"></i>
                                        {{-- <i class="fa fa-street-view"></i> --}}
                                        {{ __('Recenseados') }}</a>
                                </li>
                        @endrole
                        {{-- Fim do Links --}}

                        @role('coordenador-regional')
                        <li class="nav-item">
                            <a class="nav-link @if (\Route::current()->getName() == 'coordenador.regional.kits' ) active font-weight-bold text-primary @endif "

                            href=" {{ route('coordenador.regional.kits')}} ">
                                <i class="fa fa-suitcase"></i>
                                    {{ __('Kits') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (\Route::current()->getName() == 'coordenador.regional.recenseados' ) active font-weight-bold text-primary @endif "
                                    href=" {{ route('coordenador.regional.recenseados')}} ">
                                        <i class="fa fa-id-card"></i>
                                        {{ __('Recenseados') }}</a>
                                </li>
                        @endrole
                        @role('supervisor')
                        <li class="nav-item">
                            <a class="nav-link @if (\Route::current()->getName() == 'supervisor.kits' ) active font-weight-bold text-primary @endif "
                            href=" {{ route('supervisor.kits') }} ">
                                <i class="fa fa-suitcase"></i>
                                    {{ __('Kits') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (\Route::current()->getName() == 'supervisor.recenseados' ) active font-weight-bold text-primary @endif "
                                     href="{{ route('supervisor.recenseados') }}">
                                        <i class="fa fa-id-card"></i>
                                        {{ __('Recenseados') }}</a>
                                </li>
                        @endrole
                        @guest
                        {{--
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                                </li>
                            @endif

                             @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registar') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user-circle"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                                <i class="fas fa-sign-out-alt"></i>

                                        {{ __('Desconectar') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>
    @endauth
        <main class="py-4">
            @yield('content')
        </main>
    </div>
     <!-- Footer -->
     {{-- <footer class="sticky-footer bg-white">
        <div class="container  my-auto">
            <div class="copyright text-center  my-auto">
                <span class="h6 text-primary font-weight-bold">Copyright &copy; Gabinete Tecnico de Apoio Ao Processo Eleitoral (GTAPE) {{ date('Y')}}  </span>
            </div>
            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                Por: Aliu Djaló
            </div>
        </div>
    </footer> --}}
    <!-- End of Footer -->

    <!-- Page level plugins -->
    {{-- <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }} "></script> --}}
    {{-- <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <link href="{{asset('bootstrap-4.4.1-dist/js/bootstrap.min.js')}}" rel="stylesheet" type="text/css"> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="{{asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatables/text.js') }}"></script>
    <script src="{{ asset('chart.js/Chart.min.js') }}"></script>




</body>
</html>
