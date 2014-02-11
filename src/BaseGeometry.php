<?php

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\InvalidDimensionException;
use GeoIO\Geometry\Exception\InvalidGeometryException;
use GeoIO\Geometry\Exception\InvalidGeometryTypeException;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;

abstract class BaseGeometry implements Geometry
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
            case Dimension::DIMENSION_4D:
            case Dimension::DIMENSION_3DZ:
            case Dimension::DIMENSION_3DM:
            case Dimension::DIMENSION_2D:
                break;
            default:
                throw InvalidDimensionException::create($dimension);
        }
    }

    protected function assertGeometry($geometry, $type = null)
    {
        if (!$geometry instanceof Geometry) {
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
