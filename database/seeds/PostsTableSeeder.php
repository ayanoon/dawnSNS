<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => '1',
                'posts' => 'こんにちは。今日もいい天気！',
                'created_at' => '2022-8-12 18:35:48',
                'updated_at' => '2022-8-12 18:35:48',
            ],
        ]);
    }
}
