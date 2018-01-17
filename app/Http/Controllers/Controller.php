<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Mail\SendInvoice;
use App\PriceSetting;
use App\Usage;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getOutStandingList() {
        $strSql = "select DISTINCT users.*, rooms.room_number, rooms.id as room_id from users ";
        $strSql .= "inner join rooms on users.room_id = rooms.id ";
        $strSql .= "inner join usages on usages.room_id = rooms.id ";
        $strSql .= "inner join role_user on users.id = role_user.user_id ";
        $strSql .= "inner join roles on roles.id = role_user.role_id ";
        $strSql .= "where rooms.is_active = ? and users.is_active = ? and roles.is_staff = ? ";
        $strSql .= "and usages.is_paid = ? and users.created_by = ? ";

        if (!Auth::user()->hasRole('admin')) {
            $strSql .= "AND users.id = " . Auth::user()->getAuthIdentifier();
        }
        $users = DB::select($strSql, [1, 1, false, false, Auth::user()->getAuthIdentifier()]);

        return $users;
    }

    public function getConsumptionList() {
        $strSql = "SELECT DISTINCT users.*, rooms.room_number, AVG(usages.water_new - usages.water_old) as avg_water, AVG(usages.electric_new - usages.electric_old) as avg_kwh ";
        $strSql .= "FROM users ";
        $strSql .= "INNER JOIN rooms on users.room_id = rooms.id ";
        $strSql .= "INNER JOIN usages on usages.room_id = rooms.id ";
        $strSql .= "INNER JOIN role_user on users.id = role_user.user_id ";
        $strSql .= "INNER JOIN roles on roles.id = role_user.role_id ";
        $strSql .= "WHERE rooms.is_active = ? and users.is_active = ? ";
        $strSql .= "AND roles.is_staff = ? and users.created_by = ? ";
        if (!Auth::user()->hasRole('admin')) {
            $strSql .= "AND users.id = " . Auth::user()->getAuthIdentifier();
        }
        $strSql .= " GROUP BY users.id, rooms.room_number ";
        $users = DB::select($strSql, [1, 1, false, Auth::user()->getAuthIdentifier()]);

        return $users;

    }
}
