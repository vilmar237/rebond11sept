@extends('layouts.app_admin')
@section('title')
Ajouter un membre
@endsection
@push('styles')

@endpush
@section('content')
@include('layouts.partials.sidebar')
    
<div class="wrapper wrapper-body">
    @include($view)
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {

        if ($('.custom-date-picker').length > 0) {
            datepicker('.custom-date-picker', {
                position: 'bl',
                ...datepickerConfig
            });
        }

        @if(request()->routeIs('user.create*'))
            datepicker('#joining_date', {
                position: 'bl',
                ...datepickerConfig
            });

            datepicker('#date_of_birth', {
                position: 'bl',
                maxDate: new Date(),
                ...datepickerConfig
            });
        @endif

        @if(request()->routeIs('user.edit*'))
            datepicker('#joining_date', {
                position: 'bl',
                @if (!is_null($employee->joining_date))
                dateSelected: new Date("{{ str_replace('-', '/', $employee->joining_date) }}"),
                @endif
                ...datepickerConfig
            });
        @endif

        @if(request()->routeIs('user.edit*'))
            datepicker('#date_of_birth', {
                position: 'bl',
                maxDate: new Date(),
                @if (!is_null($employee->date_of_birth))
                dateSelected: new Date("{{ str_replace('-', '/', $employee->date_of_birth) }}"),
                @endif
                ...datepickerConfig
            });
        @endif

    
        @if(request()->routeIs('user.create*'))
            $('#save-employee-form').click(function() {
                event.preventDefault();
                const url = "{{ route('user.store') }}";

                /*toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };*/
                
                $.easyAjax({
                    url: url,
                    container: '#save-employee-data-form',
                    type: "POST",
                    disableButton: true,
                    blockUI: true,
                    buttonSelector: "#save-employee-form",
                    file: true,
                    data: $('#save-employee-data-form').serialize(),
                    success: function(response) {
                        if (response.status == 'success') {
                            if ($(MODAL_XL).hasClass('show')) {
                                $(MODAL_XL).hide();
                                window.location.reload();
                            } else {
                                window.location.href = response.redirectUrl;
                            }
                        }
                    }/*,
                    error: function(error) {
                    console.log(error);
                    toastr.error('Les données fournies sont invalides.');
                    
                    }*/
                });
                
                //alert($('#save-employee-data-form').serialize());
            });
        @endif

        @if(request()->routeIs('user.edit*'))
            $('#save-form').click(function() {
                const url = "{{ route('user.update', $employee->id) }}";

                $.easyAjax({
                    url: url,
                    container: '#save-data-form',
                    type: "POST",
                    disableButton: true,
                    blockUI: true,
                    buttonSelector: "#save-form",
                    file: true,
                    data: $('#save-data-form').serialize(),
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = response.redirectUrl;
                        }
                    }
                });
            });
        @endif

        $('#random_password').click(function() {
            const randPassword = Math.random().toString(36).substr(2, 8);

            $('#password').val(randPassword);
        });

        init(RIGHT_MODAL);

    });
    $('.cropper').on('dropify.fileReady', function(e) {
        var inputId = $(this).find('input').attr('id');
        var url = "{{ route('cropper', ':element') }}";
        url = url.replace(':element', inputId);
        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);
    });
</script>
@endpush