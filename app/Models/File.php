<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name','path','type','task_id'];


    public function getPathAttribute($key)
    {
        return asset( Storage::url($key));
    }
}
