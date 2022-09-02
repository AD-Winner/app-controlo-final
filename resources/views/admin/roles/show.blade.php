@extends('layouts.app')
@section('content')
    <div class='container bg-white '>
        <div class="row">
            <div class="col-sm-12 col-md-12">
               <a href=" {{ route('role.index')}} " class="btn btn-md btn-outline-secondary float-right"> <i class="fas fa-arrow-circle-left"></i> Voltar</a>
            </div>
        </div>
             <div class="bg-light pt-3 mt-2  ">
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
                <h4 class="h4 text-uppercase font-weight-bold" > Perfil :
                    <span class="text-info">
                        @if ($role->name=="writer")
                        {{ 'Desenvolvedor' }}
                            @elseif ($role->name=="super")
                                {{ 'Supervisor' }}
                            @elseif ($role->name=="cr")
                                {{ 'Coordenador de Regional' }}
                            @elseif ($role->name=="cp")
                                {{ 'Coordenador de Provincia' }}
                            @else
                            {{$role->name}}
                            @endif
                  </span>
                </h4>

                 <hr class="featurette-divider bg-light">

            </div>
        <div class="row mt-3 p-3">
            <div class="col-md-12">
                <h4 class="h4 text-primary font-weight-bold ">Permissões </h4>
                <div>
                    <div class="table-responsive bg-white">
                        <table class="table table table-sm table-hover">
                                <thead class="table-secondary text-uppercase">
                                    <tr>
                                        <th>Nome</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @if($role->permissions)
                                @foreach ($role->permissions as $role_permission)
                                <tr>
                                    <td>
                                        {{ $role_permission->name}}
                                    </td>
                                    <td class="text-center">
                                    <form action=" {{ route('role.permission.revoke', ['role'=>$role->id, 'permission'=>$role_permission->id])}}
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
        <div class="row bg- p-3">
            <div class="col-md-12">
                <form action=" {{ route('role.permissions', $role->id) }} " method="POST">
                    @csrf
                    
                            <!-- permissions -->
                            <div class="form-group">
                                <label for="permission">Dar uma Permissão:</label>
                                <select name="permission" class="form-control mr-sm-0" type="text" id="" placeholder="Permissions.." aria-label="Pesquisar" >
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
</div>
@endsection
