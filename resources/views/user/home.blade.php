@extends('layouts.user')
@section('content')
<div class="container p-2">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card bg-dark ">
                <div class="m-0 card-header font-weight-bold text-dark m-0  bg-white">
                    {{-- <h6 class="m-0 font-weight-bold text-dark ml-0">MENU INICIAL </h6> --}}
                    <div class="card-header py-1">
                        <h5 class="m-0 h5 font-weight-bold text-dark text-uppercase"> Região : {{$userR[0]->region}}, {{$userC[0]->cercle}}, Sector:<span class="text-danger"> {{$userS[0]->secteur}}</span></h5>
                    </div>
                </div>
            <div class="row rows-cols-4 p-0 mt-3  mb-0 text-uppercase ">
                    <div class="col ml-1">
                        <a href=" {{route('rb-index')}} " class="btn btn-outline-warning my-0 ml-3 font-weight-bold" ><i class="fas fa-fw fa-edit"></i> Actas</a>
                      {{-- Privilegio para visualizar dados --}}
                        @can('visualizar-dados')
                       <a href="{{route('rb-statistique')}}" class="btn btn-outline-warning my-0 font-weight-bold" ><i class="fas fa-fw fa-tachometer-alt"></i> Estatisticas</a>
                       @endcan
                    @can('imprimir-dados')
                    <a href="{{route('rapport-secteur-index')}}" class="btn btn-outline-warning my-0 font-weight-bold" ><i class="fas fa-fw fa-list-alt"></i> Relatórios</a>
                    @endcan
                        <a href="{{route('appropos') }} " class="btn btn-outline-success my-0 font-weight-bold" ><i class="fas fa-fw fa-question"></i>
                            {{-- Ajuda --}}
                        </a>
                    </div>
            </div>


                <div class="card-body mt-0 ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-center ">
                        {{-- <h6 class="m-0 font-weight-bold text-success   ">COMMISION REGIONAL D'ELECTIONS</h6> --}}
                        <img class="img-fluid mt-0 py-0 " style="width: 45rem;"
                            src="img/3-tela-inicial-fr.png" alt="Home-page-admin-image">
                    </div>
                </div>
            <hr class="featurette-divider bg-light p-0 m-0">
            <div class="row justify-content-center ml-5 text-white">
                By: Aliu Djalo, {{date('Y') }}
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
