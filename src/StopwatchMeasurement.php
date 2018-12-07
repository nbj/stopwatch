<?php

namespace Nbj;

use Carbon\Carbon;

class StopwatchMeasurement
{
    /**
     * Holds the result of the code executed
     *
     * @var mixed $result
     */
    protected $result;

    /**
     * Holds the start time as a float in seconds
     *
     * @var float $startTime
     */
    protected $startTime;

    /**
     * Holds the end time as a float in seconds
     *
     * @var float $endTime
     */
    protected $endTime;

    /**
     * Holds the execution time as a float in seconds
     *
     * @var float $executionTime
     */
    protected $executionTime;

    /**
     * Sets the result of the measurement
     *
     * @param mixed $result
     *
     * @return $this
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Sets the start time of the measurement
     *
     * @param float $startTime
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Sets the end time of the measurement
     *
     * @param float $endTime
     *
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Sets the execution time of the measurement
     *
     * @param float $executionTime
     *
     * @return $this
     */
    public function setExecutionTime($executionTime)
    {
        $this->executionTime = $executionTime;

        return $this;
    }

    /**
     * Gets the execution time in seconds
     *
     * @return int
     */
    public function seconds()
    {
        return (int) $this->executionTime;
    }

    /**
     * Gets the execution time in milliseconds
     *
     * @return int
     */
    public function milliseconds()
    {
        return (int) ($this->executionTime * 1000);
    }

    /**
     * Gets the execution time in microseconds
     *
     * @return int
     */
    public function microseconds()
    {
        return (int) ($this->executionTime * 1000000);
    }

    /**
     * Gets the execution time in seconds as a float
     *
     * @return float
     */
    public function secondsAsFloat()
    {
        return $this->executionTime;
    }

    /**
     * Gets the execution time in milliseconds as a float
     *
     * @return float
     */
    public function millisecondsAsFloat()
    {
        return ($this->executionTime * 1000);
    }

    /**
     * Gets the execution time in microseconds as a float
     *
     * @return float
     */
    public function microsecondsAsFloat()
    {
        return ($this->executionTime * 1000000);
    }

    /**
     * Gets the result of the code executed
     *
     * @return mixed
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * Get start time as a carbon instance
     *
     * @return Carbon
     */
    public function startTime()
    {
        return Carbon::createFromTimestamp($this->startTime);
    }

    /**
     * Get end time as a carbon instance
     *
     * @return Carbon
     */
    public function endTime()
    {
        return Carbon::createFromTimestamp($this->endTime);
    }

    /**
     * Get start time
     *
     * @return float
     */
    public function rawStartTime()
    {
        return $this->startTime;
    }

    /**
     * Get end time
     *
     * @return float
     */
    public function rawEndTime()
    {
        return $this->endTime;
    }
}
