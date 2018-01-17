<?php

namespace App\Libs;


class DateHelpers
{
    public static function formatDefaultDate($date) {
        if($date == null || $date == '' || !isset($date)) {
            return '';
        }
        return date("d-m-Y", strtotime($date));
    }
}