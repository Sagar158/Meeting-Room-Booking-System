<x-front-component>
    @push('css')
        <script src='{{ asset('assets/js/calendar.js') }}'></script>
    @endpush
    <div class="col-lg-12 col-sm-12 col-md-12 mt-5">
        <div class="card">
            <div class="card-header">
                <x-nav-button title="{{ trans('system.book_meeting') }}" target="#exampleModal"></x-nav-button>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ trans('system.book_meeting') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="bookMeeting">
                    {{ @csrf_field() }}

                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <x-text-input id="title" type="text" name="title" :value="old('title')" required autocomplete="off" placeholder="{{ trans('system.meeting_title') }}" />
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <x-text-input id="organizer" type="text" name="organizer" :value="old('organizer')" required autocomplete="off" placeholder="{{ trans('system.organizer') }}" />
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <x-text-input id="meeting_date" type="date" name="meeting_date" :value="old('meeting_date')" required autocomplete="off" placeholder="{{ trans('system.meeting_date') }}" />
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <x-text-input id="start_time" type="time" name="start_time" :value="old('start_time')" required autocomplete="off" placeholder="{{ trans('system.start_time') }}" />
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <x-text-input id="end_time" type="time" name="end_time" :value="old('end_time')" required autocomplete="off" placeholder="{{ trans('system.end_time') }}" />
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <x-select-box id="employee_id" name="employee_id[]" autocomplete="off" placeholder="{{ trans('system.employees') }}" extraClass="ajax-endpoint employees" endpoint="{{ route('employees.fetchData') }}" multiple=true value=""  required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary text-left">{{ trans('system.save') }}</button>
                        <button type="button" class="btn btn-secondary text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>

              </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewMeetingModal" tabindex="-1" role="dialog" aria-labelledby="viewMeetingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewMeetingModalLabel">{{ trans('system.meeting_details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <strong>Title:</strong> <span id="viewTitle"></span>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <strong>Organizer:</strong> <span id="viewOrganizer"></span>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <strong>Date:</strong> <span id="viewDate"></span>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <strong>Start Time:</strong> <span id="viewStartTime"></span>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <strong>End Time:</strong> <span id="viewEndTime"></span>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <strong>Participants:</strong> <span id="viewParticipants"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>
        $(document).ready(function () {
            // Initialize FullCalendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Default view is month
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listYear',
                },
                views: {
                    dayGridMonth: {
                        buttonText: 'Month', // Month view
                    },
                    timeGridWeek: {
                        buttonText: 'Week', // Week view
                    },
                    timeGridDay: {
                        buttonText: 'Day', // Day view
                    },
                    listYear: {
                        buttonText: 'Year', // Year view (list format)
                    },
                },
                events: "/meetings/events",
                eventClick: function (info) {
                    const meetingId = info.event.id;
                    $.ajax({
                        url: `/meetings/details/${meetingId}`,
                        method: "GET",
                        success: function (response) {
                            // Populate modal with meeting details
                            $('#viewTitle').text(response.title);
                            $('#viewOrganizer').text(response.organizer);
                            $('#viewDate').text(response.meeting_date);
                            $('#viewStartTime').text(response.start_time);
                            $('#viewEndTime').text(response.end_time);
                            $('#viewParticipants').text(response.participants.join(', '));

                            // Show the modal
                            $('#viewMeetingModal').modal('show');
                        },
                        error: function () {
                            alert('An error occurred while fetching the meeting details.');
                        },
                    });
                }
            });

            // Render the calendar
            calendar.render();

            $(document).on('submit','#bookMeeting', function (e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('meetings.store') }}",
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        if (response.success)
                        {
                            notification("Success", "Meeting Booked Successfully!", "success");
                            $('#bookMeeting')[0].reset();
                            $('#exampleModal').modal('hide');
                            calendar.refetchEvents();
                        }
                        else
                        {
                            notification("Success", response.message, "error");
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors)
                            {
                                notification("Error", errors[key][0], "error");
                            }
                        } else {
                            notification("Error", "An error occurred. Please try again.", "error");
                        }
                    },
                });
            });


        });


      </script>
    @endpush
</x-front-component>
