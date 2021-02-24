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
use DB;
use Hash;

class StateController extends Controller{

	//public function index($name, $age){
	public function login(){
		//echo "The name is ".$name." & age is ".$age;
		return view('login_page'); 
	}

 	public function index(Request $request)
    {
        $data = State::paginate(20);
        return view('states.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create()
    {
        $countries = Country::orderBy('id')->pluck('name', 'id')->toArray();
        return view('states.create',compact('countries'));
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
        ]);

        $input = $request->all();
       
        $user = State::create($input);
       
        return redirect()->route('states.index')
                        ->with('success','State created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        $states = State::where('id', $state->id)->first();
        return view('states.show', compact('states'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = State::find($id);
        $countries = Country::orderBy('id')->pluck('name', 'id')->toArray();
        return view('states.edit',compact('states','countries'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $this->validate($request, [
            'name' => 'required',
            'country_id' => 'required'
        ]);
        $state->update($request->all());
        return redirect()->route('states.index')
                        ->with('success','State updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::find($id)->delete();
        return redirect()->route('states.index')
                        ->with('success','State deleted successfully');
    }
	
}
