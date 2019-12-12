<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create permissions
        $permissions = [
            'dashboard',
            'capture_loan',
            'authorize_loan',
            'edit_loan',
            'roll_back_loan',
            'delete_loan',
            'view_loan',
            'add_user',
            'edit_user',
            'update_user',
            'delete_user',
            'view_user',
            'add_customer',
            'edit_customer',
            'update_customer',
            'delete_customer',
            'view_customer',
            'add_inventory',
            'edit_inventory',
            'update_inventory',
            'delete_inventory',
            'view_inventory',
            'capture_installment',
            'view_installments',
            'add_facility',
            'edit_facility',
            'update_facility',
            'delete_facility',
            'view_facility',
            'add_branch',
            'edit_branch',
            'update_branch',
            'delete_branch',
            'view_branch',
            'add_currency',
            'edit_currency',
            'update_currency',
            'delete_currency',
            'view_currency',
            'add_rates',
            'edit_rates',
            'update_rates',
            'delete_rates',
            'view_rates',
            'add_repayment_period',
            'edit_repayment_period',
            'update_repayment_period',
            'delete_repayment_period',
            'view_repayment_period',
            'add_status',
            'edit_status',
            'update_status',
            'delete_status',
            'view_status',
            'add_role',
            'edit_role',
            'update_role',
            'delete_role',
            'view_role',
            'add_permission',
            'edit_permission',
            'update_permission',
            'delete_permission',
            'view_permission',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // create roles and assign created permissions
        // or may be done by chaining
        $role=Role::create(['name'=>'basic_access']);
        $role->givePermissionTo(['dashboard']);
        $role=Role::create(['name'=>'stores_clerk']);
        $role->givePermissionTo(['add_inventory','edit_inventory','update_inventory','delete_inventory','view_inventory','dashboard']);
        $role=Role::create(['name'=>'inputter']);
        $role->givePermissionTo(['add_customer','edit_customer','update_customer','delete_customer','view_customer','capture_loan','capture_installment','view_installments','roll_back_loan','dashboard']);
        $role = Role::create(['name' => 'authorizer']);
        $role->givePermissionTo(['authorize_loan','dashboard']);
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo(Permission::all());
        $role=Role::create(['name'=>'auditor']);
        $role->givePermissionTo(['view_loan','view_user','view_customer','view_inventory','view_branch','view_facility','view_currency','view_rates','view_repayment_period','view_role','view_status','view_permission','dashboard']);
        //create a default system administrator
        User::create([
            'name' => 'Administrator',
            'email' => 'administrator'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'ZW0010001',
        ])->assignRole('administrator');
        User::create([
            'name' => 'Authorizer',
            'email' => 'fzihove'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'ZW0010001',
        ])->assignRole('authorizer');
        User::create([
            'name' => 'Inputter',
            'email' => 'inputter'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'ZW0010001',
        ])->assignRole('inputter');
        User::create([
            'name' => 'Auditor',
            'email' => 'auditor'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'ZW0010001',
        ])->assignRole('auditor');
        User::create([
            'name' => 'Basic',
            'email' => 'basic'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'ZW0010001',
        ])->assignRole('basic_access');
        User::create([
            'name' => 'Stores clerk',
            'email' => 'stores'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'ZW0010001',
        ])->assignRole('stores_clerk');
    }
}
