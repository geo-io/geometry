<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Coordinates;
use GeoIO\Dimension;
use GeoIO\Extractor as ExtractorInterface;
use GeoIO\Geometry\Exception\InvalidGeometryException;
use GeoIO\GeometryType;

class Extractor implements ExtractorInterface
{
    public function supports(mixed $geometry): bool
    {
        return $geometry instanceof Geometry;
    }

    public function extractType(mixed $geometry): GeometryType
    {
        return match (true) {
            $geometry instanceof Point => GeometryType::POINT,
            $geometry instanceof LinearRing => GeometryType::LINESTRING,
            $geometry instanceof LineString => GeometryType::LINESTRING,
            $geometry instanceof Polygon => GeometryType::POLYGON,
            $geometry instanceof MultiPoint => GeometryType::MULTIPOINT,
            $geometry instanceof MultiLineString => GeometryType::MULTILINESTRING,
            $geometry instanceof MultiPolygon => GeometryType::MULTIPOLYGON,
            $geometry instanceof GeometryCollection => GeometryType::GEOMETRYCOLLECTION,
            default => throw InvalidGeometryException::create($geometry),
        };
    }

    public function extractDimension(mixed $geometry): Dimension
    {
        if (!$geometry instanceof Geometry) {
            throw InvalidGeometryException::createForWrongType(
                Geometry::class,
                $geometry,
            );
        }

        return $geometry->getDimension();
    }

    public function extractSrid(mixed $geometry): ?int
    {
        if (!$geometry instanceof Geometry) {
            throw InvalidGeometryException::createForWrongType(
                Geometry::class,
                $geometry,
            );
        }

        return $geometry->getSrid();
    }

    public function extractCoordinatesFromPoint(mixed $point): ?Coordinates
    {
        if (!$point instanceof Point) {
            throw InvalidGeometryException::createForWrongType(
                Point::class,
                $point,
            );
        }

        $x = $point->getX();
        $y = $point->getY();

        if (null === $x || null === $y) {
            return null;
        }

        return new Coordinates(
            x: $x,
            y: $y,
            z: $point->getZ(),
            m: $point->getM(),
        );
    }

    public function extractPointsFromLineString(mixed $lineString): iterable
    {
        if (!$lineString instanceof LineString) {
            throw InvalidGeometryException::createForWrongType(
                LineString::class,
                $lineString,
            );
        }

        return $lineString->getPoints();
    }

    public function extractLineStringsFromPolygon(mixed $polygon): iterable
    {
        if (!$polygon instanceof Polygon) {
            throw InvalidGeometryException::createForWrongType(
                Polygon::class,
                $polygon,
            );
        }

        return $polygon->getLinearRings();
    }

    public function extractPointsFromMultiPoint(mixed $multiPoint): iterable
    {
        if (!$multiPoint instanceof MultiPoint) {
            throw InvalidGeometryException::createForWrongType(
                MultiPoint::class,
                $multiPoint,
            );
        }

        return $multiPoint->getPoints();
    }

    public function extractLineStringsFromMultiLineString(mixed $multiLineString): iterable
    {
        if (!$multiLineString instanceof MultiLineString) {
            throw InvalidGeometryException::createForWrongType(
                MultiLineString::class,
                $multiLineString,
            );
        }

        return $multiLineString->getLineStrings();
    }

    public function extractPolygonsFromMultiPolygon(mixed $multiPolygon): iterable
    {
        if (!$multiPolygon instanceof MultiPolygon) {
            throw InvalidGeometryException::createForWrongType(
                MultiPolygon::class,
                $multiPolygon,
            );
        }

        return $multiPolygon->getPolygons();
    }

    public function extractGeometriesFromGeometryCollection(mixed $geometryCollection): iterable
    {
        if (!$geometryCollection instanceof GeometryCollection) {
            throw InvalidGeometryException::createForWrongType(
                GeometryCollection::class,
                $geometryCollection,
            );
        }

        return $geometryCollection->getGeometries();
    }
}
