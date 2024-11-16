<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        return view('meeting.index');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'meeting_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'employee_id' => 'required|array',
        ], [
            'employee_id.required' => 'At least one employee should be selected.',
            'meeting_date.after_or_equal' => 'The meeting date cannot be in the past. Please select today or a future date.',
        ]);


        // Check for overlapping meetings
        $hasOverlap = Meeting::where('meeting_date', $validatedData['meeting_date'])
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('start_time', [$validatedData['start_time'], $validatedData['end_time']])
                      ->orWhereBetween('end_time', [$validatedData['start_time'], $validatedData['end_time']])
                      ->orWhere(function ($q) use ($validatedData) {
                          $q->where('start_time', '<=', $validatedData['start_time'])
                            ->where('end_time', '>=', $validatedData['end_time']);
                      });
            })
            ->exists();

        if ($hasOverlap)
        {
            return response()->json(
                [
                'success' => false,
                'message' => 'There is already a meeting scheduled during this time. Please choose a different time slot.',
            ], 422);
        }

        $meeting = Meeting::create($validatedData);

        $meeting->employees()->sync($validatedData['employee_id']);

        return response()->json(['success' => true, 'id' => $meeting->id]);
    }


    public function fetchEvents()
    {
        $meetings = Meeting::all();
        $events = $meetings->map(function ($meeting) {
            return [
                'id' => $meeting->id,
                'title' => $meeting->title,
                'start' => $meeting->meeting_date . 'T' . $meeting->start_time,
                'end' => $meeting->meeting_date . 'T' . $meeting->end_time,
                'organizer' => $meeting->organizer,
                'employees' => $meeting->employee_ids,
            ];
        });

        return response()->json($events);
    }

    public function getMeetingDetails($id)
    {
        $meeting = Meeting::with('employees')->findOrFail($id);

        $participants = $meeting->employees->map(function ($employee) {
            return $employee->first_name . ' ' . $employee->last_name;
        })->toArray();

        return response()->json([
            'title' => $meeting->title,
            'organizer' => $meeting->organizer,
            'meeting_date' => $meeting->meeting_date,
            'start_time' => $meeting->start_time,
            'end_time' => $meeting->end_time,
            'participants' => $participants,
        ]);
    }

}
