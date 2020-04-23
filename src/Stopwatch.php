<?php

namespace Nbj;

use Closure;
use RuntimeException;

class Stopwatch
{
    /**
     * Holds the start micro time
     *
     * @var string|float $startTime
     */
    protected $startTime = null;

    /**
     * Holds the end micro time
     *
     * @var string|float $endTime
     */
    protected $endTime = null;

    /**
     * Times the execution of a closure containing the code needed to be timed
     *
     * @param Closure $closure
     * @return StopwatchMeasurement
     */
    public static function time(Closure $closure)
    {
        $startTime = microtime(true);

        $result = $closure();

        $endTime = microtime(true);

        $executionTime = $endTime - $startTime;

        return (new StopwatchMeasurement)
            ->setResult($result)
            ->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setExecutionTime($executionTime);
    }

    /**
     * Named constructor for ease of use
     *
     * @return static
     */
    public static function create()
    {
        return new static;
    }

    /**
     * Sets the start time of the measurement
     *
     * @return $this
     */
    public function start()
    {
        $this->startTime = microtime(true);

        return $this;
    }

    /**
     * Sets the stop time of the measurement
     *
     * @return $this
     *
     * @throws RuntimeException
     */
    public function stop()
    {
        if ($this->startTime === null) {
            throw new RuntimeException('Stopwatch has not been started yet, so it cannot be stopped');
        }

        $this->endTime = microtime(true);

        return $this;
    }

    /**
     * Gets the measurement once start and stop time has been set
     *
     * @return StopwatchMeasurement
     *
     * @throws RuntimeException
     */
    public function getMeasurement()
    {
        if ($this->startTime === null || $this->endTime === null) {
            throw new RuntimeException('Stopwatch has either not been started yet or stopped, so nothing can be measured');
        }

        $executionTime = $this->endTime - $this->startTime;

        return (new StopwatchMeasurement)
            ->setStartTime($this->startTime)
            ->setEndTime($this->endTime)
            ->setExecutionTime($executionTime);
    }
}
