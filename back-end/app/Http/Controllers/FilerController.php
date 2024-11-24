<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilerController extends Controller{
    public function __invoke(Request $request){
        
        $file = $request->file('file');
        //return Storage::makeDirectory('file-storage'); //creates a folder
        Storage::putFile('file-storage', $file);

        //test
    }

    public function uploadFile(Request $request){
        $file = new File;
        $file->workspace_id = $request->workspace_id;
        $file->name = $request->name;
        //$file->path = ;
    }
    
}