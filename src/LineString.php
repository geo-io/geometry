<?php

namespace GeoIO\Geometry;

use GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException;

class LineString extends BaseGeometry
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

        $points = $this->getPoints();

        $count = count($points);

        if (1 === $count) {
            throw InsufficientNumberOfGeometriesException::create(
                2,
                $count,
                'Point'
            );
        }

        foreach ($points as $point) {
            $this->assertGeometry($point, 'GeoIO\\Geometry\\Point');
        }
    }
}
