<?php

declare(strict_types=1);

namespace App\Application\Actions\Front;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class RemoveFromFrontAction extends Action
{
    protected function action(): Response
    {
        $frontId = $this->resolveArg('id');
        $userId = $this->resolveArg('user_id');

        // TODO: Implement admin token validation
        // $this->validateAdminToken($frontId);

        // TODO: Remove user from queue
        // $removed = $this->frontRepository->removeFromQueue($frontId, $userId);

        return $this->respondWithData([
            'message' => "Uživatel {$userId} byl odebrán z fronty {$frontId}",
            'removed_user_id' => $userId,
            'front_id' => $frontId,
            'removed_at' => date('c')
        ]);
    }
}
