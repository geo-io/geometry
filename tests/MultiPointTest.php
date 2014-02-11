<?php

namespace GeoIO\Geometry;

use GeoIO\Dimension;

class MultiPointTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\MultiPoint', 'GeoIO\Geometry\BaseGeometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldRequireArrayOfGeometryObjects()
    {
        new MultiPoint(Dimension::DIMENSION_2D, array(new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfPointObjects()
    {
        new MultiPoint(Dimension::DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidDimensionException
     */
    public function testConstructorShouldThrowExceptionForInvalidDimension()
    {
        new MultiPoint('foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MixedDimensionalityException
     */
    public function testConstructorShouldThrowExceptionForMixedDimensionality()
    {
        $points = array(
            $this->getPointMock(Dimension::DIMENSION_2D),
            $this->getPointMock(Dimension::DIMENSION_4D)
        );

        new MultiPoint(Dimension::DIMENSION_2D, $points);
    }

    public function testConstructorShouldAllowEmptyPoints()
    {
        $lineString = new MultiPoint(Dimension::DIMENSION_2D);
        $this->assertTrue($lineString->isEmpty());
    }
}
