<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\User;
use App\Models\Workspace;
use App\Models\Invitation;
use App\Models\Collaboration;

class FilerController extends Controller{
    public function __invoke(Request $request){
        
        //$file = $request->file('file');
        return Storage::makeDirectory('file-storage'); //creates a folder
        //$path = Storage::putFile('file-storage', $file);
    }

    public function uploadFile(Request $request){
        $file = new File;
        $file->workspaces_id = $request->workspaces_id;
        $file->name = $request->name;

        $path = $request->file('path')->store('file-storage');
        $file->path = $path;
        $file->save();
        
        return response()->json([
            "message" => "file uploaded successfully"
        ]);
    }
    public function displayOwnedLandingScreen(Request $request){
        $workspaceNames = Workspace::where("users_id", $request->user_id)->pluck("name"); //owner
        return response()->json([
            'workspaces' => $workspaceNames
        ]);
    }

    public function displayCollabLandingScreen(Request $request){
        $collabWorkspaceId= Collaboration::where("users_id", $request->user_id)->pluck("workspaces_id");
        $workspaceNames = Workspace::whereIn("id", $collabWorkspaceId)->pluck("name");
        return response()->json([
            'workspaces' => $workspaceNames
        ]);
    }

    public function getFile($id, Request $request){
        $workspace = Workspace::where("id", $request->workspace_id)
                                    ->where("user_id", $request->user_id)
                                    ->first(); //here im checking if the workspace the user is in is the same as the work space that the user created
        $collaborator = Collaboration::where("file_id", $id)
                                        ->where("user_id", $request->user_id)
                                        ->first(); //here im checking if the user_id requesting the file is one of the collaborators rather than the owners
        if(!$workspace && !$collaborator){ 
            return response()->json([
                "error" => "unauthorized"
            ]);
        }
        $file = File::find($id);
        if(!$file){
            return response()->json([
                "error" => "not found"
            ]);
        }
        $filename = $file->name;
        $filepath = $file->path;
        if(!Storage::exists($filepath) || $filename!=$request->name){
            return response()->json([
                "error" => "file not found"
            ]);
        }
        
        return Storage::download($filepath);
        
    }

    public function getWorkSpace($id){
        $workspaceFiles = File::where("workspaces_id", $id)->pluck("name");
        if(!$workspaceFiles){
            return response()->json([
                "error" => "files not found"
            ]);
        }
        return response()->json([
            "workspace files" => $workspaceFiles
        ]);
    }
    
    
}