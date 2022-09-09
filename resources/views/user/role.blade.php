@extends('layouts.app')
@section('content')
<div class="container bg-white">
            <div class="row  ">
                <div class="col-sm-12 m-2">
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


                </div>
                <div class="col-sm-12 md-12 col-lg-12 m-2">
                    <div class="float-right">
                        <a class="btn btn-md btn-outline-primary mr-1" href=" {{route('user.index')}}"><i class="fas fa-arrow-circle-left"></i> Voltar </a>
                    </div>
                </div>

            </div>


            <div class="row">
                <h6 class="h6 font-weight-bold text-primary"> Detalhes de utilizador  </h6>
                <div >
                    Nome : <span class="text-dark font-weight-bold"> {{ $user->name}} </span>
                    E-mail : <span class="text-dark font-weight-bold "> {{ $user->email}} </span>
                </div>
            </div>

                <hr class="featurette-divider bg-light">
                <div class="table-responsive bg-white">
                    <table class="table table table-sm table-hover">
                            <thead class="table-primary ">
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
                                    @if ($user_role->name=="dev"){{ 'Desenvolvedor' }}
                                    @elseif ($user_role->name=="admin"){{ 'Administrador' }}
                                    @elseif ($user_role->name=="coordenador-nacional"){{ 'Coordenador Nacional' }}
                                    @elseif ($user_role->name=="supervisor"){{ 'Supervisor' }}
                                    @elseif ($user_role->name=="coordenador-regional") {{ 'Coordenador Regional' }}
                                    @elseif ($user_role->name=="coordenador-provincia") {{ 'Coordenador de Provincia' }}
                                    @else {{$user_role->name}}
                                @endif
                                    {{-- {{ $permission_role->name}} --}}
                                </td>
                                <td class="text-center">
                                <form action=" {{ route('user.role.remove', ['user'=>$user->id, 'role'=>$user_role->id])}}
                                    "method="post" onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <div class="text-center">
                                        <button data-toggle="apagar" data-placement="top" title="Apagar" type="submit" class="btn btn-sm text-primary">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </form>
                                </td>
                            </tr>
                         @endforeach

                       @endif
                            </tbody>
                    </table>
                </div>

                <div class="row ">
                    <div class="col-md-12">
                        <form action="{{route('user.roles', ['user'=>$user->id])}}" method="POST">
                            @csrf
                            @method('POST')
                                    <!-- permissions -->
                                    <div class="form-group">
                                        <label for="role">Designar um perfil :</label>
                                        <select name="role" class="form-control mr-sm-0" type="text" id="" placeholder="Permissions.." aria-label="Pequisar" >
                                            <option value="">...selecione perfil... </option>
                                            @foreach ( $roles as $role )
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
                                            {{-- <input class="form-control mr-sm-0" type="text" name="p"  value="{{$p}}" placeholder="Recherche.." aria-label="Pequisar"> --}}
                                            @endforeach
                                            {{-- <input class="form-control mr-sm-0" type="text" name="p"  value="{{$p}}" placeholder="Recherche.." aria-label="Pequisar"> --}}
                                        </select>
                                    </div>
                            <div class="form-group float-right mt-0 mb-0">
                                <button type="submit" class="btn  btn-outline-primary" > <i class="fas fa-check"></i> Autorizar </button>
                            </div>
                        </form>
                    </div>
                </div>

                 {{-- <hr class="featurette-divider bg-light"> --}}

            {{-- </div> --}}



            <div class="row mt-3 p-0">
                <div class="col-md-12">
                    {{-- <h4 class="h4">Permissions </h4> --}}
                    <div>
                        <div class="table-responsive bg-white">
                            <table class="table table table-sm table-hover">
                                    <thead class="table-primary ">
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
                                                        <form action=" {{ route('user.permission.remove', ['user'=>$user->id, 'permission'=>$user_permission->id])}}
                                                            "method="post" onsubmit=" return confirm('Suppression ! Êtes-vous sûr?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="text-center">
                                                                <button data-toggle="apagar" data-placement="top" title="Apagar"  type="submit" class="btn btn-sm text-primary">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>

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
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('user.permissions', ['user'=>$user->id])}}" method="POST">
                        @csrf
                        @method('POST')
                                <!-- permissions -->
                                <div class="form-group">
                                    <label for="permission">Dar Permissão:</label>
                                    <select name="permission" class="form-control mr-sm-0 text-capitalize" type="text" id="" placeholder="Permissions.." aria-label="Pequisar" >
                                        <option value="">...selecione permissão... </option>
                                        @foreach ( $permissions as $permission )
                                          <option value="{{$permission->name}}">{{$permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        <div class="form-group float-right mt-2 mb-2">
                            <button type="submit" class="btn  btn-outline-primary" > <i class="fas fa-check"></i> Permitir </button>
                        </div>
                    </form>
                 </div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="apagar"]').tooltip();
    });
</script>

@endsection
