@extends('layouts.app')
@section('title',__('Utilisateurs | Rebond'))
@section('content')
@include('layouts.partials.sidebar')
<div class="wrapper wrapper-body">
    <div class="dashboard-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-main-title">
                        <h3><i class="fa-solid fa-user-group me-3"></i>Liste Utilisateurs</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="conversion-setup">
                        <div class="main-card mt-5">
                            <div class="dashboard-wrap-content p-4">
                                <div class="d-md-flex flex-wrap align-items-center">
                                    <div class="nav custom2-tabs btn-group" role="tablist">
                                        <button class="tab-link ms-0 active" data-bs-toggle="tab"
                                            data-bs-target="#overview-tab" type="button" role="tab"
                                            aria-controls="overview-tab" aria-selected="true">Aperçu</button>
                                        <button class="tab-link" data-bs-toggle="tab" data-bs-target="#role-tab"
                                            type="button" role="tab" aria-controls="role-tab"
                                            aria-selected="false">Rôles</button>
                                    </div>
                                    <div class="rs ms-auto mt_r4">
                                        <button class="main-btn btn-hover h_40 w-100" data-bs-toggle="modal"
                                            data-bs-target="#inviteTeamModal">Inviter un membre</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="overview-tab" role="tabpanel">
                                <div class="table-card mt-4">
                                    <div class="main-table">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Nom</th>
                                                        <th scope="col">Email/Téléphone</th>
                                                        <th scope="col">Rôle</th>
                                                        <th scope="col">Adresse</th>
                                                        <th scope="col">Statut</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @unless($users->count())
                                                    @else
                                                        @foreach($users as $index => $user)
                                                            <tr>
                                                                <td>{{ $user->first_name." ".$user->last_name }}</td>
                                                                <td><a href="javascript::void(0)"
                                                                        class="__cf_email__"
                                                                        data-cfemail="4f252027212b202a0f2a372e223f232a612c2022">{{ $user->email }}/{{ $user->phone }}</a>
                                                                </td>
                                                                <td>{{ $user->role }}</td>
                                                                <td>{{ $user->address }}</td>
                                                                <td>
                                                                @if($user->status == 1)
                                                                    <button class="btn btn-success btn-xs btn-fill">Actif</button>
                                                                @else
                                                                    <button class="btn btn-default btn-xs btn-fill">Inactif
                                                                    </button>
                                                                @endif</td>
                                                                <td>
                                                                <div class="table-icons">
                                                                    <a rel="tooltip" title="Edit"
                                                                    class="btn btn-simple btn-warning btn-icon table-action edit"
                                                                    href="{{url('admin/user/'.$user->id.'/edit')}}">
                                                                        <i class="fa-solid fa-edit"></i>
                                                                    </a>
                                                                    <button rel="tooltip" title="Remove"
                                                                            class="btn btn-simple btn-danger btn-icon table-action"
                                                                            onclick="delete_button()">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                    <div class="collapse">
                                                                        {!! Form::open(array('id' => 'delete-user', 'url' => 'admin/user/'.$user->id)) !!}
                                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                                        <button type="submit" class="btn btn-danger btn-ok">Delete</button>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                @endunless
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="role-tab" role="tabpanel">
                                <div class="role-slider-content mt-4">
                                    <div class="owl-carousel role-slider owl-theme">
                                        <div class="item">
                                            <div class="main-card">
                                                <div class="role-header">
                                                    <h6>Account Owner</h6>
                                                    <span>1 per account</span>
                                                </div>
                                                <div class="role-body-content">
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Banking</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Team members</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Events</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Reports</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Customer service</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Amend bookings</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Gift certificates</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Marketing tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Integration tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Scanning app</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="main-card">
                                                <div class="role-header">
                                                    <h6>Power user</h6>
                                                    <span>Unlimited</span>
                                                </div>
                                                <div class="role-body-content">
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Banking</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Team members</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Events</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Reports</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Customer service</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Amend bookings</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Gift certificates</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Marketing tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Integration tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Scanning app</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="main-card">
                                                <div class="role-header">
                                                    <h6>Finance</h6>
                                                    <span>Unlimited</span>
                                                </div>
                                                <div class="role-body-content">
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Banking</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Team members</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Events</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Reports</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Customer service</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Amend bookings</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark"></i>
                                                        <span>Gift certificates</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Marketing tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Integration tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Scanning app</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="main-card">
                                                <div class="role-header">
                                                    <h6>Basic access</h6>
                                                    <span>Unlimited</span>
                                                </div>
                                                <div class="role-body-content">
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Banking</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Team members</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Events</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Reports</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Customer service</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Amend bookings</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Gift certificates</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Marketing tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Integration tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Scanning app</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="main-card">
                                                <div class="role-header">
                                                    <h6>Producer access</h6>
                                                    <span>1 per event</span>
                                                </div>
                                                <div class="role-body-content">
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Banking</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Team members</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Events</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Reports</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Customer service</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Amend bookings</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Gift certificates</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Marketing tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-xmark i-disabled"></i>
                                                        <span>Integration tools</span>
                                                    </div>
                                                    <div class="role-item">
                                                        <i class="fa-solid fa-check"></i>
                                                        <span>Scanning app</span>
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
</div>
@endsection