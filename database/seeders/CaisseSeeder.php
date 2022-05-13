<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Caisse;

class CaisseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caisses = [
            [
                'title' => 'Caisse 1',
                'status' => 'active',
                'address' => '1er étage',
            ],
            [
                'title' => 'Caisse 2',
                'status' => 'active',
                'address' => 'Red de chaussé',
            ]
        ];

       foreach ($caisses as $caisse) {
            Caisse::create($caisse);
       }

    }
}
