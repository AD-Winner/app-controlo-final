@extends('layouts.app')
@section('content')
<div class="container">

    <!--FIN DE MODAL D'AJOUT DE REGION-->
    <div class="row bg-white pt-3 mt-1">
        <div class="col-sm-12">
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
             <!-- ALERT DE ERROR -->
             @if(\Session::has('error'))
                <div class="alert alert-danger">
                    <p>{{ \Session::get('error')}}</p>
                </div>
            @endif
            <h5 class="modal-title ml-3 text-primary font-weight-bold" id="exampleModalLongTitle"> {{$recenseamento->tipo}} : {{$recenseamento->data->format('Y')}}</h5>
            <h6 class="modal-title ml-3 text-secondary font-weight-bold" id=""> <span class="text-primary"> Região :</span> {{ __(Auth::user()->regiao->regiao) }} </h6>
             <hr class="featurette-divider">
                <div class="row">
                    <div class="col-sm-12">
                        {{-- <div class="float-right"> --}}
                            <!-- Botton de voltar para recenseados-->
                            {{-- <a class="btn btn-sm btn-primary mr-4 float-right"  href="{{ route('coordenador.regional.recenseados') }}">
                                <i class="fas fa-street-view"></i>
                                 {{ __('Recenseados') }}
                            </a>                             --}}
                        {{-- </div> --}}
                    </div>

                    <div class="col-sm-12 ">
                          <h6 class="h6 font-weight-bold">{{ __('Total :')}} <span class="text-primary"> {{$totKits}} </span> Kits
                            ,<span class="text-danger"> {{$f + $m}} </span> Eleitores Recenseados,
                            <span class="text-primary">  {{__($m)}} </span>
                                         {{('Homens e ')}} <span class="text-primary">
                                         {{__($f)}} </span> {{('Mulheres')}}

                        </h6>
                    </div>
                 </div>
                {{-- <hr class="featurette-divider"> --}}
        </div>
        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm   table-hover ">
                        <thead class="table-primary" >
                            <tr>
                                <th  scope="col">Sector</th>
                                <th class="text-center" scope="col">Numero</th>
                                <th  scope="col">Descrição</th>
                                <th  scope="col">Recenseados</th>

                            </tr>
                        </thead>
                        <tfoot class="table-primary">
                            <tr>
                                <th  scope="col">Sector</th>
                                <th class="text-center" scope="col">Numero</th>
                                <th  scope="col">Descrição</th>
                                <th  scope="col">Recenseados</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($kits as $kit )
                                <tr>
                                    <td> {{$kit->sector->sector}} </td>
                                    <td class="text-center"> {{$kit->numero}} </td>
                                    <td> {{$kit->descricao}} </td>
                                    <td> {{ ($kit->recenseados->sum('homem')) +  ($kit->recenseados->sum('mulher'))}} </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#datatable').dataTable();
        // Start Edit Record

        // table.on('click', '.edit', function(){

        //     $tr = $(this).closest('tr');
        //     if($($tr).hasClass('child')){
        //         $tr = $tr.prev('.parent');
        //     }

        //     var data = table.row($tr).data();
        //     console.log(data);

        //     $('#cod_regiao').val(data[1]);
        //     $('#regiao').val(data[2]);

        //     $('#editForm').attr('action', '/regioes/'+data[0]);
        //     $('#editarRegionModal').modal('show');
        // })
        // End Edit Record

    });

    $(document).on('change','.provincia',function(){
        // console.log("Provincia is changed !");
         var provincia_id=$(this).val();
         var div=$(this).parent().parent().parent();
         var op="";
        //  console.log(provincia_id);
         $.ajax({
             type: 'get',
           //  url:'{!!URL::to('findCercleName')!!}',
             url:"{{route('find.regiao')}}",
             data:{'id':provincia_id},
             success:function(data){

             op+='<option value="0" selected disabled>selecione a região</option>';
             for(var i=0; i<data.length; i++){
                 op+='<option value="'+data[i].id+'">'+data[i].cod_regiao+'-'+data[i].regiao+'</option>';

             }
             div.find('.regiao').html("")
             div.find('.regiao').append(op)
         },
         error:function(){

         }
        });
    });//FIN DE LA FUNCTION ----------------------------------------->

    $(document).on('change','.regiao',function(){
        var circulo_id=$(this).val();
        var a=$(this).parent().parent().parent();
        var op="";
        $.ajax({
             type: 'get',
             //url:'{!!URL::to('findSecteurName')!!}',
             url:"{{route('find.circulo')}}",
             data:{'id':circulo_id},
            // dataType:'json',
             success:function(data){
             //   console.log(data);
            //console.log("secteur");
            //console.log(data);
            op+='<option value="0" selected disabled>selecione um circulo</option>';
             for(var i=0; i<data.length; i++){
                 op+='<option value="'+data[i].id+'">'+data[i].circulo+'</option>';

             }
             a.find('.circulo').html("")
             a.find('.circulo').append(op)

         },
         error:function(){

         }
        });
    }); /// FIN DE LA FUNCTION


    $(document).on('change','.circulo',function(){
        var sector_id=$(this).val();
        var a=$(this).parent().parent().parent();
        var op="";
        $.ajax({
             type: 'get',
             //url:'{!!URL::to('findSecteurName')!!}',
             url:"{{route('find.sector')}}",
             data:{'id':sector_id},
            // dataType:'json',
             success:function(data){

            op+='<option value="0" selected disabled>selecione o sector</option>';
             for(var i=0; i<data.length; i++){
                 op+='<option value="'+data[i].id+'">'+data[i].cod_sector+'-'+data[i].sector+'</option>';

             }
             a.find('.sector').html("")
             a.find('.sector').append(op)

         },
         error:function(){

         }
        });
    }); /// FIN DE LA FUNCTION

</script>
@endsection
