<?php

namespace GeoIO\Geometry;

use GeoIO\Geometry\Exception\InvalidCoordinateException;

class Coordinate
{
    private $x;
    private $y;
    private $z;
    private $m;

    public function __construct($x, $y, $z = null, $m = null)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->m = $m;

        $this->assert();
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getZ()
    {
        return $this->z;
    }

    public function getM()
    {
        return $this->m;
    }

    private function assert()
    {
        $x = $this->getX();

        if (!is_int($x) && !is_float($x)) {
            throw InvalidCoordinateException::create('X');
        }

        $y = $this->getY();

        if (!is_int($y) && !is_float($y)) {
            throw InvalidCoordinateException::create('Y');
        }

        $z = $this->getZ();

        if (!is_null($z) && !is_int($z) && !is_float($z)) {
            throw InvalidCoordinateException::create('Z', true);
        }

        $m = $this->getM();

        if (!is_null($m) && !is_int($m) && !is_float($m)) {
            throw InvalidCoordinateException::create('M', true);
        }
    }
}
