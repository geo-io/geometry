<?php

namespace GeoIO\Geometry;

use GeoIO\Dimension;

class LinearRingTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\LinearRing', 'GeoIO\Geometry\BaseGeometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldRequireArrayOfGeometryObjects()
    {
        new LinearRing(Dimension::DIMENSION_2D, array(new \stdClass(), new \stdClass(), new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfPointObjects()
    {
        new LinearRing(Dimension::DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock(), $this->getGeometryMock(), $this->getGeometryMock()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException
     */
    public function testConstructorShouldRequireAtLeast3Positions()
    {
        new LinearRing(Dimension::DIMENSION_2D, array($this->getPointMock(Dimension::DIMENSION_2D), $this->getPointMock(Dimension::DIMENSION_2D)));
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
            $this->getPointMock(Dimension::DIMENSION_2D),
            $this->getPointMock(Dimension::DIMENSION_2D),
            $this->getPointMock(Dimension::DIMENSION_2D),
            $this->getPointMock(Dimension::DIMENSION_4D)
        );

        new LinearRing(Dimension::DIMENSION_2D, $points);
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\LinearRingNotClosedException
     */
    public function testConstructorShouldThrowExceptionNotClosed()
    {
        $points = array(
            $this->getPointMock(Dimension::DIMENSION_2D, null, new Coordinates(1, 2, 3, 4)),
            $this->getPointMock(Dimension::DIMENSION_2D, null,new Coordinates(5, 6, 7, 8)),
            $this->getPointMock(Dimension::DIMENSION_2D, null,new Coordinates(9, 10, 11, 12)),
            $this->getPointMock(Dimension::DIMENSION_2D, null,new Coordinates(1, 2, 3, 14))
        );

        new LinearRing(Dimension::DIMENSION_2D, $points);
    }

    public function testConstructorShouldAllowEmptyPoints()
    {
        $lineString = new LinearRing(Dimension::DIMENSION_2D);
        $this->assertTrue($lineString->isEmpty());
    }
}
