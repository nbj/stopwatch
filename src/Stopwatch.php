<?php

namespace Nbj;

use Closure;

class Stopwatch
{

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
