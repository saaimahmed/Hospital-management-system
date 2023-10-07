@extends('backend.layouts.app')

@section('title', 'Doctor')

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
                  Doctor List
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Doctor
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                      Doctor List
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">

            <div class="card card-flush">

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
                                   placeholder="Search Doctor"/>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a class="btn btn-primary" id="add_service_button" data-bs-toggle="modal"
                           data-bs-target="#kt_modal_new_address">
                            Add Doctor
                        </a>
                    </div>
                </div>

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
{{--                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">--}}
{{--                                    <input class="form-check-input" type="checkbox" data-kt-check="true"--}}
{{--                                           data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1"/>--}}
{{--                                </div>--}}
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" id="select-all-checkbox" />
                                    <label class="form-check-label" for="select-all-checkbox"></label>
                                </div>
                            </th>
                            <th class="min-w-50px ps-5">id</th>
                            <th class="min-w-100px ps-5">Doctor image</th>
                            <th class="min-w-100px ps-5">Doctor Name</th>
                            <th class="min-w-100px">Designation</th>
                            <th class="min-w-100px">Department</th>
                            <th class="min-w-50px">phone</th>
                            <th class="min-w-50px">Status</th>
                            <th class="text-end min-w-70px pe-5">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">

                        @foreach($doctors as $doctor)
                            <tr id="doctor_ids{{ $doctor->id }}">
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                        <input class="form-check-input" name="ids" class="checkbox-ids" type="checkbox" value="{{ $doctor->id }}"/>
                                    </div>
                                </td>
                                <td>{{ $doctor->dr_id}}</td>
                                <td><img src="{{ $doctor->image ? asset( $doctor->image  ) : asset('assets/media/avatars/avater.jpg') }}" alt="" style="width: 60px; height: 60px;" class="image-thumbnail rounded-circle object-fit-cover"></td>
                                <td>{{ $doctor->dr_name }}</td>
                                <td>{{ $doctor->dr_designation }}</td>
                                <td>{{ $doctor->dr_department }}</td>
                                <td>{{ $doctor->dr_phone }}</td>
                                <td>
                                    <a href="{{ route('doctors.status', encrypt($doctor->id)) }}" id="status-change">
                                        <div class="badge {{ $doctor->status === 1 ? 'badge-light-success' : 'badge-light-danger' }}">{{  $doctor->status === 1 ? 'Active' : 'Deactivated'}}</div>
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
                                            <a href="{{ route('doctors.edit', encrypt($doctor->id)) }}" class="menu-link px-3 bg-light-primary text-primary ">

                                                <i class="fa fa-edit me-2 text-primary"></i>Edit
                                            </a>
                                        </div>

                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 bg-light-warning text-warning">
                                                <i class="fa fa-eye text-info me-2"></i>View
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" onclick="deleteItem({{ $doctor->id }})" class="menu-link px-3 bg-light-danger text-danger">
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
                <form class="form" method="post" action="{{ route('doctors.store') }}"  id="add_doctor_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h3 class="text-center mx-auto">Add New Doctor</h3>
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
                                <div class="col-6 fv-row">
                                    <label for="dr_name" class="required fs-5 fw-semibold mb-2">Doctor name</label>
                                    <input id="dr_name" value="{{ old('dr_name') }}" type="text" class="form-control form-control-solid" placeholder="Doctor name" name="dr_name" autofocus/>
                                    <div class="text-danger my-1" id="dr_name_error"></div>
                                </div>

                            <!--begin::Input group Department Type-->
                                <div class="col-6 fv-row">
                                    <label for="dr_department" class="required fs-5 fw-semibold mb-2">Doctor Department</label>

                                    <select name="dr_department" id="" class="js-example-basic-single form-control">
                                        <option value="" selected> </option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger my-1" id="dr_department_error"></div>
                                </div>

                            </div>
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="dr_designation" class="required fs-5 fw-semibold mb-2">Doctor Designation</label>
                                    <input id="dr_designation" value="{{ old('dr_designation') }}" type="text" class="form-control form-control-solid" placeholder="Doctor Designation" name="dr_designation" autofocus/>
                                    <div class="text-danger my-1" id="dr_designation_error"></div>
                                </div>

                            <!--begin::Input group Department Type-->
                                <div class="col-6 fv-row">
                                    <label for="dr_phone" class="required fs-5 fw-semibold mb-2">Doctor Phone</label>
                                    <input id="dr_phone" value="{{ old('dr_phone') }}" type="number" class="form-control form-control-solid" placeholder="Doctor Phone" name="dr_phone" autofocus/>
                                    <div class="text-danger my-1" id="dr_phone_error"></div>
                                </div>

                            </div>
                            <!--begin::Input group Department Description-->
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="dr_email" class="fs-5 fw-semibold mb-2">Doctor Email</label>
                                    <input id="dr_email" value="{{ old('dr_email') }}" type="email" class="form-control form-control-solid" placeholder="Doctor Email" name="dr_email" autofocus/>
                                    <div class="text-danger my-1" id="dr_email_error"></div>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="dr_biography" class=" fs-5 fw-semibold mb-2">Doctor Biography</label>
                                    <textarea name="dr_biography" id="" class="form-control" cols="30" rows="2" placeholder="Doctor Biography">{{ old('dr_biography') }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="dr_specialization" class=" fs-5 fw-semibold mb-2">Doctor Specialization</label>
                                    <textarea name="dr_specialization" id="" class="form-control" cols="30" rows="2" placeholder="Doctor Specialization">{{ old('dr_specialization') }}</textarea>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="dr_experience" class=" fs-5 fw-semibold mb-2">Doctor Experience</label>
                                    <textarea name="dr_experience" id="" class="form-control" cols="30" rows="2" placeholder="Doctor Experience">{{ old('dr_experience') }}</textarea>
                                </div>

                            </div>

                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="dr_qualification" class=" fs-5 fw-semibold mb-2">Doctor Qualification</label>
                                    <textarea name="dr_qualification" id="" class="form-control" cols="30" rows="2" placeholder="Doctor Qualification">{{ old('dr_qualification') }}</textarea>
                                </div>
                                <div class="col-6 fv-row">
                                    <div class="form-group">
                                        <label for="" class="fs-5 fw-semibold mb-2">Upload Doctor Picture</label>
                                        <div class=" form-control">
                                            <input type="file" name="image" id="">
                                        </div>
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
                    form.action = 'destroy/' + id;
                    form.submit();
                }
            })
        }
    </script>
    {{--        Add Doctor --}}
    <script>

        $(document).ready(function () {
            $("#add_doctor_form").on("submit", function (e) {
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

                        // Change the button text to "Adding..."
                        $("#submitBtn .indicator-label").text("Adding...");
                        $("#submitBtn .indicator-progress").show();

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

    <script>
{{--  deleted All Selected field--}}
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
                            url: "{{ route('doctors.all-Delete') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                $.each(all_ids, function (key, val) {
                                    $('#doctor_ids' + val).remove();
                                });
                            }
                        });
                    }
                });
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
                    placeholder: 'Select an Doctor department',
                }
            );

            $('.js-example-basic-multiple').select2({
                placeholder: 'Select Title'
            });

        });
    </script>

@endsection



