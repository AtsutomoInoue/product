<?php

use Illuminate\Database\Seeder;

class CyclingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cyclings')->insert([
        ['place' => '場所A',
         'address' => 'A市B区C1-2-3',
         'comment' => '本日は晴天なり',
        ],
        ['place' => '場所B',
         'address' => 'D市E4-56',
         'comment' => '隣の客はよく柿食う客だ',
        ],
        ['place' => '場所C',
         'address' => 'D市E村78-9-0',
         'comment' => '東京特許許可局',
        ],
        ['place' => '場所D',
         'address' => '12-3-4 areaG HCity Inations',
         'comment' => 'ローマは一日にして成らず',
        ]
      ]);
    }
}
