<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function fetchDesignation(Request $request)
    {
        $designations = Designation::select('id','name');
        if($request->filled('search'))
        {
            $designations = $designations->where('name', 'LIKE','%'.$request->search.'%');
        }
        $designations = $designations->orderBy('name','asc')->get();

        return response()->json(['data' => $designations]);
    }
}
