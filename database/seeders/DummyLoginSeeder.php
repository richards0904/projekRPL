<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'namalengkap' => 'Mas Operator',
                'email' => 'admin@gmail.com',
                'jabatan' => 'admin',
                'password' => bcrypt('admin123!')
            ],
            [
                'namalengkap' => 'Owner Admin',
                'email' => 'owner@gmail.com',
                'jabatan' => 'owner',
                'password' => bcrypt('owner123!')
            ],
            [
                'namalengkap' => 'Mas Pelanggan',
                'email' => 'plgn@gmail.com',
                'jabatan' => 'pelanggan',
                'password' => bcrypt('plgn123!')
            ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
