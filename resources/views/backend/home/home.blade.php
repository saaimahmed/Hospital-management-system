@extends('backend.layouts.app')

@section('title', 'Home')

@section('style')
    <link href="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section('body')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-3">
                    Main Dashboard
                </h1>

{{--                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">--}}
{{--                    <li class="breadcrumb-item text-muted">--}}
{{--                        <a href="" class="text-muted text-hover-primary">Dashboard</a>--}}
{{--                    </li>--}}
{{--                    <li class="breadcrumb-item">--}}
{{--                        <span class="bullet bg-gray-400 w-5px h-2px"></span>--}}
{{--                    </li>--}}
{{--                    <li class="breadcrumb-item text-muted">--}}
{{--                        Service--}}
{{--                    </li>--}}
{{--                    <li class="breadcrumb-item">--}}
{{--                        <span class="bullet bg-gray-400 w-5px h-2px"></span>--}}
{{--                    </li>--}}
{{--                    <li class="breadcrumb-item text-muted">--}}
{{--                        Manage--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </div>
        </div>
    </div>

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
                <h1>Hello</h1>
        </div>
    </div>
@endsection

@section('modal')

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
                    form.action = '//'+ id;
                    form.submit();
                }
            })
        }
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

