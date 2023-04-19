<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Yet to Start',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Started',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'name' => 'In Progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'name' => 'Paused',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'name' => 'Completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        // insert the records in the DB
        DB::table('statuses')->insert($statuses);
    }
}
