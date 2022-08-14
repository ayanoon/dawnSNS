<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'eleven',
                'mail' => 'eleven@mail.com',
                'password' => Hash::make('elvnelvn'), //パスワードをハッシュ化、もとの文字列から変換する
                'created_at' => '2022-8-12 18:35:48',
                'updated_at' => '2022-8-12 18:35:48',
            ],
            [
                'username' => 'camus',
                'mail' => 'camus@mail.com',
                'password' => Hash::make('cmcm'), //パスワードをハッシュ化、もとの文字列から変換する
                'created_at' => '2022-8-12 18:35:48',
                'updated_at' => '2022-8-12 18:35:48',
            ],
            [
                'username' => 'senya',
                'mail' => 'senya@mail.com',
                'password' => Hash::make('snysny'), //パスワードをハッシュ化、もとの文字列から変換する
                'created_at' => '2022-8-12 18:35:48',
                'updated_at' => '2022-8-12 18:35:48',
            ],
            [
                'username' => 'veronica',
                'mail' => 'veronica@mail.com',
                'password' => Hash::make('vrncvnc'), //パスワードをハッシュ化、もとの文字列から変換する
                'created_at' => '2022-8-12 18:35:48',
                'updated_at' => '2022-8-12 18:35:48',
            ],
        ]);
    }
}
