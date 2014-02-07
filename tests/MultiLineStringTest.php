<?php

namespace GeoIO\Geometry;

class MultiLineStringTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\MultiLineString', 'GeoIO\Geometry\Geometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldRequireArrayOfGeometryObjects()
    {
        new MultiLineString(GeometryInterface::DIMENSION_2D, array(new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfLineStringObjects()
    {
        new MultiLineString(GeometryInterface::DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidDimensionException
     */
    public function testConstructorShouldThrowExceptionForInvalidDimension()
    {
        new MultiLineString('foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MixedDimensionalityException
     */
    public function testConstructorShouldThrowExceptionForMixedDimensionality()
    {
        $points = array(
            $this->getLineStringMock(GeometryInterface::DIMENSION_2D),
            $this->getLineStringMock(GeometryInterface::DIMENSION_4D)
        );

        new MultiLineString(GeometryInterface::DIMENSION_2D, $points);
    }

    public function testConstructorShouldAllowEmptyLineStrings()
    {
        $lineString = new MultiLineString(GeometryInterface::DIMENSION_2D);
        $this->assertTrue($lineString->isEmpty());
    }
}
