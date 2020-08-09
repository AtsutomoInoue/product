<?php

namespace Tests\Feature\Database;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Cycling;

class CyclingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCycling1()
    {
      $this->assertTrue(
          Schema::hasColumns('cyclings', [
              'id', 'place', 'address', 'comment'
          ]),
          1
      );
    }

    public function testCycling2()
    {
         $cycling = new Cycling();
         $cycling->place = 'スーパーマーケット山田';
         $cycling->address = 'XYZ区ABC町3-2-1-';
         $cycling->comment = '早い、安い、うまい';
         $saveCycling = $cycling->save();

         $this->assertTrue($saveCycling);
   }

   public function testCycling3()
   {
     $cycling = [

     ];

     factory(Cycling::class)->create($cycling);

     $this->assertDatabaseHas('cyclings', $cycling);
   }
}
