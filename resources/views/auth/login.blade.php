@extends('layouts.app')
@section('title',__('Connexion | Rebond'))
@push('scripts')
<style>
    #btn_submit {
        width: 100%;
        transition: all 0.5s ease-in-out;
    }

    #btn_submit.isLoading {
        width: 50px;
        border-radius: 100vw;
    }

    .hide {
        display: none;
    }
</style>
@endpush
@section('content')
<div class="form-wrapper">
    <div class="app-form">
        <div class="app-form-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-10">
                        <div class="app-top-items">
                            <div class="app-top-right-link">
                                Nouveau sur rebond?<a class="sidebar-register-link" href="{{url('/register')}}">S'inscrire</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-7">
                        <div class="registration">
                            <form onsubmit="return disableButton()" action="/postLogin" method="POST">
                            @csrf
                                <h2 class="registration-title">Connectez-vous à Rebond</h2>
                                <br>
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        @php
                                            Session::forget('success');
                                        @endphp
                                    </div>
                                @endif
                                @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                        @php
                                            Session::forget('error');
                                        @endphp
                                    </div>
                                @endif
                                <div class="form-group mt-5">
                                    <label class="form-label">Votre mail*</label>
                                    <input class="form-control h_50" name="email" type="email" placeholder="Entrer votre mail"
                                    value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group mt-4">
                                    <div class="field-password">
                                        <label class="form-label">Mot de passe*</label>
                                        <a class="forgot-pass-link" href="#">Mot de passe oublié ?</a>
                                    </div>
                                    <div class="loc-group position-relative">
                                        <input class="form-control h_50" name="password" type="password"
                                            placeholder="Entrer votre mot de passe">
                                        <span class="pass-show-eye"><i class="fas fa-eye-slash"></i></span>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button id="btn_submit" class="main-btn btn-hover w-100 mt-4" type="submit">
                                    <div id="loading_submit" class="spinner-border hide" role="status"
                                        style="width: 15px; height: 15px">
                                    </div>
                                    <div id="text_submit">
                                        Connexion
                                    </div>
                                    <i class="fas fa-sign-in-alt ms-2"></i>
                                </button>
                            </form>
                            <div class="new-sign-link">
                                Nouveau sur Rebond ?<a class="signup-link" href="/register">S'inscrire</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function disableButton() {
        $("#loading_submit").removeClass("hide");
        $("#text_submit").addClass("hide");
        $("#btn_submit").addClass("isLoading").attr('disabled', 'disabled');
    }
</script>
@endpush