<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TasksRepositoryInterface AS TasksRepository;

class TasksTestController extends Controller
{
    protected $Tasks;

    public function __construct(TasksRepository $Tasks)
    {
      $this->Tasks = $Tasks;
    }

    public function index()
    {

    }
}
