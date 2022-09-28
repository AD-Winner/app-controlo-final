@extends('layouts.app')
@section('content')
<div class="container">
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
                <div class="row justify-content-center">
                    {{-- Total Regioes --}}
                    <div class="col-xl-4 col-md-6 mb-4">
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

            </div>
        </div>
                </div>  {{-- Fim de dashboard provincial --}}
            </div>
        </div>
    </div>
</div>
@endsection
