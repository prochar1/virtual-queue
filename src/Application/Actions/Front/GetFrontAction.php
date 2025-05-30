<?php

declare(strict_types=1);

namespace App\Application\Actions\Front;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class GetFrontAction extends Action
{
    protected function action(): Response
    {
        $frontId = $this->resolveArg('id');

        // TODO: Get from repository
        // $front = $this->frontRepository->findById($frontId);

        // Mock data for now
        $front = [
            'id' => $frontId,
            'name' => 'Test fronta',
            'description' => 'Popis testovací fronty',
            'status' => 'active',
            'current_number' => 5,
            'queue_length' => 8,
            'estimated_wait_time' => 15, // minutes
            'last_updated' => date('c')
        ];

        return $this->respondWithData($front);
    }
}
