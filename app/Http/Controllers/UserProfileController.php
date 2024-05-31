<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user();
        if ($profile->access_level == 1) {
            return view('dashboard.pages.profile.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = User::find($id);
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->input('pass_submit'))
        {
            dd($request);
        }
        if(!is_null($request->file('profile_picture')))
        {
            //Move Uploaded File to public folder
            $destinationPath = 'images/uploads/profiles/';
            $file = $request->file('profile_picture');
            $hashed_image_name = $file->hashName();
            $profile_img_path = $destinationPath.$hashed_image_name;
            $request->profile_picture->move(public_path($destinationPath), $hashed_image_name);
        }



        // dd($profile_picture_path);
        $profile = User::find($id);
        $profile->name = $request->input('full_name');
        $profile->email = $request->input('email');
        !isset($profile_img_path) ?
        '' : $profile->profile_picture = $profile_img_path;

        $profile->save();
        return back()->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
