<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogin()
    {
        $this->get('/login')->assertSeeText('Login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
                                'user' => 'admin'
                           ])->get('/login')->assertRedirect('/');
    }


    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "admin",
            "password" => "admin"
        ])->assertRedirect('/')
            ->assertSessionHas("user", "admin");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
                                'user'=>'admin'
                           ])->post('/login', [
            "user" => "admin",
            "password" => "admin"
        ])->assertRedirect('/');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])->assertSeeText('User and password are required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'author',
            'password' => 'author'
        ])->assertSeeText('Invalid user or password');
    }

    public function testLogout()
    {
        $this->withSession([
                                'user' => 'admin'
                           ])->post('/logout')->assertRedirect('/')->assertSessionMissing('user');
    }

    public function testGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }

}
