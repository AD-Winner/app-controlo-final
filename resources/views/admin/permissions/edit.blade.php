@extends('layouts.app')
@section('content')
    <div class='container bg-white my-3 p-3'>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h6 class="h6 font-weight-bold text-dark">Atualização das informações de permissão</h6>
            </div>
            <div class="col-sm-12 col-md-6">
               <a href=" {{ route('permission.index')}} " class="btn btn-md btn-outline-primary float-right"> <i class="fas fa-arrow-circle-left"></i> Voltar</a>
            </div>
        </div>
        <div class="bg-primary text-white pt-3 mt-2 p-5 ">

        <div class="col-sm-12">
        <hr class="featurette-divider bg-light">
        <h6 class="h6 font-weight-bold ">Informa as informações abaixo para atualizar...</h6>
            <hr class="featurette-divider bg-light">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-ms-12 p-2">
            <form action="{{route('permission.update', $permission )}}" method="POST">
                @csrf
                @method('PUT')
                        <!--LIBELLE DE LOCAL BUREAU ELECTORAL -->

                         <div class="form-group">
                            <label for="tour">Permissão:</label>
                             <input type="text" class="form-control" id="permssion" min="3" max="20"  require
                              name="name"  value="{{ $permission->name}}" placeholder="Digite alterações..." />
                        </div>


                <div class="form-group float-right mt-2">
                    <button type="submit" class="btn  btn-outline-light" > <i class="fas fa-check"></i> Atualizar </button>
                </div>
            </form>
        </div>

    </div>
    </div>

@endsection
