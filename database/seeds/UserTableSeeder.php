<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'id' => 'f45de050-5a45-4440-b5cb-dac81e666ac4',
            'password_hash' => '$2y$10$Wx0joQ47v3VDpKeakV.oBObVd5VPHrFyM5I2ZXqP.JCRnrLabbWYq', //1234Qw
            'username' => 'qwertyui',
        ]);
    }
}
