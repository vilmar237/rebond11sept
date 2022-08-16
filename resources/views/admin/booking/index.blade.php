@extends('layouts.app_admin')
@section('title',__('Réservations | Rebond'))
@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/datatables/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
@include('layouts.partials.sidebar')
<div class="wrapper wrapper-body">
    <div class="dashboard-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-main-title">
                        <h3><i class="fa-solid fa-calendar-days me-3"></i>Events</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="main-card mt-5">
                        <div class="dashboard-wrap-content p-4">
                            <h5 class="mb-4">Réservations ({{$stadium_bookings->count()}})</h5>
                            <div class="d-md-flex flex-wrap align-items-center">
                                <div class="dashboard-date-wrap">
                                    <div class="form-group">
                                        <div class="relative-input position-relative">
                                            <input class="form-control h_40" type="text"
                                                placeholder="Search by event name, status" value="">
                                            <i class="uil uil-search"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="rs ms-auto mt_r4">
                                    <div class="nav custom2-tabs btn-group" role="tablist">
                                        <button class="tab-link active" data-bs-toggle="tab"
                                            data-bs-target="#all-tab" type="button" role="tab"
                                            aria-controls="all-tab" aria-selected="true">All Event (<span
                                                class="total_event_counter">1</span>)</button>
                                        <button class="tab-link" data-bs-toggle="tab" data-bs-target="#online-tab"
                                            type="button" role="tab" aria-controls="online-tab"
                                            aria-selected="false">Online Event (<span
                                                class="total_event_counter">0</span>)</button>
                                        <button class="tab-link" data-bs-toggle="tab" data-bs-target="#venue-tab"
                                            type="button" role="tab" aria-controls="venue-tab"
                                            aria-selected="false">Venue Event (<span
                                                class="total_event_counter">1</span>)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="table-actions" class="flex-grow-1 align-items-center">
                    </div>
                    @unless($stadium_bookings->count())
                        @else
                            @foreach($stadium_bookings as $index => $stadium_booking)
                                <div class="all-promotion-list">
                                    <div class="main-card mt-4">
                                        <div class="contact-list coupon-active">
                                            <div
                                                class="top d-flex flex-wrap justify-content-between align-items-center p-4 border_bottom">
                                                <div class="icon-box">
                                                    <span class="icon-big rotate-icon icon icon-purple">
                                                        <i class="fa-solid fa-ticket"></i>
                                                    </span>
                                                    @php 

                                                        $user_name = \App\Models\User::where('id',$stadium_booking->user_id)->first();
                                                        
                                                    @endphp
                                                    <h5 class="font-18 mb-1 mt-1 f-weight-medium">{{$stadium_booking->reason}}<span
                                                            class="font-weight-normal"> - Par {{$user_name->first_name.' '.$user_name->last_name}}</span></h5>
                                                    <p class="text-gray-50 m-0"><span class="visitor-date-time">Le {{Carbon\Carbon::parse($stadium_booking->date)->isoFormat('LLLL')}}</span> - <span class="visitor-date-time">de {{Carbon\Carbon::parse($stadium_booking->start)->hour}}h à {{Carbon\Carbon::parse($stadium_booking->end)->hour}}h</span></p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <label class="btn-switch tfs-8 mb-0 me-4 mt-1">
                                                        <input type="checkbox" value="" checked>
                                                        <span class="checkbox-slider"></span>
                                                    </label>
                                                    <div class="dropdown dropdown-default dropdown-text dropdown-icon-item">
                                                        <button class="option-btn-1" type="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{url('admin/bookings/'.$stadium_booking->id.'/edit')}}" class="dropdown-item"><i
                                                                    class="fa-solid fa-pen me-3"></i>Mettre à jour</a>
                                                                    {!! Form::open(array('id' => 'delete-stadium-booking', 'url' => 'admin/bookings/'.$stadium_booking->id)) !!}
                                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                                    <button type="submit" class="dropdown-item"><i
                                                                    class="fa-solid fa-trash-can me-3"></i>Supprimer</button>
                                                                    {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bottom d-flex flex-wrap justify-content-between align-items-center p-4">
                                                <div class="icon-box ">
                                                    <span class="icon">
                                                        <i class="fa-regular fa-circle-dot"></i>
                                                    </span>
                                                    <p>Statut</p>
                                                    @if($stadium_booking->status == "pending")
                                                    <h6 class="coupon-status">En attente</h6>
                                                    @elseif($stadium_booking->status == "checked_in")
                                                    <h6 class="coupon-status">Enregistré</h6>
                                                    @elseif($stadium_booking->status == "checked_out")
                                                    <h6 class="coupon-status">Vérifié</h6>
                                                    @elseif($stadium_booking->status == "canceled")
                                                    <h6 class="coupon-status">Annulé</h6>
                                                    @endif
                                                </div>
                                                <div class="icon-box">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-chart-column"></i>
                                                    </span>
                                                    <p>Montant</p>
                                                    <h6 class="coupon-status">{{$stadium_booking->stadium_cost}} Fcfa</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%;"
                                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="icon-box">
                                                    <span class="icon">
                                                        <i class="fa-regular fa-clock"></i>
                                                    </span>
                                                    <p>Facture</p>
                                                    @if($stadium_booking->payment == 1)
                                                    <h6 class="coupon-status">Payée</h6>
                                                    @else
                                                    <h6 class="coupon-status">Non Payée</h6>
                                                    @endif
                                                </div>
                                                <div class="icon-box">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-tag"></i>
                                                    </span>
                                                    <p>Remise</p>
                                                    <h6 class="coupon-status">0%</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    @endunless
                    {{--<div class="event-list">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="all-tab" role="tabpanel">
                                <div class="main-card mt-4">
                                    <div class="contact-list">
                                        <div
                                            class="card-top event-top p-4 align-items-center top d-md-flex flex-wrap justify-content-between">
                                            <div class="d-md-flex align-items-center event-top-info">
                                                <div class="card-event-img">
                                                    <img src="images/event-imgs/img-7.jpg" alt="">
                                                </div>
                                                <div class="card-event-dt">
                                                    <h5>Tutorial on Canvas Painting for Beginners</h5>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="option-btn" type="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-gear me-3"></i>Manage</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-eye me-3"></i>Preview Event</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-clone me-3"></i>Duplicate</a>
                                                    <a href="#" class="dropdown-item delete-event"><i
                                                            class="fa-solid fa-trash-can me-3"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="bottom d-flex flex-wrap justify-content-between align-items-center p-4">
                                            <div class="icon-box ">
                                                <span class="icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </span>
                                                <p>Status</p>
                                                <h6 class="coupon-status">Publish</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </span>
                                                <p>Starts on</p>
                                                <h6 class="coupon-status">30 Jun, 2022 10:00 AM</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-ticket"></i>
                                                </span>
                                                <p>Ticket</p>
                                                <h6 class="coupon-status">250</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-tag"></i>
                                                </span>
                                                <p>Tickets sold</p>
                                                <h6 class="coupon-status">20</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="online-tab" role="tabpanel">
                                <div class="main-card d-none mt-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center flex-column min-height-430">
                                        <div class="event-list-icon">
                                            <img src="images/calendar.png" alt="">
                                        </div>
                                        <p class="font-16 mt-4 text-light3">No Event found</p>
                                    </div>
                                </div>
                                <div class="main-card mt-4">
                                    <div class="contact-list">
                                        <div
                                            class="card-top event-top p-4 align-items-center top d-md-flex flex-wrap justify-content-between">
                                            <div class="d-md-flex align-items-center event-top-info">
                                                <div class="card-event-img">
                                                    <img src="images/event-imgs/img-2.jpg" alt="">
                                                </div>
                                                <div class="card-event-dt">
                                                    <h5>Earrings Workshop with Bronwyn David</h5>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="option-btn" type="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-gear me-3"></i>Manage</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-eye me-3"></i>Preview Event</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-clone me-3"></i>Duplicate</a>
                                                    <a href="#" class="dropdown-item delete-event"><i
                                                            class="fa-solid fa-trash-can me-3"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="bottom d-flex flex-wrap justify-content-between align-items-center p-4">
                                            <div class="icon-box ">
                                                <span class="icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </span>
                                                <p>Status</p>
                                                <h6 class="coupon-status">Publish</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </span>
                                                <p>Starts on</p>
                                                <h6 class="coupon-status">30 Jun, 2022 10:00 AM</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-ticket"></i>
                                                </span>
                                                <p>Ticket</p>
                                                <h6 class="coupon-status">250</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-tag"></i>
                                                </span>
                                                <p>Tickets sold</p>
                                                <h6 class="coupon-status">20</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="venue-tab" role="tabpanel">
                                <div class="main-card mt-4">
                                    <div class="contact-list">
                                        <div
                                            class="card-top event-top p-4 align-items-center top d-md-flex flex-wrap justify-content-between">
                                            <div class="d-md-flex align-items-center event-top-info">
                                                <div class="card-event-img">
                                                    <img src="images/event-imgs/img-7.jpg" alt="">
                                                </div>
                                                <div class="card-event-dt">
                                                    <h5>Tutorial on Canvas Painting for Beginners</h5>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="option-btn" type="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-gear me-3"></i>Manage</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-eye me-3"></i>Preview Event</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="fa-solid fa-clone me-3"></i>Duplicate</a>
                                                    <a href="#" class="dropdown-item delete-event"><i
                                                            class="fa-solid fa-trash-can me-3"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="bottom d-flex flex-wrap justify-content-between align-items-center p-4">
                                            <div class="icon-box ">
                                                <span class="icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </span>
                                                <p>Status</p>
                                                <h6 class="coupon-status">Publish</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                </span>
                                                <p>Starts on</p>
                                                <h6 class="coupon-status">30 Jun, 2022 10:00 AM</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-ticket"></i>
                                                </span>
                                                <p>Ticket</p>
                                                <h6 class="coupon-status">250</h6>
                                            </div>
                                            <div class="icon-box">
                                                <span class="icon">
                                                    <i class="fa-solid fa-tag"></i>
                                                </span>
                                                <p>Tickets sold</p>
                                                <h6 class="coupon-status">20</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
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