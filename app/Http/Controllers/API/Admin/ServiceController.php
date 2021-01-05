<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Service::latest()->paginate(6);
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
            'title' => 'required',
            'body'  => 'required',
            'photo' => 'required'

        ]);

        $photo       = $request->photo;
        $strpos      = strpos($photo, ';');
        $sub         = substr($photo, 0, $strpos);
        $ext_arr     = explode('/', $sub);
        $ext         = end($ext_arr);
        $photo_name  = substr(base64_encode(time()), 0, 14) . '.' . $ext;
        $upload_path = public_path('uploads/');
        $res         = Image::make($photo)->resize(120, 120)->save($upload_path . $photo_name);
        return Service::create([
            'title' => $request->title,
            'body'  => $request->body,
            'photo' => $photo_name
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
    public function destroy(Service $service)
    {
        \unlink('uploads/' . $service->photo);
        return $service->delete();
    }
}
