<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'email', 'password'];

    public static $rules = [
        'nome' => 'required|min:2|max:100',
        'email' => 'required|unique:users,|max:50',
        'password' => 'required|min:8|confirmed',
    ];

    public static $messages = [
        'min' => 'O Campo :attribute tem que ser maior que 2 caracteres',
        'max' => 'O campo :attribute excedeu o limite de caracteres',
        'required' => 'O campo é obrigatório',
        'unique' => 'o campo :attribute deve ser único',
        'numeric' => 'ID deve ser numérico',
        'password.min' => 'A senha deve conter no minimo 8 digitos',
        'password.confirmed' => 'As senhas devem ser identicas',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     *
     *


     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];
}
