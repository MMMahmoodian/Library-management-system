<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->slug = 'admin';
        $admin->name = 'Admin';
        $admin->save();

        $staff = new Role();
        $staff->slug = 'staff';
        $staff->name = 'Staff';
        $staff->save();

        $patron = new Role();
        $patron->slug = 'patron';
        $patron->name = 'Patron';
        $patron->save();
    }
}
