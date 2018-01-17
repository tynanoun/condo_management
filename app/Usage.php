<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    //
    protected $fillable = ['start_date', 'end_date', 'previous_reading', 'current_reading', 'paid_date', 'is_paid', 'is_invoiced', 'is_downloaded', 'room_number', 'price_setting_id'];

    protected $table = 'usages';
}
