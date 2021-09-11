<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;
use PHPUnit\Framework\TestCase;

class GeometryCollectionTest extends TestCase
{
    public function testConstructorShouldThrowExceptionForMixedDimensionality(): void
    {
        $this->expectException(MixedDimensionalityException::class);

        new GeometryCollection(
            Dimension::DIMENSION_2D,
            null,
            new Point(Dimension::DIMENSION_4D, null),
        );
    }

    public function testConstructorShouldThrowExceptionForMixedSrids(): void
    {
        $this->expectException(MixedSridsException::class);

        new GeometryCollection(
            Dimension::DIMENSION_2D,
            4326,
            new Point(Dimension::DIMENSION_2D, 1234),
        );
    }

    public function testConstructorShouldAllowEmptyGeometries(): void
    {
        $collection = new GeometryCollection(Dimension::DIMENSION_2D);

        $this->assertTrue($collection->isEmpty());
    }
}
