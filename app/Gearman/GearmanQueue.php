<?php

namespace App\Gearman;

use Exception;
use GearmanClient;
use GearmanWorker;
use Illuminate\Support\Facades\Log;

class GearmanQueue extends \Illuminate\Queue\Queue implements \Illuminate\Contracts\Queue\Queue
{
    protected $client;
    protected $worker;
    protected $defaultQueue;
    private $queueInfo = [];

    private $notSupport = 'This method not support Gearman';

    public function __construct(GearmanClient $client, GearmanWorker $worker, $defaultQueue)
    {
        $this->client = $client;
        $this->worker = $worker;
        $this->defaultQueue = $defaultQueue;
    }

    /**
     * @inheritDoc
     */
    public function size($queue = null)
    {
        return $this->getQueueInfo($queue) ? intval($this->queueInfo[1]) : 0;
    }

    /**
     * @inheritDoc
     */
    public function push($job, $data = '', $queue = null)
    {
        $payload = json_decode($this->createPayload($job, $queue, $data));
        Log::debug(print_r($payload, true));
        Log::debug(print_r(unserialize($payload->data->command), true));

        $this->client->doBackground(
            $this->getQueue($queue), $this->createPayload($job, $queue, $data)
        );

        return $this->client->returnCode();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function pushRaw($payload, $queue = null, array $options = [])
    {
        throw new Exception($this->notSupport);
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
        return new GearmanJob($this->container, $this->worker, $this->getQueue($queue));

    }

    public function getQueue($queue)
    {
        return $queue ?: $this->defaultQueue;
    }

    /**
     * Get queue (function) data from Gearman
     * from socket connection
     * @param null|string $queue
     * @return bool
     */
    private function getQueueInfo($queue)
    {
        $stream = stream_socket_client("tcp://gearman:4730", $errno, $errstr, 3);

        if ($stream) {
            fputs($stream, "status\n");
            $status = fread($stream, 1024);
            fclose($stream);

            preg_match('/' . $this->getQueue($queue) . '\\t\d+\\t\d+\\t\d+/', $status, $match);

            if (array_key_exists(0, $match)) {
                $this->queueInfo = explode("\t", array_pop($match));
                return true;
            };

        }

        return false;
    }
}
