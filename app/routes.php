<?php

declare(strict_types=1);

use App\Application\Actions\Front\CreateFrontAction;
use App\Application\Actions\Front\GetFrontAction;
use App\Application\Actions\Front\JoinFrontAction;
use App\Application\Actions\Front\NextInFrontAction;
use App\Application\Actions\Front\RemoveFromFrontAction;
use App\Application\Actions\Front\TerminateFrontAction;
use App\Application\Actions\Front\PingFrontAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    // Virtual Queue API endpoints
    $app->group('/api/fronts', function (Group $group) {
        // Vytvoření fronty
        $group->post('', CreateFrontAction::class);

        // Načtení stavu fronty
        $group->get('/{id}', GetFrontAction::class);

        // Zařazení do fronty
        $group->post('/{id}/join', JoinFrontAction::class);

        // Vyvolání dalšího (vyžaduje admin token)
        $group->post('/{id}/next', NextInFrontAction::class);

        // Odebrání z fronty (vyžaduje admin token)
        $group->post('/{id}/remove/{user_id}', RemoveFromFrontAction::class);

        // Ukončení fronty (vyžaduje admin token)
        $group->post('/{id}/terminate', TerminateFrontAction::class);

        // Heartbeat od admina (vyžaduje admin token)
        $group->post('/{id}/ping', PingFrontAction::class);
    });
};
