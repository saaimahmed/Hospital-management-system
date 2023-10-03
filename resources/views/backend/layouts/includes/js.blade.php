<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('/') }}assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ asset('/') }}assets/js/scripts.bundle.js"></script>

<script src="{{ asset('/') }}assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.js"></script>

<script>
    function logout(){
        document.querySelector('#logout_form').submit()
    }
</script>

@if(Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "Success",
            text: "{{ Session::get('success') }}",
            showConfirmButton: false,
            timer: 1000
        })
    </script>
@endif

@if(Session::has('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: "Hey..",
            text: "{{ Session::get('info') }}",
        })
    </script>
@endif

@if(Session::has('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: "Warning",
            text: "{{ Session::get('warning') }}",
            // showConfirmButton: false,
            // timer: 1500,
        })
    </script>
@endif

@if(Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ Session::get('error') }}!",
            // footer: '<a href="">Why do I have this issue?</a>'
        })
    </script>
@endif
