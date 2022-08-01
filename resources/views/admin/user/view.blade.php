@extends('layouts.app_admin')
@section('title',__('Utilisateurs | Rebond'))
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
                        <h3><i class="fa-solid fa-user-group me-3"></i>Liste Utilisateurs</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="conversion-setup">
                        <div class="main-card mt-5">
                            <div class="dashboard-wrap-content p-4">
                                <div id="table-actions" class="d-md-flex flex-wrap align-items-center">
                                    <div class="nav custom2-tabs btn-group" role="tablist">
                                        <button class="tab-link ms-0 active" data-bs-toggle="tab"
                                            data-bs-target="#overview-tab" type="button" role="tab"
                                            aria-controls="overview-tab" aria-selected="true">Aperçu</button>
                                        <button class="tab-link" data-bs-toggle="tab" data-bs-target="#role-tab"
                                            type="button" role="tab" aria-controls="role-tab"
                                            aria-selected="false">Rôles</button>
                                    </div>
                                    <div class="rs ms-auto mt_r4">
                                        <a class="main-btn btn-hover h_40 w-100" href="{{route('user.create')}}" >Ajouter un membre</a>
                                    </div>&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="overview-tab" role="tabpanel">
                                <div class="table-card mt-4">
                                    <div class="main-table">
                                        {{$dataTable->table(['class' => 'table table-hover border-0 w-100'])}}
                                        {{--<div class="table-responsive">
                                            <table id="bootstrap-table" class="table">
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
                                        </div>--}}
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
@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{$dataTable->scripts()}}

<script>
    var startDate = null;
    var endDate = null;
    var lastStartDate = null;
    var lastEndDate = null;

    @if(request('startDate') != '' && request('endDate') != '' )
        startDate = '{{ request("startDate") }}';
        endDate = '{{ request("endDate") }}';
    @endif

    @if(request('lastStartDate') !=='' && request('lastEndDate') !=='' )
        lastStartDate = '{{ request("lastStartDate") }}';
        lastEndDate = '{{ request("lastEndDate") }}';
    @endif


    $('#users-table').on('preXhr.dt', function(e, settings, data) {
        var status = $('#status').val();
        var employee = $('#employee').val();
        var role = $('#role').val();
        var skill = $('#skill').val();
        var designation = $('#designation').val();
        var department = $('#department').val();
        var searchText = $('#search-text-field').val();
        data['status'] = status;
        data['employee'] = employee;
        data['role'] = role;
        data['skill'] = skill;
        data['designation'] = designation;
        data['department'] = department;
        data['searchText'] = searchText;

        /* If any of these following filters are applied, then dashboard conditions will not work  */
        if(status == "all" || employee == "all" || role == "all"  || designation == "all" || searchText == ""){
            data['startDate'] = startDate;
            data['endDate'] = endDate;
            data['lastStartDate'] = lastStartDate;
            data['lastEndDate'] = lastEndDate;
        }

    });
    const showTable = () => {
            window.LaravelDataTables["users-table"].draw();
    }
    $('#employee, #status, #search-text-field, #role, #skill, #designation, #department').on('change keyup',
        function() {
            if ($('#status').val() != "all") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            } else if ($('#employee').val() != "all") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            } else if ($('#role').val() != "all") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            } else if ($('#designation').val() != "all") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            } else if ($('#department').val() != "all") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            } else if ($('#search-text-field').val() != "") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            } else {
                $('#reset-filters').addClass('d-none');
                showTable();
            }
        });

    $('#reset-filters').click(function() {
        $('#filter-form')[0].reset();
        $('.filter-box .select-picker').selectpicker("refresh");
        $('#reset-filters').addClass('d-none');
        showTable();
    });

    $('#reset-filters-2').click(function() {
        $('#filter-form')[0].reset();
        $('.filter-box .select-picker').selectpicker("refresh");
        $('#reset-filters').addClass('d-none');
        showTable();
    });

    $('#quick-action-type').change(function() {
        const actionValue = $(this).val();
        if (actionValue != '') {
            $('#quick-action-apply').removeAttr('disabled');

            if (actionValue == 'change-status') {
                $('.quick-action-field').addClass('d-none');
                $('#change-status-action').removeClass('d-none');
            } else {
                $('.quick-action-field').addClass('d-none');
            }
        } else {
            $('#quick-action-apply').attr('disabled', true);
            $('.quick-action-field').addClass('d-none');
        }
    });

    
</script>

<script type="text/javascript">

    var delete_button = function(){
        swal({  title: "Êtes-vous certain ?",
            text: "Après avoir supprimé l'utilisateur, toutes les réservations de stades de l'utilisateur seront également supprimées.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-info btn-fill",
            confirmButtonText: "Oui, supprimer!",
            cancelButtonClass: "btn btn-danger btn-fill",
            closeOnConfirm: false,
        },function(){
            $('form#delete-user').submit();
        });
    }


</script>
@endpush