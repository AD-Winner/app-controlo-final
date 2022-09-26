@extends('layouts.app')
@section('content')
<div class="container">

    {{--  MODAL PARA ADICIONAR REGIÃO--}}
    <div class="modal fade" id="AjouterRegionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!--Titre de modal-->
                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Recenseados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Corp de Modal-->
            <h6 class="modal-title ml-3 text-primary font-weight-bold" id="exampleModalLongTitle"> {{$recenseamento->tipo}} : {{$recenseamento->data->format('Y')}}</h6>
                <form  method="POST" action=" {{route('supervisor.recenseados.store')}} " >
                @csrf
                    <div class="modal-body">
                        <input type="hidden" name="recenseamento_id" value="{{$recenseamento->id}}"/>
                        <input type="hidden" name="provincia_id" value="{{Auth::user()->provincia_id}}"/>
                        <input type="hidden" name="regiao_id"   value="{{ Auth::user()->regiao_id}}"/>
                        <input type="hidden" name="circulo_id"  value="{{ Auth::user()->circulo_id}}"/>
                        <input type="hidden" name="sector_id"   value="{{ Auth::user()->sector_id}}"/>

                        <div class="form-group font-weight-bold text-secondary">
                            <label for="data">{{ __('Data de Recenseamento :')}}</label>
                             <input type="date" class="form-control" id="data"   require
                             min="1" name="data"  placeholder="Digite data de recenseamento..." />
                        </div>
                        <div class="form-group">
                            <label for="homem">Homens:</label>
                            <input type="number" class="form-control" max="6000" min="1" name="homem"  placeholder="Homens recenseados..." />
                        </div>

                        <div class="form-group">
                            <label for="mulher">Mulheres:</label>
                            <input type="number" class="form-control" max="6000" min="1" name="mulher"  placeholder="Mulheres recenseadas..." />
                        </div>


                            <div class="form-group">
                                <label for="kit_id">Kit de recenseamento:</label>
                                <select name="kit_id" class="form-control" id="">
                                    <option > ..selecione kit </option>
                                    @foreach ($kits as $kit )
                                         <option value="{{ $kit->id }}"> {{$kit->numero}} : {{$kit->descricao}} </option>
                                    @endforeach
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Adicionar</button>
                         <button type="button" class="btn btn-sm btn-outline-info" data-dismiss="modal">Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            <h6 class="modal-title ml-3 text-secondary font-weight-bold" id=""> <span class="text-primary"> Região :</span> {{ Auth::user()->regiao->regiao }},  <span class="text-primary">Circulo : </span>{{Auth::user()->circulo->cod_circulo }}, <span class="text-primary"> Sector : </span> {{ Auth::user()->sector->sector }} </h6>
             <hr class="featurette-divider">
             <div class="row">
                    <div class="col-sm-12">
                            <div class="float-right">
                                    <!-- Botton de la modal d'ajout de Region-->
                                    <button type="button" class="btn btn-sm btn-primary mr-4 float-right" data-toggle="modal" data-target="#AjouterRegionModal">
                                        <i class="fas fa-plus"></i> Recenseados
                                    </button>
                                    {{-- <a class="btn btn-sm btn-outline-secondary" href=""><i class="fas fa-print"></i> PDF </a> --}}
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                                    <h6 class="h6 font-weight-bold">Total <span class="text-primary"> {{$tot}} </span> Eleitores Recenseados  </h6>
                            </div>
                    </div>
                 {{-- <hr class="featurette-divider"> --}}
                </div>

        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm table-hover ">
                        <thead class="table-primary">
                            <tr>
                                {{-- <th  scope="col">Região</th>
                                <th  scope="col">Sector</th> --}}
                                <th  scope="col">Kit</th>
                                <th  scope="col">Data</th>
                                <th  scope="col">Homens</th>
                                <th  scope="col">Mulheres</th>
                                <th  scope="col">Total</th>
                                <th  scope="col" class="text-center">Ações</th>

                            </tr>
                        </thead>
                        <tfoot class="table-primary" >
                            <tr>
                                {{-- <th  scope="col">Região</th>
                                <th  scope="col">Sector</th> --}}
                                <th  scope="col">Kit</th>
                                <th  scope="col">Data</th>
                                <th  scope="col">Homens</th>
                                <th  scope="col">Mulheres</th>
                                <th  scope="col">Total</th>
                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($recenseados as $recenseado )
                                <tr>

                                    {{-- <td> {{$recenseado->regiao->cod_regiao}} : {{$recenseado->regiao->regiao}} </td>
                                    <td> {{$recenseado->sector->cod_sector}} : {{$recenseado->sector->sector}} </td> --}}
                                    <td> {{$recenseado->kit->descricao}} </td>
                                    <td> {{$recenseado->data->format('d-m-Y')}} </td>
                                    <td> {{$recenseado->homem}} </td>
                                    <td> {{$recenseado->mulher}} </td>
                                    <td> {{$recenseado->homem + $recenseado->mulher}} </td>

                                    <td class="d-flex justify-content-center ">
                                        @can('apagar')
                                            <form action=" {{route('supervisor.recenseados.destroy', $recenseado->id)}}"
                                                method="post"
                                                onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                                @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm  text-primary ml-1 "><i class="fas fa-trash"></i> </button> <!--<i class="fa fa-trash"></i>-->
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
                <div class="float-right">


                </div>
            </div>
        </div>
    </div>



</div>
<script type="text/javascript">
    $(document).ready(function(){

        var table = $('#datatable').dataTable();
        // Start Edit Record

        table.on('click', '.edit', function(){

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#cod_regiao').val(data[1]);
            $('#regiao').val(data[2]);

            $('#editForm').attr('action', '/regioes/'+data[0]);
            $('#editarRegionModal').modal('show');
        })
        // End Edit Record

    });

</script>
@endsection
