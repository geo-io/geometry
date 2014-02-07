<?php

namespace GeoIO\Geometry\Exception;

class InvalidCoordinateException extends \InvalidArgumentException implements ExceptionInterface
{
    public static function create($coordinate, $nullAllowed = false)
    {
        $msg = '%s-coordinate must be ';

        if ($nullAllowed) {
            $msg .= 'null, ';
        }

        $msg .= 'integer or float.';

        return new self(sprintf(
            $msg,
            strtoupper($coordinate)
        ));
    }
}
