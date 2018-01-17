<?php
namespace App\Libs;

use App\LeaseSetting;
use App\PriceSetting;
use App\Room;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;

class Helpers
{
    public static function getRoomPricePayment($roomPricePerM2, $roomSize, $startDate, $endDate) {
        // room prices
        $numberOfDays = date("t", strtotime($startDate));
        $numberOfRentDays = round((strtotime($endDate) - strtotime($startDate))/(60*60*24));
        $totalRoomCost = (($roomPricePerM2 * $roomSize)/$numberOfDays) * $numberOfRentDays;

        return array($numberOfDays, $numberOfRentDays, $totalRoomCost);
    }

    public static function getElectricPricePayment($electricPricePerKWH, $electricUsage) {
        return $electricPricePerKWH * $electricUsage;
    }

    public static function getWaterPricePayment($waterPricePerM3, $waterUsage) {
        return $waterPricePerM3 * $waterUsage;
    }

    public static function getTotalWithVAT($subTotal, $vat) {
        if ($vat != null && $vat != 0) {
            $total = ($subTotal * $vat)/100 + $subTotal;
        } else {
            $total = $subTotal;
        }

        return $total;
    }

    public static function amountInWords($amount) {
        // Amount in to words
        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('en');

        return $currencyTransformer->toWords($amount * 100, 'USD');
    }

    public static function formatAmountToUS($amount) {

        $fmt = new \NumberFormatter( 'de_DE', \NumberFormatter::CURRENCY );

        return $fmt->formatCurrency($amount, "USD");
    }

    public static function getTenants() {
        $strSql = "select users.* from users ";
        $strSql .= "inner join role_user on users.id = role_user.user_id ";
        $strSql .= "inner join roles on roles.id = role_user.role_id ";
        $strSql .= "where users.is_active = ? AND users.created_by = ? and roles.is_staff = ? ";
        return DB::select($strSql, [true, Auth::user()->getAuthIdentifier(), false]);
    }

    public static function getStaffs() {
        $strSql = "select users.* from users ";
        $strSql .= "inner join role_user on users.id = role_user.user_id ";
        $strSql .= "inner join roles on roles.id = role_user.role_id ";
        $strSql .= "where users.is_active = ? AND users.created_by = ? and roles.is_staff = ? ";
        return DB::select($strSql, [true, Auth::user()->getAuthIdentifier(), true]);
    }

    public static function getRoomOfCurrentUser() {
        $userId = Auth::user()->getAuthIdentifier();
        $user = User::find($userId);

        $strSql = "SELECT DISTINCT rooms.* ";
        $strSql .= "FROM rooms ";
        $strSql .= "INNER JOIN users ON users.room_id = rooms.id ";
        $strSql .= "WHERE users.is_active = ? AND rooms.is_active = ? AND rooms.created_by = ?";
        if ($user->hasRole('admin')) {
            $rooms = DB::select($strSql, [1, 1, $user->id]);
        } else {
            $rooms = DB::select($strSql, [1, 1, $user->created_by]);
        }
        return $rooms;
    }

    public static function getAllActiveRooms() {
        $userId = Auth::user()->getAuthIdentifier();
        $user = User::find($userId);

        $strSql = "SELECT DISTINCT rooms.* ";
        $strSql .= "FROM rooms ";
        $strSql .= "WHERE rooms.is_active = ? AND rooms.created_by = ?";
        if ($user->hasRole('admin')) {
            $rooms = DB::select($strSql, [1, 1, $user->id]);
        } else {
            $rooms = DB::select($strSql, [1, 1, $user->created_by]);
        }
        return $rooms;
    }

    public static function convertNumToBoolean($num) {
        return $num === 0 || $num == null ? 'false' : 'true';
    }

    public static function getCurrentLeaseSettingByRoomId($roomId) {
        $currentDate = date("Y-m-d H:i:s");
        $strSql = "SELECT lease_settings.* FROM leases ";
        $strSql .= "INNER JOIN lease_settings ON leases.id = lease_settings.lease_id ";
        $strSql .= "WHERE leases.room_id = ? AND leases.is_active = ? AND lease_settings.start_date <= ? AND lease_settings.end_date >= ?";
        $strSql .= " LIMIT 1";

        return DB::select($strSql, [$roomId, 1, $currentDate, $currentDate]);
    }

    public static function getUsingRoomById($roomId) {
        $strSql = "SELECT DISTINCT rooms.* ";
        $strSql .= "FROM rooms ";
        $strSql .= "INNER JOIN users ON users.room_id = rooms.id ";
        $strSql .= "WHERE users.is_active = ? AND rooms.is_active = ? AND rooms.id = ?";

        return DB::select($strSql, [1, 1, $roomId]);
    }

    public static function getCurrentPricesByUsage($usage) {
        if (isset($usage) && $usage != null) {
            $priceSetting = PriceSetting::all()->where('id', $usage->price_setting_id)->first();
            if (!isset($priceSetting) || $priceSetting == null) {
                $room = Room::find($usage->room_id)->first();
                $priceSetting = PriceSetting::all()->where('is_active', true)->where('created_by', $room->created_by)->first();
            }

            $leaseId = $usage->lease_setting_id;
            if (isset($leaseId) && $leaseId != null) {
                $lease_setting = LeaseSetting::find($leaseId);
                if (isset($lease_setting) && $lease_setting != null) {
                    if ($lease_setting->room_price != null && $lease_setting->room_price != 0) {
                        $priceSetting->unit_supply = $lease_setting->room_price;
                    }

                    if ($lease_setting->water_price != null && $lease_setting->water_price != 0) {
                        $priceSetting->water_supply = $lease_setting->water_price;
                    }

                    if ($lease_setting->electric_price != null && $lease_setting->electric_price != 0) {
                        $priceSetting->electric_supply = $lease_setting->electric_price;
                    }
                }
            }
            return $priceSetting;
        }
        return null;
    }

    public static function getTenantsNumber() {
        $strSql = "SELECT users.*, rooms.room_number, AVG(usages.water_new - usages.water_old) as avg_water, AVG(usages.electric_new - usages.electric_old) as avg_kwh ";
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
        $customers = DB::select($strSql, [1, 1, false, Auth::user()->getAuthIdentifier()]);
        return count($customers);
    }

    public static function getInvoiceNumber() {
        $strSql = "select users.*, rooms.room_number, rooms.id as room_id from users ";
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
        return count($users);
    }


}