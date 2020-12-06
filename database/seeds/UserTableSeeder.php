<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'=>'budi',
                'email'=>'budi@gmail.com',
                'password'=>bcrypt('budi12345'),
                'role'=>'admin'
            ],
            [
                'name'=>'laura',
                'email'=>'laura@gmail.com',
                'password'=>bcrypt('laura12345'),
                'role'=>'admin'
            ],
            [
                'name'=>'erina',
                'email'=>'erina@gmail.com',
                'password'=>bcrypt('erina12345'),
                'role'=>'member'
            ]

        ]);
    }
}
