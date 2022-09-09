@extends('layouts.app')

@section('content')

{{-- INICIO DE MODAL DE REGISTAR PROVINCIA --}}
    <div class="modal fade" id="AjouterProvinciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!--Titre de modal-->
                    <h5 class="modal-title h5 font-weight-bold text-dark" id="exampleModalLongTitle"> Adicionar provincia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Corp de Modal-->
                <form  method="POST" action="{{ route('provincia.store')}}" >

                @csrf
                    <div class="modal-body">
                        <div class="form-group font-weight-bold ">
                            <label for="provincia">Provincia :</label>
                            <input type="text" class="form-control"  max="20"  require  min="1" name="provincia"  placeholder="Digite nome provincia..." />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-info" data-dismiss="modal">Voltar</button>
                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- FIM DE MODAL DE REGISTAR PROVINCIA --}}

{{-- INICIO DE MODAL DE EDITAR PROVINCIA --}}
<div class="modal fade" id="editProvinciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <!--Titre de modal-->
                <h5 class="modal-title h5 font-weight-bold text-dark" id="exampleModalLongTitle"> Actulizar dados </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Corp de Modal-->
            <form  method="POST" action="" id="editForm" >
            @csrf
            @method('PUT')
                <div class="modal-body">

                        <div class="form-group font-weight-bold ">
                        <label for="provincia">Provincia :</label>
                            <input type="text" class="form-control" id="provincia" max="20"  require
                            min="1" name="provincia"  placeholder="Digite nome provincia..." />
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-info" data-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Actulizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- FIM DE MODAL DE REGISTAR PROVINCIA --}}



<div class="container">
    <div class="row justify-content-center">
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
                                {{ \Session::get('success')}}</p>
                        </div>
                    @endif
                        <!-- ALERT DE DANGER -->
                    @if(\Session::has('error'))
                        <div class="alert alert-danger">
                                {{ \Session::get('error')}}</p>
                        </div>
                    @endif

                <div class="col-sm-12 col-md-6">
                        <h4> Total <strong> {{ $tot }} </strong> Provincias  </h4>
                </div>
                    {{-- <hr class="featurette-divider"> --}}
            </div>
            <div class="row m-2">
                <div class="col-12 col-sm-12">
                    <button type="button"  data-toggle="modal" data-target="#AjouterProvinciaModal" id=""  class="mt-0 btn-sm btn-outline-primary float-right">
                    <i class="fas fa-plus"></i>Provincia
                </button>
                </div>
                <div class="col-12 col-sm-12">
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive ">
                    <table id="datatable" class="table  table-default table-sm table-hover">
                            <thead class="">
                                <tr class="table-primary">
                                    <th>Provincia</th>
                                    <th>Regiões</th>
                                    <th>Circulos</th>
                                    <th>Sectores</th>
                                    <th class="d-flex justify-content-center ">Ações</th>
                                </tr>
                            </thead>
                            <tfoot class="">
                                <tr>
                                    <th>Provincia</th>
                                    <th>Regiões</th>
                                    <th>Circulos</th>
                                    <th>Sectores</th>
                                    <th class="d-flex justify-content-center ">Ações</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach ($provincias as $provincia)
                                    <tr>
                                        <td> {{$provincia->provincia}} </td>
                                        <td> {{$provincia->regioes->count()}} </td>
                                        <td> {{$provincia->circulos->count()}} </td>
                                        <td> {{$provincia->sectores->count() }} </td>

                                        <td class="d-flex justify-content-center ">
                                            <button   class="btn btn-sm text-primary mr-1 edit"  onclick='editProvincia( {{$provincia->id}} )' data-toggle="modal" data-target="#editProvinciaModal" > <i class="fas text-primary fa-edit"></i> <!--Modifier --></button>
                                            <form action=" {{route('provincia.destroy', ['id'=>$provincia->id])}}  " method="post"
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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){

var table = $('#datatable').dataTable();
// Start Edit Record
table.on('click', '.edit', function(){
    
    console.log("click");
    //var id = $('.edit').val();
   // console.log(id);



})
// End Edit Record
function editData(id){
     console.log(id);
}

});


</script>

@endsection
