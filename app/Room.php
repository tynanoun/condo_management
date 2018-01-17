<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['room_number', 'size', 'created_by', 'description', 'is_active'];

    protected $table = 'rooms';
    //
}
