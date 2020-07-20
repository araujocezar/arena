<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Aluguel extends Model
{
    use SoftDeletes;
    protected $dates = ['data', 'created_at', 'updated_at', 'deleted_at'];
}
