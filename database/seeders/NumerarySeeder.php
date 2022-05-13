<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Numerary;

class NumerarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numeraries = [
            [
           'value' => '5',
           'type' => 'banknote',
           'status' => 'accept'
       ],
       [
            'value' => '10',
            'type' => 'banknote',
            'status' => 'accept'
        ],
        [
            'value' => '20',
            'type' => 'banknote',
            'status' => 'accept'
       ],
       [
            'value' => '50',
            'type' => 'banknote',
            'status' => 'accept'
       ],
       [
            'value' => '100',
            'type' => 'banknote',
            'status' => 'accept'
       ],
       [
            'value' => '200',
            'type' => 'banknote',
            'status' => 'accept'
       ],
       [
            'value' => '500',
            'type' => 'banknote',
            'status' => 'accept'
       ],
       [
        'value' => '1',
        'type' => 'coin',
        'status' => 'accept'
       ],
       [
        'value' => '2',
        'type' => 'coin',
        'status' => 'accept'
       ],
       [
        'value' => '1',
        'type' => 'cent',
        'status' => 'accept'
       ],
       [
        'value' => '2',
        'type' => 'cent',
        'status' => 'accept'
       ],
       [
        'value' => '5',
        'type' => 'cent',
        'status' => 'accept'
       ],
       [
        'value' => '10',
        'type' => 'cent',
        'status' => 'accept'
       ],
       [
        'value' => '20',
        'type' => 'cent',
        'status' => 'accept'
       ],
       [
        'value' => '50',
        'type' => 'cent',
        'status' => 'accept'
       ]
    ];

       foreach ($numeraries as $numerary) {
            Numerary::create($numerary);
       }
    }
}
