<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
            $saveUser = new User();
            $saveUser->name = "Mpabaisis Technologies";
            $saveUser->email = "app.users21@gmail.com";
            $saveUser->password = Hash::make("admin123@");
            $saveUser->save();

     
    }
}
