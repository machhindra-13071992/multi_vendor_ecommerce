<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\State;
use App\Country;
use App\City;	
use DB;
use Hash;

class CityController extends Controller{

	//public function index($name, $age){
	public function login(){
		//echo "The name is ".$name." & age is ".$age;
		return view('login_page'); 
	}

 	public function index(Request $request)
    {
        $data = City::with('countries','states')->orderBy('id','DESC')->paginate(20);
        return view('cities.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create()
    {
        $countries = Country::orderBy('id')->pluck('name', 'id')->toArray();
        $states = State::orderBy('id')->pluck('name', 'id')->toArray();
        return view('cities.create',compact('countries','states'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $input = $request->all();
       
        $user = City::create($input);
       
        return redirect()->route('cities.index')
                        ->with('success','City created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $City)
    {

        $cities = City::with('countries','states')
                    ->where('id', $City->id)->first();
        return view('cities.show',compact('cities'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::find($id);
        $countries = Country::orderBy('id')->pluck('name', 'id')->toArray();
        $states = State::orderBy('id')->pluck('name', 'id')->toArray();
        return view('cities.edit',compact('states','countries','cities'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $City)
    {
        $this->validate($request, [
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);
        $City->update($request->all());
        return redirect()->route('cities.index')
                        ->with('success','City updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::find($id)->delete();
        return redirect()->route('cities.index')
                        ->with('success','City deleted successfully');
    }
	
}
