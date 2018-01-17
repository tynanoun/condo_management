<?php

/**
 * Created by PhpStorm.
 * User: TINA NOUN
 * Date: 8/30/2017
 * Time: 2:21 PM
 */
class Helpers
{

    public function getConsumptionList() {
        $strSql = "SELECT users.id, rooms.room_number, AVG(usages.electric_new - usages.electric_old) as avg_kwh ";
        $strSql .= "FROM users ";
        $strSql .= "INNER JOIN rooms on users.room_id = rooms.id ";
        $strSql .= "INNER JOIN usages on usages.room_id = rooms.id ";
        $strSql .= "INNER JOIN role_user on users.id = role_user.user_id ";
        $strSql .= "INNER JOIN roles on roles.id = role_user.role_id ";
        $strSql .= "WHERE rooms.is_active = ? and users.is_active = ? ";
        $strSql .= "AND roles.is_staff = ? and users.created_by = ? ";
        $strSql .= "GROUP BY users.id, rooms.room_number ";
        $users = DB::select($strSql, [1, 1, true, Auth::user()->getAuthIdentifier()]);

        return $users;

    }
}