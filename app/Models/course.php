<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    //

    public $timestamps = false;
    protected $table = 'course';
    protected $primaryKey = 'c_id';
    protected $fillable = [
        'c_name',
        'c_description',
        'c_price',
    ];
}
