<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $primaryKey = 'cusid';
    public $incrementing = false;
    protected $fillable = ['name','lastname','birthday','village','disid','proid','mobile','phone','Occupation','workaddress','tcusid','status'];
}
