<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactDetails;
use Illuminate\Http\Request;

class ContactDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContactDetails::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'         => 'required|email',
            'primary_phone' => 'required',
            'address'       => 'required',
            'open_day'      => 'required',
            'open_time'     => 'required'
        ]);
        return ContactDetails::updateOrCreate([
            'id' => 1
        ], [
            'email'          => $request->email,
            'primary_phone'  => $request->primary_phone,
            'optional_phone' => $request->optional_phone,
            'open_day'       => $request->open_day,
            'open_time'      => $request->open_time,
            'address'        => $request->address,
            'fb'             => $request->fb,
            'twitter'        => $request->twitter,
            'linked_in'      => $request->linked_in,
            'insta'          => $request->insta,
            'youtube'        => $request->youtube
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
