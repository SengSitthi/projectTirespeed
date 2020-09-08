<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $primaryKey = 'empid';
    protected $fillable = ['empid','name','lastname','birthday','village','disid','proid','mobile','email'];

    public $incrementing = false;
}
