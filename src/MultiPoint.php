<?php

namespace GeoIO\Geometry;

class MultiPoint extends BaseGeometry
{
    private $points;

    public function __construct($dimension, array $points = array(), $srid = null)
    {
        $this->dimension = $dimension;
        $this->srid = $srid;

        $this->points = $points;

        $this->assert();
    }

    public function isEmpty()
    {
        return 0 === count($this->points);
    }

    public function getPoints()
    {
        return $this->points;
    }

    private function assert()
    {
        $this->assertDimension($this->getDimension());

        foreach ($this->getPoints() as $point) {
            $this->assertGeometry($point, 'GeoIO\\Geometry\\Point');
        }
    }
}
