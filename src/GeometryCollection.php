<?php

namespace GeoIO\Geometry;

class GeometryCollection extends Geometry implements \Countable, \IteratorAggregate
{
    private $geometries;

    public function __construct($dimension, array $geometries = array(), $srid = null)
    {
        $this->dimension = $dimension;
        $this->srid = $srid;

        $this->geometries = array_values($geometries);

        $this->assert();
    }

    public function isEmpty()
    {
        return 0 === count($this->geometries);
    }

    public function getGeometries()
    {
        return $this->geometries;
    }

    public function count()
    {
        return count($this->geometries);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->geometries);
    }

    private function assert()
    {
        $this->assertDimension($this->getDimension());

        foreach ($this->getGeometries() as $geometry) {
            $this->assertGeometry($geometry);
        }
    }
}
