<?php

namespace GeoIO\Geometry;

interface Geometry
{
    public function getDimension();
    public function getSrid();
    public function isEmpty();
}
