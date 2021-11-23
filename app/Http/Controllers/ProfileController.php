<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function update(request $request)
    {

        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required|unique:users,username,'.$user->id,
            'password' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=256,height=256',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->messages(),
                'data' => null
            ]);
        }
        
         
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('avatar')) {

            $destinationPath = "avatar/";

            $file = $request->file('avatar');

            $fileName = $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $user->avatar = $fileName;
        }

        $user->save();

        return response()->json([
            'status' => 1,
            'message' => 'Profile updated successfully.',
            'content' => $user,
        ]);
    }
}
