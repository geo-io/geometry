<?php

namespace GeoIO\Geometry;

use GeoIO\Dimension;

class PointTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\Point', 'GeoIO\Geometry\BaseGeometry'));
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
        new Point(Dimension::DIMENSION_3DZ, new Coordinate(1, 2));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MissingCoordinateException
     */
    public function testConstructorShouldThrowExceptionForMissingMCoordinate()
    {
        new Point(Dimension::DIMENSION_3DM, new Coordinate(1, 2, 3));
    }

    public function testConstructorShouldAllowEmptyCoordinates()
    {
        $polygon = new Point(Dimension::DIMENSION_2D);
        $this->assertTrue($polygon->isEmpty());
    }
}
