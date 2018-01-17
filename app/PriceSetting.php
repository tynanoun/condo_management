<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceSetting extends Model
{
    protected $fillable = ['created_by', 'water_supply', 'electric_supply', 'unit_supply', 'description', 'is_paid', 'is_invoiced', 'is_downloaded', 'room_id', 'price_setting_id'];

    protected $table = 'price_setting';
}
