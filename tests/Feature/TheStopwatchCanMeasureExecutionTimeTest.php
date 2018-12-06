<?php

namespace Tests;

use Nbj\Stopwatch;
use Nbj\StopwatchMeasurement;
use PHPUnit\Framework\TestCase;

class TheStopwatchCanMeasureExecutionTimeTest extends TestCase
{
    /** @test */
    public function it_can_measure_the_time_of_a_closure()
    {
        /** @var StopwatchMeasurement $measurement */
        $measurement = Stopwatch::time(function () {
            time_nanosleep(0, 100000000);
        });

        // As any sleep function promises to sleep for at least the given time, it
        // cannot promise when it will be scheduled cpu time again afterwards. So
        // we must take this into account, and give our tests some leeway (5ms)
        $this->assertEquals(0, $measurement->seconds());

        $this->assertGreaterThanOrEqual(100, $measurement->milliseconds());
        $this->assertLessThanOrEqual(105, $measurement->milliseconds());

        $this->assertGreaterThanOrEqual(100000, $measurement->microseconds());
        $this->assertLessThanOrEqual(105000, $measurement->microseconds());
    }

    /** @test */
    public function it_returns_the_result_of_the_closure_to_the_measure_object()
    {
        /** @var StopwatchMeasurement $measurement */
        $measurement = Stopwatch::time(function () {
            return 'this-is-the-closures-result';
        });

        $this->assertEquals('this-is-the-closures-result', $measurement->result());
    }

    /** @test */
    public function it_can_get_the_raw_execution_time()
    {
        /** @var StopwatchMeasurement $measurement */
        $measurement = Stopwatch::time(function () {
            usleep(100);
        });

        // As any sleep function promises to sleep for at least the given time, it
        // cannot promise when it will be scheduled cpu time again afterwards. So
        // we must take this into account, and give our tests some leeway (5ms)
        $this->assertGreaterThanOrEqual(0, $measurement->secondsAsFloat());
        $this->assertLessThanOrEqual(1, $measurement->secondsAsFloat());

        $this->assertGreaterThanOrEqual(100, $measurement->millisecondsAsFloat());
        $this->assertLessThanOrEqual(105, $measurement->millisecondsAsFloat());

        $this->assertGreaterThanOrEqual(100000, $measurement->microsecondsAsFloat());
        $this->assertLessThanOrEqual(105000, $measurement->microsecondsAsFloat());
    }
}
