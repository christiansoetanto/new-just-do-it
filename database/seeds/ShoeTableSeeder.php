<?php

use Illuminate\Database\Seeder;

class ShoeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shoes')->insert([
            [
                'name'=> 'Air Jordan XXXV  PF',
                'photo'=> 'airjordanxxxvpf.jpg',
                'description'=> 'Basketball shoe',
                'price'=>'2599000'

            ],
            [
                'name'=> 'Nike Air Max Zephyr',
                'photo'=> 'nikeairmaxzephyr.jpg',
                'description'=> 'Men Shoe',
                'price'=>'1799000'

            ],
            [
                'name'=> 'Nike Air Zoom Pegasus 37',
                'photo'=> 'nikeairzoompegasus37.jpg',
                'description'=> 'Running Shoe',
                'price'=>'2599000'

            ],
            [
                'name'=> 'Nike Zoom Rival Fly 2',
                'photo'=> 'nikezoomrivalfly2.jpg',
                'description'=> 'Running Shoe',
                'price'=>'1279000'

            ],
            [
                'name'=> 'Nike Metcon 6',
                'photo'=> 'nikemetcon6.jpg',
                'description'=> 'Training Shoe',
                'price'=>'1979000'

            ],
            [
                'name'=> 'Nike Renew Fusion',
                'photo'=> 'nikerenewfusion.jpg',
                'description'=> 'Training Shoe',
                'price'=>'1279000'

            ],
            [
                'name'=> 'NikeCourt Air Zoom Vapor X',
                'photo'=> 'nikecourtairzoomvaporx.jpg',
                'description'=> 'Tennis Shoe',
                'price'=>'2099000'

            ],
            [
                'name'=> 'Nike Air Force 1 Crater',
                'photo'=> 'nikeairforce1crater.jpg',
                'description'=> 'Men Shoe',
                'price'=>'1649000'

            ]
        ]);
    }
}
