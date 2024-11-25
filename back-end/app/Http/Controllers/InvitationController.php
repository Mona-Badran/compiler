<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;


use App\Mail\SendingMail;
use App\Models\Post;
use App\Models\Invitation;

class InvitationController extends Controller{
    public function sendEmail(Request $request){
        $invitation = new Invitation;
        $invitation->sender_id = $request->sender_id;
        $invitation->recipient_email = $request->recipient_email;
        $invitation->workspaces_id = $request->workspaces_id; //to be changed
        $invitation->status = $request->status; //to be removed
        $invitation->save();

        Mail::to($invitation->recipient_email)->send(new SendingMail([
            "workspace" => $request->workspaces_id
        ]));
        $recipient_user = User::where("email", $request->recipient_email)->first();
        
        $collaboration = new Collaboration;
        $collaboration->users_id = $recipient_user->id;
        $collaboration->workspaces_id = $request->workspaces_id;
        $collaboration->invitations_id = $invitation->id;
        
    }



}