<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model{
    protected $fillable = ["sender_id", "recipient_email", "file_id",
"status"];
}
