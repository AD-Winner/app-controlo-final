<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
    body{
        font-size: 10pt;
    }
        h1{
            text-align:center;
            font-size: 8pt;
            font-family: verdana;
            padding: 0px;
            margin:0px;

        }

        h3{
            text-align:center;
            font-size: 10pt;
            font-family: verdana;
            padding: 0px;
            margin:0px;
        }
        h2{
            text-align:center;
            font-size: 14pt;
            font-family: verdana;
            padding: 0px;
            margin-top:20px;
            margin-bottom:0px;
            font-style: italic;

        }

        table{
            margin-top: 10px;
            border:none;
            width:80%;
            font-family: Arial normal 14pt;

        }

        td{
            width: 20px;
        }
        tr{
            border-style : none;
        }
        .linha{
            position: relative;
            padding-bottom : 10px;
            margin-bottom:10px;
            height:10px;

        }
        .data{
            float : right;
            margin-right: 50px;
            margin-bottom: 5px;

        }
        .tot{
            float : left;
            margin-left: 70px;


        }
        .corpo{
            width:90%;
            text-align:center;

        }
        thead{
            background-color : #4dc0b5;
            border-color: black;
            /*color: white;*/


        }
        hr{
            width:90%;
            color:red;
        }
        tbody{
            background-color : white;
            color: black;


        }
        .num{
            text-align:center;
        }

    </style>
</head>
<body>
            <h1 >REPÚBLICA DA <img src="img/_emblema-guine.png"/> GUINÉ-BISSAU</h1>
            <h3 >ASSEMBLEIA NACIONAL POPULAR</h3>
            <h3 >COMISSÃO NACIONAL DE ELEIÇÕES</h3>
            <h4 style="text-align: center;">Lista de utilizadores de sistema</h4>
            <div class="corpo">
            <!--<hr/>-->
                                        <div class="linha">
                                            <div class="tot"> Total utilizadores: <strong> {{ $tot }} </strong>
                                            </div>
                                            {{-- <br> --}}

                                            <div class="data">Imprimido dia : <strong>  {{ date('d-m-Y')}} </strong></div>
                                            <br>
                                        </div>
                    <table align="center" border="1" cellspacing="0">
                        <thead>
                            <tr>
                               <th class="num">Nome</th>
                               <th>E-mail</th>
                               <th>Perfil</th>
                               <th class="num">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>

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
                                <td> {{$user->is_active ? 'Activo' : 'Inactivo'}}  </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                <!--<div class="data"> Autor : Aliu Djaló </div>-->
                </div>

</body>
</html>
