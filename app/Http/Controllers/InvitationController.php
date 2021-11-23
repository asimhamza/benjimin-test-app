<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invitation;
use Mail;

class InvitationController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:invitations',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->messages(),
                'data' => null
            ]);
        }

        $data['token'] = substr(md5(rand(0, 9) . $request->email . time()), 0, 32);
        $data['email'] = $request->email;
        $invitation = new Invitation();
        $invitation->email = $request->email;
        $invitation->invitation_token = $data['token'];
        $invitation->save();

        Mail::send('emails.invitation', $data, function($message) use ($data) {
            $message->to($data['email'], 'User')
            ->subject('Invitation Email');
            $message->from(env('MAIL_FROM_ADDRESS'),'Test App');
            });

        return response()->json([
                'status' => 1,
                'message' => 'Invitation email to register successfully sent.',
                'content' => null,
            ]);
    }
}
