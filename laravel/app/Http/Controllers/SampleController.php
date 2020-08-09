<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\repositories\PlamodelsRepositoryInterface AS PlamodelsRepository;
//use App\Repositories\CyclesRepositoryInterface AS CyclesRepository;

class SampleController extends Controller
{
    protected $Plamodels;
    protected $Cyclings;

    public function __construct(CycllingsRepository$Cycllings)
    {
    $this->Cycllings=$Cycllings;
    }

    public function __construct(PlamodelsRepository $Plamodels)
    {
        $this->Plamodels = $Plamodels;
    }
    public function index()
    {
      // $this->Cyclings->all()
      // $this->Cyclings->get(1)
      // $this->Cyclings->insert('place_01','address01-2-3','comment01');
      // $this->Cyclings->update(11, 'place_11','address45-6-7','comment11');
      // $this->Cyclings->delete(11);

      // $this->Plamodels->all()
      // $this->Plamodels->get(1)
      // $this->Plamodels->insert('member_011','maker_01',1000,202008,'point01','comment01');
      // $this->Plamodels->update(11, 'member_11','maker_11',1100,202108,'point11','comment11'););
      // $this->Plamodels->delete(11);
    }
}
