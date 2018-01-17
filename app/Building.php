<?php
/**
 * Created by PhpStorm.
 * User: TINA NOUN
 * Date: 9/11/2017
 * Time: 1:56 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['building_name', 'location', 'owner_name', 'contract_number', 'room_capacity', 'property_manager', 'office_email', 'office_number', 'invoice_comment', 'created_by'];

    protected $table = 'buildings';
    //
}