<?php

namespace GeoIO\Geometry\Exception;

use GeoIO\Geometry\GeometryInterface;

class MixedDimensionalityException extends \InvalidArgumentException implements ExceptionInterface
{
    public static function create(GeometryInterface $geometry, GeometryInterface $subGeometry)
    {
        return new self(sprintf(
            'Can not mix dimensionality in a geometry: %s(%s) vs. %s(%s).',
            get_class($geometry),
            $geometry->getDimension(),
            get_class($subGeometry),
            $subGeometry->getDimension()
        ));
    }
}
