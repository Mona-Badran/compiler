<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\User;
use App\Models\Workspace;
use App\Models\Invitation;
use App\Models\Collaboration;
use Tymon\JWTAuth\Facades\JWTAuth; 


class FilerController extends Controller{
    public function __invoke(Request $request){
        
        //$file = $request->file('file');
        return Storage::makeDirectory('file-storage'); //creates a folder
        //$path = Storage::putFile('file-storage', $file);
    }

    public function uploadNewFile(Request $request){
        //$user = JWTAuth::parseToken()->authenticate();
        $file = new File;
        $file->workspaces_id = $request->workspaces_id;
        $file->name = $request->name;

        $path = $request->file('path')->store('file-storage');
        $file->path = $path;
        $file->save();
        
        return response()->json([
            "message" => "file uploaded successfully"
        ],200);
    }
    public function displayOwnedLandingScreen(){
        $user = JWTAuth::parseToken()->authenticate();
        $workspaceNames = Workspace::where("users_id", $user->id)->get(["id","name"]); //owner
        if($workspaceNames->isEmpty()){
            return response()->json([
                "error" => "no owned workspace"
            ]);
        }
        return response()->json([
            'workspaces' => $workspaceNames
        ],200);
    }

    public function displayCollabLandingScreen(){
        $user = JWTAuth::parseToken()->authenticate();
        $collabWorkspaceId= Collaboration::where("users_id", $user->id)->pluck("workspaces_id");
        $workspaceNames = Workspace::whereIn("id", $collabWorkspaceId)->get(["id","name"]);
        if($workspaceNames->isEmpty()){
            return response()->json([
                "error" => "no owned workspace"
            ]);
        }
        return response()->json([
            'workspaces' => $workspaceNames
        ],200);
    }

    public function getFile($id){
        // $workspace = Workspace::where("id", $request->workspace_id)
        //                             ->where("user_id", $request->user_id)
        //                             ->first(); //here im checking if the workspace the user is in is the same as the work space that the user created
        // $collaborator = Collaboration::where("file_id", $id)
        //                                 ->where("user_id", $request->user_id)
        //                                 ->first(); //here im checking if the user_id requesting the file is one of the collaborators rather than the owners
        // if(!$workspace && !$collaborator){ 
        //     return response()->json([
        //         "error" => "unauthorized"
        //     ]);
        // }
        $file = File::find($id);
        if(!$file){
            return response()->json([
                "error" => "not found"
            ],404);
        }
        //$filename = $file->name;
        $filepath = $file->path;
        if(!Storage::exists($filepath)){
            return response()->json([
                "error" => "file not found"
            ],404);
        }
        
        $content = Storage::download($filepath);
        return response()->json([
            "content"=>$content
        ]);
        
    }

    public function getWorkSpace($id){
        $workspaceFiles = File::where("workspaces_id", $id)->get(["id","name"]);
        if($workspaceFiles->isEmpty()){
            return response()->json([
                "error" => "files not found"
            ],404);
        }
        return response()->json([
            "workspacefiles" => $workspaceFiles
        ]);
    }

    
    
}