@extends('layouts.app')
@section('title',__('Changer Mot de Passe | Rebond'))
@section('content')
@include('layouts.partials.sidebar')
<div class="form-wrapper">
        <div class="app-form">
        <div class="app-form-content">
            <div class="container col-md-6">
                <br><br>
                <div class="password-des">
                    <h4>Changer de Mot de Passe</h4>
                    <p>Vous pouvez mettre à jour votre mot de passe à partir d'ici. Si
                        vous ne vous souvenez plus de votre mot de passe actuel,
                        déconnectez-vous et cliquez sur Mot de passe oublié.
                    </p>
                </div>
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
                {!! Form::open(array('url' => 'admin/user/'.Auth::user()->id.'/setting', 'files' => true, 'id'=>'passwordValidation')) !!}
                {{ Form::hidden('_method', 'PUT') }}
                {{ csrf_field() }}
                <div class="change-password-form">
                    <div class="form-group mt-4">
                        <label class="form-label">Mot de passe actuel*</label>
                        <div class="position-relative">
                            <input class="form-control h_50"
                                type="password" 
                                id="pass"
                                name="current_password"
                                required
                                placeholder="Tapez votre mot de passe">
                            <span class="pass-show-eye"><i
                                    class="fas fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label">Nouveau mot de passe*</label>
                        <div class="position-relative">
                            <input class="form-control h_50"
                                type="password" 
                                name="password"
                                required
                                placeholder="Entrer votre mot de passe"
                                id="registerPassword">
                            <span class="pass-show-eye"><i
                                    class="fas fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label">Confirmer votre nouveau mot de passe*</label>
                        <div class="position-relative">
                            <input class="form-control h_50"
                                name="password_confirmation"
                                id="registerPasswordConfirmation"
                                required
                                equalTo="#registerPassword"
                                type="password"
                                placeholder="Confirmer votre mot de passe">
                            <span class="pass-show-eye"><i
                                    class="fas fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <button class="main-btn btn-hover w-100 mt-5"
                        type="submit">Mettre à jour le mot de passe</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
 <!--  Forms Validations Plugin -->
 <script src="{{asset("assets/js/jquery.validate.min.js")}}"></script>
<script>
    $().ready(function(){
        $('#passwordValidation').validate({
            rules: {
                password:{
                    required:true,
                    minlength: 8,
                },
                password_confirmation:{
                    required:true,
                    minlength: 8,
                },
            },
            messages: {
                password:{
                    required: 'Ce champ est requis.',
                    minlength: "Le Mot de passe doit être au minimum de 8 caractères."
                },
                password_confirmation:{
                    required: 'Ce champ est requis',
                    minlength: "Le Mot de passe doit être au minimum de 8 caractères.",
                    equalTo: "Les deux mots de passe ne correspondent pas."
                },
            },
        })
    });
</script>
@endpush