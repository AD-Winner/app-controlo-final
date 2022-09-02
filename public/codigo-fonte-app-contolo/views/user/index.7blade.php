@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justifu-contetent-center ml-10">
        <div class="col-sm-0 col-md-6">
            <h2 class="h2 font-weight-bold text-dark mt-0">Utilizadores</h2>
        </div>
        <div class="col-sm-12 col-md-6">
            <form class="form-inline mt-2 mt-md-0">
                <div class="input-group mb-0 mt-0">
                        <input class="form-control mr-sm-0" type="text" name="p"  value="{{$p}}" placeholder="Pesquisar..." aria-label="Pesquisar">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                        <a href="{{ route('user-index') }}" class="btn btn-outline-danger">Anular</a>
                    </div>
                </div>
            </form>
        </div>
    </div>





    <div class="row bg-white pt-3 mt-1">
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
             <div class="float-right  font-weight-bold text-dark">

                    <a class="btn btn-sm btn-outline-secondary " href=" {{route('user-create')}}"><i class="fas fa-plus"></i> Adicionar </a>
                    <!--Button de PDF-->
                    <a class="btn btn-sm btn-outline-secondary " href=" {{route('role-index')}}"><i class="fas fa-users"></i> Perfis </a>
                    <a class="btn btn-sm btn-outline-secondary " href=" {{route('permission-index')}}"><i class="fas fa-pen"></i> Permissões </a>
                    <a class="btn btn-sm btn-outline-secondary " href=" {{route('user-print')}}"><i class="fas fa-print"></i> PDF </a>
             </div>
             <div class="col-sm-12 col-md-6">
               <h4 class="h4 font-weight-bold text-secondary"> Total <strong> {{ $tot }} </strong> Utilizadores    </h4>
                {{-- Connecté: {{ Auth::user()->name}} Profil: {{ Auth::user()->profil}} --}}
             </div>
            <hr class="featurette-divider">
        </div>
        <div class="col-12">
        <!--Table des données -->
            <div class="table-responsive">
                <table class="table table table-sm table-hover font-weight-bold ">
                        <thead class="table-dark text-uppercase">
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Perfil</th>
                                 <th>Estado</th>
                                <th class="">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                {{-- <td> {{$user->id}} </td> --}}
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td>
                                        @if ($user->profil=="admin")
                                           {{ 'Administrador' }}
                                        @endif
                                        @if ($user->profil=="cds")
                                           {{ 'Chefe de Departemento EI' }}
                                        @endif
                                        @if ($user->profil=="pcre")
                                           {{ 'Presidente de CRE' }}
                                        @endif
                                        @if ($user->profil=="dcse")
                                           {{ 'Delegado de CRE' }}
                                        @endif
                                </td>
                                 <td> {{$user->is_active ? 'Activo' : 'Inactivo'}} </td>
                                <td class='d-flex'>
                                <a href=" {{route('user-check',['id'=>$user->id])}} " @if($user->is_active==true) class="btn btn-sm btn-success text-white mr-2"@elseif ($user->is_active==false) class="btn btn-sm btn-outline-success mr-2 text-white" @endif> <i class="fas fa-check "></i> <!--Check --></a>
                                <a href=" {{route('user-edit',['id'=>$user->id])}} "   class="btn btn-sm btn-info mr-2"> <i class="fas text-white fa-edit"></i> <!--Modifier --></a>
                                <form action=" {{ route('user-destroy', ['id'=>$user->id])}}
                                    "method="post" onsubmit=" return confirm('Atenção! Apagando dados... Tem certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i><!-- Supprimer--></button>
                                </form>
                                <a href=" {{route('user-show',['id'=>$user->id])}} "   class="btn ml-2 btn-sm btn-dark mr-2"> <i class="fas text-white fa-cog"></i> <!--Modifier --></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
                <div class="float-right">
                        {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>



</div>

@endsection
