<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

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
    
}