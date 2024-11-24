<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $fillable = ["username", "email", "email_verified_at", "password", "remember_token"];
}

