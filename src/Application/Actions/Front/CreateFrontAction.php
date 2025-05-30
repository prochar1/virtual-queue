<?php

declare(strict_types=1);

namespace App\Application\Actions\Front;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class CreateFrontAction extends Action
{
    private $frontRepository;

    public function __construct($frontRepository)
    {
        $this->frontRepository = $frontRepository;
        parent::__construct();
    }

    protected function action(): Response
    {
        $data = $this->getFormData();

        // Generate unique IDs and tokens
        $frontId = 'front_' . uniqid();
        $adminToken = 'admin_' . bin2hex(random_bytes(16));

        $front = [
            'id' => $frontId,
            'name' => $data['name'] ?? 'Nová fronta',
            'description' => $data['description'] ?? '',
            'admin_token' => $adminToken,
            'status' => 'active',
            'current_number' => 0,
            'queue' => [],
            'created_at' => date('c'),
            'last_ping' => date('c')
        ];

        // TODO: Save to repository
        $this->frontRepository->create($front);

        return $this->respondWithData([
            'id' => $front['id'],
            'name' => $front['name'],
            'admin_token' => $front['admin_token'],
            'status' => $front['status'],
            'created_at' => $front['created_at']
        ], 201);
    }
}
