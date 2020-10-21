<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
         ->see('タスク')
         ->see('新規作成')
         ->click('新規作成')
         ->seePageIs('/create')
         ->see('新規作成');

    }
}
