<?php

namespace GeoIO\Geometry\Exception;

class InsufficientNumberOfGeometriesException extends \InvalidArgumentException implements Exception
{
    public static function create($expected, $given, $type)
    {
        return new self(sprintf(
            'Expected at least %d geometries of type %s, got %d.',
            $expected,
            $type,
            $given
        ));
    }
}
