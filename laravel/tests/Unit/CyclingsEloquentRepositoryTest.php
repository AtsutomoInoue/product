<?php
declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\CyclingsEloquentRepository AS Cyclings;

class CyclingsEloquentRepositoryTest extends CyclingsRepositoryInterfaceTest
{
//  use RefreshDatabase;

   protected $Cycling;

   public function setUp(): void
   {
       parent::setUp();

       $this->seed('CyclingsTableSeeder');

       $this->Cyclings = new Cyclings();
   }

   public function tearDown(): void
   {
       Artisan::call('migrate:refresh');
       parent::tearDown();
   }
}
