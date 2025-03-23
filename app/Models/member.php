<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{

    public $timestamps = false;
    protected $table = 'member';
    protected $primaryKey = 'm_id';

    protected $fillable = [
        'm_email',
        'm_password',
        'm_name'
    ];

}
