@extends('layouts.app_admin')
@section('title',__('Mise à jour | Rebond'))
@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/datatables/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
@include('layouts.partials.sidebar')
<div class="wrapper">
    <div class="event-dt-block p-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="main-title text-center">
                        <h3>Mettre à jour l'évènement</h3>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-9 col-md-12">
                    <div class="wizard-steps-block">
                        <div id="add-event-tab" class="step-app">
                            <div class="step-content">
                                <div class="step-tab-panel step-tab-info active" id="tab_step1">
                                    <div class="tab-from-content">
                                        <div class="main-card">
                                            <div class="bp-title">
                                                <h4><i class="fa-solid fa-circle-info step_icon me-3"></i>Détails
                                                </h4>
                                            </div>
                                            {!! Form::open(array('url' => 'admin/bookings/'.$stadium_booking->id.'/edit')) !!}
                                            {{ Form::hidden('_method', 'PUT') }}
                                            {{ csrf_field() }}
                                            <div class="p-4 bp-form main-form">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group border_bottom pt_30 pb_30">
                                                            <label class="form-label fs-16">Statut de validation.*</label>
                                                            <select name="status" id="status" class="selectpicker" required multiple="" data-size="5"
                                                                title="Select category" data-live-search="true">
                                                                <option value="pending"
                                                                        @if ($stadium_booking->status == 'pending') selected="selected" @endif>En attente
                                                                </option>
                                                                <option value="checked_in"
                                                                        @if ($stadium_booking->status == 'checked_in') selected="selected" @endif>
                                                                    Enregistré
                                                                </option>
                                                                <option value="checked_out"
                                                                        @if ($stadium_booking->status == 'checked_out') selected="selected" @endif>
                                                                    Vérifié
                                                                </option>
                                                                <option value="cancelled"
                                                                        @if ($stadium_booking->status == 'cancelled') selected="selected" @endif>
                                                                    Annulé
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group border_bottom pt_30 pb_30">
                                                            <label class="form-label fs-16">Statut de paiement.*</label>
                                                            <select name="payment" id="payment" class="selectpicker" required multiple="" data-size="5"
                                                                title="Select category" data-live-search="true">
                                                                <option value="1"
                                                                        @if ($stadium_booking->payment == '1') selected="selected" @endif>Payé
                                                                </option>
                                                                <option value="0"
                                                                        @if ($stadium_booking->payment == '0') selected="selected" @endif>
                                                                    Non Payé
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
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

@endsection
@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<!-- Sweet Alert 2 plugin -->
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

<script type="text/javascript">

        var delete_button = function(){
            swal({  title: "Are you sure?",
                text: "After you delete the stadium booking.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn btn-info btn-fill",
                confirmButtonText: "Yes, delete it!",
                cancelButtonClass: "btn btn-danger btn-fill",
                closeOnConfirm: false,
            },function(){
                $('form#delete-stadium-booking').submit();
            });
        }
    
</script>
@endpush