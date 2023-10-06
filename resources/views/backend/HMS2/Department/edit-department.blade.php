@extends('backend.layouts.app')

@section('title', 'Edit Department')

@section('style')
    <link href="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section('body')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-3">
                   Edit Department
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('departments.index') }}" class="text-muted text-hover-primary">Department List</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                       Edit Department
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Content-->

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">

            <div class="card card-body shadow-lg">
                <form class=""  action="{{ route('departments.update', encrypt($department->id)) }}" method="post" id="edit_department_form" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="" id="">
                        <h3 class="text-center mx-auto">Edit  Department</h3>

                    </div>
                    <!--begin::Modal body-->
                    <div class=" py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div
                            class="scroll-y me-n7 pe-7" id=""
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header"
                            data-kt-scroll-wrappers="#" data-kt-scroll-offset="300px">

                            <!--begin::Input group Department Name-->
                            <div class="row mb-5">
                                <div class="col-8 fv-row">
                                    <label for="department_name" class="required fs-5 fw-semibold mb-2">Department name</label>
                                    <input id="department_name" value="{{ $department->department_name }}" type="text" class="form-control " placeholder="Department name" name="department_name" autofocus/>
                                    <div class="text-danger my-1" id="department_name_error"></div>
                                </div>

                            {{--                                @error('department_name')--}}
                            {{--                                    <div class="text-danger mt-1">{{ $message }}</div>--}}
                            {{--                                @enderror--}}
                            <!--begin::Input group Department Type-->
                                <div class="col-4 fv-row">
                                    <label for="department_type" class="required fs-5 fw-semibold mb-2">Department Type</label>
                                    <select name="department_type" id="" class="form-control selected">
                                        <option value="doctor" {{ $department->department_type == 'Doctor' ? 'selected' : '' }} >Doctor</option>
                                    </select>
                                    <div class="text-danger my-1" id="department_type_error"></div>
                                </div>

                                {{--                                @error('department_type')--}}
                                {{--                                <div class="text-danger mt-1">{{ $message }}</div>--}}
                                {{--                                @enderror--}}
                            </div>
                            <!--begin::Input group Department Description-->
                            <div class="row mb-5">
                                <div class="col-12 fv-row">
                                    <label for="department_description" class=" fs-5 fw-semibold mb-2">Department Description</label>
                                    <textarea name="department_description" id="" class="form-control" cols="30" rows="2" placeholder="Department description">{{ $department->department_description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="form-group">
                                    <label for="department_type" class="fs-5 fw-semibold mb-2">Upload Department Picture</label>
                                    <div class="image-upload form-control">
                                        <input type="file" name="image" id="">
                                    </div>
                                    <img src="{{ $department->image ? asset( $department->image  ) : asset('assets/media/avatars/avater.jpg') }}" class="py-3" alt="Department Image" style="height: 100px; width: 100px">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        {{--                    <input type="submit" class="btn-success" value="Update">--}}
                        <button type="submit" id="updateBtn" class="btn btn-primary d-flex justify-content-center align-content-center">
                            <span class="indicator-label">Update</span>
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
            $("#edit_department_form").on("submit", function (e) {
                e.preventDefault();

                $(".text-danger").text('');
                const formData = new FormData($(this)[0]);

                $("#updateBtn .indicator-label").text("updating...");
                $("#updateBtn .indicator-progress").show();

                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST", // Change the method to POST for updating
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,

                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    window.location.href = '{{ route('departments.index') }}';
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

@endsection



