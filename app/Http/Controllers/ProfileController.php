<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    //
    public function show(){
        $data['user'] = auth()->user();

        return response()->json([
            'response_code' => '00',
            'response_message' => 'profile berhasil di tampikan',
            'data' => $data
        ]);
    }   

    public function update(Request $request){
        $user = auth()->user();
        
        if($request->hasFile('photo_profile')){

            $photo_profile = $request->file('photo_profile');
            $photo_profile_extension = $photo_profile->getClientOriginalExtension();
            $photo_profile_name = Str::slug($user->name, '-'). '-' . $user->id . "." . $photo_profile_extension;
            $photo_profile_folder = '/photos/users/photo-profile/';
            $photo_profile_location = $photo_profile_folder . $photo_profile_name;

            try {
                //code...
                $photo_profile->move(public_path($photo_profile_folder), $photo_profile_name);
                
                $user->update([
                    'photo_profile' => $photo_profile_location,
                ]);

            } catch (\Exception $e) {
                    return response()->json([
                    'response_code' => '01',
                    'response_message' => 'photo profile gagal upload',
                    'data' => $data
                ], 200);
            }

            $user->update([
                'name' => $request->name,
            ]);

            $data['user'] = $user;

             return response()->json([
                    'response_code' => '00',
                    'response_message' => 'profile berhasil diupdate',
                    'data' => $data
                ], 200);

        }
    }
}