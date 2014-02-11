<?php

namespace GeoIO\Geometry;

class Polygon extends BaseGeometry
{
    private $lineStrings;

    public function __construct($dimension, array $lineStrings = array(), $srid = null)
    {
        $this->dimension = $dimension;
        $this->srid = $srid;

        $this->lineStrings = $lineStrings;

        $this->assert();
    }

    public function isEmpty()
    {
        return 0 === count($this->lineStrings);
    }

    public function getLineStrings()
    {
        return $this->lineStrings;
    }

    private function assert()
    {
        $this->assertDimension($this->getDimension());

        foreach ($this->getLineStrings() as $lineString) {
            $this->assertGeometry($lineString, 'GeoIO\\Geometry\\LinearRing');
        }
    }
}
