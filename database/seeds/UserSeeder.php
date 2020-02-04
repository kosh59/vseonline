<?php

use App\Role;
use App\User;
use App\Permission;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Role::where('slug','user')->first();
        $admin = Role::where('slug', 'admin')->first();

        $user1 = new User();
        $user1->name = 'Test Deo';
        $user1->email = 'test@t';
        $user1->password = bcrypt('test');
        $user1->save();
        $user1->roles()->attach($user);

        $user2 = new User();
        $user2->name = 'Admin Thomas';
        $user2->email = 'admin@a';
        $user2->password = bcrypt('admin');
        $user2->save();
        $user2->roles()->attach($admin);
    }
}
