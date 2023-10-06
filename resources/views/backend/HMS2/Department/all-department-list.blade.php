@extends('backend.layouts.app')

@section('title', 'Department')

@section('style')
    <link href="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section('body')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-3">
                    Department List
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Department
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Manage List
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">

            <div class="card card-flush">
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
                                   placeholder="Search Service"/>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a class="btn btn-primary" id="add_service_button" data-bs-toggle="modal"
                           data-bs-target="#kt_modal_new_address">
                            Add department
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
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                           data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1"/>
                                </div>
                            </th>
                            <th class="min-w-50px ps-5">id</th>
                            <th class="min-w-150px ps-5">Department Image</th>
                            <th class="min-w-100px">Department Name</th>
                            <th class="min-w-100px">Department Type</th>
                            <th class="min-w-100px">Status</th>
                            <th class="text-end min-w-70px pe-5">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">

                        @foreach($departments as $department)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1"/>
                                    </div>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ $department->image ? asset( $department->image  ) : asset('assets/media/avatars/avater.jpg') }}" alt="" style="width: 60px; height: 60px;" class="image-thumbnail rounded-circle"></td>
                                <td>{{ $department->department_name }}</td>
                                <td>{{ $department->department_type }}</td>
                                <td>
                                    <a href="{{ route('departments.status', encrypt($department->id)) }}" id="status-change">
                                        <div class="badge {{$department->status === 1 ? 'badge-light-success' : 'badge-light-danger' }}">{{  $department->status === 1 ? 'Active' : 'Deactivated'}}</div>
                                    </a>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                       data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div  class="menu-item px-3 mb-1">
                                            <a href="{{ route('departments.edit', encrypt($department->id)) }}" class="menu-link px-3 bg-light-primary text-primary ">

                                                <i class="fa fa-edit me-2 text-primary"></i>Edit
                                            </a>
                                        </div>

                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 bg-light-warning text-warning">
                                                <i class="fa fa-eye text-info me-2"></i>View
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" onclick="deleteItem({{ $department->id }})" class="menu-link px-3 bg-light-danger text-danger">
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
        <div class="modal-dialog modal-dialog-top mw-850px">
            <div class="modal-content">
                <form class="form"  action="{{ route('departments.store') }}" method="post" id="add_department_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h3 class="text-center mx-auto">Add New Department</h3>
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
                                <div class="col-8 fv-row">
                                    <label for="department_name" class="required fs-5 fw-semibold mb-2">Department name</label>
                                    <input id="department_name" value="{{ old('department_name') }}" type="text" class="form-control form-control-solid" placeholder="Department name" name="department_name" autofocus/>
                                    <div class="text-danger my-1" id="department_name_error"></div>
                                </div>

{{--                                @error('department_name')--}}
{{--                                    <div class="text-danger mt-1">{{ $message }}</div>--}}
{{--                                @enderror--}}
                            <!--begin::Input group Department Type-->
                                <div class="col-4 fv-row">
                                    <label for="department_type" class="required fs-5 fw-semibold mb-2">Department Type</label>
                                    <select name="department_type" id="" class="form-control selected">
                                        <option value="doctor">Doctor</option>
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
                                    <textarea name="department_description" id="" class="form-control" cols="30" rows="2" placeholder="Department description">{{ old('department_description') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="form-group">
                                    <label for="department_type" class="fs-5 fw-semibold mb-2">Upload Department Picture</label>
                                    <div class="image-upload form-control">
                                        <input type="file" name="image" id="">
                                    </div>
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
                    form.action = '/departments/destroy/' + id;
                    form.submit();
                }
            })
        }
    </script>

    <script>
        {{--        Add Client review--}}
        $(document).ready(function () {
            $("#add_department_form").on("submit", function (e) {
                e.preventDefault();

                $(".text-danger").text('');
                const formData = new FormData($(this)[0]);


                $("#submitBtn .indicator-label").text("Adding...");
                $("#submitBtn .indicator-progress").show();

                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
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
                            // $("#submit_button").hide();
                            //
                            // setTimeout(function () {
                            //     location.reload();
                            // }, 1000);
                        }
                        // $("#add_department_form")[0].reset();
                        // $(".modal").modal('hide');
                         // $(".table").load(location.href+' .table');
                        // $('.table').DataTable().ajax.reload();

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


    //    Status Change
        // Example using jQuery for AJAX

    </script>


    <!--begin::Vendors Javascript(used for this page only)-->
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

@endsection


