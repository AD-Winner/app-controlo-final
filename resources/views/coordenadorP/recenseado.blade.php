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
            <h6 class="modal-title ml-3 text-secondary font-weight-bold" id=""> <span class="text-primary"> Provincia :</span> {{ __(Auth::user()->provincia->provincia) }}  <h6>
             <hr class="featurette-divider">
             <div class="row">
                    <div class="col-sm-12">
                            </div>
                            <div class="col-sm-12 ">
                                    <h6 class="h6 font-weight-bold"> {{ __('Total :') }} <span class="text-primary"> {{__($f + $m) }} </span> Eleitores Recenseados,
                                        <span class="text-primary">  {{__($m)}} </span>
                                         {{('Homens e ')}}
                                         <span class="text-primary">  {{__($f)}} </span>
                                         {{('Mulheres')}}
                                    </h6>
                            </div>
                    </div>
                 {{-- <hr class="featurette-divider"> --}}
                </div>

        <div class="row">
            <div class="table-responsive">
                    <table id="datatable" class="table  table-sm table-hover ">
                        <thead class="table-primary">
                            <tr>
                                <th  scope="col">Sector</th>
                                <th  scope="col">Kit</th>
                                <th  scope="col">Data</th>
                                <th  scope="col">Homens</th>
                                <th  scope="col">Mulheres</th>
                                <th  scope="col">Total</th>


                            </tr>
                        </thead>
                        <tfoot class="table-primary" >
                            <tr>
                                <th  scope="col">Sector</th>
                                <th  scope="col">Kit</th>
                                <th  scope="col">Data</th>
                                <th  scope="col">Homens</th>
                                <th  scope="col">Mulheres</th>
                                <th  scope="col">Total</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($recenseados as $recenseado )
                                <tr>
                                    <td> {{$recenseado->sector->sector}} </td>
                                    <td> {{$recenseado->kit->numero}} : {{$recenseado->kit->descricao}} </td>
                                    <td> {{$recenseado->data->format('d-m-Y')}} </td>
                                    <td> {{$recenseado->homem}} </td>
                                    <td> {{$recenseado->mulher}} </td>
                                    <td> {{$recenseado->homem+ $recenseado->mulher}} </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
                <div class="float-right">


                </div>
            </div>
        </div>
    </div>



</div>
<script type="text/javascript">
    $(document).ready(function(){

        var table = $('#datatable').dataTable();
        // Start Edit Record

        table.on('click', '.edit', function(){

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#cod_regiao').val(data[1]);
            $('#regiao').val(data[2]);

            $('#editForm').attr('action', '/regioes/'+data[0]);
            $('#editarRegionModal').modal('show');
        })
        // End Edit Record

    });

</script>
@endsection
