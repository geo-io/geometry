<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;
use PHPUnit\Framework\TestCase;

class MultiPolygonTest extends TestCase
{
    public function testConstructorShouldThrowExceptionForMixedDimensionality(): void
    {
        $this->expectException(MixedDimensionalityException::class);

        new MultiPolygon(
            Dimension::DIMENSION_2D,
            4326,
            new Polygon(Dimension::DIMENSION_2D),
            new Polygon(Dimension::DIMENSION_4D),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedSrids(): void
    {
        $this->expectException(MixedSridsException::class);

        new MultiPolygon(
            Dimension::DIMENSION_2D,
            4326,
            new Polygon(Dimension::DIMENSION_2D, 1234),
            new Polygon(Dimension::DIMENSION_4D),
        );
    }

    public function testConstructorShouldAllowEmptyPolygons()
    {
        $lineString = new MultiPolygon(Dimension::DIMENSION_2D);

        $this->assertTrue($lineString->isEmpty());
    }
}
