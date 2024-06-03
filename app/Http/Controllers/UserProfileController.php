<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function uploadProfileImage($imageFile): string
    { //Move Uploaded File to public folder
        $destinationPath = 'images/uploads/profiles/';
        $hashed_image_name = $imageFile->hashName();
        $profile_img_path = $destinationPath.$hashed_image_name;
        $imageFile->move(public_path($destinationPath), $hashed_image_name);

        return $profile_img_path;
    }


    public function update(Request $request, string $id)
    {

        $profile = User::findOrFail($id);


        if($request->input('pass_submit'))
        {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|different:current_password',
                'password_confirmation' => 'required|same:password',
            ]);

            if (Hash::check($request->current_password, $profile->password))
            {
                $profile->fill([
                 'password' => Hash::make($request->new_password)
                 ])->save();

                 return back()->with('success', 'Profile updated successfully');

             } else {
                return back()->with('error', 'Current password does not match this accounts password');
             }


        }else{

            $request->validate([
                'profile_picture' => 'mimes:jpg,webp,png,jpeg',
                'full_name' => 'required|max:255',
                'email' => 'required|email',
            ]);


            if(!is_null($request->file('profile_picture')))
            {
                $profile_img_path = $this->uploadProfileImage($request->file('profile_picture'));
            }



            // dd($profile_picture_path);
            $profile->name = $request->input('full_name');
            $profile->email = $request->input('email');
            !isset($profile_img_path) ?
            '' : $profile->profile_picture = $profile_img_path;

            $profile->save();
            return back()->with('success', 'Profile updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
