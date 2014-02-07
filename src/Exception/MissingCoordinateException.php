<?php

namespace GeoIO\Geometry\Exception;

class MissingCoordinateException extends \InvalidArgumentException implements ExceptionInterface
{
    public static function create($coordinate, $dimension)
    {
        return new self(sprintf(
            '%s-coordinate must not be null for dimension %s.',
            strtoupper($coordinate),
            $dimension
        ));
    }
}
