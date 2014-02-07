<?php

namespace GeoIO\Geometry;

class MultiPointTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\MultiPoint', 'GeoIO\Geometry\Geometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldRequireArrayOfGeometryObjects()
    {
        new MultiPoint(GeometryInterface::DIMENSION_2D, array(new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfPointObjects()
    {
        new MultiPoint(GeometryInterface::DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock()));
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
            $this->getPointMock(GeometryInterface::DIMENSION_2D),
            $this->getPointMock(GeometryInterface::DIMENSION_4D)
        );

        new MultiPoint(GeometryInterface::DIMENSION_2D, $points);
    }

    public function testConstructorShouldAllowEmptyPoints()
    {
        $lineString = new MultiPoint(GeometryInterface::DIMENSION_2D);
        $this->assertTrue($lineString->isEmpty());
    }
}
