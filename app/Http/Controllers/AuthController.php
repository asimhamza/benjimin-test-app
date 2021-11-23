<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invitation;
use App\Models\User;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['name'] =  $user->name;
            $success['phone'] =  $user->username;
            $success['email'] =  $user->email;
   
            return response()->json([
                'status' => 1,
                'message' => 'Successfully logged In.',
                'content' => $success,
            ]);
        } 
        else{ 
            return response()->json([
                'status' => 0,
                'message' => 'Unauthorised',
                'error' => 'Unauthorised',
            ]);
        } 
    }
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:20|unique:users',
            'password' => 'required',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->messages(),
                'data' => null
            ]);
        }
        
        //Look for invitation token in database
        $invitation = Invitation::where('invitation_token', $request->token)->first();
        if(!$invitation)
        {
            return response()->json([
                'status' => 0,
                'message' => 'Invalid invitation link',
                'error' => 'Invalid invitation link',
            ]);
        }

        //Create new user
        $user = new User();
        $user->username = $request->username;
        $user->email = $invitation->email;
        $user->pin = rand(100000, 999999);
        $user->password = Hash::make($request->password);
        $user->save();

        //Delete the invitation link
        $invitation->delete();

        $data['email'] = $user->email;
        $data['pin'] = $user->pin;

        //Send 6 digit pin code
        Mail::send('emails.pin_code_conformation', $data, function($message) use ($data) {
            $message->to($data['email'], 'User')
            ->subject('Pin verification');
            $message->from(env('MAIL_FROM_ADDRESS'),'Test App');
            });

        //Attempt to login
        if(Auth::attempt(['email' => $user->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['name'] =  $user->name;
            $success['phone'] =  $user->username;
            $success['email'] =  $user->email;
   
            return response()->json([
                'status' => 1,
                'message' => 'Successfully registered.',
                'content' => $success,
            ]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Successfully registered.',
            'content' => null,
        ]);
    }

    public function verify_account(Request $request)
    {
        $request->validate([
            'pin' => 'required|numeric'
        ]);

        $user = Auth::user();

        if($user->status == 1)
        {
            return response()->json([
                'status' => 0,
                'message' => 'Account already verified.',
                'error' => 'Account already verified.',
            ]);
        }

        if($user->pin != $request->pin)
        {
            return response()->json([
                'status' => 0,
                'message' => 'Invalid Pin Code.',
                'error' => 'Invalid Pin Code.',
            ]);
        }

        $user->status = 1;
        $user->save();

        return response()->json([
            'status' => 1,
            'message' => 'Account successfully verified.',
            'content' => null,
        ]);
    }
}
