<?php

declare(strict_types=1);

namespace App\Application\Actions\Front;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class JoinFrontAction extends Action
{
    protected function action(): Response
    {
        $frontId = $this->resolveArg('id');
        $data = $this->getFormData();

        // Generate queue number and user token
        $queueNumber = rand(100, 999);
        $userToken = 'user_' . bin2hex(random_bytes(8));

        $queueEntry = [
            'queue_number' => $queueNumber,
            'user_token' => $userToken,
            'name' => $data['name'] ?? 'Anonymní uživatel',
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'joined_at' => date('c'),
            'front_id' => $frontId
        ];

        // TODO: Add to queue in repository
        // $position = $this->frontRepository->addToQueue($frontId, $queueEntry);

        return $this->respondWithData([
            'queue_number' => $queueEntry['queue_number'],
            'user_token' => $queueEntry['user_token'],
            'position_in_queue' => rand(1, 10),
            'estimated_wait_time' => rand(5, 30),
            'front_id' => $frontId,
            'joined_at' => $queueEntry['joined_at']
        ], 201);
    }
}
