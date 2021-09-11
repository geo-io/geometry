<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;
use PHPUnit\Framework\TestCase;

class LineStringTest extends TestCase
{
    public function testConstructorShouldRequireAtLeastTwoPositions(): void
    {
        $this->expectException(InsufficientNumberOfGeometriesException::class);

        new LineString(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D, 4326),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedDimensionality(): void
    {
        $this->expectException(MixedDimensionalityException::class);

        new LineString(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D, 4326),
            new Point(Dimension::DIMENSION_4D, 4326),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedSrids(): void
    {
        $this->expectException(MixedSridsException::class);

        new LinearRing(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D, 1234),
            new Point(Dimension::DIMENSION_2D),
        );
    }

    public function testConstructorShouldAllowEmptySridAndPoints(): void
    {
        $lineString = new LineString(Dimension::DIMENSION_2D);

        $this->assertTrue($lineString->isEmpty());
    }
}
