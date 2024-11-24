<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilerController extends Controller{
    public function __invoke(Request $request){
        
        $file = $request->file('file');
        return Storage::makeDirectory('file-storage'); //creates a folder
        //Storage::putFile('file-storage', $file);

        //test
    }
}