<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class enroll extends Model
{
    //
    public $timestamps = false;
    protected $table = 'enroll';
    protected $primaryKey = 'cer_id';
    protected $fillable = [
        'm_id',
        'c_id',
        'cer_start',
        'cer_expire',
    ];
}
