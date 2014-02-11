<?php

namespace GeoIO\Geometry\Exception;

    class InvalidGeometryException extends \InvalidArgumentException implements Exception
{
    public static function create($value)
    {
        return new self(sprintf(
            'Expected valid Geometry object, got %s.',
            is_object($value) ? get_class($value) : gettype($value)
        ));
    }
}
