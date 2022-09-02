@extends('layouts.admin')
@section('content')
<div class="container">
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
                                             <a class="btn btn-md btn-outline-secondary " href=" {{route('user-index')}}"><i class="fas fa-arrow-circle-left"></i> Voltar </a>
                 </div>
                 <div class="col-sm-12 col-md-6">
                   <h4> Detalhes de utilizadores  </h4>
                 </div>
                <hr class="featurette-divider">
            </div>

            <div class="col-sm-12">
                <div>


                </div>
               <div class="table-responsive bg-white">
                    <table class="table table table-sm table-hover">
                            <thead class="table-secondary text-uppercase">
                                <tr>
                                    <th>Nome</th>
                                    <th class="text-center">E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>  {{ $user->name}}  </td>
                                    <td  class="text-center">  {{ $user->email}} </td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                <hr class="featurette-divider bg-light">


                <div class="table-responsive bg-white">
                    <table class="table table table-sm table-hover">
                            <thead class="table-secondary text-uppercase">
                                <tr>
                                    <th>Perfil</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if($user->roles)
                            @foreach ($user->roles as $user_role)
                            <tr>
                                <td>
                                    @if ($user_role->name=="admin")
                                    {{ 'Administrateur' }}
                                        @elseif ($user_role->name=="cds")
                                            {{ 'Chefe de Departemento' }}
                                        @elseif ($user_role->name=="pcre")
                                            {{ 'Presidente de CRE' }}
                                        @elseif ($user_role->name=="dcse")
                                            {{ 'Delegado de CRE' }}
                                        @else
                                        {{$user_role->name}}
                                        @endif
                                    {{-- {{ $permission_role->name}} --}}
                                </td>
                                <td class="text-center">
                                <form action=" {{ route('user-role-remove', ['user'=>$user->id, 'role'=>$user_role->id])}}
                                    "method="post" onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            {{-- {{ $role_permission->name}} --}}
                                            <i class="fas fa-trash"></i><!-- Supprimer-->
                                        </button> <!--<i class="fa fa-trash"></i>-->
                                    </div>
                                </form>
                                </td>
                            </tr>
                         @endforeach

                       @endif
                            </tbody>
                    </table>
                </div>

                <div class="row p-3 ">
                    <div class="col-md-12">
                        <form action="{{route('user-roles', ['user'=>$user->id])}}" method="POST">
                            @csrf
                            @method('POST')
                                    <!-- permissions -->
                                    <div class="form-group">
                                        <label for="role">Designar um perfil :</label>
                                        <select name="role" class="form-control mr-sm-0" type="text" id="" placeholder="Permissions.." aria-label="Pequisar" >
                                            <option value="">...selecione perfil... </option>
                                            @foreach ( $roles as $role )
                                            <option value="{{$role->name}}">
                                                    @if ($role->name=="admin")
                                                    {{ 'Administrador' }}
                                                    @elseif ($role->name=="cds")
                                                    {{ 'Chefe de Departemento' }}
                                                    @elseif ($role->name=="pcre")
                                                    {{ 'Presidente de CRE' }}
                                                    @elseif ($role->name=="dcse")
                                                    {{ 'Delagado de CRE' }}
                                                    @else
                                                    {{$role->name}}
                                                    @endif
                                            </option>
                                            {{-- <input class="form-control mr-sm-0" type="text" name="p"  value="{{$p}}" placeholder="Recherche.." aria-label="Pequisar"> --}}
                                            @endforeach
                                            {{-- <input class="form-control mr-sm-0" type="text" name="p"  value="{{$p}}" placeholder="Recherche.." aria-label="Pequisar"> --}}
                                        </select>
                                    </div>
                            <div class="form-group float-right mt-2 mb-2">
                                <button type="submit" class="btn  btn-success" > <i class="fas fa-check"></i> Autorizar </button>
                            </div>
                        </form>
                    </div>
                </div>

                 <hr class="featurette-divider bg-light">

            {{-- </div> --}}



            <div class="row mt-3 p-0">
                <div class="col-md-12">
                    {{-- <h4 class="h4">Permissions </h4> --}}
                    <div>
                        <div class="table-responsive bg-white">
                            <table class="table table table-sm table-hover">
                                    <thead class="table-secondary text-uppercase">
                                        <tr>
                                            <th>Permissões</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($user->permissions)
                                            @foreach ($user->permissions as $user_permission)
                                                <tr>
                                                    <td>
                                                        {{ $user_permission->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        <form action=" {{ route('user-permission-revoke', ['user'=>$user->id, 'permission'=>$user_permission->id])}}
                                                            "method="post" onsubmit=" return confirm('Suppression ! Êtes-vous sûr?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    {{-- {{ $role_permission->name}} --}}
                                                                    <i class="fas fa-trash"></i><!-- Supprimer-->
                                                                </button> <!--<i class="fa fa-trash"></i>-->
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row bg- p-3">
                <div class="col-md-12">
                    <form action="{{route('user-permissions', ['user'=>$user->id])}}" method="POST">
                        @csrf
                        @method('POST')
                                <!-- permissions -->
                                <div class="form-group">
                                    <label for="permission">Dar Permissão:</label>
                                    <select name="permission" class="form-control mr-sm-0" type="text" id="" placeholder="Permissions.." aria-label="Pequisar" >
                                        <option value="">...selecione permissão... </option>
                                        @foreach ( $permissions as $permission )
                                          <option value="{{$permission->name}}">{{$permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        <div class="form-group float-right mt-2 mb-2">
                            <button type="submit" class="btn  btn-success" > <i class="fas fa-check"></i> Permitir </button>
                        </div>
                    </form>
                 </div>
                </div>
            </div>
        </div>
</div>
@endsection
