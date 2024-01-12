<?php

namespace Tests\Feature;

use App\Services\UserServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertFalse;

class UserServiceTest extends TestCase
{
    private UserServices $userService;

    protected function setUp():void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserServices::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login('admin', 'admin'));
    }

    public function testLoginFailed()
    {
        self::assertFalse($this->userService->login('admin', 'password'));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login('admin', '12345'));
    }


}
