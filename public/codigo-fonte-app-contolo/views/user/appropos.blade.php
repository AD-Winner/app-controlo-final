@extends('layouts.user')
@section('content')
<div class='container '>
<!--Ligne de buttons de page acceuil-->
 <div class="row justifu-contetent-center">
            <div class="col-sm-12 col-md-6">
               <a href="{{ route('home-user') }}" class="btn btn-md ml-3 btn-outline-secondary float-left">  <i class="fas fa-arrow-circle-left"></i> Voltar</a>
            </div>
            <div class="col-sm-12 col-md-6">
            </div>
</div>



    <div  class="row-justify-content-center  mt-2">
        <div class="col-md-12">
            <div class="card bg-dark ">
                <div class="card-header text-white  bg-dark ">{{ __('AJUDA...') }}
                </div>
                <div class="card-body bg-white  py-0">

                <h6 class="h6 text-success my-3 font-weight-bold text-uppercase">Introdução</h6>
                <div class="">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, animi dolores nisi ipsum voluptas harum illo possimus veritatis odit? Qui ipsam non optio soluta fuga odio nihil dolore unde minus.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis placeat praesentium mollitia alias libero esse minus et itaque eius velit, temporibus, nemo possimus saepe ullam laborum exercitationem est tempore hic?
                </div>
                <h5 class="h6 text-success my-3 font-weight-bold text-uppercase">Digitalização de Actas de apuramento</h5>
                <div class="">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, animi dolores nisi ipsum voluptas harum illo possimus veritatis odit? Qui ipsam non optio soluta fuga odio nihil dolore unde minus.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis placeat praesentium mollitia alias libero esse minus et itaque eius velit, temporibus, nemo possimus saepe ullam laborum exercitationem est tempore hic?
                </div>
                <h5 class="h6 text-success my-3 font-weight-bold text-uppercase">Estatisticas Sectorial</h5>
                <div class="">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, animi dolores nisi ipsum voluptas harum illo possimus veritatis odit? Qui ipsam non optio soluta fuga odio nihil dolore unde minus.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis placeat praesentium mollitia alias libero esse minus et itaque eius velit, temporibus, nemo possimus saepe ullam laborum exercitationem est tempore hic?
                </div>
                <h5 class="h6 text-success my-3 font-weight-bold text-uppercase">Gestão de Relatorios</h5>
                <div class="">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, animi dolores nisi ipsum voluptas harum illo possimus veritatis odit? Qui ipsam non optio soluta fuga odio nihil dolore unde minus.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis placeat praesentium mollitia alias libero esse minus et itaque eius velit, temporibus, nemo possimus saepe ullam laborum exercitationem est tempore hic?
                </div>
                <h5 class="h6 text-success my-2 font-weight-bold text-uppercase">Ajuda</h5>
                <div class="">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, animi dolores nisi ipsum voluptas harum illo possimus veritatis odit? Qui ipsam non optio soluta fuga odio nihil dolore unde minus.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis placeat praesentium mollitia alias libero esse minus et itaque eius velit, temporibus, nemo possimus saepe ullam laborum exercitationem est tempore hic?
                </div>

                <hr class="featurette-divider bg-light p-0 m-0">
                    <div class="row mt-2 ml-5 text-white">
                        Gestion D'Election :: Developped by : Aliu Djalo {{date('d-m-Y') }}
                    </div>

                </div>

            </div>

        </div>
    </div>
    </div>
</div> <!--FIN DE CONTAINER-->
@endsection
