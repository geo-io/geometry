<?php

namespace GeoIO\Geometry;

use GeoIO;

class MultiPolygonTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\MultiPolygon', 'GeoIO\Geometry\Geometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldRequireArrayOfGeometryObjects()
    {
        new MultiPolygon(GeoIO\DIMENSION_2D, array(new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfPolygonObjects()
    {
        new MultiPolygon(GeoIO\DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidDimensionException
     */
    public function testConstructorShouldThrowExceptionForInvalidDimension()
    {
        new MultiPolygon('foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MixedDimensionalityException
     */
    public function testConstructorShouldThrowExceptionForMixedDimensionality()
    {
        $points = array(
            $this->getPolygonMock(GeoIO\DIMENSION_2D),
            $this->getPolygonMock(GeoIO\DIMENSION_4D)
        );

        new MultiPolygon(GeoIO\DIMENSION_2D, $points);
    }

    public function testConstructorShouldAllowEmptyPolygons()
    {
        $lineString = new MultiPolygon(GeoIO\DIMENSION_2D);
        $this->assertTrue($lineString->isEmpty());
    }
}
