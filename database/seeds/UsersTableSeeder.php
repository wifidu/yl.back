<?php

use App\Model\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user           = new User;
        $user->roles_id = 1;
        $user->name     = "admin";
        $user->email    = "875147715@qq.com";
        $user->password = bcrypt("admin");
        $user->save();
        $user->assignRole('Founder');

        User::insert([
            "roles_id" => 2,
            "name"     => "weifan",
            "email"    => "123@qq.com",
            "password" => $user->password,
        ]);
    }
}
