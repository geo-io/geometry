<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;
use PHPUnit\Framework\TestCase;

class MultiPointTest extends TestCase
{
    public function testConstructorShouldThrowExceptionForMixedDimensionality(): void
    {
        $this->expectException(MixedDimensionalityException::class);

        new MultiPoint(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D),
            new Point(Dimension::DIMENSION_4D),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedSrids(): void
    {
        $this->expectException(MixedSridsException::class);

        new MultiPoint(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D, 1234),
            new Point(Dimension::DIMENSION_4D),
        );
    }

    public function testConstructorShouldAllowEmptySridAndPoints(): void
    {
        $lineString = new MultiPoint(Dimension::DIMENSION_2D);

        $this->assertTrue($lineString->isEmpty());
    }
}
