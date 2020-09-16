<?php

namespace App\Gearman;

use GearmanClient;
use GearmanWorker;
use Illuminate\Contracts\Queue\Queue;

class GearmanConnector implements \Illuminate\Queue\Connectors\ConnectorInterface
{
    /**
     * @param array $config
     * @return GearmanQueue|Queue
     */
    public function connect(array $config)
    {
        $client = new GearmanClient();
        $client->addServer($config['host'], $config['port']);

        $worker = new GearmanWorker();
        $worker->addServer($config['host'], $config['port']);

        return new GearmanQueue($client, $worker, $config['queue']);
    }
}
