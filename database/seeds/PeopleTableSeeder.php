<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $param =[
            'username' => 'seren',
            'mail' => 'underthesea@co.jp',
            'password' => 'srnsrn',
            'bio' => '海底王国の女王です。',
         ];
         DB::table('users')->insert($param);
    }
}
