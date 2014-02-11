<?php

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\MissingCoordinateException;

class Point extends Geometry
{
    private $coordinates;

    public function __construct($dimension, Coordinates $coordinates = null, $srid = null)
    {
        $this->dimension = $dimension;
        $this->srid = $srid;

        $this->coordinates = $coordinates;

        $this->assert();
    }

    public function isEmpty()
    {
        return null === $this->coordinates;
    }

    public function getX()
    {
        if (null === $this->coordinates) {
            return null;
        }

        return $this->coordinates->getX();
    }

    public function getY()
    {
        if (null === $this->coordinates) {
            return null;
        }

        return $this->coordinates->getY();
    }

    public function getZ()
    {
        if (null === $this->coordinates) {
            return null;
        }

        return $this->coordinates->getZ();
    }

    public function getM()
    {
        if (null === $this->coordinates) {
            return null;
        }

        return $this->coordinates->getM();
    }

    private function assert()
    {
        $dimension = $this->getDimension();

        $this->assertDimension($dimension);

        if (null === $this->getZ() &&
            (Dimension::DIMENSION_4D === $dimension ||
             Dimension::DIMENSION_3DZ === $dimension)) {
            throw MissingCoordinateException::create('Z', $dimension);
        }

        if (null === $this->getM() &&
            (Dimension::DIMENSION_4D === $dimension ||
             Dimension::DIMENSION_3DM === $dimension)) {
            throw MissingCoordinateException::create('M', $dimension);
        }
    }
}
