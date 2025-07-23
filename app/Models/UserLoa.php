<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'user_id',
        'info_id',
        'result_id',
        'LAO_file'
    ];
}
