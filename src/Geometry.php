<?php

namespace GeoIO\Geometry;

use GeoIO\Geometry\Exception\InvalidDimensionException;
use GeoIO\Geometry\Exception\InvalidGeometryException;
use GeoIO\Geometry\Exception\InvalidGeometryTypeException;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;

abstract class Geometry implements GeometryInterface
{
    protected $dimension;
    protected $srid;

    public function getDimension()
    {
        return $this->dimension;
    }

    public function getSrid()
    {
        return $this->srid;
    }

    protected function assertDimension($dimension)
    {
        switch ($dimension) {
            case GeometryInterface::DIMENSION_4D:
            case GeometryInterface::DIMENSION_3DZ:
            case GeometryInterface::DIMENSION_3DM:
            case GeometryInterface::DIMENSION_2D:
                break;
            default:
                throw InvalidDimensionException::create($dimension);
        }
    }

    protected function assertGeometry($geometry, $type = null)
    {
        if (!$geometry instanceof GeometryInterface) {
            throw InvalidGeometryException::create($geometry);
        }

        if (null !== $type && !$geometry instanceof $type) {
            throw InvalidGeometryTypeException::create($type, $geometry);
        }

        if ($geometry->getDimension() !== $this->getDimension()) {
            throw MixedDimensionalityException::create($this, $geometry);
        }

        if (null !== ($srid = $geometry->getSrid()) && $srid !== $this->getSrid()) {
            throw MixedSridsException::create($this, $geometry);
        }
    }
}
