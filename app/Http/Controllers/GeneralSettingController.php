<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use DB;
use App\GeneralSetting;
use Input;

class GeneralSettingController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $general_settings = GeneralSetting::first();
        $uuid = Str::uuid();
        return view('general_settings.index', compact('general_settings','uuid'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request) {
		$GeneralSettingData = GeneralSetting::create($request->all());
        return redirect()->route('general_settings.index')->with('success', 'Record updated successfully.');
    }
   
   /**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\GeneralSetting  $GeneralSetting
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, GeneralSetting $GeneralSetting) {
        $GeneralSetting->update($request->all());
        return redirect()->route('general_settings.index')->with('success', 'Record updated successfully.');
    }
}
