<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CitiesController extends Controller
{

    public $title = 'Cities';
    public function fetchCities(Request $request)
    {
        $cities = Cities::select('id','name');
        if($request->filled('search')){
            $cities = $cities->where('name', 'LIKE','%'.$request->search.'%');
        }
        if($request->filled('field1'))
        {
            $cities = $cities->where('country_id', $request->field1);
        }
        else{
            $cities = $cities->offset(0)->take(10);
        }

        $cities = $cities->get();

        return response()->json(['data' => $cities]);
    }


    public function index()
    {
        $title = $this->title;
        return view('cities.index', compact('title'));
    }

    public function create()
    {
        $title = $this->title;
        $city = new Cities;
        return view('cities.edit', compact('title','city'));
    }

    public function store(Request $request)
    {
        $this->authorize('create',Cities::class);

        $validatedData = $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $state = State::findOrFail($validatedData['state_id']);

        $city = new Cities;
        $city->name = $validatedData['name'];
        $city->country_id = $validatedData['country_id'];
        $city->state_id = $validatedData['state_id'];
        $city->state_code = $state->fips_code;
        $city->country_code = $state->country_code;
        $city->latitude = $state->latitude;
        $city->longitude = $state->longitude;
        $city->save();
        return redirect()->route('city.index')->with('success', 'City added successfully');
    }


    public function edit($cityId)
    {
        $title = $this->title;
        $city = Cities::findOrFail($cityId);
        return view('cities.edit', compact('title','city'));
    }

    public function update(Request $request, $cityId)
    {
        $this->authorize('update',Cities::class);

        $validatedData = $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $state = State::findOrFail($validatedData['state_id']);

        $city = Cities::findOrFail($cityId);
        $city->name = $validatedData['name'];
        $city->country_id = $validatedData['country_id'];
        $city->state_id = $validatedData['state_id'];
        $city->state_code = $state->fips_code;
        $city->country_code = $state->country_code;
        $city->latitude = $state->latitude;
        $city->longitude = $state->longitude;
        $city->save();

        return redirect()->route('city.index')->with('success', 'City updated successfully');
    }

    public function destroy(Request $request, $cityId)
    {
        $this->authorize('delete',Cities::class);
        $record = Cities::destroy($cityId);
        return response()->json(['success' => $record]);

    }
    public function getCitiesData()
    {
        $this->authorize('viewAny',Cities::class);
        $query = Cities::orderBy('id','desc');

        return DataTables::of($query)
            ->addColumn('country', function($city){
                return isset($city->country->name) ? $city->country->name : '';
            })
            ->addColumn('state', function($city){
                return isset($city->state->name) ? $city->state->name : '';
            })
            ->addColumn('action', function ($city) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('city.edit', $city->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('city.destroy', $city->id).'" data-id="'.$city->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }



}
