@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center font-weight-bold">
        <div class="col-md-12 col-lg-8 mb-2">
            <a href=" {{ route('user-index')}} " class="btn btn-md btn-outline-secondary float-right"> <i class="fas fa-arrow-circle-left"></i> Voltar</a>
         </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h6 class="h6 font-weight-bold text-info text-uppercase">Atualizar informações  de utilizador</h6></div>

                <div class="card-body">
                    <!--<form method="POST" action="{{ route('register') }}">-->
                    <form  action="{{ route('user-update', ['id'=>$user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail : ') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- CHAMPS POUR PERFIL DE L'UTILISATEUR -->
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Perfil: ') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="profil" name="profil" type="text" class="form-control" value="{{$user->profil}}"  name="profil"> --}}
                                {{-- @foreach($regions as $region)
                                <option <?= $user->region_id==$region->id ? 'selected' : '' ?> value="{{$region->id}}"> {{$region->region}} </option>
                                @endforeach --}}
                                <select name="role" id="region_id" class="form-control">
                                    <option value="{{$user->profil}}">  </option>
                                    <option <?= $user->profil=="admin" ? 'selected' : '' ?> value="admin"> Administrador </option>
                                    <option <?= $user->profil=="pcre" ? 'selected' : '' ?> value="pcre"> Presidente de CRE </option>
                                    <option <?= $user->profil=="dcse" ? 'selected' : '' ?> value="dcse"> Delegado de CRE </option>
                                    <option <?= $user->profil=="cds" ? 'selected' : '' ?> value="dcse"> Chefe de departemento EI</option>
                                   </select>
                            </div>
                        </div>
                         <!-- CHAMPS POUR LACAL DE L'UTILISATEUR -->
                        <div class="form-group row">
                            <label for="local" class="col-md-4 col-form-label text-md-right">{{ __('Região: ') }}</label>
                            <div class="col-md-6">
                               <!-- <input id="local" type="text" class="form-control" name="local">-->
                               <select name="region_id" id="region_id" class="form-control region">
                                <option value="">..selectionner la région...</option>
                               @foreach($regions as $region)
                                <option <?= $user->region_id==$region->id ? 'selected' : '' ?> value="{{$region->id}}"> {{$region->region}} </option>
                                @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="local" class="col-md-4 col-form-label text-md-right">{{ __('Circulo: ') }}</label>
                            <div class="col-md-6">
                               <!-- <input id="local" type="text" class="form-control" name="local">-->
                               <select name="cercle_id" id="cercle_id" class="form-control cercle">
                               <option value="">..selectionner le cercle...</option>
                               @foreach($cercles as $cercle)
                                <option <?= $user->cercle_id==$cercle->id ? 'selected' : '' ?> value="{{$cercle->id}}"> {{$cercle->cercle}} </option>
                                @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="local" class="col-md-4 col-form-label text-md-right">{{ __('Sector: ') }}</label>
                            <div class="col-md-6">
                               <!-- <input id="local" type="text" class="form-control" name="local">-->
                               <select name="secteur_id" id="secteur_id" class="form-control secteur">
                               <option value="">..selectionner le secteur...</option>
                               @foreach($secteurs as $secteur)
                                 <option <?= $user->secteur_id==$secteur->id ? 'selected' : '' ?> value="{{$secteur->id}}"> {{$secteur->secteur}} </option>
                                @endforeach
                               </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Codigo: ') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                value="{{$user->password}}"
                                 name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar codigo: ') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-primary float-right">
                                    {{ __('Atualizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script text="javascript">
    $(document).ready(function(){
    //------------ DEBUT DE LA FONCTION APPELEE QUAND ON SELECIONNE UNE REGION -------------------
    //------Quand on selectionne une region, il affiche les cercles de cette région -----------
    $(document).on('change','.region',function(){
        //console.log("Region is changed !");
    // window.locate()
         var region_id=$(this).val();
         var div=$(this).parent().parent().parent();
         var op="";
         // console.log(region_id);
         $.ajax({
             type: 'get',
           //  url:'{!!URL::to('findCercleName')!!}',
             url:"{{route('find-cercle')}}",
             data:{'id':region_id},
             success:function(data){
                 //console.log(div);
             op+='<option value="0" selected disabled> ..selectionner le cercle.. </option>';
             for(var i=0; i<data.length; i++){
                 op+='<option value="'+data[i].id+'">'+data[i].cercle+'</option>';

             }
             div.find('.cercle').html("")
             div.find('.cercle').append(op)
         },
         error:function(){

         }
        });
    });//FIN DE LA FUNCTION ----------------------------------------->
    $(document).on('change','.cercle',function(){
        var cercle_id=$(this).val();
        var a=$(this).parent().parent().parent();
        var op="";
        $.ajax({
             type: 'get',
             //url:'{!!URL::to('findSecteurName')!!}',
             url:"{{route('find-secteur')}}",
             data:{'id':cercle_id},
            // dataType:'json',
             success:function(data){
                console.log("success");
            //console.log("secteur");
            //console.log(data);
            op+='<option value="0" selected disabled>..selectionner le secteur..</option>';
             for(var i=0; i<data.length; i++){
                 op+='<option value="'+data[i].id+'">'+data[i].secteur+'</option>';

             }
             a.find('.secteur').html("")
             a.find('.secteur').append(op)

         },
         error:function(){

         }
        });
    }); /// FIN DE LA FUNCTION
 });
</script>
@endsection
