@extends('backend.layouts.app')

@section('title', 'Edit Appointment')

@section('style')
    <link href="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section('body')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-3">
                    Edit Appointment
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('doctors.index') }}" class="text-muted text-hover-primary">Appointment List</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Edit Appointment
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Content-->

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">

            <div class="card card-body shadow-lg">
                <form class="form" method="post" action="{{ route('appointments.update',encrypt($appointment->id)) }}"  id="edit_appointment_form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h3 class="text-center mx-auto">Edit Appointment</h3>

                    </div>
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">

                        <div class="row mb-5">
                            <input type="hidden" name="doctor_id" value="{{ $appointment->doctor_id }}">
                            <div class="col-6 fv-row">
                                <label for="schedule_id" class="required fs-5 fw-semibold mb-2">Schedule</label>
                                <select name="schedule_id" id="schedule_id" class="form-control js-example-basic-single" >
                                    <option value=""><-- Select a schedule --></option>
                                    <option value="{{ $appointment->schedule_id }}" selected>{{ $appointment->schedule->schedule_days }} ({{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }})</option>
                                </select>
                                <div class="text-danger my-1" id="schedule_id_error"></div>
                            </div>

                            <div class="col-6 fv-row">
                                <label for="appointment_date" class="required fs-5 fw-semibold mb-2">Appointment Date</label>
                                <input type="date" name="appointment_date" id="appointment_date" value="{{ $appointment->appointment_date }}"  class="form-control">

                                <div class="text-danger my-1" id="appointment_date_error"></div>
                            </div>



                        </div>
                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="" class="required fs-5 fw-semibold mb-2">Patient Type</label>

                                <select name="patient_type" id="patient_type"  class="js-example-basic-single form-control"  data-placeholder="Select Patient Type">

                                    <option value="">-- Select a patient type --</option>
                                    <option value="new" {{ old ('patient_type') ?? $appointment->patient_type == 'new' ? 'selected' : '' }} >New</option>
                                    <option value="old" {{ old ('patient_type') ?? $appointment->patient_type == 'old' ? 'selected' : '' }}>Old</option>
                                    <option value="report" {{ old('patient_type') ?? $appointment->patient_type == 'report' ? 'selected' : '' }}>Report</option>

                                </select>
                                <div class="text-danger my-1" id="patient_type_error"></div>
                            </div>
                            <div class="col-6 fv-row">
                                <label for="" class="required fs-5 fw-semibold mb-2">Appointment Status</label>

                                <select name="status" id="status"  class="js-example-basic-single form-control"  data-placeholder="Select Appointment Status">

                                    <option value="">--Select--</option>
                                    <option value="pending" {{ old('status') ?? $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ old('status') ?? $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="waiting" {{ old('status') ?? $appointment->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                    <option value="hold" {{ old('status') ?? $appointment->status == 'hold' ? 'selected' : '' }}>Hold</option>
                                    <option value="canceled" {{ old('status') ?? $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    <option value="seen" {{ old('status')?? $appointment->status == 'seen' ? 'selected' : '' }}>Seen</option>

                                </select>
                                <div class="text-danger my-1" id="status_error"></div>
                            </div>
                        </div>
                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <button type="submit" id="updateBtn" class="btn btn-primary d-flex justify-content-center align-content-center">
                        <span class="indicator-label pt-2 text-white">Update
                        </span>
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
        {{--Edit---}}
        $(document).ready(function () {
            $("#edit_appointment_form").on("submit", function (e) {
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

                        $("#updateBtn .indicator-label").text("updating...");
                        $("#updateBtn .indicator-progress").show();

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
            $('.js-example-basic-single').select2();

            $('#appointment_date').on('change', function() {
                var appointmentDate = $('#appointment_date').val();
                var doctorId = $('input[name="doctor_id"]').val();

                if (appointmentDate && doctorId) {
                    $.ajax({
                        url: '{{ route('get.schedules') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: { doctor_id: doctorId, appointment_date: appointmentDate },
                        success: function(data) {
                            $('#schedule_id').empty();
                            if (data.schedules.length > 0) {
                                $.each(data.schedules, function(index, schedule) {
                                    $('#schedule_id').append($('<option>', {
                                        value: schedule.id,
                                        text: schedule.schedule_days + ' (' + schedule.start_time + ' - ' + schedule.end_time + ')'
                                    }));
                                });

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Match',
                                    text: 'Schedules available'
                                });
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
                            handleErrors(xhr, status, error);
                        }
                    });
                }
            });
        });



    </script>


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
                    // placeholder: '',
                }
            );

            $('.js-example-basic-multiple').select2({
                placeholder: 'Select Title'
            });

        });
    </script>
@endsection





