<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;

class AdminAuthMiddleware implements Middleware
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            $response = new SlimResponse();
            $response->getBody()->write(json_encode(['error' => 'Missing admin token']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $token = substr($authHeader, 7);

        // TODO: Validate admin token against database/storage
        if (!$this->validateAdminToken($token)) {
            $response = new SlimResponse();
            $response->getBody()->write(json_encode(['error' => 'Invalid admin token']));
            return $response->withStatus(403)->withHeader('Content-Type', 'application/json');
        }

        return $handler->handle($request);
    }

    /**
     * Validate the admin token.
     * Replace this stub with actual validation logic.
     */
    private function validateAdminToken(string $token): bool
    {
        // TODO: Implement actual token validation logic.
        // For now, accept a hardcoded token for demonstration.
        return $token === 'your_admin_token_here';
    }
}
