<?php

declare(strict_types=1);

namespace App\Application\Actions\Front;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class NextInFrontAction extends Action
{
    protected function action(): Response
    {
        $frontId = $this->resolveArg('id');

        // TODO: Implement admin token validation
        // $this->validateAdminToken($frontId);

        // TODO: Get next person from queue
        // $nextPerson = $this->frontRepository->getNext($frontId);

        // Mock data
        $nextPerson = [
            'queue_number' => rand(100, 999),
            'name' => 'Jan Novák',
            'phone' => '+420123456789',
            'called_at' => date('c')
        ];

        // TODO: Update current number in front
        // $this->frontRepository->updateCurrentNumber($frontId, $nextPerson['queue_number']);

        return $this->respondWithData([
            'called_person' => $nextPerson,
            'current_number' => $nextPerson['queue_number'],
            'remaining_in_queue' => rand(3, 15),
            'front_id' => $frontId
        ]);
    }
}
