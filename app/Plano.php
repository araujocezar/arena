<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $fillable = ['dias_semana', 'preco', 'categoria_id'];

    public function alunoplanos(){
        return $this->hasMany('app\Alunoplano');
    }

    public function categoria(){
        return $this->hasOne('nowait\Categoria');
    }
}
