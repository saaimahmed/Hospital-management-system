@extends('backend.layouts.app')

@section('title', 'Edit Schedule')

@section('style')
    <link href="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section('body')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-3">
                    Edit Schedule
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('schedules.index') }}" class="text-muted text-hover-primary">Schedule List</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Edit Schedule
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Content-->

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">

            <div class="card card-body shadow-lg">
                <form class="form" method="post" action="{{ route('schedules.update', encrypt($schedule->id)) }}"  id="edit_schedule_form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h3 class="text-center mx-auto">Edit Schedule</h3>

                    </div>
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Input group Department Name-->
                        <div class="row mb-5">
                            <!--begin::Input group Department Type-->
                            <div class="col-6 fv-row">
                                <label for="doctor_id" class="required fs-5 fw-semibold mb-2">Doctor Name</label>
                                <select name="doctor_id" id="" class="js-example-basic-single form-control">
                                    <option value="" selected> </option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ $doctor->id == $schedule->doctor_id ? 'Selected' : '' }} >{{ $doctor->dr_name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger my-1" id="doctor_id_error"></div>
                            </div>
                            <div class="col-6 fv-row">
                                <label for="schedule_days" class="required fs-5 fw-semibold mb-2">Select Days</label>
                                <select name="schedule_days[]" id="schedule_days" multiple="multiple" class="js-example-basic-multiple form-control">
                                    <option value="Saturday" {{ $schedule->schedule_days == 'Saturday' ? 'Selected' : '' }}>Saturday</option>
                                    <option value="Sunday" {{ $schedule->schedule_days == 'Sunday' ? 'Selected' : '' }} >Sunday</option>
                                    <option value="Monday" {{ $schedule->schedule_days == 'Monday' ? 'Selected' : '' }} >Monday</option>
                                    <option value="Tuesday" {{ $schedule->schedule_days == 'Tuesday' ? 'Selected' : '' }}>Tuesday</option>
                                    <option value="Wednesday" {{ $schedule->schedule_days == 'Wednesday' ? 'Selected' : '' }}>Wednesday</option>
                                    <option value="Thursday" {{ $schedule->schedule_days == 'Thursday' ? 'Selected' : '' }}>Thursday</option>
                                    <option value="Friday" {{ $schedule->schedule_days == 'Friday' ? 'Selected' : '' }}>Friday</option>
                                </select>
                                <div class="text-danger my-1" id="schedule_days_error"></div>
                            </div>

                        </div>
                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="start_time" class="required fs-5 fw-semibold mb-2">Start Time</label>
                                <input id="start_time" value="{{ old('start_time') ?? $schedule->start_time }}" type="time" class="form-control form-control-solid"  name="start_time" autofocus/>
                                <div class="text-danger my-1" id="start_time_error"></div>
                            </div>

                            <div class="col-6 fv-row">
                                <label for="end_time" class="required fs-5 fw-semibold mb-2">End Time</label>
                                <input id="end_time" value="{{ old('end_time') ?? $schedule->end_time }}" type="time" class="form-control form-control-solid"  name="end_time" autofocus/>
                                <div class="text-danger my-1" id="end_time_error"></div>
                            </div>
                        </div>
                        <!--begin::Input group Department Description-->
                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="maximum_patient" class="fs-5 fw-semibold mb-2">Maximum Patient</label>
                                <input id="maximum_patient" value="{{ old('maximum_patient') ?? $schedule->maximum_patient }}" type="text" class="form-control form-control-solid" placeholder="Maximum Patient" name="maximum_patient" autofocus/>
                            </div>
                            <div class="col-6 fv-row">
                                <label for="new_patient_fee" class="fs-5 fw-semibold mb-2">New Patient Fee</label>
                                <input id="new_patient_fee" value="{{ old('new_patient_fee') ?? $schedule->new_patient_fee }}" type="text" class="form-control form-control-solid" placeholder="New Patient fee" name="new_patient_fee" autofocus/>
                                <div class="text-danger my-1" id="new_patient_fee_error"></div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="old_patient_fee" class="fs-5 fw-semibold mb-2">Old Patient Fee</label>
                                <input id="old_patient_fee" value="{{ old('old_patient_fee') ?? $schedule->old_patient_fee }}" type="text" class="form-control form-control-solid" placeholder="Old Patient fee" name="old_patient_fee" autofocus/>
                            </div>
                            <div class="col-6 fv-row">
                                <label for="report_fee" class="fs-5 fw-semibold mb-2">Report Fee</label>
                                <input id="report_fee" value="{{ old('report_fee')  ?? $schedule->report_fee }}" type="text" class="form-control form-control-solid" placeholder="Report Fee" name="report_fee" autofocus/>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer flex-center">
                        <button type="submit" id="updateBtn" class="btn btn-primary d-flex justify-content-center align-content-center">
                        <span class="indicator-label pt-2 text-white">Update
                        </span>
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>

                        </button>
                    </div>

                    <!--begin::Modal footer-->

                </form>
            </div>

        </div>
    </div>
@endsection


@section('js')


    <script>
        {{--Edit---}}
        $(document).ready(function () {
            $("#edit_schedule_form").on("submit", function (e) {
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
                                    window.location.href = '{{ route('schedules.index') }}';
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
                    placeholder: 'Select an Doctor department',
                }
            );

            $('.js-example-basic-multiple').select2({
                placeholder: 'Select Title'
            });

        });
    </script>
@endsection






