<?php

namespace GeoIO\Geometry;

use GeoIO\Factory as FactoryInterface;

class Factory implements FactoryInterface
{
    public function createPoint($dimension, array $coordinates, $srid = null)
    {
        $coordinates = new Coordinates(
            $coordinates['x'],
            $coordinates['y'],
            $coordinates['z'],
            $coordinates['m']
        );

        return new Point($dimension, $coordinates, $srid);
    }

    public function createLineString($dimension, array $points, $srid = null)
    {
        return new LineString($dimension, $points, $srid);
    }

    public function createLinearRing($dimension, array $points, $srid = null)
    {
        return new LinearRing($dimension, $points, $srid);
    }

    public function createPolygon($dimension, array $lineStrings, $srid = null)
    {
        return new Polygon($dimension, $lineStrings, $srid);
    }

    public function createMultiPoint($dimension, array $points, $srid = null)
    {
        return new MultiPoint($dimension, $points, $srid);
    }

    public function createMultiLineString($dimension, array $lineStrings, $srid = null)
    {
        return new MultiLineString($dimension, $lineStrings, $srid);
    }

    public function createMultiPolygon($dimension, array $polygons, $srid = null)
    {
        return new MultiPolygon($dimension, $polygons, $srid);
    }

    public function createGeometryCollection($dimension, array $geometries, $srid = null)
    {
        return new GeometryCollection($dimension, $geometries, $srid);
    }
}
