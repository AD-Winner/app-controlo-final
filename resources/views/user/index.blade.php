@extends('layouts.app')
@section('content')
<div class="container">
    {{--  MODAL PARA ADICIONAR REGIÃO--}}
    <div class="modal fade" id="AdicionarCirculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!--Titre de modal-->
                    <h6 class="h6 modal-title font-weight-bold text-primary" id="exampleModalLongTitle">Adicionar Utilizador</h6>
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
                         <!-- CHAMPS POUR PERFIL DE L'UTILISATEUR -->
                         <div class="form-group font-weight-bold ">
                            <label for="perfil" class="">{{ __('Perfil: ') }}</label>
                                {{-- <input id="profil" type="text" class="form-control" name="profil"> --}}
                                <select name="perfil" id="perfil" class="form-control perfil">
                                    <option value="">..selecione perfil...</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}">
                                            @if ($role->name=="dev"){{ 'Desenvolvedor' }}
                                            @elseif ($role->name=="admin"){{ 'Administrador' }}
                                            @elseif ($role->name=="coordenador-nacional"){{ 'Coordenador Nacional' }}
                                            @elseif ($role->name=="supervisor"){{ 'Supervisor' }}
                                            @elseif ($role->name=="coordenador-regional") {{ 'Coordenador Regional' }}
                                            @elseif ($role->name=="coordenador-provincia") {{ 'Coordenador de Provincia' }}
                                            @else {{$role->name}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                          </div>

                           <!-- CHAMPS REGIAO -->
                           <div class="form-group " id="grupo-provincia">
                            <label for="provincia_id">Provincia:</label>
                            <select name="provincia_id" class="form-control provincia" id="">
                                <option > ..selecione provincia </option>
                                @foreach ($provincias as $provincia )
                                     <option value="{{ $provincia->id }}"> {{$provincia->provincia}} </option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group" id="grupo-regiao">
                            <label for="regiao_id">Região:</label>
                            <select name="regiao_id" class="form-control regiao" id="" >
                                <option  > selecione uma região</option>

                            </select>
                        </div>
                         <div class="form-group" id="grupo-circulo">
                            <label for="circulo_id">Circulo Eleitoral:</label>
                            <select name="circulo_id" class="form-control circulo" id="" >
                                <option  > selecione uma circulo</option>

                            </select>
                        </div>
                         <div class="form-group" id="grupo-sector">
                            <label for="sector_id">Sector:</label>
                            <select name="sector_id" class="form-control sector" id="" >
                                <option  > selecione um sector</option>

                            </select>
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
                        <button type="button" class="btn btn-sm btn-outline-primary mr-4 float-right" data-toggle="modal" data-target="#AdicionarCirculoModal">
                            <i class="fas fa-plus"></i><i class="fas fa-user"></i> Utilizador
                        </button>
                        {{-- <a class="btn btn-sm btn-outline-secondary" href=""><i class="fas fa-print"></i> PDF </a> --}}
                    </div>
                </div>
                <div class="col-sm-12 ">
                        <h6 class="h6 font-weight-bold">Total <span class="text-primary"> {{$tot}} </span> Utilizadores  </h6>
                </div>
                <div class="d-flex  m-1">
                    <div class="btn-group-horizontal btn-group-xs">
                        <a href=" {{route('role.index')}}" class="btn btn-sm  btn-primary"> <i class="fas fa-user"></i>  Perfil</a>
                        <a href=" {{route('permission.index')}}"  class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i> Permissões</a>

                    </div>
               </div>
            </div>

            <div class="row float-right">

               <!--Button Ajouter et de PDF -->
            </div>
                {{-- <hr class="featurette-divider"> --}}
        </div>

        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm   table-hover ">
                        <thead class="table-primary " >
                            <tr>

                                <th  scope="col">Nome</th>
                                <th  scope="col">Email</th>
                                <th  scope="col">Perfil</th>
                                <th  scope="col">Estado</th>
                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tfoot class="table-primary " >
                            <tr>
                                <th  scope="col">Nome</th>
                                <th  scope="col">Email</th>
                                <th  scope="col">Perfil</th>
                                <th  scope="col">Estado</th>

                                <th  scope="col" class="text-center">Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user )
                                <tr>
                                    {{-- <td class="text-center"> {{$circulo->cod_regiao}} </td> --}}
                                    <td> {{$user->name}} </td>
                                    <td> {{$user->email}} </td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                        @if ($role->name=="dev"){{ 'Desenvolvedor' }}
                                        @elseif ($role->name=="admin"){{ 'Administrador' }}
                                        @elseif ($role->name=="coordenador-nacional"){{ 'Coordenador Nacional' }}
                                        @elseif ($role->name=="supervisor"){{ 'Supervisor' }}
                                        @elseif ($role->name=="coordenador-regional") {{ 'Coordenador de Regional' }}
                                        @elseif ($role->name=="coordenador-provincia") {{ 'Coordenador de Provincia' }}
                                        @else {{$role->name}}
                                        @endif
                                        @endforeach

                                    </td>
                                    <td> {{$user->is_active ? 'Activo' : 'Inactivo'}} </td>

                                    <td class="d-flex justify-content-center ">
                                        <a href=" {{route('user.check', $user->id)}}" data-toggle="check" data-placement="top" title="Ativar ou Desactivar"
                                            @if($user->is_active==true)
                                            class="btn btn-sm  text-danger mr-2"
                                            @elseif ($user->is_active==false)
                                            class="btn btn-sm mr-2 text-success"
                                            @endif
                                            ><i class="fas fa-check "></i> <!--Check -->
                                        </a>
                                        <a href=" {{route('user.show',$user->id)}}" data-toggle="configurar" data-placement="top" title="Configurar"  class="btn btn-sm text-info mr-2"> <i class="fas text-primary fa-cog"></i> <!--Modifier --></a>
                                        <a href=" {{route('user.edit',$user->id)}} " data-toggle="editar" data-placement="top" title="Editar"  class="btn btn-sm text-info mr-2"> <i class="fas text-primary fa-edit"></i> <!--Modifier --></a>
                                        <form action=" {{route('user.destroy', $user->id)}}  " method="post"
                                            onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                         @csrf
                                         @method('DELETE')
                                         <button data-toggle="apagar" data-placement="top" title="Apagar" type="submit" class="btn btn-sm text-primary ml-1 "><i class="fas fa-trash"></i> </button> <!--<i class="fa fa-trash"></i>-->
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

        $('[data-toggle="editar"]').tooltip();
        $('[data-toggle="check"]').tooltip();
        $('[data-toggle="apagar"]').tooltip();
        $('[data-toggle="configurar"]').tooltip();

        $('#grupo-provincia').hide()
        $('#grupo-regiao').hide()
        $('#grupo-circulo').hide()
        $('#grupo-sector').hide()
        // Start Edit Record


    });

    $(document).on('change','.perfil',function(){
            let role = $(this).val()
            // alert("Perfil changed : "+ role);
            if(role=='admin'){
                $('#grupo-provincia').hide()
                $('#grupo-regiao').hide()
                $('#grupo-circulo').hide()
                $('#grupo-sector').hide()
            }else
            if(role=='coordenador-nacional'){
                $('#grupo-provincia').hide()
                $('#grupo-regiao').hide()
                $('#grupo-circulo').hide()
                $('#grupo-sector').hide()
            }else if(role=='supervisor'){
                $('#grupo-provincia').show()
                $('#grupo-regiao').show()
                $('#grupo-circulo').show()
                $('#grupo-sector').show()

            }else if(role=='coordenador-provincia'){
                $('#grupo-provincia').show()

                $('#grupo-regiao').hide()
                $('#grupo-circulo').hide()
                $('#grupo-sector').hide()
            }else if(role=='coordenador-regional'){
                $('#grupo-provincia').show()
                $('#grupo-regiao').show()

                $('#grupo-circulo').hide()
                $('#grupo-sector').hide()
            }else{
                $('#grupo-provincia').hide()
                $('#grupo-regiao').hide()
                $('#grupo-circulo').hide()
                $('#grupo-sector').hide()
            }

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


    $(document).on('change','.circulo',function(){
        var sector_id=$(this).val();
        var a=$(this).parent().parent().parent();
        var op="";
        $.ajax({
             type: 'get',
             //url:'{!!URL::to('findSecteurName')!!}',
             url:"{{route('find.sector')}}",
             data:{'id':sector_id},
            // dataType:'json',
             success:function(data){

            op+='<option value="0" selected disabled>selecione o sector</option>';
             for(var i=0; i<data.length; i++){
                 op+='<option value="'+data[i].id+'">'+data[i].cod_sector+'-'+data[i].sector+'</option>';

             }
             a.find('.sector').html("")
             a.find('.sector').append(op)

         },
         error:function(){

         }
        });
    }); /// FIN DE LA FUNCTION

</script>
@endsection
