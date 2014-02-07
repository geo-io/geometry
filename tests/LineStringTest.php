<?php

namespace GeoIO\Geometry;

use GeoIO;

class LineStringTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\LineString', 'GeoIO\Geometry\Geometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldRequireArrayOfGeometryObjects()
    {
        new LineString(GeoIO\DIMENSION_2D, array(new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfPointObjects()
    {
        new LineString(GeoIO\DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException
     */
    public function testConstructorShouldRequireAtLeastTwoPositions()
    {
        new LineString(GeoIO\DIMENSION_2D, array($this->getPointMock()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidDimensionException
     */
    public function testConstructorShouldThrowExceptionForInvalidDimension()
    {
        new LineString('foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MixedDimensionalityException
     */
    public function testConstructorShouldThrowExceptionForMixedDimensionality()
    {
        $points = array(
            $this->getPointMock(GeoIO\DIMENSION_2D),
            $this->getPointMock(GeoIO\DIMENSION_4D)
        );

        new LineString(GeoIO\DIMENSION_2D, $points);
    }

    public function testConstructorShouldAllowEmptyPoints()
    {
        $lineString = new LineString(GeoIO\DIMENSION_2D);
        $this->assertTrue($lineString->isEmpty());
    }
}
