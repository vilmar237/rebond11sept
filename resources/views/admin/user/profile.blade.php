@extends('layouts.app')
@section('title',__('Profile | Rebond'))
@section('content')
@include('layouts.partials.sidebar')
<div class="wrapper">
    <div class="container">
        <div class="modal-dialog modal-lg">
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
        <br>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aboutModalLabel">Mettre à jour le profil</h5>
                </div>
                <div class="modal-body">
                {!! Form::open(array('url' => 'admin/user/'.Auth::user()->id.'/profile', 'files' => true)) !!}
                {{ Form::hidden('_method', 'PUT') }}
                {{ csrf_field() }}
                    <div class="model-content main-form">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Prénom*</label>
                                    <input class="form-control h_40" name="first_name" required type="text" placeholder="" value="{{$user->first_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Nom*</label>
                                    <input class="form-control h_40" name="last_name" required type="text" placeholder="" value="{{$user->last_name}}">
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Email*</label>
                                    <input class="form-control h_40" name="email" required type="text" placeholder=""
                                        value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Téléphone*</label>
                                    <input class="form-control h_40" name="phone" required type="text" placeholder="" value="{{$user->phone}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group main-form mt-4">
                                    <label class="form-label">Genre*</label>
                                    <select name="gender" class="selectpicker" required data-size="5" title="Sélectionner un genre"
                                        data-live-search="true">
                                        <option value="male"
                                                @if($user->gender == "male")
                                                selected="selected"
                                                @endif
                                        >Homme
                                        </option>
                                        <option value="female"
                                                @if($user->gender == "female")
                                                selected="selected"
                                                @endif
                                        >Femme
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Adresse</label>
                                    <input class="form-control h_40" type="text" placeholder="" name="address" value="{{$user->address}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Avatar</label>
                                    <input type="file" name="avatar" class="form-control h_40">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Identifiant Facebook</label>
                                    <input class="form-control h_40" type="text" placeholder="" name="facebook_id" value="{{$user->facebook_id}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Identifiant Twitter</label>
                                    <input class="form-control h_40" type="text" name="twitter_id" placeholder="" value="{{$user->twitter_id}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Identifiant Google</label>
                                    <input class="form-control h_40" name="goole_id" type="text" placeholder="" value="{{$user->gogle_id}}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group mt-4">
                                    <label class="form-label">Bio</label>
                                    <textarea class="form-textarea" name="about" placeholder="">{{$user->about}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="co-main-btn min-width btn-hover h_40" data-bs-target="#aboutModal"
                        data-bs-toggle="modal" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="main-btn min-width btn-hover h_40">Mettre à jour</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection