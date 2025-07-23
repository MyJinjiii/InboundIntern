<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_id',
        'info_id',
        'user_id',
        'interview_right',
        'interview_result',
        'confirm_right',
    ];
}
