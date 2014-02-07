<?php

namespace GeoIO\Geometry\Exception;

use GeoIO\Geometry\GeometryInterface;

class InvalidGeometryTypeException extends \InvalidArgumentException implements ExceptionInterface
{
    public static function create($expected, GeometryInterface $geometry)
    {
        return new self(sprintf(
            'Expected valid %s object, got %s.',
            $expected,
            is_object($geometry) ? get_class($geometry) : $geometry
        ));
    }
}
