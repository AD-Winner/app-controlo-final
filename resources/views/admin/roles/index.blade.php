@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row float-right">
        <div class="float-right">
            <button type="button" class="btn btn-sm btn-outline-primary"
                    data-toggle="modal" data-target="#AjouterRoleModal">
                    <i class="fas fa-plus"></i> Perfil
              </button>
        </div>
    </div>
    <h6 class="h6 font-weight-bold text-primary mt-0">Perfis de utilizadores</h6>
    <h6 class="h6 font-weight-bold text-dark mt-0"> Total <strong> {{ $tot }} </strong> Perfis  </h6>
    <div class="modal fade" id="AjouterRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!--Titre de modal-->
                    <h6 class="h6 modal-title  font-weight-bold text-dark"  id="exampleModalLongTitle">
                    Adicionar perfil de utilizador</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Corp de Modal-->
                <form  method="POST" action="{{ route('role.store')}}" >
                @method('POST')
                @csrf
                    <div class="modal-body">
                        <!--LIBELLE DE LOCAL BUREAU ELECTORAL -->

                         <div class="form-group  font-weight-bold text-dark ">
                            <label for="name">Perfil :</label>
                             <input type="text" class="form-control" id="role" max="20"  require
                             min="1" name="name"  placeholder="Digite perfil de utilizador..." />
                        </div>

                        @error('name')
                            <span class="text-danger">
                            {{ $message }}
                            </span>
                        @enderror


                    </div>
                    <div class="modal-footer  font-weight-bold">
                         <button type="button"
                         class="btn btn-sm btn-outline-info" data-dismiss="modal">Voltar</button>
                         <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row bg-white text- ">
        <div class="col-sm-12">
            <!-- MESSAGE DE ERREUR -->
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

        <!-- ALERT DANGER -->
        @if(\Session::has('error'))
        <div class="alert alert-danger">
            <p>{{ \Session::get('error')}}</p>
        </div>
        @endif
        <div class="row float-right">
            <div class="d-flex  m-1">
                <div class="btn-group-horizontal btn-group-xs">
                    <a href=" {{route('permission.index')}}"  class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i> Permissões</a>
                    <a href=" {{route('user.index')}}" class="btn btn-sm  btn-primary"> <i class="fas fa-users"></i>  Utilizadores</a>
                </div>
           </div>
           <!--Button Ajouter et de PDF -->
        </div>
    </div>
        <div class="row">
        <hr class="featurette-divider m-1">
        <div class="table-responsive">
            <table id="datatable"  class="table  table-sm  table-hover ">
                    <thead class="table-primary ">
                        <tr>
                            <th>Perfil</th>
                            <th class="text-center font-weight-bold">Ações</th>
                        </tr>
                    </thead>
                    <tfoot class="table-primary ">
                        <tr>
                            <th>Perfil</th>
                            <th class="text-center font-weight-bold">Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @foreach($roles as $role)
                        <tr >
                            <td class="text-left">
                                @if ($role->name=="dev"){{ 'Desenvolvedor' }}
                                @elseif ($role->name=="admin"){{ 'Administrador' }}
                                @elseif ($role->name=="coordenador-nacional"){{ 'Coordenador Nacional' }}
                                @elseif ($role->name=="supervisor"){{ 'Supervisor' }}
                                @elseif ($role->name=="coordenador-regional") {{ 'Coordenador Regional' }}
                                @elseif ($role->name=="coordenador-provincia") {{ 'Coordenador de Provincia' }}
                                @else {{$role->name}}
                                @endif

                            </td>

                            {{-- <td> {{    $role->guard_name  }}   </td> --}}

                            <td class='d-flex justify-content-center'>
                                <a href=" {{route('role.show', $role->id)}} "   class="btn btn-sm text-dark mr-2"> <i class="fas text-primary fa-cog"></i> <!--Modifier --></a>
                                <a href=" {{route('role.edit',$role->id)}} "   class="btn btn-sm text-info mr-2 "> <i class="fas text-primary fa-edit"></i> <!--Modifier --></a>
                                    <form action=" {{ route('role.destroy', $role->id)}}
                                    "method="post" onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-primary"><i class="fas  fa-trash"></i><!-- Supprimer--></button> <!--<i class="fa fa-trash"></i>-->
                                    </form>
                                </td>

                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>
<script type=" text/javascript">
    $(document).ready(function(){
        var table = $('#datatable').dataTable();
    });
</script>
@endsection

