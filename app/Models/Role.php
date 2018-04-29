<?php

namespace Previs\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['title', 'permissions'];

}