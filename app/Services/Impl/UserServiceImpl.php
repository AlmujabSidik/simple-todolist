<?php

namespace App\Services\Impl;

use App\Services\UserServices;

class UserServiceImpl implements UserServices
{

    private array $users = [
        'admin' => 'admin'
    ];
    public function login( string $user , string $password ): bool
    {
        if (!isset($this->users[$user])){
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password == $correctPassword;
    }

}
