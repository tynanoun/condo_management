<?php
/**
 * Created by PhpStorm.
 * User: TINA NOUN
 * Date: 9/12/2017
 * Time: 1:32 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['usage_id', 'paid_electric', 'paid_water', 'paid_room', 'is_electric_paid', 'is_water_paid', 'is_room_paid', 'total_electric_price', 'total_water_price', 'total_room_price'];

    protected $table = 'payments';
    //
}