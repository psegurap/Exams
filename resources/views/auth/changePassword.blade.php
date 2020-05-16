{{-- @extends('layouts.app') --}}
@extends('layouts.main')
@section('title')Cambiar Contraseña @endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="border-bottom rounded-bottom">
                <div class="header-pages text-white text-uppercase rounded-top">{{ __('Cambiar Contraseña') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
   
                         {{-- @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach  --}}
  
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control single-input-form  @error('current_password') is-invalid @enderror"  name="current_password" placeholder="Contraseña actual" autocomplete="current-password">
                                
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="new_password" type="password" class="form-control single-input-form @error('new_password') is-invalid @enderror" name="new_password" placeholder="Nueva contraseña" autocomplete="current-password">
                                
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="new_confirm_password" type="password" class="form-control single-input-form @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" placeholder="Confirmar nueva contraseña" autocomplete="current-password">
                                @error('new_confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if(session()->has('message'))
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="text-success">
                                        <strong>
                                            {{ session()->get('message') }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-info rounded-0">
                                    Cambiar Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection