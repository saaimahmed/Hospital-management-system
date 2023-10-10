@extends('backend.layouts.app')

@section('title', 'Appointments')

@section('style')
    <link href="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    {{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
@endsection

@section('body')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-3">
                    Appointment List
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Appointment
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Appointment List
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">

            <div class="card card-flush">
                <div class="card-body py-5">
                    <h1>Quick Appointment</h1>
                </div>
                <div class="pt-5 mx-10">
                    <ul class="nav-item d-flex gap-8 justify-content-end align-items-center">
                        <li class="nav-link">
                            {{--                            <a href="#" class="" id="selected-Data-Delete"><i class="fa fa-trash fs-2x text-danger"></i></a>--}}
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="" id="selected-Data-Delete" class="delete-btn-group py-5" href="" data-bs-original-title="Delete Selected" aria-label="Delete Selected"><i class="fa fa-trash fs-2x text-danger"></i></a>

                        </li>
                        <li class="nav-link"> <a href="" class=""><i class="fa fa-file-excel fs-2x text-success"></i></a></li>
                        <li class="nav-link"> <a href="" class=""><i class="fa fa-print fs-2x text-warning"></i></a></li>
                    </ul>

                </div>

                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->

                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <input type="text" data-kt-ecommerce-category-filter="search"
                                   class="form-control form-control-solid w-250px ps-12"
                                   placeholder="Search Schedule"/>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a class="btn btn-primary" id="add_service_button" data-bs-toggle="modal"
                           data-bs-target="#kt_modal_new_address">
                            Add Appointment
                        </a>
                    </div>
                </div>


                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" id="select-all-checkbox" />
                                    <label class="form-check-label" for="select-all-checkbox"></label>
                                </div>
                            </th>
                            <th class="min-w-100px ps-5">Appointment id</th>
                            <th class="min-w-100px ps-5">Patient Name</th>
                            <th class="min-w-100px ps-5">Department Name</th>
                            <th class="min-w-100px">Doctor name</th>
                            <th class="min-w-100px">Appointment date</th>
                            <th class="min-w-100px">Schedule Id</th>
                            <th class="min-w-50px">Patient Type</th>
                            <th class="min-w-50px">Status</th>
                            <th class="text-end min-w-50px pe-5">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">

                        @foreach($appointments as $appointment)
                            <tr id="appointments_ids{{ $appointment->id }}">
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                        <input class="form-check-input" name="ids" class="checkbox-ids" type="checkbox" value="{{ $appointment->id }}"/>
                                    </div>
                                </td>
                                <td>{{ $appointment->id}}</td>

                                    <td>{{ $appointment->patient_id }}</td>

                                @if ($appointment->department)
                                    <td>{{ $appointment->department->department_name }}</td>
                                @else
                                    <td>Null</td>
                                @endif

                                <td>{{ optional($appointment->doctor)->dr_name }}</td>

                                <td>{{ $appointment->appointment_date  }}</td>

                                @if ($appointment->schedule)
                                    <td>{{ $appointment->schedule->schedule_days }} <br>

                                        <strong>Start Time: </strong><span class="text-success">{{ \Carbon\Carbon::parse($appointment->schedule->start_time )->format('h:i A')}}</span><br>
                                        <strong>End Time: </strong><span class="text-danger">{{ \Carbon\Carbon::parse( $appointment->schedule->end_time )->format('h:i A')}}</span><br>
                                    </td>
                                @else
                                    <td>Null</td>
                                @endif

                                <td>{{ $appointment->patient_type }}</td>
                                <td>{{ $appointment->status }}</td>


                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                       data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div  class="menu-item px-3 mb-1">
                                            <a href="{{ route('appointments.edit', encrypt($appointment->id)) }}" class="menu-link px-3 bg-light-primary text-primary ">

                                                <i class="fa fa-edit me-2 text-primary"></i>Edit
                                            </a>
                                        </div>

                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 bg-light-warning text-warning">
                                                <i class="fa fa-eye text-info me-2"></i>View
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" onclick="deleteItem({{ $appointment->id }})" class="menu-link px-3 bg-light-danger text-danger">
                                                <i class="fa fa-trash text-danger me-2"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{--            <!--being::Form - Delete Type -->--}}
            <form id="delete_form" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="_method" value="DELETE">
            </form>
        </div>
    </div>
@endsection

