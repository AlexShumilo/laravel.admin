<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'email', 'logo', 'website'

    ];

    // установка связи один-ко-многим к таблице сотрудников
    public function employees() {
        return $this->hasMany('App\Employee');
    }
}
