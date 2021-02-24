<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use DB;
use App\Country;

class CountryController extends Controller {
	
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $countries = Country::paginate(20);

        return view('countries.index', compact('countries'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        return view('countries.create');
    }

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        $countriesData = Country::create($request->all());
        return redirect()->route('countries.index')->with('success', 'Country created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Country  $country
 * @return \Illuminate\Http\Response
 */
    public function show(Country $country) {
        $countries = Country::where('id', $country->id)->first();
        return view('countries.show', compact('countries'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Country  $country
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
        $country = Country::where('id', $id)->first();
        return view('countries.edit',compact('country'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Country  $country
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Country $country) {
        $request->validate([
            'name' => 'required'
        ]);
        $country->update($request->all());

        return redirect()->route('countries.index')->with('success', 'Country updated successfully');
    }
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Country  $country
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Country::where('id',$id)->delete();
        return redirect()->route('countries.index')
                        ->with('success','Country deleted successfully');
    }

    /**
 * Remove the specified resource from storage.
 *
 * @param  \App\VideoCategory  $getAllStatesById
 * @return \Illuminate\Http\Response
 */
    public function getAllStatesById($id)
    {
        $states = DB::table("states")
                    ->where("country_id",$id)
                    ->pluck("name","id");
        return json_encode($states);
    }

    /**
 * Remove the specified resource from storage.
 *
 * @param  \App\VideoCategory  $getAllCitiesById
 * @return \Illuminate\Http\Response
 */
    public function getAllCitiesById($id)
    {
        $cities = DB::table("cities")
                    ->where("state_id",$id)
                    ->pluck("name","id");
        return json_encode($cities);
    }

}
