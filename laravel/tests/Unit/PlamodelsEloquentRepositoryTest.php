<?php
declare(strict_types=1);

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\repositories\PlamodelsEloquentRepository AS Plamodels;

class PlamodelsEloquentRepositoryTest extends  PlamodelsRepositoryInterfaceTest
{
    use RefreshDatabase;

    protected $Plamodels;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('PlamodelTableSeeder');

        $this->Plamodels = new Plamodels();
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }
}
