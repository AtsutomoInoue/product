<?php

use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
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
        'process_id' => '1',
        'process' => '未処理',
      ],
      [
        'process_id' => '2',
        'process' => '処理中',
      ],
      [
        'process_id' => '3',
        'process' => '処理済',
      ],
    ]);
    }
}
