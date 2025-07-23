<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'info_id',
        'personal_status',
        'education_status',
        'cv_status',
        'motivation_status',
        'transcript_status',
        'passport_status',
        'admin_accept_name',
        'comment',
        'status'

    ];
}