@section('modal')
    <!--begin::Modal - Add Department-->
    <div class="modal fade" id="kt_modal_new_address" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top mw-1000px">
            <div class="modal-content">
                <form class="form" method="post" action="{{ route('appointments.store') }}"  id="add_appointment_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h3 class="text-center mx-auto">Add New Appointment</h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div
                            class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header"
                            data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">

                            <!--begin::Input group Department Name-->
                            <div class="row mb-5">
                                <!--begin::Input group Department Type-->
                                <div class="col-6 fv-row">
                                    <label for="patient_search" class="required fs-5 fw-semibold mb-2">Patient Name or ID</label>
                                    <input type="text" name="patient_id" id="patient_search" placeholder="Search Patient Name or ID..." class="form-control">
                                    <div id="patient_list"></div>

                                    <div class="text-danger my-1" id="patient_name_error"></div>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="schedule_id" class="required fs-5 fw-semibold mb-2">Schedule</label>
                                    <select name="schedule_id" id="schedule_id" class="form-control js-example-basic-single" >
                                        <option value=""><-- Select a schedule --></option>
                                    </select>
                                </div>

                            </div>

                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="" class="required fs-5 fw-semibold mb-2">Doctor Department Name</label>

                                    <select name="department_id" id="department_id"  class="js-example-basic-single form-control"  data-placeholder="Select Department">
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" >{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger my-1" id="department_id_error"></div>
                                </div>
                                <div class="col-6 fv-row">
                                <label for="" class="required fs-5 fw-semibold mb-2">Patient Type</label>

                                <select name="patient_type" id="patient_type"  class="js-example-basic-single form-control"  data-placeholder="Select Patient Type">

                                    <option value="">-- Select a patient type --</option>
                                    <option value="new" {{ old('patient_type') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="old" {{ old('patient_type') == 'old' ? 'selected' : '' }}>Old</option>
                                    <option value="report" {{ old('patient_type') == '"report' ? 'selected' : '' }}>Report</option>

                                </select>
                                <div class="text-danger my-1" id="patient_type_error"></div>
                            </div>
                            </div>
                            <!-- Begin:: Input group Department Description -->
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="" class="required fs-5 fw-semibold mb-2">Doctor Name</label>

                                    <select name="doctor_id" id="doctor_id" class="js-example-basic-single form-control" data-placeholder="Select Doctor">
                                        <option value="doctor_id" class="text-center" ><--Select A Doctor--></option>

                                    </select>

                                    <div class="text-danger my-1" id="doctor_id_error"></div>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="" class="required fs-5 fw-semibold mb-2">Appointment Status</label>

                                    <select name="status" id="status"  class="js-example-basic-single form-control"  data-placeholder="Select Appointment Status">

                                        <option value="">--Select--</option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="waiting" {{ old('status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                        <option value="hold" {{ old('status') == 'hold' ? 'selected' : '' }}>Hold</option>
                                        <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        <option value="seen" {{ old('status') == 'seen' ? 'selected' : '' }}>Seen</option>

                                    </select>
                                    <div class="text-danger my-1" id="status_error"></div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="appointment_date" class="required fs-5 fw-semibold mb-2">Appointment Date</label>
                                    <input type="date" name="appointment_date" id="appointment_date"   class="form-control">


                                    <div class="text-danger my-1" id="appointment_date_error"></div>
                                </div>



                            </div>


                        </div>
                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <button type="submit" id="submitBtn" class="btn btn-primary d-flex justify-content-center align-content-center">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">
                               <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')




    <script>

        function deleteItem(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.querySelector('#delete_form');
                    form.action = 'destroy/' + id;
                    form.submit();
                }
            })
        }
    </script>
{{--    // Add Client review--}}
    <script>
        $(document).ready(function () {
            $("#add_appointment_form").on("submit", function (e) {
                e.preventDefault();

                $(".text-danger").text('');
                const formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,

                    success: function (response) {

                        $("#submitBtn .indicator-label").text("Adding...");
                        $("#submitBtn .indicator-progress").show();
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    // Redirect to the index page
                                    window.location.href = '{{ route('appointments.index') }}';
                                }
                            });
                        }

                    },
                    error: function (error) {
                        if (error.status === 422) {
                            var errors = error.responseJSON.errors;
                            for (var field in errors) {
                                $("#" + field + "_error").text(errors[field][0]);
                            }
                        } else {
                            console.error(error);
                        }
                    },
                });
            });
        });
    </script>
    {{--  deleted All Selected field--}}
    <script>

        $(document).ready(function() {
            $('#select-all-checkbox').on('click', function() {
                $('.checkbox-ids').prop('checked', $(this).prop('checked'));
            });

            $("#selected-Data-Delete").on('click', function (e) {
                e.preventDefault();

                let all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function () {
                    all_ids.push($(this).val());
                });

                // Add a SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User clicked "Yes, delete it!" in the confirmation dialog
                        $.ajax({
                            url: "",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                $.each(all_ids, function (key, val) {
                                    $('#appointments_ids' + val).remove();
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2(
                {
                    // placeholder: 'Select an Doctor name',
                }
            );

            $('.js-example-basic-multiple').select2({
                // placeholder: 'Select Days'
            });

        });
    </script>

    {{-- patient id Searching ajax   --}}
    <script>
        $(document).ready(function () {
            $("#patient_search").on('keyup', function () {
                var value = $(this).val();

                $.ajax({
                    url: "{{ route('get.patients') }}",
                    type: "get",
                    data: {
                        'search': value,
                    },
                    success: function (data) {
                        $("#patient_list").html(data);
                    }
                });
            });


            $("#patient_list").on('click', 'li', function () {
                var selectedValue = $(this).text();
                $("#patient_search").val(selectedValue);
                $("#patient_list").html("");
            });
        });


    </script>
    {{-- Department Select Dr field show Doctor   --}}
    <script>
        $('#department_id').on('change', function() {
            var departmentId = $(this).val();

            if (departmentId) {
                $.ajax({
                    url: '{{ route('get.doctors') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: { department_id: departmentId },
                    success: function(data) {
                        $('#doctor_id').empty();

                        if (data.length > 0) {
                            $.each(data, function(index, doctor) {
                                $('#doctor_id').append($('<option>', {
                                    value: doctor.id,
                                    text: doctor.dr_name
                                }));
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "No doctor available"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "No Department Selected"
                });
            }
        });






    </script>
    {{-- Schedule date Select Show Schedule date and availabe or not   --}}
    <script>

        $(document).ready(function() {

            $('#doctor_id').select2();

            $('#doctor_id, #appointment_date').on('change', function() {
                var doctorId = $('#doctor_id').val();
                var appointmentDate = $('#appointment_date').val();

                if (doctorId && appointmentDate) {
                    $.ajax({
                        url: '{{ route('get.schedules') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: { doctor_id: doctorId, appointment_date: appointmentDate },
                        success: function(data) {
                            $('#schedule_id').empty();
                            if (!data.schedulesEmpty) {
                                $.each(data.schedules, function(index, schedule) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Match',
                                        text: 'schedules available'
                                    });
                                    $('#schedule_id').append($('<option>', {
                                        value: schedule.id,
                                        text: schedule.schedule_days + ' (' + schedule.start_time + ' - ' + schedule.end_time + ')'
                                    }));
                                });

                                $('#schedule_id').trigger('change');
                            } else {
                                $('#schedule_id').append($('<option>', {
                                    value: '',
                                    text: '<-- No schedules available -->'
                                }));
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No schedules available'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    // Handle the case when doctorId or appointmentDate is not selected
                    $('#schedule_id').empty().append($('<option>', {
                        value: '',
                        text: 'No schedules available'
                    }));

                    // Remove any previously added error message
                    $('#schedule_id_error').empty();
                }
            });
        });

    </script>



    <!--begin::Vendors Javascript(used for this page only)-->
    {{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
    <script src="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.js"></script>


    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('/') }}assets/js/custom/apps/ecommerce/catalog/categories.js"></script>
    <script src="{{ asset('/') }}assets/js/widgets.bundle.js"></script>
    <script src="{{ asset('/') }}assets/js/custom/widgets.js"></script>
    <script src="{{ asset('/') }}assets/js/custom/apps/chat/chat.js"></script>
    <script src="{{ asset('/') }}assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="{{ asset('/') }}assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="{{ asset('/') }}assets/js/custom/utilities/modals/new-address.js"></script>
    <script src="{{ asset('/') }}assets/js/custom/utilities/modals/users-search.js"></script>



    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2(
                {
                    // placeholder: 'Select Options ',
                }
            );


            $('.js-example-basic-multiple').select2({
                placeholder: 'Select Days'
            });

        });
    </script>

@endsection





