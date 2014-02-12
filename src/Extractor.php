<?php

namespace GeoIO\Geometry;

use GeoIO\Extractor as ExtractorInterface;
use GeoIO\Geometry\Exception\InvalidGeometryException;

class Extractor implements ExtractorInterface
{
    public function supports($geometry)
    {
        return $geometry instanceof Geometry;
    }

    public function extractType($geometry)
    {
        switch (true) {
            case $geometry instanceof Point:
                return ExtractorInterface::TYPE_POINT;
            case $geometry instanceof LineString:
                return ExtractorInterface::TYPE_LINESTRING;
            case $geometry instanceof Polygon:
                return ExtractorInterface::TYPE_POLYGON;
            case $geometry instanceof MultiPoint:
                return ExtractorInterface::TYPE_MULTIPOINT;
            case $geometry instanceof MultiLineString:
                return ExtractorInterface::TYPE_MULTILINESTRING;
            case $geometry instanceof MultiPolygon:
                return ExtractorInterface::TYPE_MULTIPOLYGON;
            case $geometry instanceof GeometryCollection:
                return ExtractorInterface::TYPE_GEOMETRYCOLLECTION;
            default:
                throw InvalidGeometryException::create($geometry);
        }
    }

    public function extractDimension($geometry)
    {
        return $geometry->getDimension();
    }

    public function extractSrid($geometry)
    {
        return $geometry->getSrid();
    }

    public function extractCoordinatesFromPoint($point)
    {
        return array(
            'x' => $point->getX(),
            'y' => $point->getY(),
            'z' => $point->getZ(),
            'm' => $point->getM()
        );
    }

    public function extractPointsFromLineString($lineString)
    {
        return $lineString->getPoints();
    }

    public function extractLineStringsFromPolygon($polygon)
    {
        return $polygon->getLineStrings();
    }

    public function extractPointsFromMultiPoint($multiPoint)
    {
        return $multiPoint->getPoints();
    }

    public function extractLineStringsFromMultiLineString($multiLineString)
    {
        return $multiLineString->getLineStrings();
    }

    public function extractPolygonsFromMultiPolygon($multiPolygon)
    {
        return $multiPolygon->getPolygons();
    }

    public function extractGeometriesFromGeometryCollection($geometryCollection)
    {
        return $geometryCollection->getGeometries();
    }
}
