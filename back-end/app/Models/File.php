<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'name',
        'path',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function collaborations()
    {
        return $this->hasMany(Collaboration::class);
    }
}
