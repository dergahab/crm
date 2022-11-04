<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name'  => 'Yeni',
                'color' => '#1cd94e'
            ],
            [
                'name'  => 'Davam edir',
                'color' => '#108579'
            ],
            [
                'name'  => 'Gözləmədə',
                'color' => '#875807'
            ],
            [
                'name'  => 'Tamamlandi',
                'color' => '#1607eb'
            ],
        ];

        foreach($statuses as $status){
            Status::create([
                'name'  => $status['name'],
                'color' => $status['color'],
            ]);
        }
       
    }
}
