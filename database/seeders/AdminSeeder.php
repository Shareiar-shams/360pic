<?php

namespace Database\Seeders;

use App\Models\Admin\admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' =>'admin',
                'email' =>'admin@example.com',
                'password' => bcrypt('shareiar'),
                'status'=>'1',
                'phone'=>'01307665311',
                'image'=>'noimage.jpg',
                'position'=>'Administor',
            ],
        ];

        foreach ($admins as $key => $value) {

            admin::create($value);
        }
    }
}
