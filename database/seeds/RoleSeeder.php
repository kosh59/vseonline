<?php

use App\Role;
use Illuminate\Database\Seeder;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Role();
        $user->name = 'User';
        $user->slug = 'user';
        $user->save();

        $developer = new Role();
        $developer->name = 'Admin';
        $developer->slug = 'admin';
        $developer->save();
    }
}
