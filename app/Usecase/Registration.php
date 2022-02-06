<?php declare(strict_types=1);

namespace App\Usecase;

use App\Model\User;
use App\Util\Crypto;

class Registration {
    public static function register($user, $email, $password) {
        $user = User::create([
            'id' => Crypto::generateUuid(),
            'name' => $user,
            'email' => $email,
            'password' => md5($password)
        ]);

        return $user instanceof User;
    }
}