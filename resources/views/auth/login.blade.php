@extends('layouts.app')

@section('content')
<div class="container text-white">
    <div class="d-flex align-items-center flex-column justify-content-center pt-3 my-3">
        <!-- <img src="{{ asset('img/_logo-cne.png') }} " alt="logo" width="100px" width="100px" class="img pt-5"> -->
        <img  src="{{ asset('img/login-3.png') }} " alt="logo" height="150px" width="150px" class="img pt-2">
        <!-- <img src="{{ asset('img/logo.png') }}"/>  -->
         <h4 class="h4 text-white mb-0 font-weight-bold">GTAPE</h4>
         <h6 class="h6 text-white mt-0">Sistema de Recolha de Dados</h6>

            <div class="col-md-12 col-lg-5">
                    @if(\Session::has('error'))
                    <div class="alert alert-warning text-center text-danger">
                        <p>{{ \Session::get('error')}}</p>
                    </div>
                    @endif
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                                </ul>
                            </div>
                    @endif --}}
            </div>
            <form action="{{ route('login') }}" method="POST" class="col-md-12 col-lg-5">
            @csrf
                    <div class="form-group m-2 p-2 rounded-lg">
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Seu e-mail..." value="{{ old('email') }}" required autocomplete="email" autofocus/>
                            @error('email')
                                <span class="invalid-feedback alert-danger " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                            <div class="form-group m-2 p-2" >
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password" placeholder="Seu codigo..." />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group m-2 p-2">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">

                                {{-- <i><a class="nav-link text-white" href="{{ route('register') }}">{{ __('Inscription') }}</a></i> --}}

                            </div>

                            <div class="form-group   p-1 text-center">
                                <button class="btn btn-outline-light  btn-lg " type="submit"> <i class="fas fa-sign-in-alt"> </i>  Se conectar </button>
                            </div>

            </form>



    </div>
</div>
<style>
    body{

        /* background: linear-gradient(90deg, rgba(250,255,32,0.8) 10%, rgba(255,255,213,0) 100%, rgba(255,255,23,0.5) 100%); */

        /* background-color: #22a548; */
        /* background-color: rgb(8, 57, 59); */
        /* background-color:  #0c1a45; */
        background-color:  #70a7fa;

    }
</style>

@endsection
