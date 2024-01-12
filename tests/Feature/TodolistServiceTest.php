<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{

    private TodolistService $todolistService;


    protected function setUp():void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodoListNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo('1', 'test');

        $todolist = Session::get('todolist');

        foreach ($todolist as $value){
            self::assertEquals($value['id'], '1');
            self::assertEquals($value['todo'], 'test');
        }

    }

    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodoList());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'php'
            ],
            [
                'id' => '2',
                'todo' => 'javascript'
            ]
        ];

        $this->todolistService->saveTodo('1', 'php');
        $this->todolistService->saveTodo('2', 'javascript');

        self::assertEquals($expected, $this->todolistService->getTodoList());
    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo('1', 'js');
        $this->todolistService->saveTodo('2', 'php');
        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo('3');
        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo('1');
        self::assertEquals(1, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo('2');
        self::assertEquals(0, sizeof($this->todolistService->getTodoList()));
    }


}
