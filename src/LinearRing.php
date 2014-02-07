<?php

namespace GeoIO\Geometry;

use GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException;
use GeoIO\Geometry\Exception\LinearRingNotClosedException;

class LinearRing extends LineString
{
    public function __construct($dimension, array $points = array(), $srid = null)
    {
        parent::__construct($dimension, $points, $srid);

        $this->assert();
    }

    private function assert()
    {
        $points = $this->getPoints();

        $count = count($points);

        if ($count > 0 && $count < 4) {
            throw InsufficientNumberOfGeometriesException::create(
                4,
                $count,
                'Point'
            );
        }

        $lastPoint = end($points);
        $firstPoint = reset($points);

        if ($lastPoint && $firstPoint &&
            ($lastPoint->getX() !== $firstPoint->getX() ||
             $lastPoint->getY() !== $firstPoint->getY() ||
             $lastPoint->getZ() !== $firstPoint->getZ() ||
             $lastPoint->getM() !== $firstPoint->getM())) {
            throw LinearRingNotClosedException::create();
        }
    }
}
