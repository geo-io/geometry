<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;
use PHPUnit\Framework\TestCase;

class PolygonTest extends TestCase
{
    public function testConstructorShouldThrowExceptionForMixedDimensionality(): void
    {
        $this->expectException(MixedDimensionalityException::class);

        new Polygon(
            Dimension::DIMENSION_2D,
            4326,
            new LinearRing(Dimension::DIMENSION_4D),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedSrids(): void
    {
        $this->expectException(MixedSridsException::class);

        new Polygon(
            Dimension::DIMENSION_2D,
            4326,
            new LinearRing(Dimension::DIMENSION_2D, 1234),
        );
    }

    public function testConstructorShouldAllowEmptyLineStrings(): void
    {
        $polygon = new Polygon(Dimension::DIMENSION_2D);

        $this->assertTrue($polygon->isEmpty());
    }
}
