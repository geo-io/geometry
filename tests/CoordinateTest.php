<?php

namespace GeoIO\Geometry;

class CoordinateTest extends TestCase
{
    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidCoordinateException
     */
    public function testConstructorShouldThrowExceptionForInvalidXCoordinate()
    {
        new Coordinate('foo', 2);
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidCoordinateException
     */
    public function testConstructorShouldThrowExceptionForInvalidYCoordinate()
    {
        new Coordinate(1, 'foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidCoordinateException
     */
    public function testConstructorShouldThrowExceptionForInvalidZCoordinate()
    {
        new Coordinate(1, 2, 'foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidCoordinateException
     */
    public function testConstructorShouldThrowExceptionForInvalidMCoordinate()
    {
        new Coordinate(1, 2, 3, 'foo');
    }

    public function testConstructorShouldAllowEmptyZAndMCoordinates()
    {
        $coordinates = new Coordinate(1, 2);
        $this->assertNull($coordinates->getZ());
        $this->assertNull($coordinates->getM());
    }
}
