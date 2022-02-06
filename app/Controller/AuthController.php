<?php declare(strict_types=1);

namespace App\Controller;


use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\User;

class AuthController extends AbstractController {
    public function jwtAuth(RequestInterface $request, ResponseInterface $response) {
        $userRequest = $request->all();
        $msgResponse = ['msg' => 'Access Denied', 'token' => null];
        
        $user = User::query()->where([
            'email' => $userRequest['email'],
            'password' => md5($userRequest['password'])
        ])->first();

        if ($user) {
            $token = 'ABC'; // TODO JWT

            $msgResponse['msg'] = 'success';
            $msgResponse['token'] = $token;
        }

        return $response->json($msgResponse);
    }
}