@extends('layouts.app')
@section('title',__('Accueil | Rebond'))
@section('content')
<div class="wrapper">
    <div class="hero-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9 col-md-10">
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
                    <div class="hero-banner-content">
                        <h2>Effectuez votre réservation et prenez du plaisir en jouant sur le stade multisport rebond</h2>
                        <p>Rebond est une plateforme de réservation tout-en-un pour tout sportif..</p>
                        <a href="{{url('/booking-stadium')}}" class="main-btn btn-hover">Réserver maintenant <i
                                class="fa-solid fa-arrow-right ms-3"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="event-dt-block p-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="event-top-dts">
                        <div class="event-top-date">
                            <span class="event-month">Juin</span>
                            <span class="event-date">01</span>
                        </div>
                        <div class="event-top-dt">
                            <h3 class="event-main-title">Evènement à suivre : Nom Evènement</h3>
                            <div class="event-top-info-status">
                                <span class="event-type-name"><i class="fa-solid fa-video"></i>Deux zéro MINFOPRA</span>
                                <span class="event-type-name details-hr">Starts on <span class="ev-event-date">Mer,
                                        Juin 01, 2022 5:30</span></span>
                                <span class="event-type-name details-hr">1h</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7 col-md-12">
                    <div class="main-event-dt">
                        <div class="event-img">
                            <img src="images/event-imgs/big-1.jpg" alt="">
                        </div>
                        <div class="share-save-btns dropdown">
                            <button class="sv-btn me-2"><i class="fa-regular fa-bookmark me-2"></i>Me Rappeler</button>
                            <button class="sv-btn" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="fa-solid fa-share-nodes me-2"></i>Partager</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i
                                            class="fa-brands fa-facebook me-3"></i>Facebook</a></li>
                                <li><a class="dropdown-item" href="#"><i
                                            class="fa-brands fa-twitter me-3"></i>Twitter</a></li>
                                <li><a class="dropdown-item" href="#"><i
                                            class="fa-regular fa-envelope me-3"></i>Email</a></li>
                            </ul>
                        </div>
                        <div class="main-event-content">
                            <h4>A Propos de cet évènement</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dolor justo, sodales
                                mattis orci et, mattis faucibus est. Nulla semper consectetur sapien a tempor. Ut
                                vel lacus lorem. Nulla mauris massa, pharetra a mi ut, mattis euismod libero. Ut
                                pretium bibendum urna nec egestas. Etiam tempor vehicula libero. Aenean cursus
                                venenatis orci, ac porttitor leo porta sit amet. Nulla eleifend mollis enim sed
                                rutrum. Nunc cursus ex a ligula consequat aliquet. Donec semper tellus ac ante
                                vestibulum, vitae varius leo mattis. In vestibulum blandit tempus. Etiam elit
                                turpis, volutpat hendrerit varius ut, posuere a sapien. Maecenas molestie bibendum
                                finibus. Nulla euismod neque vel sem hendrerit faucibus. Nam sit amet metus
                                sollicitudin, luctus eros at, consectetur libero.</p>
                            <p>In malesuada luctus libero sed gravida. Suspendisse nunc est, maximus vel viverra
                                nec, suscipit non massa. Maecenas efficitur vestibulum pellentesque. Ut finibus
                                ullamcorper congue. Sed ut libero sit amet lorem venenatis facilisis. Mauris egestas
                                tortor vel massa auctor, eget gravida mauris cursus. Etiam elementum semper
                                fermentum. Suspendisse potenti. Morbi lobortis leo urna, non laoreet enim ultricies
                                id. Integer id felis nec sapien consectetur porttitor. Proin tempor mauris in odio
                                iaculis semper. Cras ultricies nulla et dui viverra, eu convallis orci fermentum.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-12">
                    <div class="main-card event-right-dt">
                        <div class="bp-title">
                            <h4>Détails évènement</h4>
                        </div>
                        <div class="time-left">
                            <div class="countdown">
                                <div class="countdown-item">
                                    <span id="day"></span>jours
                                </div>
                                <div class="countdown-item">
                                    <span id="hour"></span>Heures
                                </div>
                                <div class="countdown-item">
                                    <span id="minute"></span>Minutes
                                </div>
                                <div class="countdown-item">
                                    <span id="second"></span>Secondes
                                </div>
                            </div>
                        </div>
                        <div class="event-dt-right-group mt-5">
                            <div class="event-dt-right-icon">
                                <i class="fa-solid fa-circle-user"></i>
                            </div>
                            <div class="event-dt-right-content">
                                <h4>Organisé par</h4>
                                <h5>Cyrille</h5>
                                <a href="attendee_profile_view.html">Voir profil</a>
                            </div>
                        </div>
                        <div class="event-dt-right-group">
                            <div class="event-dt-right-icon">
                                <i class="fa-solid fa-calendar-day"></i>
                            </div>
                            <div class="event-dt-right-content">
                                <h4>Heure et date</h4>
                                <h5>Mer, Juin 01, 2022 5:30</h5>
                                <div class="add-to-calendar">
                                    <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-calendar-days me-3"></i>Ajouter sur le calendrier
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="fa-brands fa-windows me-3"></i>Outlook</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="fa-brands fa-google me-3"></i>Google</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="fa-brands fa-yahoo me-3"></i>Yahoo</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="event-dt-right-group">
                            <div class="event-dt-right-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="event-dt-right-content">
                                <h4>Lieu</h4>
                                <h5 class="mb-0">Rebond Stade</h5>
                            </div>
                        </div>
                        <div class="event-dt-right-group">
                            <div class="event-dt-right-icon">
                                <i class="fa-solid fa-money-check-dollar"></i>
                            </div>
                            <div class="event-dt-right-content">
                                <h4>Statut</h4>
                                <h5 class="mb-0">Gratuit</h5>
                            </div>
                        </div>
                        <div class="booking-btn">
                            <a href="checkout.html" class="main-btn btn-hover w-100">Demander à participer</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="more-events">
                        <div class="main-title position-relative">
                            <h3>Evènements à suivre</h3>
                            <a href="explore_events.html" class="view-all-link">Parcourir<i
                                    class="fa-solid fa-right-long ms-2"></i></a>
                        </div>
                        <div class="owl-carousel moreEvents-slider owl-theme">
                            <div class="item">
                                <div class="main-card mt-4">
                                    <div class="event-thumbnail">
                                        <a href="venue_event_detail_view.html" class="thumbnail-img">
                                            <img src="images/event-imgs/img-1.jpg" alt="">
                                        </a>
                                        <span class="bookmark-icon" title="Bookmark"></span>
                                    </div>
                                    <div class="event-content">
                                        <a href="venue_event_detail_view.html" class="event-title">A New Way Of
                                            Life</a>
                                        <div class="duration-price-remaining">
                                            <span class="duration-price">AUD $100.00*</span>
                                            <span class="remaining"></span>
                                        </div>
                                    </div>
                                    <div class="event-footer">
                                        <div class="event-timing">
                                            <div class="publish-date">
                                                <span><i class="fa-solid fa-calendar-day me-2"></i>15 Apr</span>
                                                <span class="dot"><i class="fa-solid fa-circle"></i></span>
                                                <span>Fri, 3.45 PM</span>
                                            </div>
                                            <span class="publish-time"><i
                                                    class="fa-solid fa-clock me-2"></i>1h</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-card mt-4">
                                    <div class="event-thumbnail">
                                        <a href="online_event_detail_view.html" class="thumbnail-img">
                                            <img src="images/event-imgs/img-2.jpg" alt="">
                                        </a>
                                        <span class="bookmark-icon" title="Bookmark"></span>
                                    </div>
                                    <div class="event-content">
                                        <a href="online_event_detail_view.html" class="event-title">Earrings
                                            Workshop with Bronwyn David</a>
                                        <div class="duration-price-remaining">
                                            <span class="duration-price">AUD $75.00*</span>
                                            <span class="remaining"><i class="fa-solid fa-ticket fa-rotate-90"></i>6
                                                Remaining</span>
                                        </div>
                                    </div>
                                    <div class="event-footer">
                                        <div class="event-timing">
                                            <div class="publish-date">
                                                <span><i class="fa-solid fa-calendar-day me-2"></i>30 Apr</span>
                                                <span class="dot"><i class="fa-solid fa-circle"></i></span>
                                                <span>Sat, 11.20 PM</span>
                                            </div>
                                            <span class="publish-time"><i
                                                    class="fa-solid fa-clock me-2"></i>2h</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-card mt-4">
                                    <div class="event-thumbnail">
                                        <a href="venue_event_detail_view.html" class="thumbnail-img">
                                            <img src="images/event-imgs/img-3.jpg" alt="">
                                        </a>
                                        <span class="bookmark-icon" title="Bookmark"></span>
                                    </div>
                                    <div class="event-content">
                                        <a href="venue_event_detail_view.html" class="event-title">Spring Showcase
                                            Saturday April 30th 2022 at 7pm</a>
                                        <div class="duration-price-remaining">
                                            <span class="duration-price">Free*</span>
                                            <span class="remaining"></span>
                                        </div>
                                    </div>
                                    <div class="event-footer">
                                        <div class="event-timing">
                                            <div class="publish-date">
                                                <span><i class="fa-solid fa-calendar-day me-2"></i>1 May</span>
                                                <span class="dot"><i class="fa-solid fa-circle"></i></span>
                                                <span>Sun, 4.30 PM</span>
                                            </div>
                                            <span class="publish-time"><i
                                                    class="fa-solid fa-clock me-2"></i>3h</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-card mt-4">
                                    <div class="event-thumbnail">
                                        <a href="online_event_detail_view.html" class="thumbnail-img">
                                            <img src="images/event-imgs/img-4.jpg" alt="">
                                        </a>
                                        <span class="bookmark-icon" title="Bookmark"></span>
                                    </div>
                                    <div class="event-content">
                                        <a href="online_event_detail_view.html" class="event-title">Shutter Life</a>
                                        <div class="duration-price-remaining">
                                            <span class="duration-price">AUD $85.00</span>
                                            <span class="remaining"><i class="fa-solid fa-ticket fa-rotate-90"></i>7
                                                Remaining</span>
                                        </div>
                                    </div>
                                    <div class="event-footer">
                                        <div class="event-timing">
                                            <div class="publish-date">
                                                <span><i class="fa-solid fa-calendar-day me-2"></i>1 May</span>
                                                <span class="dot"><i class="fa-solid fa-circle"></i></span>
                                                <span>Sun, 5.30 PM</span>
                                            </div>
                                            <span class="publish-time"><i
                                                    class="fa-solid fa-clock me-2"></i>1h</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-card mt-4">
                                    <div class="event-thumbnail">
                                        <a href="venue_event_detail_view.html" class="thumbnail-img">
                                            <img src="images/event-imgs/img-5.jpg" alt="">
                                        </a>
                                        <span class="bookmark-icon" title="Bookmark"></span>
                                    </div>
                                    <div class="event-content">
                                        <a href="venue_event_detail_view.html" class="event-title">Friday Night
                                            Dinner at The Old Station May 27 2022</a>
                                        <div class="duration-price-remaining">
                                            <span class="duration-price">AUD $41.50*</span>
                                            <span class="remaining"></span>
                                        </div>
                                    </div>
                                    <div class="event-footer">
                                        <div class="event-timing">
                                            <div class="publish-date">
                                                <span><i class="fa-solid fa-calendar-day me-2"></i>27 May</span>
                                                <span class="dot"><i class="fa-solid fa-circle"></i></span>
                                                <span>Fri, 12.00 PM</span>
                                            </div>
                                            <span class="publish-time"><i
                                                    class="fa-solid fa-clock me-2"></i>5h</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-card mt-4">
                                    <div class="event-thumbnail">
                                        <a href="venue_event_detail_view.html" class="thumbnail-img">
                                            <img src="images/event-imgs/img-6.jpg" alt="">
                                        </a>
                                        <span class="bookmark-icon" title="Bookmark"></span>
                                    </div>
                                    <div class="event-content">
                                        <a href="venue_event_detail_view.html" class="event-title">Step Up Open Mic
                                            Show</a>
                                        <div class="duration-price-remaining">
                                            <span class="duration-price">AUD $200.00*</span>
                                            <span class="remaining"></span>
                                        </div>
                                    </div>
                                    <div class="event-footer">
                                        <div class="event-timing">
                                            <div class="publish-date">
                                                <span><i class="fa-solid fa-calendar-day me-2"></i>30 Jun</span>
                                                <span class="dot"><i class="fa-solid fa-circle"></i></span>
                                                <span>Thu, 4.30 PM</span>
                                            </div>
                                            <span class="publish-time"><i
                                                    class="fa-solid fa-clock me-2"></i>1h</span>
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