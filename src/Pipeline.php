<?php
declare(strict_types=1);

namespace Cekta\HTTP\Server;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Pipeline implements RequestHandlerInterface
{
    /**
     * @var RequestHandlerInterface
     */
    private $handler;
    /**
     * @var MiddlewareInterface[]
     */
    private $middlewareInterfaces;

    public function __construct(RequestHandlerInterface $handler, MiddlewareInterface ...$middlewareInterfaces)
    {
        $this->handler = $handler;
        $this->middlewareInterfaces = $middlewareInterfaces;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = current($this->middlewareInterfaces);
        next($this->middlewareInterfaces);
        if ($middleware instanceof MiddlewareInterface) {
            return $middleware->process($request, $this);
        }
        return $this->handler->handle($request);
    }
}
