@php
    $route = (!isset($employee->id) ? route('employees.store') : route('employees.update',$employee->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ $title }}"></x-page-heading>
        <x-back-button></x-back-button>
        <div class="container-fluid card mt-3">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                    <div id="alert-message" class="alert alert-success d-none"></div>
                </div>
            </div>
            <form id="employeeForm" action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name', $employee->first_name)" required autocomplete="off" placeholder="{{ trans('system.first_name') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name', $employee->last_name)" required autocomplete="off" placeholder="{{ trans('system.last_name') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="email" type="email" name="email" :value="old('email', $employee->email)" required autocomplete="off" placeholder="{{ trans('system.email') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="phone_number" type="text" name="phone_number" :value="old('phone_number', $employee->phone_number)" required autocomplete="off" placeholder="{{ trans('system.phone') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="gender" name="gender" :value="old('gender', $employee->gender)" :values="\App\Models\Employee::$gender" autocomplete="off" placeholder="{{ trans('system.gender') }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="date_of_birth" type="date" name="date_of_birth" :value="old('date_of_birth', $employee->date_of_birth)" required autocomplete="off" placeholder="{{ trans('system.date_of_birth') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="employment_status" name="employment_status" :value="old('employment_status', $employee->employment_status)" :values="\App\Models\Employee::$employeeStatus" autocomplete="off" placeholder="{{ trans('system.employment_status') }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="department_id" name="department_id" value="{{ $employee->department_id }}" autocomplete="off" placeholder="{{ trans('system.department') }}" extraClass="ajax-endpoint departments" endpoint="{{ route('departments.fetch') }}" optionText="{{ (old('department_id') || isset($employee->department_id)) ? \App\Models\Department::findorFail($employee->department_id)->name : '' }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="designation_id" name="designation_id" value="{{ $employee->designation_id }}" autocomplete="off" placeholder="{{ trans('system.designation') }}" extraClass="ajax-endpoint designations" endpoint="{{ route('designations.fetch') }}" optionText="{{ (old('designation_id') || isset($employee->designation_id)) ? \App\Models\Designation::findorFail($employee->designation_id)->name : '' }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="country_id" name="country_id" value="{{ $employee->country_id }}" autocomplete="off" placeholder="{{ trans('system.country') }}" extraClass="ajax-endpoint countries" endpoint="{{ route('countries.fetch') }}" optionText="{{ (old('country_id') || isset($employee->country_id)) ? \App\Models\Countries::findorFail($employee->country_id)->name : '' }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="city_id" name="city_id" value="{{ $employee->city_id }}" autocomplete="off" placeholder="{{ trans('system.city') }}" extraClass="ajax-endpoint cities" endpoint="{{ route('cities.fetch') }}" optionText="{{ (old('city_id') || isset($employee->city_id)) ? \App\Models\Cities::findorFail($employee->city_id)->name : '' }}" field1="{{ $employee->country_id }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="date_of_joining" type="date" name="date_of_joining" :value="old('date_of_joining', $employee->date_of_joining)" required autocomplete="off" placeholder="{{ trans('system.date_of_joining') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="address" type="text" name="address" :value="old('address', $employee->address)" required autocomplete="off" placeholder="{{ trans('system.address') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="reporting_manager" type="text" name="reporting_manager" :value="old('reporting_manager', $employee->reporting_manager)" required autocomplete="off" placeholder="{{ trans('system.reporting_manager') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="salary" type="number" name="salary" :value="old('salary', $employee->salary)" required autocomplete="off" placeholder="{{ trans('system.salary') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="employment_type" name="employment_type" :value="old('employment_type', $employee->employment_type)" :values="\App\Models\Employee::$employmentType" autocomplete="off" placeholder="{{ trans('system.employment_type') }}" required/>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="profile_image" type="file" name="profile_image" extraClass="myDropify" autocomplete="off" placeholder="{{ trans('system.profile_image') }}"/>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function(){
                @if(isset($employee->profile_image))
                    $('.dropify-render').html('<img src="{{ asset($employee->profile_image) }}">')
                    $('.dropify-preview').css('display','block');
                @endif
                $(document).on('change', '.countries', function() {
                    var selectedCountry = $(this).val();
                    var $citiesSelect = $(this).parent().parent().next().find('.cities');
                    $citiesSelect.attr('data-field1-id', selectedCountry);
                    destroySelect2($citiesSelect, 'Select City');
                });

                $(document).on('submit','#employeeForm', function (e) {
                    e.preventDefault();

                    // Get form data
                    var formData = new FormData(this);

                    // Clear previous error messages
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback-error').remove();
                    $('#alert-message').addClass('d-none').text('');

                    // Disable the submit button
                    const submitButton = $(this).find('button[type="submit"]');
                    submitButton.prop('disabled', true);

                    // Perform AJAX request for validation and submission
                    $.ajax({
                        url: "{{ $route }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            // Optionally show a loading spinner
                            submitButton.text('Submitting...');
                        },
                        success: function (response) {
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                            $('#alert-message').removeClass('d-none alert-danger').addClass('alert-success').text(response.success || 'Employee created successfully!');
                            $('#employeeForm')[0].reset();
                            submitButton.prop('disabled', false).text('Save');
                            // Redirect after 2 seconds
                            setTimeout(function () {
                                window.location.href = "{{ route('employees.index') }}";
                            }, 2000);
                        },
                        error: function (xhr) {
                            // If validation fails, show the error messages
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                for (var field in errors) {
                                    var inputField = $(`[name="${field}"]`);
                                    var formGroup = inputField.closest('.col-lg-4, .col-sm-12, .col-md-4'); // Adjust this selector based on your form layout

                                    // Mark the input as invalid and add the error message
                                    inputField.addClass('is-invalid');
                                    formGroup.append(`<div class="invalid-feedback-error">${errors[field][0]}</div>`);
                                }
                            } else {
                                // Display general error message
                                $('#alert-message').removeClass('d-none alert-success').addClass('alert-danger').text('An unexpected error occurred. Please try again.');
                            }
                            submitButton.prop('disabled', false).text('Save');
                        }
                    });
                });

            });
        </script>
    @endpush
</x-app-layout>
