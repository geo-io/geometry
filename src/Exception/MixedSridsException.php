<?php

namespace GeoIO\Geometry\Exception;

use GeoIO\Geometry\GeometryInterface;

class MixedSridsException extends \InvalidArgumentException implements ExceptionInterface
{
    public static function create(GeometryInterface $geometry, GeometryInterface $subGeometry)
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
