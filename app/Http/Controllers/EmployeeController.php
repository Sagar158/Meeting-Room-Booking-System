<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Employees List';
        return view('employees.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Employee';
        $employee = new Employee();
        return view('employees.edit', compact('title','employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'employment_status' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'date_of_joining' => 'required|date',
            'address' => 'required|string|max:255',
            'reporting_manager' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0',
            'employment_type' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {

            if ($request->hasFile('profile_image'))
            {
                $validatedData['profile_image'] = Helper::imageUpload($request->profile_image, 'profile');
            }

            Employee::create($validatedData);

            DB::commit();

            // Respond with success message for AJAX request
            if ($request->ajax()) {
                return response()->json(['success' => 'Employee created successfully!']);
            }

            return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Employee Store Error: ' . $e->getMessage());

            if ($request->ajax())
            {
                return response()->json(['error' => 'An error occurred while creating the employee. Please try again later.'], 500);
            }
        }
    }


    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employeeId)
    {
        $title = 'Edit Employee';
        $employee = Employee::findOrFail($employeeId);
        return view('employees.edit', compact('title','employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $employeeId)
    {
        // Find the employee record
        $employee = Employee::findOrFail($employeeId);

        // Validation rules
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $employeeId,
            'phone_number' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'employment_status' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'date_of_joining' => 'required|date',
            'address' => 'required|string|max:255',
            'reporting_manager' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0',
            'employment_type' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('profile_image'))
            {
                $validatedData['profile_image'] = Helper::imageUpload($request->profile_image, 'profile');
            }

            // Update the employee record
            $employee->update($validatedData);

            DB::commit();

            // Respond with success message for AJAX request
            if ($request->ajax()) {
                return response()->json(['success' => 'Employee updated successfully!']);
            }

            return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Employee Update Error: ' . $e->getMessage());

            // Respond with error message for AJAX request
            if ($request->ajax()) {
                return response()->json(['error' => 'An error occurred while updating the employee. Please try again later.'], 500);
            }

            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the employee. Please try again later.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($employeeId)
    {
        $record = Employee::destroy($employeeId);
        return response()->json(['success' => $record]);
    }

    public function fetch()
    {
        $query = Employee::with(['department','designation']);
        return DataTables::of($query)
            ->addColumn('employee_name', function($employee){
                return $employee->full_name;
            })
            ->addColumn('department', content: function($employee){
                return $employee->department->name;
            })
            ->addColumn('designation', content: function($employee){
                return $employee->designation->name;
            })
            ->editColumn('employment_status', function($employee){
                return ucfirst($employee->employment_status);
            })
            ->addColumn('action', function($data){
                return view('employees.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function fetchData(Request $request)
    {
        $employees = Employee::select('id',DB::raw("CONCAT(first_name, ' ', last_name) as name"));
        if($request->filled('search'))
        {
            $employees = $employees->where('name', 'LIKE','%'.$request->search.'%');
        }

        $employees = $employees->get();

        return response()->json(['data' => $employees]);
    }

}
