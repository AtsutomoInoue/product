<?php

use Illuminate\Database\Seeder;

class PlamodelTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('plamodels')->insert([
          [
            'name' => 'ロボット１',
            'maker' => 'メーカーA',
            'price' => '500',
            'released' => '200001',
            'point' => '組み立てやすい',
            'comment' => '組み上げた時の出来栄えが良く飾りやすい。但し付属品が少ない',
          ],
          [
            'name' => '車１',
            'maker' => 'メーカーB',
            'price' => '1500',
            'released' => '200511',
            'point' => '内部まで徹底したディテール',
            'comment' => 'この値段で精密性が高く、アレンジのしやすさも良いが、紛失に注意',
          ],
          [
            'name' => 'キャラ１',
            'maker' => 'メーカーC',
            'price' => '3500',
            'released' => '201806',
            'point' => '表情パーツの豊かさ',
            'comment' => 'キャラクタープラモとしては表情パーツに富んでいる。しかし、可動が狭いのが気になる所',
          ],
        ]);
    }
}
