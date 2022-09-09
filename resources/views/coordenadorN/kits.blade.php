@extends('layouts.app')
@section('content')
<div class="container">
    <!--FIN DE MODAL D'AJOUT DE REGION-->
    <div class="row bg-white pt-3 mt-1">
        <div class="col-sm-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                    </ul>
                </div>
            @endif
             <!-- ALERT DE SUCCESS -->
             @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success')}}</p>
                </div>
            @endif
             <!-- ALERT DE ERROR -->
             @if(\Session::has('error'))
                <div class="alert alert-danger">
                    <p>{{ \Session::get('error')}}</p>
                </div>
            @endif
            <h5 class="modal-title ml-3 text-primary font-weight-bold" id="exampleModalLongTitle"> {{$recenseamento->tipo}} : {{$recenseamento->data->format('Y')}}</h5>            
             <hr class="featurette-divider">
                <div class="row">
                    <div class="col-sm-12">                      
                    </div>

                    <div class="col-sm-12 ">
                          <h6 class="h6 font-weight-bold">{{ __('Total :')}} <span class="text-primary"> {{$totKits}} </span> Kits
                            ,<span class="text-danger"> {{$f + $m}} </span> {{ __('Eleitores Recenseados,')}}
                            <span class="text-primary">  {{__($m)}} </span>{{ __('Homens e ')}} 
                                         <span class="text-primary">{{__($f)}} </span> 
                                         {{('Mulheres')}}                            
                        </h6>
                    </div>
                 </div>
                {{-- <hr class="featurette-divider"> --}}
        </div>
        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm   table-hover ">
                        <thead class="table-primary" >
                            <tr>
                                <th  scope="col">Região</th>
                                <th  scope="col">Sector</th>
                                <th class="text-center" scope="col">Numero</th>
                                <th  scope="col">Descrição</th>
                                <th  scope="col">Recenseados</th>                                
                                
                            </tr>
                        </thead>
                        <tfoot class="table-primary">
                            <tr>
                                <th  scope="col">Região</th>
                                <th  scope="col">Sector</th>
                                <th class="text-center" scope="col">Numero</th>
                                <th  scope="col">Descrição</th>
                                <th  scope="col">Recenseados</th>
                                
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($kits as $kit )
                                <tr>                                 
                                    <td> {{$kit->regiao->regiao}} </td>
                                    <td> {{$kit->sector->sector}} </td>
                                    <td class="text-center"> {{$kit->numero}} </td>                                    
                                    <td> {{$kit->descricao}} </td>
                                    <td> {{ ($kit->recenseados->sum('homen')) +  ($kit->recenseados->sum('mulher'))}} </td>                                                                    
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#datatable').dataTable();    
    });   
</script>
@endsection
