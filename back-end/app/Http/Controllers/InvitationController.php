<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Post;
use App\Mail\SendingMail;
use App\Models\Workspace;
use App\Models\Invitation;
use App\Models\Collaboration;

class InvitationController extends Controller{
    public function sendEmail(Request $request){
        
        $workspaceInvite = Workspace::where("users_id", $request->sender_id)
                                        ->where("id", $request->workspaces_id)
                                        ->first();
        if(!$workspaceInvite){
            return response()->json([
                "error" => "you dont own the workspace that you are inviting others to"
            ],404);
        }

        $recipient_user = User::where("email", $request->recipient_email)->first();
        if(!$recipient_user){
            return response()->json([
                "error" => "email not found"
            ],404);
        }

        $workspaceInvited = Workspace::where("users_id", $recipient_user->id)
                                        ->where("id", $request->workspaces_id)
                                        ->first();

        if($workspaceInvited){
            return response()->json([
                "error" => "You cant invite youself to your workspace"
            ],400);
        }

        $invitation = new Invitation;
        $invitation->sender_id = $request->sender_id;
        $invitation->recipient_email = $request->recipient_email;
        $invitation->workspaces_id = $request->workspaces_id; //to be changed
        $invitation->status = $request->status; //to be removed
        $invitation->save();

        Mail::to($invitation->recipient_email)->send(new SendingMail([
            "workspace" => $request->workspaces_id
        ]));
        //$recipient_user = User::where("email", $request->recipient_email)->first();
        

        $collaboration = new Collaboration;
        $collaboration->users_id = $recipient_user->id;
        $collaboration->workspaces_id = $request->workspaces_id;
        $collaboration->invitations_id = $invitation->id;
        $collaboration->save();

        
    }

    public function changeRole(Request $request){
        $recipient_user = User::where("email", $request->recipient_email)->first();
        if(!$recipient_user){
            return response()->json([
                "error" => "email not found"
            ],404);
        }
        
        $collaboration = Collaboration::where("workspaces_id", $request->workspaces_id)
                                        ->where("users_id", $recipient_user->id)
                                        ->first();

        if ($collaboration->role == $request->role){
            return response()->json([
                "error" => "The invited user is already in ". $request->role ." role"
            ],400);
        }
        
        if (!in_array($request->role, ['Edit', 'View'])) {
            return response()->json([
                "error" => "only assign 'Edit' or 'View'."
            ], 400);
        }

        $collaboration->role = $request->role;
        $collaboration->save();

        return response()->json([
            "message" => "Role updated successfully"
        ]);

    }



}