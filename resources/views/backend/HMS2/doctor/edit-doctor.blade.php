@extends('backend.layouts.app')

@section('title', 'Edit Doctor')

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
                        <a href="{{ route('doctors.index') }}" class="text-muted text-hover-primary">Doctor List</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Edit Doctor
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Content-->

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">

            <div class="card card-body shadow-lg">
                <form class="form" method="post" action="{{ route('doctors.update', encrypt($doctor->id)) }}"  id="edit_doctor_form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h3 class="text-center mx-auto">Edit Doctor</h3>

                    </div>
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">

                        <!--begin::Input group Department Name-->
                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="dr_name" class="required fs-5 fw-semibold mb-2">Doctor name</label>
                                <input id="dr_name" value="{{ old('dr_name') ?? $doctor->dr_name }}" type="text" class="form-control " placeholder="Doctor name" name="dr_name" autofocus/>
                                <div class="text-danger my-1" id="dr_name_error"></div>
                            </div>

                            <!--begin::Input group Department Type-->
                            <div class="col-6 fv-row">
                                <label for="dr_department" class="required fs-5 fw-semibold mb-2">Doctor Department</label>

                                <select name="dr_department" id="" class="js-example-basic-single form-control">
                                    <option value="" selected> </option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $department->id == $doctor->dr_department ? 'Selected' : ' ' }} >
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-danger my-1" id="dr_department_error"></div>
                            </div>

                        </div>
                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="dr_designation" class="required fs-5 fw-semibold mb-2">Doctor Designation</label>
                                <input id="dr_designation" value="{{ old('dr_designation') ?? $doctor->dr_designation }}" type="text" class="form-control " placeholder="Doctor Designation" name="dr_designation" autofocus/>
                                <div class="text-danger my-1" id="dr_designation_error"></div>
                            </div>

                            <!--begin::Input group Department Type-->
                            <div class="col-6 fv-row">
                                <label for="dr_phone" class="required fs-5 fw-semibold mb-2">Doctor Phone</label>
                                <input id="dr_phone" value="{{ old('dr_phone') ?? $doctor->dr_phone }}" type="number" class="form-control " placeholder="Doctor Phone" name="dr_phone" autofocus/>
                                <div class="text-danger my-1" id="dr_phone_error"></div>
                            </div>

                        </div>
                        <!--begin::Input group Department Description-->
                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="dr_email" class="fs-5 fw-semibold mb-2">Doctor Email</label>
                                <input id="dr_email" value="{{ old('dr_email') ?? $doctor->dr_email }}" type="email" class="form-control " placeholder="Doctor Email" name="dr_email" autofocus/>
                                <div class="text-danger my-1" id="dr_email_error"></div>
                            </div>
                            <div class="col-6 fv-row">
                                <label for="dr_biography" class=" fs-5 fw-semibold mb-2">Doctor Biography</label>
                                <textarea name="dr_biography" id="" class="form-control" cols="30" rows="2" placeholder="Doctor Biography">{{ old('dr_biography') ?? $doctor->dr_biography }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="dr_specialization" class=" fs-5 fw-semibold mb-2">Doctor Specialization</label>
                                <textarea name="dr_specialization" id="" class="form-control" cols="30" rows="2" placeholder="Doctor Specialization">{{ old('dr_specialization') ?? $doctor->dr_specialization }}</textarea>
                            </div>
                            <div class="col-6 fv-row">
                                <label for="dr_experience" class=" fs-5 fw-semibold mb-2">Doctor Experience</label>
                                <textarea name="dr_experience" id="" class="form-control" cols="30" rows="2" placeholder="Doctor Experience">{{ old('dr_experience') ?? $doctor->dr_experience }}</textarea>
                            </div>

                        </div>

                        <div class="row mb-5">
                            <div class="col-6 fv-row">
                                <label for="dr_qualification" class=" fs-5 fw-semibold mb-2">Doctor Qualification</label>
                                <textarea name="dr_qualification" id="" class="form-control" cols="30" rows="2" placeholder="Doctor Qualification">{{ old('dr_qualification') ?? $doctor->dr_qualification }}</textarea>
                            </div>
                            <div class="col-6 fv-row">
                                <div class="form-group">
                                    <label for="" class="fs-5 fw-semibold mb-2">Upload Doctor Picture</label>
                                    <div class=" form-control">
                                        <input type="file" name="image" id="">
                                    </div>

                                    <img src="{{ $doctor->image ? asset( $doctor->image  ) : asset('assets/media/avatars/avater.jpg') }}" class="py-3 image-fluid  object-fit-cover" alt="Doctor Image" style="height: 100px; width: 100px">
                                </div>
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
            $("#edit_doctor_form").on("submit", function (e) {
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
                                    window.location.href = '{{ route('doctors.index') }}';
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




