<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['display_name', 'name', 'description', 'is_active', 'is_staff'];
}