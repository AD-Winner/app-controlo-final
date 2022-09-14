@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Incio Dashboard geral --}}
    @role('admin')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10 col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    {{ __(':') }}  <span class="text-primary text-uppercase">{{  __('Administrador') }}</span> </div>
                <div class="card-body">
                 <!-- Page Heading -->
                    {{-- <div class="d-sm-flex align-items-center pt-3 justify-content-between mb-4">
                        <h4 class="h4 text-weight-bold mb-0 text-gray-800 text-uppercase">Dashboard Nacional</h4>

                        @role('admin')
                        <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Gestão de Relatórios</a>
                        @endrole
                    </div> --}}
                 <!-- Page Heading -->
                    <div class="row my-2 ml-2">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __($recenseamento->tipo)}} {{ __($recenseamento->data->format('Y'))}} </h6>
                    </div>

                     <!-- Content Row -->
                    <div class="row">
                        {{-- Total Provincia --}}
                        <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Provincias
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ __($totalProvincia)}} </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Total Regioes --}}
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Regiões</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ __($totalRegiao)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Total Sectors --}}
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Sectores</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ __($totalSector)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kits</div>
                                            <div class="row gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> {{ __($totalKit)}} </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-suitcase fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Teste dashboard --}}
                        <div class="row d-flex p-2 m-2 justify-content-evenly">
                            <div class="card shadow bg-light text-primary border-primary  d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <div class="p-2 text-center text-primary"> <i class="fas  fa-id-card"></i> <br> {{ __($totalRecenseado)}} <br> Total</div>
                            </div>
                            <div class="card shadow  bg-light text-primary border-primary  d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <h6 class="text-center text-primary"> <i class="fas fa-male"></i> <br>  {{ __($homen) }} <br> Homens</h6>
                            </div>
                            <div class="card shadow p-2  bg-light text-primary border-primary  d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <h6 class=" text-center text-primary"> <i class="fas fa-female"></i> <br>  {{ __($mulher)}} <br> Mulheres</h6>
                            </div>
                        </div>
                         <div class="row  text-dark justify-content-center">
                            <div class="card-body ml-4">
                                <div class="col-md-12 col-lg-12">
                                    <div class="row font-weight-bold  justify-content-center ">
                                        <div class="col text-center">
                                            {{ __('Coordenadores')}}
                                        </div>
                                        <div class="col text-center">
                                            {{__('Supervisores')}}
                                        </div>                                

                                    </div>
                                    <div class="row justify-content-center" >
                                        <div class="col text-center">
                                            {{ __($totalCoord)}}
                                        </div>
                                        <div class="col text-center">
                                            {{ __($totalSuper)}}
                                        </div>                               
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="card border-left-success bg-white h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-3 ml-2">
                                            <div class="h6 text-xs font-weight-bold text-primary  ml-4">   Eleitores Estimados: <span class=" text-success"> {{ __($recenseamento->estimado)}}  </span>  <span class=" text-danger float-right font-weight-bold"> {{ __($resto)}}  </span> </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto m-3">
                                                    {{-- <div class="h5 mb-0 mr-3 font-weight-bold text-primary text-light-800"> 50% Conclu</div> --}}
                                                </div>

                                                <div class="col">
                                                    <div class="progress progress-md ">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{__($pourcentual_total_recenseado)}}%" aria-valuenow={{__($pourcentual_total_recenseado)}} aria-valuemin="0"
                                                            aria-valuemax="100"> {{__($pourcentual_total_recenseado)}}%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto mt-4 ">
                                            <div class="h5 mb-0 mr-2 ml-1 font-weight-bold text-success text-success-800"> {{__($pourcentual_total_recenseado)}}%</div>
                                        </div>
                                        <div>
                                            {{-- <span class=" h6 text-danger float-right font-weight-bold"> {{ __($resto)}} </span> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>                        
                </div> <!-- End Of Content Row-->

                <div class="row   bg-white justify-content-center">
                    {{-- <div class="col-md-6 col-lg-6 float-left mr-0"> --}}
                        
                           
                        {{-- </div> --}}                   
                    {{-- <div class="col-md-6 col-lg-12"> --}}
                    <div class="row   m-4 ">
                        {{--Graphe PIE Vote par genre  --}}
                        <div class="card m-b-20 mt-2 mb-2">
                             <!-- Card Header - Dropdown -->
                             <div class="row   bg-primary text-center py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-light text-uppercase">{{__('Diagrama de Recenseamento Regional')}} </h6>
                            </div>

                            <div class="card-body mb-2 " >
                              <div class="inbox-wid">
                                <div class="inbox-item">
                                <canvas id="myChart1" width="200" height="100"></canvas>
                                <script>
                                  var ctx = document.getElementById('myChart1').getContext('2d');
                                  var myChart = new Chart(ctx, {
                                  type: 'bar',
                                  data: {
                                    labels: ['Yellow', 'Green', 'Purple', 'Other', 'Data1'],
                                    datasets: [{
                                    label: 'Total Regional ',
                                    data: [50, 30, 40, 20, 10, 3, 4,],
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 0.5)',
                                        'rgba(255, 206, 86, 0.5)',
                                         'rgba(75, 255, 192, 0.8)',
                                        'rgba(153, 102, 255, 0.8)',
                                       'rgba(255, 159, 64, 0.8)',
                                    //    'rgba(255, 99, 132, 0.5)',
                                       // */
                                    ],
                                    borderColor: [
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 255, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                         'rgba(255, 159, 64, 1)',
                                        // 'rgba(255, 99, 132, 1)',
                                        //*/
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                        </script>
                                </div> <!-- fin inbox-wid-->
                              </div><!-- fin d'inbox wid -->
                          </div><!-- FIN DE CARD BODY -->
                        </div><!-- fin de card-->

                    </div>
                    {{-- </div> <!-- FIN DE LA COLONNE--> --}}

                </div>
                </div>

                </div> <!-- Fin card Body -->
            </div>
        </div>
    </div>
    @endrole {{-- Fim de dashboard Geral --}}
    @role('coordenador-nacional')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10 col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    {{ __(':') }}  <span class="text-primary text-uppercase">{{  __('Nacional') }}</span> </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="row d-flex justify-content-evenly">
                            <div class="card shadow-lg bg-success text-white d-flex align-items-center justify-content-center c col-4 rounded-circle">
                            <h2 class="text-center text-white"> <i class="fas fa-user-graduate"></i> <br> {{ __('#')}} <br> Etudiants</h2>
                            </div>
                            <div class="card shadow-lg p-2  bg-success text-white d-flex align-items-center justify-content-center c col-4 rounded-circle">
                                <h2 class="text-center text-white"> <i class="far fa-file-pdf"></i> <br>  {{ __('#')}}} <br> Stages soumis</h2>
                            </div>
                            <div class="card shadow-lg p-2  bg-success text-white d-flex align-items-center justify-content-center c col-4 rounded-circle">
                                <h2 class="text-center text-white"> <i class="fas fa-chalkboard-teacher"></i> <br>  {{ __('#')}} <br> Enseignants</h2>
                            </div>
                            <div class="card shadow-lg   bg-success text-white d-flex align-items-center justify-content-center c col-4 rounded-circle">
                                <h2 class="text-center text-white"> <i class="fas fa-school"></i> <br>  {{ __('#')}} <br> Parcours</h2>
                            </div>
                            <div class="card shadow-lg bg-success  text-white d-flex align-items-center justify-content-center c col-4 rounded-circle">
                                <h2 class="text-center text-white"> <i class="fas fa-user"></i> <br>  {{ __('#')}}  <br> Utilisateurs</h2>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole {{-- Fim de dashboard Geral --}}


    @role('supervisor') {{-- Incio Dashboard Supervisor --}}
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        {{ __('Supervisão') }}  <span class="text-primary">   {{ (Auth::user()->regiao->regiao) }} {{ __(', Circulo ') }} {{ (Auth::user()->circulo->cod_circulo) }} </span>   {{ __('Sector :') }} <span class="text-primary text-uppercase">  {{ (Auth::user()->sector->sector) }} </span>  </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    @endrole {{-- Fim de dashboard para supervisao --}}

    @role('coordenador-regional') {{-- Incio Dashboard Regional --}}
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="card">
                    <div class=" card-header font-weight-bold">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        {{ __('Região ')}} {{__(':')}} <span class="text-primary text-uppercase">  {{ (Auth::user()->regiao->regiao) }} </span> </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    @endrole {{-- Fim de dashboard regional --}}
    @role('coordenador-provincia') {{-- Incio Dashboard Regional --}}
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="card">
                    <div class=" card-header font-weight-bold">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        {{ __('Provincia ')}} {{__(':')}} <span class="text-primary text-uppercase">  {{ (Auth::user()->provincia->provincia) }} </span> </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    @endrole {{-- Fim de dashboard regional --}}




 <script text="javascript" src="{{ asset('js/refresh.js') }}"></script>
</div>
@endsection
