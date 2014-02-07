<?php

namespace GeoIO\Geometry;

use GeoIO;

class GeometryCollectionTest extends TestCase
{
    public function testIsSubclassOfGeometry()
    {
        $this->assertTrue(is_subclass_of('GeoIO\Geometry\GeometryCollection', 'GeoIO\Geometry\Geometry'));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidGeometryException
     */
    public function testConstructorShouldThrowExceptionForInvalidGeometry()
    {
        new GeometryCollection(GeoIO\DIMENSION_2D, array(new \stdClass()));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\InvalidDimensionException
     */
    public function testConstructorShouldThrowExceptionForInvalidDimension()
    {
        new GeometryCollection('foo');
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MixedDimensionalityException
     */
    public function testConstructorShouldThrowExceptionForMixedDimensionality()
    {
        new GeometryCollection(GeoIO\DIMENSION_2D, array($this->getGeometryMock(GeoIO\DIMENSION_4D)));
    }

    /**
     * @expectedException GeoIO\Geometry\Exception\MixedSridsException
     */
    public function testConstructorShouldThrowExceptionForMixedSrids()
    {
        new GeometryCollection(GeoIO\DIMENSION_2D, array($this->getGeometryMock(GeoIO\DIMENSION_2D, 123)), 456);
    }

    public function testConstructorShouldAllowEmptyGeometries()
    {
        $collection = new GeometryCollection(GeoIO\DIMENSION_2D);
        $this->assertTrue($collection->isEmpty());
    }

    public function testConstructorShouldReindexGeometriesArrayNumerically()
    {
        $geometry1 = $this->getGeometryMock(GeoIO\DIMENSION_2D);
        $geometry2 = $this->getGeometryMock(GeoIO\DIMENSION_2D);

        $geometries = array(
            'one' => $geometry1,
            'two' => $geometry2,
        );

        $collection = new GeometryCollection(GeoIO\DIMENSION_2D, $geometries);
        $this->assertSame(array($geometry1, $geometry2), iterator_to_array($collection));
    }

    public function testIsTraversable()
    {
        $geometries = array(
            $this->getGeometryMock(GeoIO\DIMENSION_2D),
            $this->getGeometryMock(GeoIO\DIMENSION_2D),
        );

        $collection = new GeometryCollection(GeoIO\DIMENSION_2D, $geometries);

        $this->assertInstanceOf('Traversable', $collection);
        $this->assertSame($geometries, iterator_to_array($collection));
    }

    public function testIsCountable()
    {
        $geometries = array(
            $this->getGeometryMock(GeoIO\DIMENSION_2D),
            $this->getGeometryMock(GeoIO\DIMENSION_2D),
        );

        $collection = new GeometryCollection(GeoIO\DIMENSION_2D, $geometries);

        $this->assertInstanceOf('Countable', $collection);
        $this->assertCount(2, $collection);
    }
}
