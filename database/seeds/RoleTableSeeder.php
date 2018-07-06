<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          $role_admin = new Role();
          $role_admin->name = 'admin';
          $role_admin->description = 'User tertinggi (Super User)';
          $role_admin->save();

          $role_seller = new Role();
          $role_seller->name = 'seller';
          $role_seller->description = 'Seller user';
          $role_seller->save();

          $role_customer = new Role();
          $role_customer->name = 'customer';
          $role_customer->description = 'Customer user';
          $role_customer->save();
    }
}
