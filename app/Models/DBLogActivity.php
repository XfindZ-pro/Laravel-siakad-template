<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DBLogActivity extends Model
{
    protected $table = 'db_log_activities';

    protected $fillable = [
        'action',
        'description',
    ];
}
