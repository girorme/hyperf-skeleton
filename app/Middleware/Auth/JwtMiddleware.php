<?php

declare(strict_types=1);

namespace App\Middleware\Auth;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\HttpServer\Contract\RequestInterface as HttpRequest;

class JwtMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var HttpResponse
     */
    protected $response;

    public function __construct(
        ContainerInterface $container, 
        HttpResponse $response,
        HttpRequest $request
    ) {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->request->hasHeader('Authorization')) {
            return $this->response->json([
                'error' => 'Unauthorized'
            ]);
        }

        list(, $token) = explode(' ', ($this->request->header('Authorization')));


        if (!$token) {
            return $this->response->json([
                'error' => 'Unauthorized'
            ]);
        }

        // TODO: check $token against JWT

        return $handler->handle($request);
    }
}