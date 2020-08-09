<?php

namespace Tests\Feature\Database;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Plamodel;

class PlamodelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     public function testPlamodel1()
     {
       $this->assertTrue(
         Schema::hasColumns('plamodels',[
           'id','name','maker','price','released'
         ]),
         1
       );
     }

     public function testPlamodel2()
     {
          $plamodel = new Plamodel();
          $plamodel->name = 'aaaa';
          $plamodel->maker = 'doom';
          $plamodel->price = '300';
          $plamodel->released = '199906';
          $plamodel->point = 'ああああ';
          $plamodel->comment = 'あばあばばば';
          $savePlamodel = $plamodel->save();

          $this->assertTrue($savePlamodel);
    }

    public function testPlamodel3()
    {
      $plamodel = [

      ];

      factory(Plamodel::class)->create($plamodel);

      $this->assertDatabaseHas('plamodels', $plamodel);
    }

}
