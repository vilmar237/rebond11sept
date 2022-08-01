<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Vilmar">
    <meta name="author" content="Vilmar">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ url()->asset('assets/images/fav.png')}}">

    <link rel="preconnect" href="{{ url()->asset('assets/fonts.googleapis.com/index.html')}}">
    <link rel="preconnect" href="{{ url()->asset('assets/fonts.gstatic.com/index.html')}}" crossorigin>
    <link
        href="{{ url()->asset('assets/fonts.googleapis.com/css25e50.css?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap')}}"
        rel="stylesheet">
    <link href='{{ url()->asset('assets/vendor/unicons-2.0.1/css/unicons.css')}}' rel='stylesheet'>
    <link href="{{ url()->asset('assets/css/style.css')}}" rel="stylesheet">
    
    <link href="{{ url()->asset('assets/css/vertical-responsive-menu.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/css/analytics.css')}}" rel="stylesheet">
    
    <link href="{{ url()->asset('assets/css/responsive.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/css/night-mode.css')}}" rel="stylesheet">

    <link href="{{ url()->asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/main.css') }}">
    <link href="{{ url()->asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{ url()->asset('assets/css/customs.css')}}" rel="stylesheet">

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ asset('vendor/css/datepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/froiden/helper.css') }}">

    <!-- TimePicker -->
    <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap-timepicker.min.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @stack('styles')

    @notifyCss

    
</head>

