<?php

namespace GeoIO\Geometry;

use GeoIO;

class PolygonTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\Polygon', 'GeoIO\Geometry\Geometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldRequireArrayOfGeometryObjects()
    {
        new Polygon(GeoIO\DIMENSION_2D, array(new \stdClass(), new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryTypeException
     */
    public function testConstructorShouldRequireArrayOfLineStringObjects()
    {
        new Polygon(GeoIO\DIMENSION_2D, array($this->getGeometryMock(), $this->getGeometryMock()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidDimensionException
     */
    public function testConstructorShouldThrowExceptionForInvalidDimension()
    {
        new Polygon('foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MixedDimensionalityException
     */
    public function testConstructorShouldThrowExceptionForMixedDimensionality()
    {
        $lineStrings = array(
             $this->getLinearRingMock(GeoIO\DIMENSION_4D)
        );

        new Polygon(GeoIO\DIMENSION_2D, $lineStrings);
    }

    public function testConstructorShouldAllowEmptyLineStrings()
    {
        $polygon = new Polygon(GeoIO\DIMENSION_2D);
        $this->assertTrue($polygon->isEmpty());
    }
}
