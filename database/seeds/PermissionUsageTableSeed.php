<?php

use Illuminate\Database\Seeder;

class PermissionUsageTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PERMISSION
        $this->generatePermissions();
        $this->generateAdmin();
        $admin = DB::table('users')->where('email', 'dev1@onestoneinc.com')->first();
        $this->generateRooms($admin->id);
        $this->generateRate($admin->id);
        $this->generateUsages();
        $this->generateAccountUser();
        $this->generateGeneralUser();
        $this->generateScannerUser();
        $this->createMaintenances($admin->id);
        $this->createLeases();
    }

    private function generateAdmin() {

        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'is_staff' => true,
            'description' => 'Project Administrator'
        ]);

        $permission = DB::table('permissions')->where('name', 'admin')->first();
        $role = DB::table('roles')->where('name', 'admin')->first();

        DB::table('permission_role')->insert([
            'permission_id' => $permission->id,
            'role_id' => $role->id
        ]);

        DB::table('users')->insert([
            'first_name' => 'Kim',
            'last_name' => 'Dara',
            'email' => 'dev1@onestoneinc.com',
            'password' => bcrypt('123456')
        ]);

        $admin = DB::table('users')->where('email', 'dev1@onestoneinc.com')->first();

        DB::table('role_user')->insert([
            'user_id' => $admin->id,
            'role_id' => $role->id
        ]);
    }

    private function generateGeneralUser()
    {
        DB::table('roles')->insert([
            'name' => 'generaluser',
            'display_name' => 'General User',
            'is_staff' => false,
            'description' => 'generanl User'
        ]);

        $permission = DB::table('permissions')->where('name', 'download_invoice')->first();
        $role = DB::table('roles')->where('name', 'generaluser')->first();

        DB::table('permission_role')->insert([
            'permission_id' => $permission->id,
            'role_id' => $role->id
        ]);

        $room = DB::table('rooms')->where('room_number', '101')->first();
        $admin = DB::table('users')->where('email', 'dev1@onestoneinc.com')->first();

        DB::table('users')->insert([
            'first_name' => 'Cham',
            'last_name' => 'ry',
            'room_id' => $room->id,
            'email' => 'dev2@onestoneinc.com',
            'start_date'=>date("Y-m-d H:i:s"),
            'end_date'=>date("Y-m-d H:i:s", strtotime("+ 12 months")),
            'contact_number' => '023 23 23 23',
            'created_by' => $admin->id,
            'password' => bcrypt('123456')
        ]);

        $devTest = DB::table('users')->where('email', 'dev2@onestoneinc.com')->first();

        DB::table('role_user')->insert([
            'user_id' => $devTest->id,
            'role_id' => $role->id
        ]);
    }

    private function generateScannerUser() {
        DB::table('roles')->insert([
            'name' => 'scanner',
            'display_name' => 'Scanner',
            'is_staff' => true,
            'description' => 'Scanner'
        ]);

        $permission = DB::table('permissions')->where('name', 'scanning')->first();
        $role = DB::table('roles')->where('name', 'scanner')->first();

        DB::table('permission_role')->insert([
            'permission_id' => $permission->id,
            'role_id' => $role->id
        ]);

        $admin = DB::table('users')->where('email', 'dev1@onestoneinc.com')->first();

        DB::table('users')->insert([
            'first_name' => 'Scanner',
            'last_name' => 'ry',
            'email' => 'dev3@onestoneinc.com',
            'contact_number'=> '023 23 23 23',
            'created_by' => $admin->id,
            'start_date'=>date("Y-m-d H:i:s"),
            'end_date'=>date("Y-m-d H:i:s", strtotime("+ 12 months")),
            'password' => bcrypt('123456')
        ]);


        $devTest = DB::table('users')->where('email', 'dev3@onestoneinc.com')->first();

        DB::table('role_user')->insert([
            'user_id' => $devTest->id,
            'role_id' => $role->id
        ]);
    }

    private function generateAccountUser() {

        DB::table('roles')->insert([
            'name' => 'accountant',
            'display_name' => 'Accountant',
            'is_staff' => true,
            'description' => 'Accountant'
        ]);

        $permission = DB::table('permissions')->where('name', 'download_invoice')->first();
        $role = DB::table('roles')->where('name', 'accountant')->first();

        DB::table('permission_role')->insert([
            'permission_id' => $permission->id,
            'role_id' => $role->id
        ]);

        $permission = DB::table('permissions')->where('name', 'paid_invoice')->first();
        DB::table('permission_role')->insert([
            'permission_id' => $permission->id,
            'role_id' => $role->id
        ]);

        $permission = DB::table('permissions')->where('name', 'send_invoice')->first();
        DB::table('permission_role')->insert([
            'permission_id' => $permission->id,
            'role_id' => $role->id
        ]);

        $admin = DB::table('users')->where('email', 'dev1@onestoneinc.com')->first();

        DB::table('users')->insert([
            'first_name' => 'Cham',
            'last_name' => 'ry',
            'email' => 'dev4@onestoneinc.com',
            'contact_number'=> '023 23 23 23',
            'created_by' => $admin->id,
            'password' => bcrypt('123456')
        ]);


        $devTest = DB::table('users')->where('email', 'dev4@onestoneinc.com')->first();

        DB::table('role_user')->insert([
            'user_id' => $devTest->id,
            'role_id' => $role->id
        ]);
    }

    private function generatePermissions() {

        DB::table('permissions')->insert([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'description admin',
            'category_name' =>'admin'

        ]);

        // invoice

        DB::table('permissions')->insert([
            'name' => 'editInvoiceComment',
            'display_name' => 'Edit Comment',
            'description' => 'Edit Comment',
            'category_name' =>'Invoice'
        ]);

        DB::table('permissions')->insert([
            'name' => 'send_invoice',
            'display_name' => 'Email',
            'description' => 'Email',
            'category_name' =>'Invoice'
        ]);

        DB::table('permissions')->insert([
            'name' => 'download_invoice',
            'display_name' => 'Download',
            'description' => 'Download',
            'category_name' =>'Invoice'
        ]);

        DB::table('permissions')->insert([
            'name' => 'paid_invoice',
            'display_name' => 'Paid',
            'description' => 'Be able to click on paid',
            'category_name' =>'Invoice'
        ]);

        DB::table('permissions')->insert([
            'name' => 'scanning',
            'display_name' => 'Scanning',
            'description' => 'Be able to scan the report',
            'category_name' =>'Invoice'
        ]);
        // Tenant
        DB::table('permissions')->insert([
            'name' => 'tenantView',
            'display_name' => 'View',
            'description' => 'Be able to Insert',
            'category_name' =>'User->Tenant'
        ]);
        DB::table('permissions')->insert([
            'name' => 'tenantInsert',
            'display_name' => 'Insert',
            'description' => 'Be able to Insert',
            'category_name' =>'User->Tenant'
        ]);

        DB::table('permissions')->insert([
            'name' => 'tenantDelete',
            'display_name' => 'Delete',
            'description' => 'Be able to Delete',
            'category_name' =>'User->Tenant'
        ]);

        DB::table('permissions')->insert([
            'name' => 'tenantUpdate',
            'display_name' => 'Update',
            'description' => 'Be able to Update',
            'category_name' =>'User->Tenant'
        ]);

        // Staff
        DB::table('permissions')->insert([
            'name' => 'staffView',
            'display_name' => 'View',
            'description' => 'Be able to View',
            'category_name' =>'User->Staff'
        ]);
        DB::table('permissions')->insert([
            'name' => 'staffInsert',
            'display_name' => 'Insert',
            'description' => 'Be able to Insert',
            'category_name' =>'User->Staff'
        ]);

        DB::table('permissions')->insert([
            'name' => 'staffDelete',
            'display_name' => 'Delete',
            'description' => 'Be able to Delete',
            'category_name' =>'User->Staff'
        ]);

        DB::table('permissions')->insert([
            'name' => 'staffUpdate',
            'display_name' => 'Update',
            'description' => 'Be able to Update',
            'category_name' =>'User->Staff'
        ]);

        // Building
        DB::table('permissions')->insert([
            'name' => 'buildingView',
            'display_name' => 'View',
            'description' => 'Be able to View',
            'category_name' =>'Building'
        ]);

        DB::table('permissions')->insert([
            'name' => 'buildingEdit',
            'display_name' => 'Edit',
            'description' => 'Be able to Edit',
            'category_name' =>'Building'
        ]);

        // lease
        DB::table('permissions')->insert([
            'name' => 'leaseView',
            'display_name' => 'View',
            'description' => 'Be able to View',
            'category_name' =>'Lease'
        ]);
        DB::table('permissions')->insert([
            'name' => 'leaseInsert',
            'display_name' => 'Insert',
            'description' => 'Be able to Insert',
            'category_name' =>'Lease'
        ]);

        DB::table('permissions')->insert([
            'name' => 'leaseDelete',
            'display_name' => 'Delete',
            'description' => 'Be able to Delete',
            'category_name' =>'Lease'
        ]);

        DB::table('permissions')->insert([
            'name' => 'leaseUpdate',
            'display_name' => 'Update',
            'description' => 'Be able to Update',
            'category_name' =>'Lease'
        ]);

        // Maintenance
        DB::table('permissions')->insert([
            'name' => 'maintenanceView',
            'display_name' => 'View',
            'description' => 'Be able to View',
            'category_name' =>'Maintenance'
        ]);

        DB::table('permissions')->insert([
            'name' => 'maintenanceEdit',
            'display_name' => 'Edit',
            'description' => 'Be able to Edit',
            'category_name' =>'Maintenance'
        ]);

        // Price Setting
        DB::table('permissions')->insert([
            'name' => 'priceSettingView',
            'display_name' => 'View',
            'description' => 'Be able to View',
            'category_name' =>'Price Setting'
        ]);

        DB::table('permissions')->insert([
            'name' => 'priceSettingEdit',
            'display_name' => 'Edit',
            'description' => 'Be able to Edit',
            'category_name' =>'Price Setting'
        ]);

        // User Role
        DB::table('permissions')->insert([
            'name' => 'roleView',
            'display_name' => 'View',
            'description' => 'Be able to View',
            'category_name' =>'User->Role'
        ]);
        DB::table('permissions')->insert([
            'name' => 'roleInsert',
            'display_name' => 'Insert',
            'description' => 'Be able to Insert',
            'category_name' =>'User->Role'
        ]);

        DB::table('permissions')->insert([
            'name' => 'roleUpdate',
            'display_name' => 'Update',
            'description' => 'Be able to Update',
            'category_name' =>'User->Role'
        ]);

        // Room

        DB::table('permissions')->insert([
            'name' => 'roomView',
            'display_name' => 'roomView',
            'description' => 'Be able to View',
            'category_name' =>'Room'
        ]);
        DB::table('permissions')->insert([
            'name' => 'roomInsert',
            'display_name' => 'Insert',
            'description' => 'Be able to Insert',
            'category_name' =>'Room'
        ]);

        DB::table('permissions')->insert([
            'name' => 'roomDelete',
            'display_name' => 'Delete',
            'description' => 'Be able to Delete',
            'category_name' =>'Room'
        ]);

        DB::table('permissions')->insert([
            'name' => 'roomUpdate',
            'display_name' => 'Update',
            'description' => 'Be able to Update',
            'category_name' =>'Room'
        ]);

        DB::table('permissions')->insert([
            'name' => 'download_maintenance',
            'display_name' => 'Download',
            'description' => 'Be able to Download Maintenance',
            'category_name' =>'Maintenance'
        ]);

    }

    private function generateUsages() {

        $admin = DB::table('users')->where('email', 'dev1@onestoneinc.com')->first();

        $room101 = DB::table('rooms')->where('room_number', '101')->first();
        $price_setting = DB::table('price_setting')->where('created_by', $room101->created_by)->where('is_active', true)->first();

        DB::table('usages')->insert([
            'start_date' => date("Y-m-d H:i:s"),
            'end_date' => date("Y-m-d H:i:s"),
            'electric_old' => 300,
            'electric_new' => 400,
            'water_old' => 340,
            'water_new' => 600,
            'paid_date' => date("Y-m-d H:i:s"),
            'room_id' => $room101->id,
            'price_setting_id' => $price_setting->id
        ]);

        $room102 = DB::table('rooms')->where('room_number', '102')->first();
        $price_setting = DB::table('price_setting')->where('created_by', $room102->created_by)->where('is_active', true)->first();

        DB::table('usages')->insert([
            'start_date' => date("Y-m-d H:i:s"),
            'end_date' => date("Y-m-d H:i:s"),
            'electric_old' => 300,
            'electric_new' => 400,
            'water_old' => 340,
            'water_new' => 600,
            'paid_date' => date("Y-m-d H:i:s"),
            'room_id' => $room102->id,
            'price_setting_id' => $price_setting->id
        ]);


        $room103 = DB::table('rooms')->where('room_number', '103')->first();
        $price_setting = DB::table('price_setting')->where('created_by', $room103->created_by)->where('is_active', true)->first();
        DB::table('usages')->insert([
            'start_date' => date("Y-m-d H:i:s"),
            'end_date' => date("Y-m-d H:i:s"),
            'electric_old' => 300,
            'electric_new' => 400,
            'water_old' => 340,
            'water_new' => 600,
            'paid_date' => date("Y-m-d H:i:s"),
            'room_id' => $room103->id,
            'price_setting_id' => $price_setting->id
        ]);
    }

    private function generateRate($createdUserId) {
        DB::table('price_setting')->insert([
            'water_supply' => 23,
            'electric_supply' => 34,
            'unit_supply' => 45,
            'description' => "price for Aug",
            'created_by' => $createdUserId
        ]);
    }

    private function generateRooms($createdUserId) {
        DB::table('rooms')->insert([
            'room_number' => '101',
            'size' => 34,
            'description' => "room 101",
            'created_by' => $createdUserId
        ]);

        DB::table('rooms')->insert([
            'room_number' => '103',
            'size' => 79,
            'description' => "room 103",
            'created_by' => $createdUserId
        ]);

        DB::table('rooms')->insert([
            'room_number' => '102',
            'size' => 90,
            'description' => "room 102",
            'created_by' => $createdUserId
        ]);


        DB::table('rooms')->insert([
            'room_number' => '105',
            'size' => 20,
            'description' => "room 105",
            'created_by' => $createdUserId
        ]);
    }

    private function createMaintenances($createdUserId) {
        $room101 = DB::table('rooms')->where('room_number', '101')->first();
        DB::table('maintenances')->insert([
            'task_name' => 'Repairing Window',
            'start_date' => date("Y-m-d H:i:s"),
            'end_date' => date("Y-m-d H:i:s"),
            'room_id' => $room101->id,
            'assign_user_id' => $createdUserId,
            'description' => 'Repairing window lock, changed it.',
            'status' => 'done'
        ]);

        DB::table('maintenances')->insert([
            'task_name' => 'Repairing door',
            'start_date' => date("Y-m-d H:i:s"),
            'end_date' => date("Y-m-d H:i:s"),
            'room_id' => $room101->id,
            'assign_user_id' => $createdUserId,
            'description' => 'Repared the door lock',
            'status' => 'done'
        ]);
    }

    private function createLeases() {
        $room101 = DB::table('rooms')->where('room_number', '101')->first();
        DB::table('leases')->insert([
            'start_current_reading_electric' => 700,
            'start_current_reading_water' => 700,
            'room_id' => $room101->id,
            'is_active' => true
        ]);

        $activeLease = DB::table('leases')->where('room_id', $room101->id)->first();
        $endDate = date("Y-m-d H:i:s", strtotime(date("Y-m-d", strtotime( date("Y-m-d H:i:s"))) . " +1 month"));
        DB::table('lease_settings')->insert([
            'start_date' => date("Y-m-d H:i:s"),
            'end_date' => $endDate,
            'lease_id' => $activeLease->id,
            'room_price'=> 23,
            'water_price' => 34,
            'is_active' => true
        ]);
    }
}
