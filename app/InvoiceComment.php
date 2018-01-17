<?php
/**
 * Created by PhpStorm.
 * User: TINA NOUN
 * Date: 9/12/2017
 * Time: 9:22 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class InvoiceComment extends Model
{
    protected $fillable = ['usage_id', 'comments'];

    protected $table = 'invoice_comments';
    //
}