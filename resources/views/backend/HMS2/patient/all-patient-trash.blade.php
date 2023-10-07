@extends('backend.layouts.app')

@section('title', 'Patients Trash')

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
                    Patients Trash List
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('patients.index') }}" class="text-muted text-hover-primary">Show All Patients</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Patients Trash List
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
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="" class="py-5" href="" id="select-data-restore" data-bs-original-title="Selected Restore" aria-label="Delete Selected"><i class="fas fa-undo fs-2x text-success"></i></a>
                        </li>
                        <li class="nav-link">

                            {{--                            <a href="" class=""><i class="fa fa-trash fs-2x text-danger"></i></a>--}}

                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="" class="delete-btn-group py-5" id="select-force-delete" href="" data-bs-original-title="Delete Selected" aria-label="Delete Selected"><i class="fa fa-trash fs-2x text-danger"></i></a>
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
                                   placeholder="Search patient"/>
                        </div>
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
                            <th class="min-w-50px ps-5">id</th>
                            <th class="min-w-100px ps-5">Patient Name</th>
                            <th class="min-w-100px ps-5">Mobile</th>
                            <th class="min-w-100px">Sex/Gender</th>
                            <th class="min-w-100px">Blood Group</th>
                            <th class="min-w-50px">Age</th>
                            <th class="min-w-50px">Address</th>
                            <th class="text-end min-w-100px pe-5">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">

                        @foreach($patients as $patient)
                            <tr id="patients_ids{{ $patient->id }}">
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" name="ids" class="checkbox-ids" type="checkbox" value="{{ $patient->id }}"/>
                                    </div>
                                </td>
                                <td>{{ $patient->patient_id}}</td>
                                <td>{{ $patient->patient_name }}</td>
                                <td>{{ $patient->patient_mobile }}</td>
                                <td>{{ $patient->patient_gender }}</td>
                                <td>{{ $patient->patient_blood_group }}</td>
                                <td>{{ $patient->patient_age }} {{ $patient->unit }}</td>
                                <td>{{ $patient->patient_address }}</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                       data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div  class="menu-item px-3 mb-1">
                                            <a href="{{ route('patients.restore', encrypt($patient->id)) }}" class="menu-link px-3 bg-light-success text-success ">

                                                <i class="fas fa-undo me-2 text-success"></i>Restore
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" onclick="deleteItem({{ $patient->id }})" class="menu-link px-3 bg-light-danger text-danger">
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
                    form.action = 'permanent-delete/' + id;
                    form.submit();
                }
            })
        }
    </script>



    {{-- Restore Selected field--}}
    <script>
        $(document).ready(function() {
            $('#select-all-checkbox').on('click', function() {
                $('.checkbox-ids').prop('checked', $(this).prop('checked'));
            });

            $("#select-data-restore").on('click', function (e) {
                e.preventDefault();

                let all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function () {
                    all_ids.push($(this).val());
                });

                // Add a SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User clicked "Yes, delete it!" in the confirmation dialog
                        $.ajax({
                            url: "{{ route('patients.all-restore') }}",
                            type: "get",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                $.each(all_ids, function (key, val) {
                                    $('#patients_ids' + val).remove();
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    {{--Forece Delete  Selected field--}}
    <script>
        $(document).ready(function() {
            $('#select-all-checkbox').on('click', function() {
                $('.checkbox-ids').prop('checked', $(this).prop('checked'));
            });

            $("#select-force-delete").on('click', function (e) {
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
                    confirmButtonText: 'Yes, Permanent Delete  it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User clicked "Yes, delete it!" in the confirmation dialog
                        $.ajax({
                            url: "{{ route('patients.select-permanent-delete') }}",
                            type: "post",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                $.each(all_ids, function (key, val) {
                                    $('#patients_ids' + val).remove();
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







@endsection





