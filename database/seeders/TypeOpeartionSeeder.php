<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeOperation;

class TypeOpeartionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeopeartions = [
            [
            'title' => 'Dépôt de caisse',
            'status' => 'active',
            'action' => 'in'
            ],
            [
                'title' => 'Remise en banque',
                'status' => 'active',
                'action' => 'out'
            ],
            [
                'title' => 'Retrait',
                'status' => 'active', 
                'action' => 'out'
            ]
        ];

       foreach ($typeopeartions as $typeopeartion) {
            TypeOperation::create($typeopeartion);
       }

    }
}
