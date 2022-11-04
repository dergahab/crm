<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
       $prioties = [
        [
            'name'  => 'Yüksək',
            'color' => 'red'
        ],
        [
            'name'  => 'Orta',
            'color' => 'blue'
        ],
        [
            'name'  => 'Aşağı',
            'color' => 'yellow'
        ],
    ];

       foreach($prioties as $prioty){
            Priority::create([
                'name' => $prioty['name'],
                'color' => $prioty['color'],
            ]);
       }
    }
}
