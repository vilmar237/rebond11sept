<header class="header">
    <div class="header-inner">
        <nav
            class="navbar navbar-expand-lg bg-barren barren-head navbar fixed-top justify-content-sm-start pt-0 pb-0">
            @if(request()->is('admin'))
            <div class="container-fluid ps-0">
            @else
            <div class="container">
            @endif
                @if(request()->is('admin'))
                <button type="button" id="toggleMenu" class="toggle_menu">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
                <button id="collapse_menu" class="collapse_menu me-4">
                    <i class="fa-solid fa-bars collapse_menu--icon "></i>
                    <span class="collapse_menu--label"></span>
                </button>
                @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon">
                        <i class="fa-solid fa-bars"></i>
                    </span>
                </button>
                <a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 me-auto" href="{{url('/')}}">
                    <div class="res-main-logo">
                        <img src="{{ url()->asset('assets/images/logo-rebond_130x70.jpg')}}" alt="">
                    </div>
                    <div class="main-logo" id="logo">
                        <img src="{{ url()->asset('assets/images/logo-rebond_130x70.jpg')}}" alt="">
                        <img class="logo-inverse" src="{{ url()->asset('assets/images/logo-rebond_130x70.jpg')}}" alt="">
                    </div>
                </a>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <div class="offcanvas-logo" id="offcanvasNavbarLabel">
                            <img src="{{ url()->asset('assets/images/logo-rebond_130x70.jpg')}}" alt="">
                        </div>
                        <button type="button" class="close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="offcanvas-top-area">
                            <div class="create-bg">
                                <a href="{{url('/booking-stadium')}}" class="offcanvas-create-btn">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span>Réserver Maintenant</span>
                                </a>
                            </div>
                        </div>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe_5">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{url('/')}}">Accueil</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">Qui sommes nous ?</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">Nous écrire</a>
                            </li>
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('login')}}">Connexion</a>
                            </li>
                            @endguest
                            
                        </ul>
                    </div>
                    <div class="offcanvas-footer">
                        <div class="offcanvas-social">
                            <h5>Suivez-nous aussi sur</h5>
                            <ul class="social-links">
                                <li><a href="#" class="social-link"><i class="fab fa-facebook-square"></i></a>
                                <li><a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                <li><a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <li><a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right-header order-2">
                    <ul class="align-self-stretch">
                        
                        <li>
                            <a href="{{url('/booking-stadium')}}" class="create-btn btn-hover">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>Réserver Maintenant</span>
                            </a>
                        </li>
                        @auth
                        <li class="dropdown account-dropdown">
                            <a href="#" class="account-link" role="button" id="accountClick"
                                data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="images/profile-imgs/img-13.jpg" alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-account dropdown-menu-end"
                                aria-labelledby="accountClick">
                                <li>
                                    <div class="dropdown-account-header">
                                        <div class="account-holder-avatar">
                                            <img src="images/profile-imgs/img-13.jpg" alt="">
                                        </div>
                                        <h5>John Doe</h5>
                                        <p><a href="https://www.gambolthemes.net/cdn-cgi/l/email-protection"
                                                class="__cf_email__"
                                                data-cfemail="640e0b0c0a000b0124011c05091408014a070b09">[email&#160;protected]</a>
                                        </p>
                                    </div>
                                </li>
                                <li class="profile-link">
                                    <a href="my_organisation_dashboard.html" class="link-item">My Organisation</a>
                                    <a href="organiser_profile_view.html" class="link-item">Mon Profil</a>
                                    <a href="{{ route('logout') }}" class="link-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Déconnexion</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endauth
                        <li>
                            <div class="night_mode_switch__btn">
                                <div id="night-mode" class="fas fa-moon fa-sun"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="overlay"></div>
    </div>
</header>