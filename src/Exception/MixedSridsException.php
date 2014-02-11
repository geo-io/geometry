<?php

namespace GeoIO\Geometry\Exception;

use GeoIO\Geometry\Geometry;

class MixedSridsException extends \InvalidArgumentException implements Exception
{
    public static function create(Geometry $geometry, Geometry $subGeometry)
    {
        return new self(sprintf(
            'Can not mix SRID\'s in a geometry: %s(%s) vs. %s(%s).',
            get_class($geometry),
            $geometry->getSrid(),
            get_class($subGeometry),
            $subGeometry->getSrid()
        ));
    }
}
