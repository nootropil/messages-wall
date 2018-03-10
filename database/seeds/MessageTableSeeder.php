<?php

use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message')->insert([
            'id' => 'ae4721de-b8b1-4758-b443-e713d165f043',
            'body' => 'Развивая эту тему, типизация отталкивает амфибрахий – это уже пятая стадия понимания по М.Бахтину.',
            'user_id' => 'f45de050-5a45-4440-b5cb-dac81e666ac4',
        ]);
    }
}
