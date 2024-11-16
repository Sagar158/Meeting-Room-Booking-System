<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\State;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function fetchCountries(Request $request)
    {
        $countries = Countries::select('id','name');
        if($request->filled('search')){
            $countries = $countries->where('name', 'LIKE','%'.$request->search.'%');
        }
        $countries = $countries->get();

        return response()->json(['data' => $countries]);
    }
}
