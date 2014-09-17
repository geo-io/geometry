<?php

namespace GeoIO\Geometry;

class CoordinatesTest extends TestCase
{
    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidCoordinateException
     */
    public function testConstructorShouldThrowExceptionForInvalidXCoordinate()
    {
        new Coordinates('foo', 2);
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidCoordinateException
     */
    public function testConstructorShouldThrowExceptionForInvalidYCoordinate()
    {
        new Coordinates(1, 'foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidCoordinateException
     */
    public function testConstructorShouldThrowExceptionForInvalidZCoordinate()
    {
        new Coordinates(1, 2, 'foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidCoordinateException
     */
    public function testConstructorShouldThrowExceptionForInvalidMCoordinate()
    {
        new Coordinates(1, 2, 3, 'foo');
    }

    public function testConstructorShouldAllowEmptyZAndMCoordinates()
    {
        $coordinates = new Coordinates(1, 2);
        $this->assertNull($coordinates->getZ());
        $this->assertNull($coordinates->getM());
    }
}
