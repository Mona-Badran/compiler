<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\User;
use App\Models\Workspace;
use App\Models\Invitation;

class FilerController extends Controller{
    public function __invoke(Request $request){
        
        //$file = $request->file('file');
        return Storage::makeDirectory('file-storage'); //creates a folder
        //$path = Storage::putFile('file-storage', $file);
    }

    public function uploadFile(Request $request){
        $file = new File;
        $file->workspace_id = $request->workspace_id;
        $file->name = $request->name;

        $path = $request->file('path')->store('file-storage');
        $file->path = $path;
        $file->save();
        
        return response()->json([
            "message" => "file uploaded successfully"
        ]);
    }
    public function getFile($id, Request $request){
        $Invitationfile = Collaboration::where("id", $request->workspace_id)->first();
        if(!$workspace){
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
    
}