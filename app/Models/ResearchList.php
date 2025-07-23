<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchList extends Model
{
    use HasFactory;
    protected $fillable = [
        'division',
        'program',
        'prof_name',
        'short',
        'topic',
        'support',
        'details',
        'approve',
        'advisor_id',
        'year_id'
    ] ;
}
