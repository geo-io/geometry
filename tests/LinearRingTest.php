<?php

namespace GeoIO\Geometry;

use GeoIO;

class LinearRingTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\LinearRing', 'GeoIO\Geometry\Geometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldRequireArrayOfGeometryObjects()
    {
        new LinearRing(GeoIO\DIMENSION_2D, array(new \stdClass(), new \stdClass(), new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfPointObjects()
    {
        new LinearRing(GeoIO\DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock(), $this->getGeometryMock(), $this->getGeometryMock()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException
     */
    public function testConstructorShouldRequireAtLeast3Positions()
    {
        new LinearRing(GeoIO\DIMENSION_2D, array($this->getPointMock(GeoIO\DIMENSION_2D), $this->getPointMock(GeoIO\DIMENSION_2D)));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidDimensionException
     */
    public function testConstructorShouldThrowExceptionForInvalidDimension()
    {
        new LinearRing('foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MixedDimensionalityException
     */
    public function testConstructorShouldThrowExceptionForMixedDimensionality()
    {
        $points = array(
            $this->getPointMock(GeoIO\DIMENSION_2D),
            $this->getPointMock(GeoIO\DIMENSION_2D),
            $this->getPointMock(GeoIO\DIMENSION_2D),
            $this->getPointMock(GeoIO\DIMENSION_4D)
        );

        new LinearRing(GeoIO\DIMENSION_2D, $points);
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\LinearRingNotClosedException
     */
    public function testConstructorShouldThrowExceptionNotClosed()
    {
        $points = array(
            $this->getPointMock(GeoIO\DIMENSION_2D, null, new Coordinates(1, 2, 3, 4)),
            $this->getPointMock(GeoIO\DIMENSION_2D, null,new Coordinates(5, 6, 7, 8)),
            $this->getPointMock(GeoIO\DIMENSION_2D, null,new Coordinates(9, 10, 11, 12)),
            $this->getPointMock(GeoIO\DIMENSION_2D, null,new Coordinates(1, 2, 3, 14))
        );

        new LinearRing(GeoIO\DIMENSION_2D, $points);
    }

    public function testConstructorShouldAllowEmptyPoints()
    {
        $lineString = new LinearRing(GeoIO\DIMENSION_2D);
        $this->assertTrue($lineString->isEmpty());
    }
}
