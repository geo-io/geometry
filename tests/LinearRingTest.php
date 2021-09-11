<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Coordinates;
use GeoIO\Dimension;
use GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException;
use GeoIO\Geometry\Exception\LinearRingNotClosedException;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;
use PHPUnit\Framework\TestCase;

class LinearRingTest extends TestCase
{
    public function testConstructorShouldRequireAtLeast3Positions(): void
    {
        $this->expectException(InsufficientNumberOfGeometriesException::class);

        new LinearRing(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D, 4326),
            new Point(Dimension::DIMENSION_2D, 4326),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedDimensionality(): void
    {
        $this->expectException(MixedDimensionalityException::class);

        new LinearRing(
            Dimension::DIMENSION_2D,
            null,
            new Point(Dimension::DIMENSION_2D, null),
            new Point(Dimension::DIMENSION_2D, null),
            new Point(Dimension::DIMENSION_2D, null),
            new Point(Dimension::DIMENSION_4D, null),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedSrids(): void
    {
        $this->expectException(MixedSridsException::class);

        new LinearRing(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D, 1234),
            new Point(Dimension::DIMENSION_2D, 4326),
            new Point(Dimension::DIMENSION_2D, 4326),
            new Point(Dimension::DIMENSION_2D, 4326),
        );
    }

    public function testConstructorShouldThrowExceptionNotClosed(): void
    {
        $this->expectException(LinearRingNotClosedException::class);

        new LinearRing(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D, 4326, new Coordinates(1, 2, 3, 4)),
            new Point(Dimension::DIMENSION_2D, 4326, new Coordinates(5, 6, 7, 8)),
            new Point(Dimension::DIMENSION_2D, 4326, new Coordinates(9, 10, 11, 12)),
            new Point(Dimension::DIMENSION_2D, 4326, new Coordinates(1, 2, 3, 14)),
        );
    }

    public function testConstructorShouldAllowEmptySridAndPoints(): void
    {
        $lineString = new LinearRing(Dimension::DIMENSION_2D);

        $this->assertTrue($lineString->isEmpty());
    }
}
