@extends('layouts.app')
@section('title',__('Réserver | Rebond'))
@push('styles')
<link href="{{ url()->asset('assets/css/datepicker.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="wrapper">
    <div class="event-dt-block p-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="main-title text-center">
                        <h3>Réserver Rebond</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="wizard-steps-block">
                        <div id="add-event-tab" class="step-app">
                            {!! Form::open(array('url' => '/booking-stadium/book', 'id' => 'form')) !!}
                            {{ Form::hidden('_method', 'POST') }}
                            @csrf

                            @if ($errors->any())
                                <div class="row">
                                    <div class="col-md-12 alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="step-content">
                                <div class="step-tab-panel step-tab-info active" id="tab_step1">
                                    <div class="tab-from-content">
                                        <div class="main-card">
                                            <div class="bp-title">
                                                <h4><i class="fa-solid fa-circle-info step_icon me-3"></i>Informations de réservation (10.000 FCFA/Heure)
                                                </h4>
                                            </div>
                                            
                                            <div class="p-4 bp-form main-form">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group border_bottom pb_30">
                                                            <label class="form-label fs-16">Donnez à votre activité un
                                                                Nom.*</label>
                                                            <p class="mt-2 d-block fs-14 mb-3">Voyez comment votre nom apparaîtra sur la page de l'événement et une liste de tous les endroits où le nom de votre événement sera utilisé. <a href="#"
                                                                    class="a-link">En savoir plus</a></p>
                                                            <input required class="form-control h_50" id="uname" name="name" type="text"
                                                                placeholder="Entrer le nom de votre activité" value="">
                                                                
                                                        </div>
                                                        <div class="form-group border_bottom pt_30 pb_30">
                                                            <label class="form-label fs-16">Motif de réservation.*</label>
                                                            <p class="mt-2 d-block fs-14 mb-3">Choisir le motif de votre réservation. <a href="#" class="a-link">En savoir plus.</a></p>
                                                            <select id="reason" required name="reason" class="selectpicker" data-size="5"
                                                                title="Choisir un motif" data-live-search="true">
                                                                <option value="Tennis">Tennis</option>
                                                                <option value="Football">Football</option>
                                                                <option value="Basket">Basket</option>
                                                                <option value="Voley">Voley</option>
                                                                <option value="Handball">Handball</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group border_bottom pt_30 pb_30">
                                                            <label class="form-label fs-16">Quand est votre activité ?*</label>
                                                            <p class="mt-2 fs-14 d-block mb-3">Dites à vos participants
                                                                quand votre activité s'effectuera afin qu'ils puissent se préparer à
                                                                assister.</p>
                                                            <div class="row g-2">
                                                                <div class="col-md-6">
                                                                    <label class="form-label mt-3 fs-6">Date de l'activité.*</label>
                                                                    <div class="loc-group position-relative">
                                                                        <input required id="from" name="date"
                                                                            class="form-control h_50 datepicker-here"
                                                                            data-language="en" type="text"
                                                                            placeholder="AAAA/MM/JJ" value="" autocomplete="off">
                                                                        <span class="absolute-icon"><i
                                                                                class="fa-solid fa-calendar-days"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row g-2">
                                                                        <div class="col-md-6">
                                                                            <div class="clock-icon">
                                                                                <label
                                                                                    class="form-label mt-3 fs-6">Heure de début</label>
                                                                                <select id="start" required name="start" class="selectpicker"
                                                                                    data-size="5"
                                                                                    data-live-search="true">
                                                                                    <option value="08:00">08:00
                                                                                    </option>
                                                                                    <option value="09:00">09:00
                                                                                    </option>
                                                                                    <option value="10:00">10:00
                                                                                    </option>
                                                                                    <option value="11:00">11:00
                                                                                    </option>
                                                                                    <option value="12:00">12:00
                                                                                    </option>
                                                                                    <option value="13:00">13:00
                                                                                    </option>
                                                                                    <option value="14:00">14:00
                                                                                    </option>
                                                                                    <option value="15:00">15:00
                                                                                    </option>
                                                                                    <option value="16:00">16:00
                                                                                    </option>
                                                                                    <option value="17:00">17:00
                                                                                    </option>
                                                                                    <option value="18:00">18:00
                                                                                    </option>
                                                                                    <option value="19:00">19:00
                                                                                    </option>
                                                                                    <option value="20:00">20:00
                                                                                    </option>
                                                                                    <option value="21:00">21:00
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="clock-icon">
                                                                                <label
                                                                                    class="form-label mt-3 fs-6">Heure de fin</label>
                                                                                <select id="end" required name="end" class="selectpicker"
                                                                                    data-size="5"
                                                                                    data-live-search="true">
                                                                                    <option value="08:00">08:00
                                                                                    </option>
                                                                                    <option value="09:00">09:00
                                                                                    </option>
                                                                                    <option value="10:00">10:00
                                                                                    </option>
                                                                                    <option value="11:00">11:00
                                                                                    </option>
                                                                                    <option value="12:00">12:00
                                                                                    </option>
                                                                                    <option value="13:00">13:00
                                                                                    </option>
                                                                                    <option value="14:00">14:00
                                                                                    </option>
                                                                                    <option value="15:00">15:00
                                                                                    </option>
                                                                                    <option value="16:00">16:00
                                                                                    </option>
                                                                                    <option value="17:00">17:00
                                                                                    </option>
                                                                                    <option value="18:00">18:00
                                                                                    </option>
                                                                                    <option value="19:00">19:00
                                                                                    </option>
                                                                                    <option value="20:00">20:00
                                                                                    </option>
                                                                                    <option value="21:00">21:00
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-footer step-tab-pager mt-12">
                                <button type="submit"
                                    class="col-md-3 btn btn-default btn-hover steps_btn">Vérifier la disponibilité</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ url()->asset('assets/js/datepicker.min.js')}}"></script>
<script src="{{ url()->asset('assets/js/i18n/datepicker.en.js')}}"></script>
@endpush