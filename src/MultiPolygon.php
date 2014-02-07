<?php

namespace GeoIO\Geometry;

class MultiPolygon extends Geometry
{
    private $polygons;

    public function __construct($dimension, array $polygons = array(), $srid = null)
    {
        $this->dimension = $dimension;
        $this->srid = $srid;

        $this->polygons = $polygons;

        $this->assert();
    }

    public function isEmpty()
    {
        return 0 === count($this->polygons);
    }

    public function getPolygons()
    {
        return $this->polygons;
    }

    private function assert()
    {
        $this->assertDimension($this->getDimension());

        foreach ($this->getPolygons() as $polygon) {
            $this->assertGeometry($polygon, 'GeoIO\\Geometry\\Polygon');
        }
    }
}
