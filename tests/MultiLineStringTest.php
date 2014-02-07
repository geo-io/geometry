<?php

namespace GeoIO\Geometry;

use GeoIO;

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
        new MultiLineString(GeoIO\DIMENSION_2D, array(new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfLineStringObjects()
    {
        new MultiLineString(GeoIO\DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock()));
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
            $this->getLineStringMock(GeoIO\DIMENSION_2D),
            $this->getLineStringMock(GeoIO\DIMENSION_4D)
        );

        new MultiLineString(GeoIO\DIMENSION_2D, $points);
    }

    public function testConstructorShouldAllowEmptyLineStrings()
    {
        $lineString = new MultiLineString(GeoIO\DIMENSION_2D);
        $this->assertTrue($lineString->isEmpty());
    }
}
