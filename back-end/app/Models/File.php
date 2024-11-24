<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model{
    protected $fillable = ["workspace_id", "name", "path"];
}

