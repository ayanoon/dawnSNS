<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->insert([
            [
                'follow' => '5',
                'follower' => '4',
                'created_at' => '2022-8-12 18:35:48',
            ],
            [
                'follow' => '3',
                'follower' => '1',
                'created_at' => '2022-8-12 18:35:48',
            ],
            [
                'follow' => '4',
                'follower' => '1',
                'created_at' => '2022-8-12 18:35:48',
            ],
        ]);
    }
}
