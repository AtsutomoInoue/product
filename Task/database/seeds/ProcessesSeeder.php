<?php

use Illuminate\Database\Seeder;

class ProcessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('processes')->insert([
      [
        'id' => '1',
        'process_name' => '未処理',
      ],
      [
        'id' => '2',
        'process_name' => '処理中',
      ],
      [
        'id' => '3',
        'process_name' => '処理済',
      ],
    ]);
    }
}
