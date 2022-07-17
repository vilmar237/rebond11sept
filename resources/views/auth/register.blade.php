@extends('layouts.app')

@section('content')
<div class="form-wrapper">
    <div class="app-form">
        <div class="app-form-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-10">
                        <div class="app-top-items">
                            <a href="index.html">
                                <div class="sign-logo" id="logo">
                                    <img src="images/logo.svg" alt="">
                                    <img class="logo-inverse" src="images/dark-logo.svg" alt="">
                                </div>
                            </a>
                            <div class="app-top-right-link">
                            Vous avez déjà un compte ?<a class="sidebar-register-link" href="{{route('login')}}">Se connecter</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-7">
                        <div class="registration">
                            <form method="POST" action="{{ route('register') }}">
                            @csrf
                                <h2 class="registration-title">S'insrire à Rebond</h2>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group mt-4">
                                            <label class="form-label">Prénom*</label>
                                            <input name="first_name" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }} h_50" type="text" placeholder="Votre prénom" value="{{ old('first_name') }}" required autofocus>
                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group mt-4">
                                            <label class="form-label">Nom*</label>
                                            <input name="last_name" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }} h_50" type="text" placeholder="Votre Nom" value="{{ old('last_name') }}" required>
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group mt-4">
                                            <label class="form-label">Votre Email*</label>
                                            <input name="email" class="form-control h_50 {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required type="email" placeholder="Votre Email">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group main-form mt-4">
                                            <label class="form-label">Genre*</label>
                                            <select name="gender" class="selectpicker" data-size="5" title="Nothing selected"
                                                data-live-search="true">
                                                <option value="" disabled selected>Sélectionner votre genre</option>
                                                <option value="male" @if(old('gender') == "male") selected="selected" @endif>Homme
                                                </option>
                                                <option value="female" @if(old('gender') == "female") selected="selected" @endif>Femme
                                                </option>
                                            </select>
                                            @if ($errors->has('gender'))
                                                <span class="invalid-feedback help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group mt-4">
                                            <div class="field-password">
                                                <label class="form-label">Mot de Passe*</label>
                                            </div>
                                            <div class="loc-group position-relative">
                                                <input name="password" class="form-control h_50 {{ $errors->has('password') ? ' is-invalid' : '' }}" required type="password" placeholder="Votre mot de passe">
                                                <span class="pass-show-eye"><i class="fas fa-eye-slash"></i></span>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group mt-4">
                                            <div class="field-password">
                                                <label class="form-label">Confirmer le Mot de Passe*</label>
                                            </div>
                                            <div class="loc-group position-relative">
                                                <input name="password_confirmation" class="form-control h_50 {{ $errors->has('password_confirmation') ? ' invalid' : '' }}" type="password" placeholder="Confirmer votre mot de passe" required>
                                                <span class="pass-show-eye"><i class="fas fa-eye-slash"></i></span>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="invalid-feedback help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <button class="main-btn btn-hover w-100 mt-4" type="submit">S'inscrire</button>
                                    </div>
                                </div>
                            </form>
                            <div class="agree-text">
                            En cliquant sur "S'inscrire", vous acceptez les <a href="#">Termes & Conditions</a> et
                                avez lu la <a href="#">Politique de confidentialité</a>.
                            </div>
                            
                            <div class="new-sign-link">
                            Vous avez déjà un compte ?<a class="signup-link" href="{{route('login')}}">Se connecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
