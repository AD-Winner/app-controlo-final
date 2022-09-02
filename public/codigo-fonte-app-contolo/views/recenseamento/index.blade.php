@extends('layouts.app')
@section('content')
<div class="container">

    {{--  MODAL PARA ADICIONAR REGIÃO--}}
    <div class="modal fade" id="AjouterRegionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!--Titre de modal-->
                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Recenseamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Corp de Modal-->
                <form  method="POST" action=" {{route('recenseamento.store')}} " >
                @csrf
                    <div class="modal-body">


                        <div class="form-group">
                            <label for="tipo">Tipo de Recenseamento:</label>
                            <input type="text" class="form-control" max="20" min="3" name="tipo" id="tipo" placeholder="Digite tipo de Recenseamento" />
                        </div>
                        <div class="form-group font-weight-bold text-secondary">
                            <label for="data">Data de Recenseamento:</label>
                             <input type="date" class="form-control" id="data" max="2"  require
                             min="1" name="data"  placeholder="Digite tipo data de recenseamento..." />
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
                                <i class="fas fa-plus"></i> Recenseamento
                            </button>
                            {{-- <a class="btn btn-sm btn-outline-secondary" href=""><i class="fas fa-print"></i> PDF </a> --}}
                    </div>
                </div>
                <div class="col-sm-12 ">
                        <h6 class="h6 font-weight-bold">Total <span class="text-dark"> {{$tot}} </span> Recenseamentos  </h6>
                </div>
             </div>
                {{-- <hr class="featurette-divider"> --}}
        </div>

        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm table-striped table-primary table-hover ">
                        <thead >
                            <tr>
                                <th  scope="col">Tipo</th>
                                <th  scope="col">Data</th>
                                <th  scope="col" class="text-center">Ações</th>

                            </tr>
                        </thead>
                        <tfoot >
                            <tr>
                                <th  scope="col">Tipo</th>
                                <th  scope="col">Data</th>
                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($recenseamentos as $recenseamento )
                                <tr>

                                    <td> {{$recenseamento->tipo}} </td>
                                    <td> {{$recenseamento->data}} </td>

                                    <td class="d-flex justify-content-center ">
                                        <form action=" {{route('recenseamento.destroy', ['id'=>$recenseamento->id])}}  " method="post"
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
