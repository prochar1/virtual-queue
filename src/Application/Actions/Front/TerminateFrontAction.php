<?php

declare(strict_types=1);

namespace App\Application\Actions\Front;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class TerminateFrontAction extends Action
{
    protected function action(): Response
    {
        $frontId = $this->resolveArg('id');

        // TODO: Implement admin token validation
        // $this->validateAdminToken($frontId);

        // TODO: Terminate front in repository
        // $this->frontRepository->terminate($frontId);

        return $this->respondWithData([
            'message' => "Fronta {$frontId} byla ukončena",
            'front_id' => $frontId,
            'status' => 'terminated',
            'terminated_at' => date('c')
        ]);
    }
}
