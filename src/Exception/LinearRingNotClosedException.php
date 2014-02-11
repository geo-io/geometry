<?php

namespace GeoIO\Geometry\Exception;

class LinearRingNotClosedException extends \InvalidArgumentException implements Exception
{
    public static function create()
    {
        return new self('LinearRing requires the first and last positions to be equivalent.');
    }
}
