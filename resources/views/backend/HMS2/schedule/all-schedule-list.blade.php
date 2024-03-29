@extends('backend.layouts.app')

@section('title', 'Schedule')

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
                    Schedule List
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Schedule
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Schedule List
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
                                   placeholder="Search Schedule"/>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a class="btn btn-primary" id="add_service_button" data-bs-toggle="modal"
                           data-bs-target="#kt_modal_new_address">
                            Add Schedule
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
                            <th class="min-w-50px ps-5">Schedule id</th>
                            <th class="min-w-100px ps-5">Doctor Name</th>
                            <th class="min-w-100px">Fees</th>
                            <th class="min-w-100px">Days</th>
                            <th class="min-w-50px">Visiting hour</th>
                            <th class="min-w-50px">Status</th>
                            <th class="text-end min-w-70px pe-5">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">

                        @foreach($schedules as $schedule)
                            <tr id="schedule_ids{{ $schedule->id }}">
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                        <input class="form-check-input" name="ids" class="checkbox-ids" type="checkbox" value="{{ $schedule->id }}"/>
                                    </div>
                                </td>
                                <td>{{ $schedule->id}}</td>

                                @if ($schedule->doctor)
                                    <td>{{ $schedule->doctor->dr_name }}</td>
                                @else
                                    <td>Null</td>
                                @endif

                                <td><strong>New Patient: </strong><span class="text-success">{{ $schedule->new_patient_fee }} Tk</span><br>
                                    <strong>Old Patient: </strong><span class="text-info">{{ $schedule->old_patient_fee }} Tk</span><br>
                                    <strong>Report: </strong><span class="text-warning">{{ $schedule->report_fee }} Tk</span></strong><br>
                                </td>
                                <td>{{ $schedule->schedule_days  }}</td>

                                <td>

                                    <strong>Start Time: </strong><span class="text-success">{{ \Carbon\Carbon::parse( $schedule->start_time )->format('h:i A')}}</span><br>
                                    <strong>Start Time: </strong><span class="text-danger">{{ \Carbon\Carbon::parse( $schedule->end_time )->format('h:i A')}}</span><br>
                                </td>
                                <td>
                                    <a href="{{ route('schedules.status', encrypt($schedule->id)) }}" id="status-change">
                                        <div class="badge {{ $schedule->status === 1 ? 'badge-light-success' : 'badge-light-danger' }}">{{  $schedule->status === 1 ? 'Active' : 'Deactivated'}}</div>
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
                                            <a href="{{ route('schedules.edit',encrypt($schedule->id)) }}" class="menu-link px-3 bg-light-primary text-primary ">

                                                <i class="fa fa-edit me-2 text-primary"></i>Edit
                                            </a>
                                        </div>

                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 bg-light-warning text-warning">
                                                <i class="fa fa-eye text-info me-2"></i>View
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" onclick="deleteItem({{ $schedule->id }})" class="menu-link px-3 bg-light-danger text-danger">
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
                <form class="form" method="post" action="{{ route('schedules.store') }}"  id="add_schedule_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h3 class="text-center mx-auto">Add New Schedule</h3>
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
                                    <label for="doctor_id" class="required fs-5 fw-semibold mb-2">Doctor Name</label>
                                    <select name="doctor_id" id="" class="js-example-basic-single form-control">
                                        <option value="" selected> </option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->dr_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger my-1" id="doctor_id_error"></div>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="schedule_days" class="required fs-5 fw-semibold mb-2">Select Days</label>
                                    <select name="schedule_days[]" id="schedule_days" multiple="multiple" class="js-example-basic-multiple form-control">
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                    </select>
                                    <div class="text-danger my-1" id="schedule_days_error"></div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="start_time" class="required fs-5 fw-semibold mb-2">Start Time</label>
                                    <input id="start_time" value="{{ old('start_time') }}" type="time" class="form-control form-control-solid"  name="start_time" autofocus/>
                                    <div class="text-danger my-1" id="start_time_error"></div>
                                </div>

                                <div class="col-6 fv-row">
                                    <label for="end_time" class="required fs-5 fw-semibold mb-2">End Time</label>
                                    <input id="end_time" value="{{ old('end_time') }}" type="time" class="form-control form-control-solid"  name="end_time" autofocus/>
                                    <div class="text-danger my-1" id="end_time_error"></div>
                                </div>
                            </div>
                            <!--begin::Input group Department Description-->
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="maximum_patient" class="fs-5 fw-semibold mb-2">Maximum Patient</label>
                                    <input id="maximum_patient" value="{{ old('maximum_patient') }}" type="text" class="form-control form-control-solid" placeholder="Maximum Patient" name="maximum_patient" autofocus/>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="new_patient_fee" class="fs-5 fw-semibold mb-2">New Patient Fee</label>
                                    <input id="new_patient_fee" value="{{ old('new_patient_fee') }}" type="text" class="form-control form-control-solid" placeholder="New Patient fee" name="new_patient_fee" autofocus/>
                                    <div class="text-danger my-1" id="new_patient_fee_error"></div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-6 fv-row">
                                    <label for="old_patient_fee" class="fs-5 fw-semibold mb-2">Old Patient Fee</label>
                                    <input id="old_patient_fee" value="{{ old('old_patient_fee') }}" type="text" class="form-control form-control-solid" placeholder="Old Patient fee" name="old_patient_fee" autofocus/>
                                </div>
                                <div class="col-6 fv-row">
                                    <label for="report_fee" class="fs-5 fw-semibold mb-2">Report Fee</label>
                                    <input id="report_fee" value="{{ old('report_fee') }}" type="text" class="form-control form-control-solid" placeholder="Report Fee" name="report_fee" autofocus/>
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

    <script>
                // Add Client review
        $(document).ready(function () {
            $("#add_schedule_form").on("submit", function (e) {
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
                            url: "{{ route('schedules.all-Delete') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                $.each(all_ids, function (key, val) {
                                    $('#schedule_ids' + val).remove();
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
                    placeholder: 'Select an Doctor name',
                }
            );

            $('.js-example-basic-multiple').select2({
                placeholder: 'Select Days'
            });

        });
    </script>

@endsection




