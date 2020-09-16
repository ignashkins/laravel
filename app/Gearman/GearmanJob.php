<?php


namespace App\Gearman;


use GearmanWorker;
use Illuminate\Container\Container;
use Illuminate\Queue\Jobs\JobName;
use Illuminate\Support\Facades\Log;

class GearmanJob extends \Illuminate\Queue\Jobs\Job implements \Illuminate\Contracts\Queue\Job
{
    protected $worker;
    protected $queue;

    public function __construct(Container $container, GearmanWorker $worker, $queue)
    {
        $this->container = $container;
        $this->worker = $worker;

        $this->worker->addFunction($queue, [$this, 'onJob']);
    }

    public function onJob(\GearmanJob $job)
    {
        $workload = $job->workload();

        Log::debug($workload);

        $payload = json_decode($workload, true);

        list($class, $method) = JobName::parse($payload['job']);


        $this->instance = $this->resolve($class);
        $this->instance->{$method}($this, $payload['data']);
    }

    /**
     * @inheritDoc
     */
    public function attempts()
    {
        // TODO: Implement attempts() method.
    }

    /**
     * @inheritDoc
     */
    public function getJobId()
    {
        // TODO: Implement getJobId() method.
    }

    /**
     * @inheritDoc
     */
    public function getRawBody()
    {
        // TODO: Implement getRawBody() method.
    }
}
