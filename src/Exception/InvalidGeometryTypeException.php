<?php

namespace GeoIO\Geometry\Exception;

use GeoIO\Geometry\Geometry;

class InvalidGeometryTypeException extends \InvalidArgumentException implements Exception
{
    public static function create($expected, Geometry $geometry)
    {
        return new self(sprintf(
            'Expected valid %s object, got %s.',
            $expected,
            is_object($geometry) ? get_class($geometry) : $geometry
        ));
    }
}
