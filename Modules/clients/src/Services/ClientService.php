<?php

namespace Modules\Clients\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Clients\Models\Client;

class ClientService
{
    public function createClient(array $data): Client
    {
        return Client::query()->create($data);
    }

    public function updateClient(Client $client, array $data): Client
    {
        $client->update($data);

        return $client->fresh();
    }

    public function deleteClient(Client $client): bool
    {
        return (bool) $client->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Client::query()
            ->where('company_id', $companyId)
            ->orderBy('client_name')
            ->get();
    }

    public function findOrFail(int $clientId): Client
    {
        return Client::query()->findOrFail($clientId);
    }
}
