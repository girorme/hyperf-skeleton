<?php declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use Hyperf\HttpServer\Contract\RequestInterface;
use App\Usecase\Registration;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;

class UserController extends AbstractController
{
    public function index(RequestInterface $request)
    {
        return User::get();
    }

    public function show(string $id)
    {
        return User::find($id);
    }

    public function store(RequestInterface $request, ResponseInterface $response): Psr7ResponseInterface
    {
        $responseData = ['success' => true, 'message' => 'User registration ok'];
        $user = $request->all()['user'];
        
        if (!Registration::register($user['name'], $user['email'], $user['password'])) {
            $response['success'] = false;
            $response['message'] = 'Error on registration';

            return $response->json($responseData);
        }
        
        return $response->json($responseData);
    }

    public function delete(string $id)
    {
        return User::destroy($id);
    }
}