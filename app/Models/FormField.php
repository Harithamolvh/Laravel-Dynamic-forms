<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $guarded=[];
    protected $casts = [
        'rules' => 'array',
        'options' => 'array'
    ];
}
