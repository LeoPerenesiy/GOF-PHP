<?php

namespace Decorator;

interface OrderService
{
    public function create(array $data): array;
}

class BasicOrderService implements OrderService
{
    public function create(array $data): array
    {
        // business logic
        return [
            'id' => rand(1, 1000),
            'status' => 'created'
        ];
    }
}

class PermissionOrderService implements OrderService
{
    private OrderService $service;

    public function __construct(
        OrderService $service
    ) {
        $this->service = $service;
    }

    public function create(array $data): array
    {
        $user = auth()->user();

        if (!$user || !$user->can('create-order')) {
            throw new \Exception('Forbidden');
        }

        return $this->service->create($data);
    }
}

$service = new BasicOrderService();

// Cover in decorator
$service = new PermissionOrderService($service);

$order = $service->create([
    'product_id' => 1
]);