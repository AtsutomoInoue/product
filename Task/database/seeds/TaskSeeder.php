<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('tasks')->insert([
            [
              'title' => '資料作成',
              'body' => '来週の会議に使う資料を完成させる。',
              'limit' => '2020-09-08',
              'process_id' => '1',
            ],
            [
              'title' => '客先訪問',
              'body' => '打ち合わせの為、B社へ訪問する。その際にプロジェクトの進捗状況を連絡してもらう。',
              'limit' => '2020-09-14',
              'process_id' => '1',
            ]
          ]);
    }
}
