@extends('layouts.app')
@section('title',__('Confirmer la réservation | Rebond'))
@push('styles')

@endpush
@section('content')
<div class="wrapper">
    <div class="event-dt-block p-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-7 col-md-10">
                    <div class="booking-confirmed-content">
                        <div class="main-card">
                            <div class="booking-confirmed-top text-center p_30">
                                <div class="booking-confirmed-img mt-4">
                                    <img src="{{ url()->asset('assets/images/logo-rebond_130x70.jpg')}}" alt="">
                                </div>
                                <h4>Confirmez votre réservation</h4>
                                <p class="ps-lg-4 pe-lg-4">Veuillez vous assurer des détails de votre réservation ci-dessous avant confirmation.</p>
                                <div class="add-calender-booking">
                                    <h5>Suivez-nous sur</h5>
                                    <a href="#" class="cb-icon"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="#" class="cb-icon"><i class="fa-brands fa-twitter"></i></a>
                                </div>
                            </div>
                            <div class="booking-confirmed-bottom">
                                <div class="booking-confirmed-bottom-bg p_30">
                                    <form action="" method="POST">
                                        <div class="event-order-dt">
                                            <div class="event-thumbnail-img">
                                                <img src="{{ url()->asset('assets/images/logo-rebond_130x70.jpg')}}" alt="">
                                            </div>
                                            
                                            <div class="event-order-dt-content">
                                                <h5>Réservation du stade Rebond pour</h5>
                                                <span> {{Carbon\Carbon::parse($datas['bookings']['date'])->isoFormat('LLLL')}}. De {{Carbon\Carbon::parse($datas['bookings']['start'])->hour}}h à {{Carbon\Carbon::parse($datas['bookings']['end'])->hour}}h  Durée {{$no_of_hours}}h</span>
                                                <div class="buyer-name">{{Auth()->user()->first_name}} {{Auth()->user()->last_name}}</div>
                                                <div class="buyer-name">Motif : {{$datas['bookings']['reason']}}</div>
                                                <div class="booking-total-tickets">
                                                    <i class="fa-solid fa-ticket rotate-icon"></i>
                                                    <span class="booking-count-tickets mx-2">1</span>x {{$no_of_hours}}h
                                                </div>
                                                <div class="booking-total-grand">
                                                    Total : <span>{{$datas['bookings']['stadium_cost']}} Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="invoice.html" class="main-btn btn-hover h_50 w-100 mt-5"><i
                                                class="fa-solid fa-ticket rotate-icon me-3"></i>Confirmer ma réservation</a>
                                    </form>
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

@endpush