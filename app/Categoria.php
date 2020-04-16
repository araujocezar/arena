<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    protected $fillable = ['tipo'];

    public function planos()
    {
        return $this->hasMany('App\Plano');
    }
}
