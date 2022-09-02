@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="h4 font-weight-bold text-dark ">As Permissões de Utilizadores</h4>
            <div class="modal fade" id="AjouterPermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <!--Titre de modal-->
                            <h5 class="modal-title h5 font-weight-bold text-dark" id="exampleModalLongTitle">Adicionar permissão para utilizadores</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Corp de Modal-->
                        <form  method="POST" action="{{ route('permission-store')}}" >
                        @method('POST')
                        @csrf
                            <div class="modal-body">
                                <!--LIBELLE DE LOCAL BUREAU ELECTORAL -->

                                 <div class="form-group font-weight-bold ">
                                    <label for="role">Permissão :</label>
                                     <input type="text" class="form-control" id="role" max="20"  require
                                     min="1" name="permission"  placeholder="Digite permissão..." />
                                </div>


                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-md btn-outline-danger" data-dismiss="modal">Voltar</button>
                                 <button type="submit" class="btn btn-md btn-outline-success"><i class="fas fa-plus"></i> Adicionar</button>
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

                 <hr class="featurette-divider">
                 <!--Button Ajouter et de PDF -->
                 <div class="float-right">
                        <!-- Botton de la modal d'ajout de Bureaux-->
                        <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#AjouterPermissionModal">
                            <i class="fas fa-plus"></i> Adicionar permissão
                        </button>
                        <!--Button de PDF-->
                        <a class="btn btn-sm btn-outline-secondary " href=" {{route('role-index')}}"><i class="fas fa-user"></i> Perfis </a>
                        <a class="btn btn-sm btn-outline-secondary " href=" {{route('user-index')}}"><i class="fas fa-users"></i> Utilizadores </a>
                 </div>
                 <div class="col-sm-12 col-md-6">
                   <h4 class="h4 font-weight-bold"> Total <strong> {{ $tot }} </strong> Permissões  </h4>
                 </div>
                <hr class="featurette-divider">
            </div>


        <div class="col-12">

         <div class="table-responsive">
            <table class="table table table-sm table-hover font-weight-bold ">
                    <thead class="table-dark text-uppercase">
                        <tr>
                            <th>Permissão</th>
                            {{-- <th>Guard</th> --}}
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr >
                            <td>
                                {{$permission->name}}

                            </td>
                            {{-- <td > {{$permission->guard_name}} </td> --}}
                            <td class='d-flex text-left'>
                            <a href=" {{route('permission-edit',['id'=>$permission->id])}} "   class="btn btn-sm btn-info mr-2"> <i class="fas text-white fa-edit"></i> <!--Modifier --></a>
                            <a href=" {{route('permission-show',['id'=>$permission->id])}} "   class="btn btn-sm btn-dark mr-2"> <i class="fas text-white fa-cog"></i> <!--Modifier --></a>
                                <form action=" {{ route('permission-destroy', ['id'=>$permission->id])}}
                                "method="post" onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i><!-- Supprimer--></button> <!--<i class="fa fa-trash"></i>-->
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
         </div>
    </div>
</div>
@endsection
