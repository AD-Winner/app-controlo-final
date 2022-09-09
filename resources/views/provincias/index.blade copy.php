@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fas fa-fw fa-map"></i> {{ __('Provincias') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
                                    {{-- <p id="sucesso" alert alert-success> </span> --}}
                                        {{ \Session::get('success')}}</p>
                                </div>

                            @endif
                            <div >
                                <span id="sucesso" class="text-success"> </span>
                                    {{-- {{ \Session::get('success')}}</p> --}}
                            </div>
                             <hr class="featurette-divider">
                             {{-- <div class="float-right">
                                    <!-- Botton de la modal d'ajout de Region-->
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#AjouterRegionModal">
                                        <i class="fas fa-plus"></i> Adicionar Provincia
                                    </button>

                             </div> --}}
                             <div class="col-sm-12 col-md-6">
                               <h4> Total <strong> {{ $tot }} </strong> Provincias  </h4>
                             </div>
                                <hr class="featurette-divider">
                        </div>

                         {{-- <form action="{{route('provincia.store')}}"  method="POST">
                            @csrf
                            {{-- @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="privi">Provincia:</label>
                                    <input type="text" name="provi" class="form-control" id="" max="20" min="3"
                                        placeholder="Nome da provincia" />
                                </div>
                                <button type="submit"   class="mt-2 btn btn-outline-primary"><i class="fas fa-plus"></i>Add</button>
                            </div>
                        </form> --}}

                        <div class="card">
                            <div class="card-header">
                                <span id="addT">Add new record</span>
                                <span id="updateT">Update data</span>
                            </div>
                                <div class="card-body">
                                    {{-- <form  > --}}
                                        <!-- Corp de Modal-->
                                        @csrf
                                        {{-- @method('PUT') --}}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="privincia">Provincia:</label>
                                                <input type="text" name="provincia" class="form-control" id="provincia" max="20" min="3"
                                                  placeholder="Nome da provincia" />
                                                  <span class="text-danger" id="provinciaError"></span>
                                            </div>

                                            {{-- <input type="text" id="id"> --}}

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" onclick="addData()" id="addButton"  class="mt-2 btn btn-outline-primary"><i class="fas fa-plus"></i>Add</button>
                                            <button type="submit" onclick="updateData()" id="updateButton" class="btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-plus"></i>Update</button>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                            </div>
                                <div class="float-right">
                                </div>
                         </div>


                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-sm table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                               <th>#</th>
                                                <th>Provincia</th>
                                                {{-- <th>Regiões</th>
                                                <th>Circulos</th> --}}
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('#addT').show();
    $('#addButton').show();
    $('#updateT').hide();
    $('#updateButton').hide();

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    function allData(){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/provincias/all",
            // url: "{{route('provincia.allData')}}",
            success:function(response){
                var data = ""
                //  console.log(response);
                $.each(response, function (key, value){
                    // console.log(value.id)
                    // console.log(value.id +" " +value.provincia)
                    data = data + "<tr>"
                        data = data + "<td>"+ value.id +"</td>"
                        data = data + "<td>"+ value.provincia +"</td>"
                        data = data + "<td>"
                            data = data + "<button class='btn btn-sm btn-primary m-1' onclick='editData("+value.id+")'> <i class='fas fa-edit'></i> </button>"
                            data = data + "<button class='btn btn-sm btn-danger mr-1'> <i class='fas fa-trash'></i> </button>"
                        data = data + "</td>"
                    data = data + "</tr>"
                })
                $('tbody').html(data);
            }
        })
    }

    allData();

    function clearData(){
        $('#provincia').val('');
        $('#provinciaError').text('');
    }

    function addData(){
       var provincia =  $('#provincia').val();

    //    console.log(provincia);
       $.ajax({
           type: "POST",
           dataType: "json",
           data:{provincia:provincia},
           url: "/provincias-store",
           success: function(data){
            clearData();
            allData();

            $('#sucesso').text('Data added successfuly');
            window.alert('Provincia registada com sucesso');
            //   console.log('Dados registado');
           },
           error: function(error){
                $('#sucesso').text('');
               $('#provinciaError').text(error.responseJSON.errors.provincia);
            //    console.log(error.responseJSON.errors.provincia);
           }
       })
    }
    //---------------------START EDIT DATAS -------------------\\

            // function editData(id){
            //     // alert(id);
            //     $.ajax({
            //         type: "GET",
            //         dataType: "json",
            //         url: "/provincia/edit/"+id,
            //         success: function(data){
            //             $('#addT').hide();
            //             $('#addButton').hide();
            //             $('#updateT').show();
            //             $('#updateButton').show();

            //             $('#id').val(data.id);
            //             $('#provincia').val(data.provincia);
            //             // console.log(data);
            //         },
            //         error: function(error){
            //             // console.log(error);
            //         }

            //     })
            // }

    //------------------- END EDIT DATA -----------------------\\

     //------------------- START UPDATE DATA -----------------------\\

    //  function updateData(){

    //     var id =  $('#id').val();
    //     var provincia =  $('#provincia').val();

    //     $.ajax([
    //         type: "PUT",
    //         dataType: "json",
    //         data: {id : id, provincia:provincia},
    //         url: "/provincia/update/"+id,
    //         success: function (response){
    //             console.log(data);
    //         },
    //         error: function (error){
    //             $('#provinciaError').text(error.responseJSON.errors.provincia);
    //         }
    //     ])


    //  }
     //------------------- END UPDATE DATA -----------------------\\
</script>

@endsection
