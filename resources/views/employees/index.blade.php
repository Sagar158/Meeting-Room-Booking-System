<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ $title }}"></x-page-heading>
        <x-right-side-button link="{{ route('employees.create') }}" title="{{ trans('system.create') }}" extraClass="float-right"></x-right-side-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                              <th>{{ trans('system.employee_name') }}</th>
                              <th>{{ trans('system.email') }}</th>
                              <th>{{ trans('system.phone') }}</th>
                              <th>{{ trans('system.department') }}</th>
                              <th>{{ trans('system.designation') }}</th>
                              <th>{{ trans('system.employment_status') }}</th>
                              <th>{{ trans('system.action') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("employees.fetch") }}',
                    columns: [
                        { data: 'employee_name', name: 'employee_name' },
                        { data: 'email', name: 'email' },
                        { data: 'phone_number', name: 'phone_number'},
                        { data: 'department', name: 'department'},
                        { data: 'designation', name: 'designation'},
                        { data: 'employment_status', name: 'employment_status'},
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
