<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;
use PHPUnit\Framework\TestCase;

class MultiLineStringTest extends TestCase
{
    public function testConstructorShouldThrowExceptionForMixedDimensionality()
    {
        $this->expectException(MixedDimensionalityException::class);

        new MultiLineString(
            Dimension::DIMENSION_2D,
            null,
            new LineString(Dimension::DIMENSION_4D, null),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedSrids(): void
    {
        $this->expectException(MixedSridsException::class);

        new MultiLineString(
            Dimension::DIMENSION_2D,
            4326,
            new LineString(Dimension::DIMENSION_2D, 1234),
        );
    }

    public function testConstructorShouldAllowEmptyLineStrings()
    {
        $lineString = new MultiLineString(Dimension::DIMENSION_2D);

        $this->assertTrue($lineString->isEmpty());
    }
}
