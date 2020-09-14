<?php

namespace App\Gearman;

use GearmanClient;
use Illuminate\Contracts\Queue\Queue;

class GearmanConnector implements \Illuminate\Queue\Connectors\ConnectorInterface
{
    /**
     * @param array $config
     * @return GearmanQueue|Queue
     */
    public function connect(array $config)
    {
        $connection = new GearmanClient();
        $connection->addServer($config['host'], $config['port']);

        return new GearmanQueue($connection);
    }
}
