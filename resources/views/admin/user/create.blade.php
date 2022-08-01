@extends('layouts.app_admin')

@push('styles')

@endpush
@section('content')
@include('layouts.partials.sidebar')
    
<div class="wrapper wrapper-body">
    @include($view)
</div>

@endsection
@push('scripts')
<script src="{{ asset('vendor/jquery/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function() {

        if ($('.custom-date-picker').length > 0) {
            datepicker('.custom-date-picker', {
                position: 'bl',
                ...datepickerConfig
            });
        }

        datepicker('#joining_date', {
            position: 'bl',
            ...datepickerConfig
        });

        datepicker('#date_of_birth', {
            position: 'bl',
            maxDate: new Date(),
            ...datepickerConfig
        });

        @if(request()->routeIs('user.update*'))
        datepicker('#joining_date', {
            position: 'bl',
            @if (!is_null($employee->joining_date))
            dateSelected: new Date("{{ str_replace('-', '/', $employee->joining_date) }}"),
            @endif
            ...datepickerConfig
        });
        @endif

        @if(request()->routeIs('user.update*'))
        datepicker('#date_of_birth', {
            position: 'bl',
            maxDate: new Date(),
            @if (!is_null($employee->date_of_birth))
            dateSelected: new Date("{{ str_replace('-', '/', $employee->date_of_birth) }}"),
            @endif
            ...datepickerConfig
        });
        @endif

    
        
        $('#save-employee-form').click(function() {
            event.preventDefault();
            const url = "{{ route('user.store') }}";

            /*$("#save-employee-data-form").validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
                    username: {
                        required: true,
                        minlength: 2
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    topic: {
                        required: "#newsletter:checked",
                        minlength: 2
                    },
                    agree: "required"
                },
                messages: {
                    first_name: "Please enter your firstname",
                    last_name: "Please enter your lastname",
                    username: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 2 characters"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    email: "Please enter a valid email address",
                    agree: "Please accept our policy",
                    topic: "Please select at least 2 topics"
                }

            });*/

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

        @if(request()->routeIs('user.update*'))
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