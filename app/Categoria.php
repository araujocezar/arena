<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $fillable = ['tipo'];

    public function planos()
    {
        return $this->hasMany('App\Plano');
    }
}
