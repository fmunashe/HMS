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
            'reject_loan',
            'delete_loan',
            'generate_loan_report',
            'add_user',
            'edit_user',
            'hault_user',
            'delete_user',
            'generate_user_report',
            'add_customer',
            'edit_customer_details',
            'delete_customer',
            'blacklist_customer',
            'generate_customer_report',
            'add_inventory',
            'edit_inventory',
            'delete_inventory',
            'reserve_inventory',
            'generate_inventory_report',
            'generate_report',
            'display_reports',
            'capture_installment',
            'view_installments',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // create roles and assign created permissions
        // or may be done by chaining
        $role=Role::create(['name'=>'basic_access']);
        $role->givePermissionTo(['dashboard']);
        $role=Role::create(['name'=>'stores_clerk']);
        $role->givePermissionTo(['add_inventory','edit_inventory','delete_inventory','delete_inventory']);
        $role=Role::create(['name'=>'inputter']);
        $role->givePermissionTo(['add_customer','capture_loan','capture_installment','view_installments']);
        $role = Role::create(['name' => 'authorizer']);
        $role->givePermissionTo(['capture_loan','authorize_loan','reject_loan','add_customer','edit_customer_details']);
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo(Permission::all());
        $role=Role::create(['name'=>'auditor']);
        $role->givePermissionTo(['display_reports','generate_customer_report','generate_inventory_report']);
        //create a default system administrator
        User::create([
            'name' => 'Administrator',
            'email' => 'administrator'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'040',
        ])->assignRole('administrator');
        User::create([
            'name' => 'Authorizer',
            'email' => 'authorizer'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'040',
        ])->assignRole('authorizer');
        User::create([
            'name' => 'Inputter',
            'email' => 'inputter'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'040',
        ])->assignRole('inputter');
        User::create([
            'name' => 'Auditor',
            'email' => 'auditor'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'040',
        ])->assignRole('auditor');
        User::create([
            'name' => 'Basic',
            'email' => 'basic'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'040',
        ])->assignRole('basic_access');
        User::create([
            'name' => 'Stores clerk',
            'email' => 'stores'.'@agribank.co.zw',
            'password' => bcrypt('12345678'),
            'branch'=>'040',
        ])->assignRole('stores_clerk');
    }
}
