<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\repositories\TasksEloquentRepository As Tasks;

class TasksEloquentRepositoryTest extends TasksRepositoryInterfaceTest
{
    //use RefreshDatabase;
    protected $Tasks;

    public function setUp(): void
    {
      parent::setUp();

      $this->seed('TaskSeeder');

      $this->Tasks = new Tasks();
    }

    public function tearDown(): void
    {
      Artisan::call('migrate:refresh');
      parent::tearDown();
    }

}
