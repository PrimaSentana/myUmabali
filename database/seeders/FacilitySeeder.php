<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facilities')->insert([
            [
                'id' => '1',
                'title' => 'Wi-Fi',
                'image_path' => 'facilities/01KBWT62NTFEBBGTHYE6XRETEV.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '2',
                'title' => 'Shower',
                'image_path' => 'facilities/01KBWT6NX6CPN6QP9N0WKD0KXC.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '3',
                'title' => 'Pool',
                'image_path' => 'facilities/01KBWT7920EVDSGW68ZQKXC16A.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '4',
                'title' => 'Parking Area',
                'image_path' => 'facilities/01KBWT82F57VA0VRH87MNKPAEK.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
