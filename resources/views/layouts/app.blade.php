<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} : {{ isset($title) ? $title : '' }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        @if(Session::has('theme') && (Session::get('theme') == 'dark'))
            <link rel="stylesheet" href="{{ asset('assets/css/demo_2/style.css') }}">
        @else
            <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
        @endif
        <link rel="shortcut icon" href="{{ asset('/assets/images/laravel-2.svg') }}" type="image/x-icon">
        <!-- Scripts -->
        @stack('css')


    </head>
    <body class="font-sans antialiased">
        <div class="main-wrapper">
            <x-sidebar></x-sidebar>
            <x-settings-sidebar></x-settings-sidebar>
            <div class="page-wrapper">
                <x-header></x-header>
                <div class="page-content">
                    {{ $slot }}
                </div>
                <x-footer></x-footer>
            </div>
        </div>
    </body>

	<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
	<script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('assets/js/tinymce.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('assets/js/select-2.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#alert").fadeTo(5000, 500).slideUp(1000, function(){
                $("#alert").slideUp(100);
            });

            $(document).on('click','.delete-record',function(){
                var route = $(this).attr('data-route');
                Swal.fire({
                            title: "{{ trans('system.are_you_sure') }}",
                            text: "{{ trans('system.you_wont_be_able_to_revert_it') }}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "{{ trans('system.yes_delete_it') }}"
                            }).then((result) => {
                            if (result.isConfirmed)
                            {
                                $.ajax({
                                        url: route,
                                        method: 'POST',
                                        headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response)
                                        {

                                            if(response.success == 1)
                                            {

                                                notification("{{ trans('system.deleted') }}", "{{ trans('system.record_has_been_deleted_successfully') }}","success");

                                                $('#dataTable').DataTable().ajax.reload();
                                            }
                                            else
                                            {
                                                notification("{{ trans('system.oops') }}", "{{ trans('system.something_went_wrong') }}","error")
                                            }
                                        }
                                      });
                            }
                        });
            });

            $(document).on('click','.change-status',function(){
                var route = $(this).attr('data-route');
                Swal.fire({
                            title: "{{ trans('system.are_your_sure') }}",
                            text: "{{ trans('system.you_want_change_the_status') }}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "{{ trans('system.yes_change_it') }}"
                            }).then((result) => {
                            if (result.isConfirmed)
                            {
                                $.ajax({
                                        url: route,
                                        method: 'POST',
                                        headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response)
                                        {

                                            if(response.success == 1)
                                            {
                                                notification("{{ trans('system.changed') }}", "{{ trans('system.status_has_been_changed_successfully') }}", "success");
                                                $('#dataTable').DataTable().ajax.reload();
                                            }
                                            else
                                            {
                                                notification("OOPS!","{{ trans('system.something_went_wrong') }}","error");

                                            }
                                        }
                                      });
                            }
                        });
            });
            refreshSelectBox();
        });
    </script>


</html>
