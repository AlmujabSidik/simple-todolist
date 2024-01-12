<?php

    namespace Tests\Feature;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Tests\TestCase;

    class TodolistControllerTest extends TestCase
    {
        public function testTodolist()
        {
            $this->withSession([ 'user' => 'admin' , 'todolist' => [ 'id' => '1' , 'todo' => 'learn Laravel' , ] ])->get('/todolist')->assertSeeText('1')->assertSeeText('learn laravel');
        }

        public function testAddTodoFailed()
        {
            $this->withSession([
                'user' => 'admin',
                               ])->post('/todolist', [])->assertSeeText('todo cannot be empty');
        }

        public function testAddTodoSuccess()
        {
            $this->withSession([
                                   'user' => 'admin',
                               ])->post('/todolist', [
                                   'todo' => 'learn laravel',
            ])->assertRedirect('/todolist');
        }

        public function testRemoveTodolist()
        {

            $this->withSession([
                                   "user" => "admin",
                                   "todolist" => [
                                       [
                                           "id" => "1",
                                           "todo" => "learn php"
                                       ],
                                       [
                                           "id" => "2",
                                           "todo" => "learn laravel"
                                       ]
                                   ]
                               ])->post("/todolist/1/delete")
                ->assertRedirect("/todolist");

        }





    }
