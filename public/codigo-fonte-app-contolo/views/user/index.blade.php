@extends('layouts.app')
@section('content')
<div class="container">
    {{--  MODAL PARA ADICIONAR REGIÃO--}}
    <div class="modal fade" id="AdicionarCirculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!--Titre de modal-->
                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Utilizadores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Corp de Modal-->
                <form  method="POST" action=" {{route('user.store')}} " >
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                         <div class="form-group">
                            <label for="email" class="">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>

                         <div class="form-group">
                            <label for="password" class="">{{ __('Codigo:') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>

                         <div class="form-group">
                            <label for="password-confirm">{{ __('Confirmação de codigo :') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                            <i class="fas fa-plus"></i><i class="fas fa-user"></i> Utilizador
                        </button>
                        {{-- <a class="btn btn-sm btn-outline-secondary" href=""><i class="fas fa-print"></i> PDF </a> --}}
                    </div>
                </div>
                <div class="col-sm-12 ">
                        <h6 class="h6 font-weight-bold">Total <span class="text-primary"> {{$tot}} </span> Sectores  </h6>
                </div>
            </div>
                {{-- <hr class="featurette-divider"> --}}
        </div>

        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm table-striped  table-hover ">
                        <thead >
                            <tr>

                                <th  scope="col">Nome</th>
                                <th  scope="col">Email</th>
                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tfoot >
                            <tr>
                                <th  scope="col">Nome</th>
                                <th  scope="col">Email</th>


                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user )
                                <tr>
                                    {{-- <td class="text-center"> {{$circulo->cod_regiao}} </td> --}}
                                    <td> {{$user->name}} </td>
                                    <td> {{$user->email}} </td>

                                    <td class="d-flex justify-content-center ">
                                        <a href=" {{route('user.check',['id'=>$user->id])}} " @if($user->is_active==true) class="btn btn-sm  text-white mr-2"@elseif ($user->is_active==false) class="btn btn-sm mr-2 text-success" @endif> <i class="fas fa-check "></i> <!--Check --></a>
                                        <a href=" {{route('user.edit',['id'=>$user->id])}} "   class="btn btn-sm text-info mr-2"> <i class="fas text-primary fa-edit"></i> <!--Modifier --></a>
                                        <form action=" {{route('user.destroy', ['id'=>$user->id])}}  " method="post"
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

    $(document).on('change','.regiao',function(){
        var circulo_id=$(this).val();
        var a=$(this).parent().parent().parent();
        var op="";
        $.ajax({
             type: 'get',
             //url:'{!!URL::to('findSecteurName')!!}',
             url:"{{route('find.circulo')}}",
             data:{'id':circulo_id},
            // dataType:'json',
             success:function(data){
             //   console.log(data);
            //console.log("secteur");
            //console.log(data);
            op+='<option value="0" selected disabled>selecione um circulo</option>';
             for(var i=0; i<data.length; i++){
                 op+='<option value="'+data[i].id+'">'+data[i].circulo+'</option>';

             }
             a.find('.circulo').html("")
             a.find('.circulo').append(op)

         },
         error:function(){

         }
        });
    }); /// FIN DE LA FUNCTION
</script>
@endsection
