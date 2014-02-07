<?php

namespace GeoIO\Geometry;

use GeoIO;

class PointTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\Point', 'GeoIO\Geometry\Geometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidDimensionException
     */
    public function testConstructorShouldThrowExceptionForInvalidDimension()
    {
        new Point('foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MissingCoordinateException
     */
    public function testConstructorShouldThrowExceptionForMissingZCoordinate()
    {
        new Point(GeoIO\DIMENSION_3DZ, new Coordinates(1, 2));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MissingCoordinateException
     */
    public function testConstructorShouldThrowExceptionForMissingMCoordinate()
    {
        new Point(GeoIO\DIMENSION_3DM, new Coordinates(1, 2, 3));
    }

    public function testConstructorShouldAllowEmptyCoordinates()
    {
        $polygon = new Point(GeoIO\DIMENSION_2D);
        $this->assertTrue($polygon->isEmpty());
    }
}
