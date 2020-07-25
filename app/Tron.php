<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tron extends Model
{
    /** 
     * Fillable for mass columns in DB
     * 
     * @var array
     */
    protected $fillable = ['address', 'secret'];
}
