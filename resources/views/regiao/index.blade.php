@extends('layouts.app')
@section('content')
<div class="container">

    {{--  MODAL PARA ADICIONAR REGIÃO--}}
    <div class="modal fade" id="AjouterRegionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!--Titre de modal-->
                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar região</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Corp de Modal-->
                <form  method="POST" action=" {{route('regioes.store')}} " >
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="provincia_id">Provincia da região:</label>
                            <select name="provincia_id" class="form-control " id="">
                                <option value=""> ..selecione uma provincia... </option>
                                    @foreach ($provincias as $provincia)
                                        <option value="{{$provincia->id}}"> {{$provincia->provincia }} </option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cod_regiao">Codigo:</label>
                            <input type="number" min="1" max="10" class="form-control"  placeholder="Codigo da região" name="cod_regiao" id="cod_regiao" >
                        </div>
                         <div class="form-group">
                            <label for="regiao">Região:</label>
                             <input type="text" class="form-control" max="20" min="3" name="regiao" id="regiao" placeholder="Nome da região" />
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
             <hr class="featurette-divider">
             <div class="row">
                <div class="col-sm-12">
                 <div class="float-right">
                        <!-- Botton de la modal d'ajout de Region-->
                        <button type="button" class="btn btn-sm btn-primary mr-4 float-right" data-toggle="modal" data-target="#AjouterRegionModal">
                            <i class="fas fa-plus"></i> Região
                        </button>
                        {{-- <a class="btn btn-sm btn-outline-secondary" href=""><i class="fas fa-print"></i> PDF </a> --}}
                    </div>
                </div>
                    <div class="col-sm-12 ">
                          <h6 class="h6 font-weight-bold">Total <span class="text-dark"> {{$tot}} </span> Regiões  </h6>
                    </div>
             </div>
                {{-- <hr class="featurette-divider"> --}}
        </div>

        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm   table-hover ">
                        <thead  class="table-primary">
                            <tr>

                                <th class="text-center" scope="col">Codigo</th>
                                <th  scope="col">Região</th>
                                <th  scope="col">Provincia</th>
                                <th  scope="col">Circulos</th>
                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tfoot  class="table-primary">
                            <tr>
                                <th class="text-center" scope="col">Codigo</th>
                                <th  scope="col">Região</th>
                                <th  scope="col">Provincia</th>
                                <th  scope="col">Circulos</th>
                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($regioes as $regiao )
                                <tr>
                                    <td class="text-center"> {{$regiao->cod_regiao}} </td>
                                    <td> {{$regiao->regiao}} </td>
                                    <td> {{$regiao->provincia->provincia}} </td>
                                    <td> {{$regiao->circulos->count()}} </td>
                                    <td class="d-flex justify-content-center ">
                                        <form action=" {{route('regioes.destroy', ['id'=>$regiao->id])}}  " method="post"
                                            onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-sm  text-primary ml-1 "><i class="fas fa-trash"></i> </button> <!--<i class="fa fa-trash"></i>-->
                                        </form>
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
