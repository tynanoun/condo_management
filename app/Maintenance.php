<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['room_id', 'task_name','room_id', 'user_id', 'description'];
}
