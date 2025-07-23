<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'title',
        'email',
        'tel',
        'title',
        'level_of_studies',
        'year_of_study',
        'study_program',
        'faculty',
        'university',
        'country',
        'topic',
        'advisor',
        'program_focus',
        'internship_duration',
        'start_date',
        'ending_date',
        'cv_file',
        'motivation_file',
        'passport_file',
        'transcript_file',
        'scholarship',
        'user_id',
        'topic_id'
    ];
}
