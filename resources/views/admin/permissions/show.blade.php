@extends('layouts.app')
@section('content')
    <div class='container bg-white '>
        <div class="row">
            <div class="col-sm-12 col-md-12">
               <a href=" {{ route('permission.index')}} " class="btn btn-md btn-outline-secondary float-right"> <i class="fas fa-arrow-circle-left"></i> Voltar</a>
            </div>
        </div>
                <div class="bg-light pt-3 m-2  ">
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
            <div class="col-sm-12">
                <hr class="featurette-divider bg-light">
                <h4 class="h4 font-weight-bold  text-uppercase" > Permissão :
                    <span class="text-info">
                       {{ $permission->name }}
                  </span></h4>

                 <hr class="featurette-divider bg-light">

            </div>
        <div class="row mt-3 p-3">
            <div class="col-md-12">
                {{-- <h4 class="h4">Roles : </h4> --}}
                <div>
                    <div class="table-responsive bg-white">
                        <table class="table table table-sm table-hover">
                                <thead class="table-secondary text-uppercase">
                                    <tr>
                                        <th>Perfil</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @if($permission->roles)
                                @foreach ($permission->roles as $permission_role)
                                <tr>
                                    <td>
                                        @if ($permission_role->name=="writer"){{ 'Desenvolvedor' }}
                                            @elseif ($permission_role->name=="admin") {{ 'Administrador' }}        
                                            @elseif ($permission_role->name=="cn") {{ 'Coordenador Nacional' }}
                                            @elseif ($permission_role->name=="super"){{ 'Supervisor' }}
                                            @elseif ($permission_role->name=="cr"){{ 'Coordenador de Regional' }}
                                            @elseif ($permission_role->name=="cp") {{ 'Coordenador de Provincia' }}
                                            @else {{$permission_role->name}}
                                        @endif
                                        {{-- {{ $permission_role->name}} --}}
                                    </td>
                                    <td class="text-center">
                                    <form action=" {{ route('permission.role.remove', ['permission'=>$permission->id, 'role'=>$permission_role->id])}}
                                        "method="post" onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                        @csrf
                                        @method('DELETE')
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-danger">
            
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
             <div class="row p-3 ">
                <div class="col-md-12">
                    <form action="{{route('permission.roles', ['permission'=>$permission->id])}}" method="POST">
                        @csrf
                        @method('POST')
                                <!-- permissions -->
                                <div class="form-group">
                                <label for="role">Designar um perfil :</label>
                                    <select name="role" class="form-control mr-sm-0" type="text" id="" placeholder="Permissions.." aria-label="Pequisar" >
                                        <option value="">...selecione perfil... </option>
                                        @foreach ( $roles as $role )
                                        <option value="{{$role->name}}">
                                            @if ($role->name=="writer") {{ 'Desenvolvedor' }}
                                                @elseif ($role->name=="admin"){{ 'Administrador' }}      
                                                @elseif ($role->name=="cn"){{ 'Coordenador Nacional' }}  
                                                @elseif ($role->name=="cp"){{ 'Coordenador de Provincia' }}
                                                @elseif ($role->name=="cr"){{ 'Coordenador de Regional' }}
                                                @elseif ($role->name=="super"){{ 'Supervisor' }}
                                                @else   {{$role->name}}
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
        </div>
      </div>
    </div>
</div>
@endsection
