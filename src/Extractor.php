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

    public function type($geometry)
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

    public function extractPoint($point)
    {
        return array(
            'dimension' => $point->getDimension(),
            'coordinates' => array(
                'x' => $point->getX(),
                'y' => $point->getY(),
                'z' => $point->getZ(),
                'm' => $point->getM()
            ),
            'srid' => $point->getSrid()
        );
    }

    public function extractLineString($lineString)
    {
        return array(
            'dimension' => $lineString->getDimension(),
            'points' => $lineString->getPoints(),
            'srid' => $lineString->getSrid()
        );
    }

    public function extractPolygon($polygon)
    {
        return array(
            'dimension' => $polygon->getDimension(),
            'linestrings' => $polygon->getLineStrings(),
            'srid' => $polygon->getSrid()
        );
    }

    public function extractMultiPoint($multiPoint)
    {
        return array(
            'dimension' => $multiPoint->getDimension(),
            'points' => $multiPoint->getPoints(),
            'srid' => $multiPoint->getSrid()
        );
    }

    public function extractMultiLineString($multiLineString)
    {
        return array(
            'dimension' => $multiLineString->getDimension(),
            'linestrings' => $multiLineString->getLineStrings(),
            'srid' => $multiLineString->getSrid()
        );
    }

    public function extractMultiPolygon($multiPolygon)
    {
        return array(
            'dimension' => $multiPolygon->getDimension(),
            'polygons' => $multiPolygon->getPolygons(),
            'srid' => $multiPolygon->getSrid()
        );
    }

    public function extractGeometryCollection($geometryCollection)
    {
        return array(
            'dimension' => $geometryCollection->getDimension(),
            'geometries' => $geometryCollection->getGeometries(),
            'srid' => $geometryCollection->getSrid()
        );
    }
}
