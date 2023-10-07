@extends('backend.layouts.app')

@section('title', 'Edit Patient')

@section('style')
    <link href="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section('body')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-3">
                    Edit Doctor
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('patients.index') }}" class="text-muted text-hover-primary">Patient List</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Edit patient
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Content-->

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">

            <div class="card card-body shadow-lg">
                <form class="form" method="post" action="{{ route('patients.update', encrypt($patient->id)) }}"  id="edit_patient_form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h3 class="text-center mx-auto">Edit Patient</h3>

                    </div>
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->

                            <!--begin::Input group Department Name-->
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="patient_name" class="required fs-5 fw-semibold mb-2">Patient name</label>
                                    <input id="patient_name" value="{{ old('patient_name')  ?? $patient->patient_name }}" type="text" class="form-control form-control-solid" placeholder="Patient name" name="patient_name" autofocus/>
                                    <div class="text-danger my-1" id="patient_name_error"></div>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="patient_id" class="required fs-5 fw-semibold mb-2">Patient Id</label>
                                    <input id="patient_id" value="{{ old('patient_id')  ?? $patient->patient_id }}" type="text" class="form-control form-control-solid" placeholder="Patient Id" name="patient_id" autofocus readonly/>
                                    <div class="text-danger my-1" id="patient_id_error"></div>
                                </div>

                                <!--begin::Input group Department Type-->


                            </div>

                            <div class="row mb-5">

                                <div class="col-6 fv-row">
                                    <label for="patient_mobile" class="required fs-5 fw-semibold mb-2">Patient Mobile</label>
                                    <input id="patient_mobile" value="{{ old('patient_mobile') ?? $patient->patient_mobile }}" type="number" class="form-control form-control-solid" placeholder="Patient Mobile" name="patient_mobile" autofocus/>
                                    <div class="text-danger my-1" id="patient_mobile_error"></div>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="patient_email" class=" fs-5 fw-semibold mb-2">Patient Email</label>
                                    <input id="patient_email" value="{{ old('patient_email') ?? $patient->patient_email}}" type="email" class="form-control form-control-solid" placeholder="Patient Email" name="patient_email" autofocus/>

                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="patient_gender" class="required fs-5 fw-semibold mb-2">Patient Gender / Sex</label>

                                    <select name="patient_gender" id="" class="js-example-basic-single form-control">
                                        <option value="" selected>  </option>
                                        <option value="male" {{ $patient->patient_gender == 'male' ? 'selected' : '' }} >Male</option>
                                        <option value="female" {{ $patient->patient_gender == 'female' ? 'selected' : '' }} >Female</option>
                                        <option value="other" {{ $patient->patient_gender == 'other' ? 'selected' : '' }} >Other</option>
                                    </select>
                                    <div class="text-danger my-1" id="patient_gender_error"></div>
                                </div>

                                <div class="col-6 fv-row">
                                    <label for="" class="fs-5 fw-semibold mb-2">Patient Blood Group</label>

                                    <select name="patient_blood_group" id="" class="js-example-basic-single form-control">
                                        <option value="" selected> </option>
                                        <option value="A+" {{ $patient->patient_blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ $patient->patient_blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ $patient->patient_blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ $patient->patient_blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="AB+"{{ $patient->patient_blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-"{{ $patient->patient_blood_group == 'AB+' ? 'selected' : '' }}>AB-</option>
                                        <option value="O+" {{ $patient->patient_blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ $patient->patient_blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="patient_age" class="required fs-5 fw-semibold mb-2">Patient Age</label>
                                    <input id="patient_age" value="{{ old('patient_age') ?? $patient->patient_age }}" type="number" class="form-control form-control-solid" placeholder="Patient Age" name="patient_age" autofocus/>
                                    <div class="text-danger my-1" id="patient_age_error"></div>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="" class="fs-5 fw-semibold mb-2">Unit</label>
                                    <select name="unit" id="" class="js-example-basic-single form-control">
                                        <option value="years" {{ $patient->unit == 'years' ? 'selected' : '' }}>Years</option>
                                        <option value="month" {{ $patient->unit == 'month' ? 'selected' : '' }}>Month</option>
                                        <option value="day" {{ $patient->unit == 'day' ? 'selected' : '' }}>Day</option>
                                    </select>
                                </div>

                            </div>
                            <!--begin::Input group Department Description-->
                            <div class="row mb-5">
                                <div class="col-12 fv-row">
                                    <label for="patient_address" class=" fs-5 fw-semibold mb-2">Patient Address</label>
                                    <textarea name="patient_address" id="" class="form-control" cols="30" rows="2" placeholder="Patient Address">{{ old('patient_address') ?? $patient->patient_address }}</textarea>
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
            $("#edit_patient_form").on("submit", function (e) {
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
                                    window.location.href = '{{ route('patients.index') }}';
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





