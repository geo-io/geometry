<?php

namespace GeoIO\Geometry;

interface GeometryInterface
{
    public function getDimension();

    public function getSrid();

    public function isEmpty();
}
