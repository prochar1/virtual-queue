<?php

declare(strict_types=1);

namespace App\Application\Actions\Front;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class PingFrontAction extends Action
{
    protected function action(): Response
    {
        $frontId = $this->resolveArg('id');

        // TODO: Implement admin token validation
        // $this->validateAdminToken($frontId);

        // TODO: Update last ping time
        // $this->frontRepository->updateLastPing($frontId);

        return $this->respondWithData([
            'message' => 'Ping úspěšný',
            'front_id' => $frontId,
            'last_ping' => date('c'),
            'status' => 'active'
        ]);
    }
}
