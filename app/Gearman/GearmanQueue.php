<?php

namespace App\Gearman;

use GearmanClient;

class GearmanQueue implements \Illuminate\Contracts\Queue\Queue
{
    protected $connection;

    public function __construct(GearmanClient $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function size($queue = null)
    {
        // TODO: Implement size() method.
    }

    /**
     * @inheritDoc
     */
    public function push($job, $data = '', $queue = null)
    {
        // TODO: Implement push() method.
        // dd($this->connection->doStatus());
    }

    /**
     * @inheritDoc
     */
    public function pushOn($queue, $job, $data = '')
    {
        // TODO: Implement pushOn() method.
    }

    /**
     * @inheritDoc
     */
    public function pushRaw($payload, $queue = null, array $options = [])
    {
        // TODO: Implement pushRaw() method.
    }

    /**
     * @inheritDoc
     */
    public function later($delay, $job, $data = '', $queue = null)
    {
        // TODO: Implement later() method.
    }

    /**
     * @inheritDoc
     */
    public function laterOn($queue, $delay, $job, $data = '')
    {
        // TODO: Implement laterOn() method.
    }

    /**
     * @inheritDoc
     */
    public function bulk($jobs, $data = '', $queue = null)
    {
        // TODO: Implement bulk() method.
    }

    /**
     * @inheritDoc
     */
    public function pop($queue = null)
    {
        // TODO: Implement pop() method.
    }

    /**
     * @inheritDoc
     */
    public function getConnectionName()
    {
        // TODO: Implement getConnectionName() method.
    }

    /**
     * @inheritDoc
     */
    public function setConnectionName($name)
    {
        // TODO: Implement setConnectionName() method.
    }
}
