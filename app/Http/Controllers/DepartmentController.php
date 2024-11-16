<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function fetchDepartment(Request $request)
    {
        $departments = Department::select('id','name');
        if($request->filled(key: 'search'))
        {
            $departments = $departments->where('name', 'LIKE','%'.$request->search.'%');
        }
        $departments = $departments->orderBy('name','asc')->get();

        return response()->json(['data' => $departments]);
    }
}
