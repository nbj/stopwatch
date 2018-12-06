<?php

namespace Tests;

use Carbon\Carbon;
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
            time_nanosleep(0, 100000000);
        });

        // As any sleep function promises to sleep for at least the given time, it
        // cannot promise when it will be scheduled cpu time again afterwards. So
        // we must take this into account, and give our tests some leeway (5ms)
        $this->assertGreaterThanOrEqual(0, $measurement->secondsAsFloat());
        $this->assertLessThanOrEqual(1, $measurement->secondsAsFloat());
        $this->assertTrue(is_float($measurement->secondsAsFloat()));

        $this->assertGreaterThanOrEqual(100, $measurement->millisecondsAsFloat());
        $this->assertLessThanOrEqual(105, $measurement->millisecondsAsFloat());
        $this->assertTrue(is_float($measurement->millisecondsAsFloat()));

        $this->assertGreaterThanOrEqual(100000, $measurement->microsecondsAsFloat());
        $this->assertLessThanOrEqual(105000, $measurement->microsecondsAsFloat());
        $this->assertTrue(is_float($measurement->microsecondsAsFloat()));
    }

    /** @test */
    public function it_knows_the_time_it_was_started_and_ended()
    {
        $now = Carbon::now();

        /** @var StopwatchMeasurement $measurement */
        $measurement = Stopwatch::time(function () {
            time_nanosleep(0, 100000000);
        });

        $this->assertInstanceOf(Carbon::class, $measurement->startTime());
        $this->assertEquals($measurement->startTime()->day, $now->day);
        $this->assertEquals($measurement->startTime()->hour, $now->hour);
        $this->assertEquals($measurement->startTime()->minute, $now->minute);

        $this->assertInstanceOf(Carbon::class, $measurement->endTime());
        $this->assertEquals($measurement->endTime()->day, $now->day);
        $this->assertEquals($measurement->endTime()->hour, $now->hour);
        $this->assertEquals($measurement->endTime()->minute, $now->minute);
    }

    /** @test */
    public function it_knows_the_original_timestamp_for_when_it_was_started_and_ended()
    {
        /** @var StopwatchMeasurement $measurement */
        $measurement = Stopwatch::time(function () {
            time_nanosleep(0, 100000000);
        });

        $this->assertTrue(is_float($measurement->rawStartTime()));
        $this->assertTrue(is_float($measurement->rawEndTime()));
    }
}
