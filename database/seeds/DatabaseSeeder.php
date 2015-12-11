<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * データベース初期値設定実行.
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
