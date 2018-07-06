<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_seller = Role::where('name', 'seller')->first();
        $role_customer = Role::where('name', 'seller')->first();

        $admin = new User();
        $admin->name = 'Oki Candra';
        $admin->email = 'okicandra21@gmail.com';
        $admin->notelp = '081228185607';
        $admin->password = bcrypt('FairyTail04');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $seller = new User();
        $seller->name = 'Dio Satriani';
        $seller->email = 'diosatriani@gmail.com';
        $seller->notelp = '081288991011';
        $seller->password = bcrypt('123456');
        $seller->save();
        $seller->roles()->attach($role_seller);

        $customer = new User();
        $customer->name = 'Abdul Malik';
        $customer->email = 'malikzain@gmail.com';
        $customer->notelp = '082211994433';
        $customer->password = bcrypt('123456');
        $customer->save();
        $customer->roles()->attach($role_customer);

    }
}
