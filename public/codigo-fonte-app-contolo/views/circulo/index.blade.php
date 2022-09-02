@extends('layouts.app')
@section('content')
<div class="container">

    {{--  MODAL PARA ADICIONAR REGIÃO--}}
    <div class="modal fade" id="AdicionarCirculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!--Titre de modal-->
                    <div class="modal-title" id="exampleModalLongTitle"><h6 class="h6 font-weight-bold text-secondary"> Adicionar Crculo</h6></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Corp de Modal-->
                <form  method="POST" action=" {{route('circulo.store')}} " >
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="provincia_id">Provincia:</label>
                            <select name="provincia_id" class="form-control provincia" id="" >
                                <option >selecione provincia </option>
                                @foreach ($provincias as $provincia )
                                     <option value="{{ $provincia->id }}"> {{$provincia->provincia}} </option>
                                @endforeach
                            </select>
                             {{-- <input type="text" class="form-control" max="20" min="3" name="regiao" id="circulo" placeholder="Nome da região" /> --}}
                        </div>
                         <div class="form-group">
                            <label for="regiao_id">Região:</label>
                            <select name="regiao_id" class="form-control regiao" id="" >
                                <option  >selecione a região</option>
                            </select>
                             {{-- <input type="text" class="form-control" max="20" min="3" name="regiao" id="circulo" placeholder="Nome da região" /> --}}
                        </div>
                        <div class="form-group">
                            <label for="cod_circulo">Codigo:</label>
                            <input type="number" min="1" max="30" class="form-control"  placeholder="Codigo da Circulo Eleitoral" name="cod_circulo" id="cod_circulo" >
                        </div>
                         <div class="form-group">
                            <label for="circulo">Circulo Eleitoral:</label>
                             <input type="text" class="form-control" max="20" min="3" name="circulo" id="circulo" placeholder="Nome da região" />
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Adicionar</button>
                         <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Voltar</button>
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
                        <button type="button" class="btn btn-sm btn-primary mr-4 float-right" data-toggle="modal" data-target="#AdicionarCirculoModal">
                            <i class="fas fa-plus"></i> Circulo
                        </button>
                        {{-- <a class="btn btn-sm btn-outline-secondary" href=""><i class="fas fa-print"></i> PDF </a> --}}
                    </div>
                </div>
                    <div class="col-sm-12 ">
                          <h6 class="h6 font-weight-bold">Total <span class="text-primary"> {{$tot}} </span> Circulos  </h6>
                    </div>
             </div>
                {{-- <hr class="featurette-divider"> --}}
        </div>

        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm table-striped table-primary table-hover ">
                        <thead >
                            <tr class="text-center">
                               <!-- <th>#</th> -->
                                <th  scope="col">Codigo</th>
                                <th  scope="col">Circulo</th>
                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tfoot class="text-center" >
                            <tr>
                               <!-- <th>#</th> -->
                                <th class="text-center" scope="col">Codigo</th>
                                <th  scope="col">Circulo</th>
                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($circulos as $circulo )
                                <tr class="text-center">
                                    {{-- <td class="text-center"> {{$circulo->cod_regiao}} </td> --}}
                                    <td> {{$circulo->cod_circulo}} </td>
                                    <td> {{$circulo->circulo}} </td>
                                    <td class="d-flex justify-content-center ">
                                        {{-- <a href="#" class='btn btn-sm btn-light bg-dark text-primary  edit'><i class='fas fa-edit'></i></a> --}}
                                        {{-- <a href=" {{route('regioes.show', ['regiao'=>$regiao->id])}} "  class='btn btn-sm btn-light bg-dark text-warning m-1'><i class='fas fa-eye'></i></a> --}}

                                        <form action=" {{route('circulo.destroy', ['id'=>$circulo->id])}}  " method="post"
                                            onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-sm text-primary ml-1 "><i class="fas fa-trash"></i> </button> <!--<i class="fa fa-trash"></i>-->
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

        // table.on('click', '.edit', function(){

        //     $tr = $(this).closest('tr');
        //     if($($tr).hasClass('child')){
        //         $tr = $tr.prev('.parent');
        //     }

        //     var data = table.row($tr).data();
        //     console.log(data);

        //     $('#cod_regiao').val(data[1]);
        //     $('#regiao').val(data[2]);

        //     $('#editForm').attr('action', '/regioes/'+data[0]);
        //     $('#editarRegionModal').modal('show');
        // })
        // End Edit Record

    });


    $(document).on('change','.provincia',function(){
        // console.log("Provincia is changed !");
         var provincia_id=$(this).val();
         var div=$(this).parent().parent().parent();
         var op="";
        //  console.log(provincia_id);
         $.ajax({
             type: 'get',
           //  url:'{!!URL::to('findCercleName')!!}',
             url:"{{route('find.regiao')}}",
             data:{'id':provincia_id},
             success:function(data){

             op+='<option value="0" selected disabled>selecione a região</option>';
             for(var i=0; i<data.length; i++){
                 op+='<option value="'+data[i].id+'">'+data[i].cod_regiao+'-'+data[i].regiao+'</option>';

             }
             div.find('.regiao').html("")
             div.find('.regiao').append(op)
         },
         error:function(){

         }
        });
    });//FIN DE LA FUNCTION ----------------------------------------->


</script>
@endsection
