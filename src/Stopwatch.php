<?php

namespace Nbj;

use Closure;

class Stopwatch
{
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
}