<body class="d-flex flex-column h-100">

    @include('layouts.partials.header')

    <x:notify-messages />

    @yield('content')
    
    @include('layouts.partials.footer')

    
    
    <script src="{{ url()->asset('assets/js/vertical-responsive-menu.min.js')}}"></script>
    <script src="{{ url()->asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    
    <script src="{{ url()->asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url()->asset('assets/vendor/OwlCarousel/owl.carousel.js')}}"></script>
    <script src="{{ url()->asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    
    <script src="{{ url()->asset('assets/js/custom.js')}}"></script>
    <script src="{{ url()->asset('assets/js/night-mode.js')}}"></script>
    <script src="{{ url()->asset('assets/js/customs.js')}}"></script>
     <!-- Global Required Javascript -->
     <script src="{{ url()->asset('js/main.js') }}"></script>

    {{-- Timepicker --}}
    <script src="{{ asset('vendor/jquery/bootstrap-timepicker.min.js') }}"></script>

    <script src="{{ asset('vendor/froiden/helper.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
   <!-- also the modal itself -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center align-items-center modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel rounded mr-3" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-primary rounded">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- also the modal itself -->
    <div id="myModalXl" class="modal fade overflow-auto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center align-items-center modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body bg-grey">
                    Loading...
                </div>

            </div>
        </div>
    </div>

    

    @stack('scripts')

    <script>
        const MODAL_HEADING = '#modelHeading';
        const MODAL_LG = '#myModal';
        const RIGHT_MODAL = '#task-detail-1';
        const MODAL_XL = '#myModalXl';
        const datepickerConfig = {
            formatter: (input, date, instance) => {
                input.value = moment(date).format('{{ global_setting()->moment_date_format }}')
            },
            showAllDates: true,
            customDays: ["@lang('app.weeks.Sun')", "@lang('app.weeks.Mon')", "@lang('app.weeks.Tue')",
                "@lang('app.weeks.Wed')", "@lang('app.weeks.Thu')", "@lang('app.weeks.Fri')",
                "@lang('app.weeks.Sat')"
            ],
            customMonths: ["@lang('app.months.January')", "@lang('app.months.February')",
                "@lang('app.months.March')", "@lang('app.months.April')", "@lang('app.months.May')",
                "@lang('app.months.June')", "@lang('app.months.July')", "@lang('app.months.August')",
                "@lang('app.months.September')", "@lang('app.months.October')",
                "@lang('app.months.November')", "@lang('app.months.December')"
            ],
            customOverlayMonths: ["@lang('app.monthsShort.Jan')", "@lang('app.monthsShort.Feb')",
                "@lang('app.monthsShort.Mar')", "@lang('app.monthsShort.Apr')",
                "@lang('app.monthsShort.May')", "@lang('app.monthsShort.Jun')",
                "@lang('app.monthsShort.Jul')", "@lang('app.monthsShort.Aug')",
                "@lang('app.monthsShort.Sep')", "@lang('app.monthsShort.Oct')",
                "@lang('app.monthsShort.Nov')", "@lang('app.monthsShort.Dec')"
            ],
            overlayButton: "@lang('app.submit')",
            overlayPlaceholder: "@lang('app.enterYear')",
            startDay: parseInt("{{ date('Y-m-d', strtotime("+7 day")) }}")
        };

        /*const daterangeConfig = {
            "@lang('app.today')": [moment(), moment()],
            "@lang('app.last30Days')": [moment().subtract(29, 'days'), moment()],
            "@lang('app.thisMonth')": [moment().startOf('month'), moment().endOf('month')],
            "@lang('app.lastMonth')": [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf(
                    'month')
            ],
            "@lang('app.last90Days')": [moment().subtract(89, 'days'), moment()],
            "@lang('app.last6Months')": [moment().subtract(6, 'months'), moment()],
            "@lang('app.last1Year')": [moment().subtract(1, 'years'), moment()]
        };

        const daterangeLocale = {
            "format": "{{ global_setting()->moment_date_format }}",
            "customRangeLabel": "@lang('app.customRange')",
            "separator": " @lang('app.to') ",
            "applyLabel": "@lang('app.apply')",
            "cancelLabel": "@lang('app.cancel')",
            "daysOfWeek": ['@lang("app.weeks.Sun")', '@lang("app.weeks.Mon")',
                '@lang("app.weeks.Tue")',
                '@lang("app.weeks.Wed")', '@lang("app.weeks.Thu")', '@lang("app.weeks.Fri")',
                '@lang("app.weeks.Sat")'
            ],
            "monthNames": ['@lang("app.months.January")', '@lang("app.months.February")',
                "@lang('app.months.March')", "@lang('app.months.April')",
                "@lang('app.months.May')",
                "@lang('app.months.June')", "@lang('app.months.July')",
                "@lang('app.months.August')",
                "@lang('app.months.September')", "@lang('app.months.October')",
                "@lang('app.months.November')", "@lang('app.months.December')"
            ],
            "firstDay": parseInt(date)
        };*/
        const dropifyMessages = {
            default: "@lang('app.dragDrop')",
            replace: "@lang('app.dragDropReplace')",
            remove: "@lang('app.remove')",
            error: "@lang('messages.errorOccured')",
        };

        const DROPZONE_FILE_ALLOW = "{{ global_setting()->allowed_file_types }}";
        const DROPZONE_MAX_FILESIZE = "{{ global_setting()->allowed_file_size }}";
        Dropzone.prototype.defaultOptions.dictDefaultMessage = "{{ __('modules.projectTemplate.dropFile') }}";
    </script>
    <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'user' => user(),
            ]) !!};
    </script>
    @notifyJs

    <script>
        let quillArray = {};

        function quillImageLoad(ID) {

            quillArray[ID] = new Quill(ID, {
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, 4, 5, false]
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['image', 'code-block', 'link'],
                        [{
                            'direction': 'rtl'
                        }],
                        ['clean']
                    ],
                    clipboard: {
                        matchVisual: false
                    },
                    "emoji-toolbar": true,
                    "emoji-textarea": true,
                    "emoji-shortname": true,
                },
                theme: 'snow'
            });
            $.each(quillArray, function(key, quill) {
                quill.getModule('toolbar').addHandler('image', selectLocalImage);
            });

        }
        /**
         * Step1. select local image
         *
         */
        function selectLocalImage() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.click();

            // Listen upload local image and save to server
            input.onchange = () => {
                const file = input.files[0];

                // file type is only image.
                if (/^image\//.test(file.type)) {
                    saveToServer(file);
                } else {
                    console.warn('Vous ne pouvez télécharger que des images.');
                }
            };
        }

        /**
         * Step2. save to server
         *
         * @param {File} file
         */
        function saveToServer(file) {
            const fd = new FormData();
            fd.append('image', file);
            $.ajax({
                type: 'POST',
                url: "{{ route('image.store') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    insertToEditor(response)
                },
            });
        }

        function insertToEditor(url) {
            // push image url to rich editor.
            $.each(quillArray, function(key, quill) {
                try {
                    let range = quill.getSelection();
                    quill.insertEmbed(range.index, 'image', url);
                } catch (err) {}
            });
        }
    </script>
</body>

</html>