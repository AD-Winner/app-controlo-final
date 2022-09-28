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
                    <div class="row my-2 ml-2">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __($recenseamento->tipo)}} {{ __($recenseamento->data->format('Y'))}} </h6>
                    </div>

                     <!-- Content Row -->
                    <div class="row">
                        {{-- Total Provincia --}}
                        <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card border-bottom-info shadow h-100 py-2">
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
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
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
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
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
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kits</div>
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
                            <div class="card border-bottom-info shadow bg-light text-primary   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <div class=" h6 font-weight-bold p-2 text-center text-primary"> <i class="fas  fa-address-card fa-2x text-gray-500"></i> <br> {{ __($totalRecenseado)}} <br> Total</div>
                            </div>
                            <div class="card shadow  bg-light text-primary border-bottom-info  d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-male fa-2x text-gray-500"></i> <br>  {{ __($homen) }} <br> Homens</h6>
                            </div>
                            <div class="card shadow p-2  bg-light text-primary border-bottom-info   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-female fa-2x text-gray-500"></i> <br>  {{ __($mulher)}} <br> Mulheres</h6>
                            </div>
                        </div>
                    <div class="col-md-12 col-lg-12">
                            <div class="card border-bottom-success bg-white h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-3 ml-2">
                                            <div class="h6 text-xs font-weight-bold text-success  ml-4">Eleitores Estimados: <span class=" text-success"> {{ __($estimado)}}  </span>  <span class=" text-danger float-right font-weight-bold"> {{ __($resto)}}  </span> </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto m-3">
                                                    {{-- <div class="h5 mb-0 mr-3 font-weight-bold text-primary text-light-800"> 50% Conclu</div> --}}
                                                </div>

                                                <div class="col">
                                                    <div class="progress progress-striped">
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
                             <div class="row  p-2 bg-light text-center py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary text-capitalize">{{__('Diagrama de Recenseamento Regional')}} </h6>
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
                                    labels:
                                    [
                                         '{{$reg[0]}} | {{$totR[0]}}' , '{{$reg[1]}}|{{$totR[1]}}', '{{$reg[2]}}|{{$totR[2]}}', '{{$reg[3]}} | {{$totR[3]}}',
                                         '{{$reg[4]}} | {{$totR[4]}} ' , '{{$reg[5]}} | {{$totR[5]}} ', '{{$reg[6]}} | {{$totR[6]}}',
                                         '{{$reg[7]}} | {{$totR[7]}}' , '{{$reg[8]}} | {{$totR[8]}}', '{{$reg[9]}} | {{$totR[9]}} ',
                                         '{{$reg[10]}} | {{$totR[10]}}'
                                    ],
                                    datasets: [{
                                    label: 'Total',


                                    data: [
                                        '{{$totR[0]}}', '{{$totR[1]}}', '{{$totR[2]}}', '{{$totR[3]}}',
                                        '{{$totR[4]}}', '{{$totR[5]}}', '{{$totR[6]}}', '{{$totR[7]}}',
                                        '{{$totR[8]}}', '{{$totR[9]}}', '{{$totR[10]}}'

                                        ],
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(54, 162, 235, 0.5)',
                                        'rgba(255, 206, 86, 0.5)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'

                                    ],
                                    borderColor: [
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'

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
                                </div>
                              </div>
                          </div>
                        </div>

                    </div>


                </div>
                </div>


                {{-- Coordenadores e Supervisores --}}

<div class="col-md-12 col-lg-12">
    <div class="card border-bottom-primary bg-white h-100 mb-5 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="">
                    <div class="h6 text-xs font-weight-bold text-primary  ml-4">Agentes Recenseadores : </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="row font-weight-bold  justify-content-center ">
                                <div class="col text-center ">
                                    {{ __('Admins')}}
                                </div>
                                <div class="col text-center">
                                    {{ __('Coordenadores')}}
                                </div>
                                <div class="col text-center">
                                    {{__('Supervisores')}}
                                </div>

                            </div>
                            <div class="row justify-content-center" >
                                <div class="col text-center">
                                    <div class="card border-left-primary " >
                                    {{ __($totalAdmin)}}
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <div class="card border-left-primary " >
                                    {{ __($totalCoord)}}
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <div class="card border-left-primary " >
                                    {{ __($totalSuper)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
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
                    {{ __(':') }}  <span class="text-primary text-uppercase">{{  __('Coordenador Nacional') }}</span> </div>
                <div class="card-body">
                 <!-- Page Heading -->
                    <div class="row my-2 ml-2">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __($recenseamento->tipo)}} {{ __($recenseamento->data->format('Y'))}} </h6>
                    </div>

                     <!-- Content Row -->
                    <div class="row">
                        {{-- Total Provincia --}}
                        <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card border-bottom-info shadow h-100 py-2">
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
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
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
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
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
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kits</div>
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
                            <div class="card border-bottom-info shadow bg-light text-primary   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <div class=" h6 font-weight-bold p-2 text-center text-primary"> <i class="fas  fa-address-card fa-2x text-gray-500"></i> <br> {{ __($totalRecenseado)}} <br> Total</div>
                            </div>
                            <div class="card shadow  bg-light text-primary border-bottom-info  d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-male fa-2x text-gray-500"></i> <br>  {{ __($homen) }} <br> Homens</h6>
                            </div>
                            <div class="card shadow p-2  bg-light text-primary border-bottom-info   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-female fa-2x text-gray-500"></i> <br>  {{ __($mulher)}} <br> Mulheres</h6>
                            </div>
                        </div>
                    <div class="col-md-12 col-lg-12">
                            <div class="card border-bottom-success bg-white h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-3 ml-2">
                                            <div class="h6 text-xs font-weight-bold text-success  ml-4">Eleitores Estimados: <span class=" text-success"> {{ __($estimado)}}  </span>  <span class=" text-danger float-right font-weight-bold"> {{ __($resto)}}  </span> </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto m-3">
                                                    {{-- <div class="h5 mb-0 mr-3 font-weight-bold text-primary text-light-800"> 50% Conclu</div> --}}
                                                </div>

                                                <div class="col">
                                                    <div class="progress progress-striped">
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
                             <div class="row  p-2 bg-light text-center py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary text-capitalize">{{__('Diagrama de Recenseamento Regional')}} </h6>
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
                                    labels:
                                    [
                                         '{{$reg[0]}} | {{$totR[0]}}' , '{{$reg[1]}}|{{$totR[1]}}', '{{$reg[2]}}|{{$totR[2]}}', '{{$reg[3]}} | {{$totR[3]}}',
                                         '{{$reg[4]}} | {{$totR[4]}} ' , '{{$reg[5]}} | {{$totR[5]}} ', '{{$reg[6]}} | {{$totR[6]}}',
                                         '{{$reg[7]}} | {{$totR[7]}}' , '{{$reg[8]}} | {{$totR[8]}}', '{{$reg[9]}} | {{$totR[9]}} ',
                                         '{{$reg[10]}} | {{$totR[10]}}'
                                    ],
                                    datasets: [{
                                    label: 'Total',


                                    data: [
                                        '{{$totR[0]}}', '{{$totR[1]}}', '{{$totR[2]}}', '{{$totR[3]}}',
                                        '{{$totR[4]}}', '{{$totR[5]}}', '{{$totR[6]}}', '{{$totR[7]}}',
                                        '{{$totR[8]}}', '{{$totR[9]}}', '{{$totR[10]}}'

                                        ],
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(54, 162, 235, 0.5)',
                                        'rgba(255, 206, 86, 0.5)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'

                                    ],
                                    borderColor: [
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'

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
                                </div>
                              </div>
                          </div>
                        </div>

                    </div>
                </div>
            </div>
                {{-- Coordenadores e Supervisores --}}

<div class="col-md-12 col-lg-12">
    {{-- <div class="card border-bottom-primary bg-white h-100 mb-5 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="">
                    <div class="h6 text-xs font-weight-bold text-primary  ml-4">Agentes Recenseadores : </div>
                    <div class="row no-gutters align-items-center">
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
                                    <div class="card border-left-primary " >
                                    {{ __($totalCoord)}}
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <div class="card border-left-primary " >
                                    {{ __($totalSuper)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div> --}}
</div>

                </div> <!-- Fin card Body -->
            </div>
        </div>
    </div>
    @endrole {{-- Fim de dashboard provincial --}}




    @role('supervisor') {{-- Incio Dashboard Supervisor --}}
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        {{ __('Supervisão') }}  <span class="text-primary">   {{ (Auth::user()->regiao->regiao) }} {{ __(', Circulo ') }} {{ (Auth::user()->circulo->cod_circulo) }} </span>   {{ __('Sector :') }} <span class="text-primary text-uppercase">  {{ (Auth::user()->sector->sector) }} </span>  </div>

                    <div class="card-body">
                        <div class="row my-2 ml-2">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __($recenseamento->tipo)}} {{ __($recenseamento->data->format('Y'))}} </h6>
                        </div>

                         <!-- Content Row -->
                        <div class="row">
                            {{-- Total Regioes --}}
                                  {{-- Total Circulos --}}
                            <div class="col-xl-4 col-md-4 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Circulo
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ __(Auth::user()->circulo->circulo)}} </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Total Sectors --}}
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Sector</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ __(Auth::user()->sector->sector)}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kits</div>
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
                            {{-- Teste total Recenseados, Homens e Mulheres --}}
                            <div class="row d-flex p-2 m-2 justify-content-evenly">
                                <div class="card border-bottom-info shadow bg-light text-primary   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                    <div class=" h6 font-weight-bold p-2 text-center text-primary"> <i class="fas  fa-address-card fa-2x text-gray-500"></i> <br> {{ __($totalRecenseado)}} <br> Total</div>
                                </div>
                                <div class="card shadow  bg-light text-primary border-bottom-info  d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                    <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-male fa-2x text-gray-500"></i> <br>  {{ __($homen) }} <br> Homens</h6>
                                </div>
                                <div class="card shadow p-2  bg-light text-primary border-bottom-info   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                    <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-female fa-2x text-gray-500"></i> <br>  {{ __($mulher)}} <br> Mulheres</h6>
                                </div>
                            </div>
                            {{-- Coluna de progress bar --}}
                            <div class="col-md-12 col-lg-12">
                                    <div class="card border-bottom-info bg-white h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-3 ml-2">
                                                    <div class="h6 text-xs font-weight-bold text-success  ml-4">Eleitores Estimados: <span class=" text-success"> {{ __($estimado)}}  </span>  <span class=" text-danger float-right font-weight-bold"> {{ __($resto)}}  </span> </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto m-3">
                                                            {{-- <div class="h5 mb-0 mr-3 font-weight-bold text-primary text-light-800"> 50% Conclu</div> --}}
                                                        </div>

                                                        <div class="col">
                                                            <div class="progress progress-striped">
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
                    </div> {{-- End of card-body --}}
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
                        <div class="row my-2 ml-2">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __($recenseamento->tipo)}} {{ __($recenseamento->data->format('Y'))}} </h6>
                        </div>

                         <!-- Content Row -->
                        <div class="row">
                            {{-- Total Regioes --}}
                                  {{-- Total Circulos --}}
                            <div class="col-xl-4 col-md-4 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Circulos
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ __($totalCirculo)}} </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Total Sectors --}}
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
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
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kits</div>
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
                            {{-- Teste total Recenseados, Homens e Mulheres --}}
                            <div class="row d-flex p-2 m-2 justify-content-evenly">
                                <div class="card border-bottom-info shadow bg-light text-primary   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                    <div class=" h6 font-weight-bold p-2 text-center text-primary"> <i class="fas  fa-address-card fa-2x text-gray-500"></i> <br> {{ __($totalRecenseado)}} <br> Total</div>
                                </div>
                                <div class="card shadow  bg-light text-primary border-bottom-info  d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                    <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-male fa-2x text-gray-500"></i> <br>  {{ __($homen) }} <br> Homens</h6>
                                </div>
                                <div class="card shadow p-2  bg-light text-primary border-bottom-info   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                    <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-female fa-2x text-gray-500"></i> <br>  {{ __($mulher)}} <br> Mulheres</h6>
                                </div>
                            </div>
                            {{-- Coluna de progress bar --}}
                            <div class="col-md-12 col-lg-12">
                                    <div class="card border-bottom-info bg-white h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-3 ml-2">
                                                    <div class="h6 text-xs font-weight-bold text-success  ml-4">Eleitores Estimados: <span class=" text-success"> {{ __($estimado)}}  </span>  <span class=" text-danger float-right font-weight-bold"> {{ __($resto)}}  </span> </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto m-3">
                                                            {{-- <div class="h5 mb-0 mr-3 font-weight-bold text-primary text-light-800"> 50% Conclu</div> --}}
                                                        </div>

                                                        <div class="col">
                                                            <div class="progress progress-striped">
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
                    </div>
                </div>
            </div>
        </div>
    @endrole {{-- Fim de dashboard provincial --}}
    @role('coordenador-provincia') {{-- Incio Dashboard Regional --}}
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="card">
                    <div class=" card-header font-weight-bold">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        {{ __('Provincia ')}} {{__(':')}} <span class="text-primary text-uppercase">  {{ (Auth::user()->provincia->provincia) }} </span> </div>

                    <div class="card-body">

                        <!-- Page Heading -->
                    <div class="row my-2 ml-2">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __($recenseamento->tipo)}} {{ __($recenseamento->data->format('Y'))}} </h6>
                    </div>

                     <!-- Content Row -->
                    <div class="row">
                        {{-- Total Regioes --}}
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
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
                              {{-- Total Circulos --}}
                        <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Circulos
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ __($totalCirculo)}} </div>
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
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
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
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kits</div>
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
                            <div class="card border-bottom-info shadow bg-light text-primary   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <div class=" h6 font-weight-bold p-2 text-center text-primary"> <i class="fas  fa-address-card fa-2x text-gray-500"></i> <br> {{ __($totalRecenseado)}} <br> Total</div>
                            </div>
                            <div class="card shadow  bg-light text-primary border-bottom-info  d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-male fa-2x text-gray-500"></i> <br>  {{ __($homen) }} <br> Homens</h6>
                            </div>
                            <div class="card shadow p-2  bg-light text-primary border-bottom-info   d-flex align-items-center justify-content-center c col-2 rounded-circle">
                                <h6 class="h6 font-weight-bold text-center text-primary"> <i class="fas fa-female fa-2x text-gray-500"></i> <br>  {{ __($mulher)}} <br> Mulheres</h6>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                                <div class="card border-bottom-info bg-white h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-3 ml-2">
                                                <div class="h6 text-xs font-weight-bold text-success  ml-4">Eleitores Estimados: <span class=" text-success"> {{ __($estimado)}}  </span>  <span class=" text-danger float-right font-weight-bold"> {{ __($resto)}}  </span> </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto m-3">
                                                        {{-- <div class="h5 mb-0 mr-3 font-weight-bold text-primary text-light-800"> 50% Conclu</div> --}}
                                                    </div>

                                                    <div class="col">
                                                        <div class="progress progress-striped">
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
            </div>
                    </div>  {{-- Fim de dashboard provincial --}}
                </div>
            </div>
        </div>
    @endrole {{-- Fim de dashboard provincial --}}




 <script text="javascript" src="{{ asset('js/refresh.js') }}"></script>
</div>
@endsection
