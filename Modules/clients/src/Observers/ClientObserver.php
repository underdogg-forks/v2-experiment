<?php

namespace Modules\Clients\Observers;

use Modules\Clients\Models\Client;
use Carbon\Carbon;

class ClientObserver
{
    /**
     * Handle the Client "creating" event.
     *
     * @param  Client  $client
     * @return void
     */
    public function creating(Client $client)
    {
        if (empty($client->client_date_created)) {
            $client->client_date_created = Carbon::now();
        }
        if (empty($client->client_date_modified)) {
            $client->client_date_modified = Carbon::now();
        }
    }

    /**
     * Handle the Client "updating" event.
     *
     * @param  Client  $client
     * @return void
     */
    public function updating(Client $client)
    {
        $client->client_date_modified = Carbon::now();
    }
}
