<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
      <link rel="shortcut icon" href="{{ asset('assets/images/laravel-2.svg') }}" />
      @stack('css')
   </head>
   <body>
        <div class="container">
            <div class="row">
                {{ $slot }}
            </div>
        </div>
        <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/template.js') }}"></script>
        <script src="{{ asset('assets/js/select2.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('assets/js/data-table.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
        @stack('scripts')
        <script src="{{ asset('assets/js/select-2.js') }}"></script>
        <script>
            $(document).ready(function(){
                refreshSelectBox();
            });
        </script>
    </body>
</html>
