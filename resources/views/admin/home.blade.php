@extends('layouts.app')
@section('title',__('Administration | Rebond'))
@section('content')
@include('layouts.partials.sidebar')
<div class="wrapper wrapper-body">
    <div class="dashboard-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-main-title">
                        <h3><i class="fa-solid fa-gauge me-3"></i>Dashboard</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="main-card add-organisation-card p-4 mt-5">
                        <div class="ocard-left">
                            <div class="ocard-avatar">
                                <img src="images/profile-imgs/img-13.jpg" alt="">
                            </div>
                            <div class="ocard-name">
                                <h4>John Doe</h4>
                                <span>My Organisation</span>
                            </div>
                        </div>
                        <div class="ocard-right">
                            <button class="pe-4 ps-4 co-main-btn min-width" data-bs-toggle="modal"
                                data-bs-target="#addorganisationModal"><i class="fa-solid fa-plus"></i>Add
                                Organisation</button>
                        </div>
                    </div>
                    <div class="main-card mt-4">
                        <div class="dashboard-wrap-content">
                            <div class="d-flex flex-wrap justify-content-between align-items-center p-4">
                                <div
                                    class="dashboard-date-wrap d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="dashboard-date-arrows">
                                        <a href="#" class="before_date"><i class="fa-solid fa-angle-left"></i></a>
                                        <a href="#" class="after_date disabled"><i
                                                class="fa-solid fa-angle-right"></i></a>
                                    </div>
                                    <h5 class="dashboard-select-date">
                                        <span>1st April, 2022</span>
                                        -
                                        <span>30th April, 2022</span>
                                    </h5>
                                </div>
                                <div class="rs">
                                    <div class="dropdown dropdown-text event-list-dropdown">
                                        <button class="dropdown-toggle event-list-dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span>Selected Events (1)</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">1</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-report-content">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-md-6">
                                        <div class="dashboard-report-card purple">
                                            <div class="card-content">
                                                <div class="card-content">
                                                    <span class="card-title fs-6">Revenue (AUD)</span>
                                                    <span class="card-sub-title fs-3">$550.00</span>
                                                    <div class="d-flex align-items-center">
                                                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                                                        <span class="text-Light font-12 ms-2 me-2">0.00%</span>
                                                        <span class="font-12 color-body text-nowrap">From Previous
                                                            Period</span>
                                                    </div>
                                                </div>
                                                <div class="card-media">
                                                    <i class="fa-solid fa-money-bill"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6">
                                        <div class="dashboard-report-card red">
                                            <div class="card-content">
                                                <div class="card-content">
                                                    <span class="card-title fs-6">Orders</span>
                                                    <span class="card-sub-title fs-3">2</span>
                                                    <div class="d-flex align-items-center">
                                                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                                                        <span class="text-Light font-12 ms-2 me-2">0.00%</span>
                                                        <span class="font-12 color-body text-nowrap">From Previous
                                                            Period</span>
                                                    </div>
                                                </div>
                                                <div class="card-media">
                                                    <i class="fa-solid fa-box"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6">
                                        <div class="dashboard-report-card info">
                                            <div class="card-content">
                                                <div class="card-content">
                                                    <span class="card-title fs-6">Page Views</span>
                                                    <span class="card-sub-title fs-3">30</span>
                                                    <div class="d-flex align-items-center">
                                                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                                                        <span class="text-Light font-12 ms-2 me-2">0.00%</span>
                                                        <span class="font-12 color-body text-nowrap">From Previous
                                                            Period</span>
                                                    </div>
                                                </div>
                                                <div class="card-media">
                                                    <i class="fa-solid fa-eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6">
                                        <div class="dashboard-report-card success">
                                            <div class="card-content">
                                                <div class="card-content">
                                                    <span class="card-title fs-6">Ticket Sales</span>
                                                    <span class="card-sub-title fs-3">3</span>
                                                    <div class="d-flex align-items-center">
                                                        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                                                        <span class="text-Light font-12 ms-2 me-2">0.00%</span>
                                                        <span class="font-12 color-body text-nowrap">From Previous
                                                            Period</span>
                                                    </div>
                                                </div>
                                                <div class="card-media">
                                                    <i class="fa-solid fa-ticket"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-card mt-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center border_bottom p-4">
                            <div
                                class="dashboard-date-wrap d-flex flex-wrap justify-content-between align-items-center">
                                <div class="select-graphic-category">
                                    <div class="form-group main-form mb-2">
                                        <select class="selectpicker" data-width="150px">
                                            <option value="revenue">Revenue</option>
                                            <option value="orders">Orders</option>
                                            <option value="pageviews">Page Views</option>
                                            <option value="ticketsales">Ticket Sales</option>
                                        </select>
                                    </div>
                                    <small class="mt-4">See the graphical representation below</small>
                                </div>
                            </div>
                            <div class="rs">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1">
                                    <label class="btn btn-outline-primary" for="btnradio1">Monthly</label>
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" checked>
                                    <label class="btn btn-outline-primary" for="btnradio2">Weekly</label>
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
                                    <label class="btn btn-outline-primary" for="btnradio3">Dailty</label>
                                </div>
                            </div>
                        </div>
                        <div class="item-analytics-content p-4 ps-1 pb-2">
                            <div id="views-graphic"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection