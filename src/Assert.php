<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException;
use GeoIO\Geometry\Exception\LinearRingNotClosedException;
use GeoIO\Geometry\Exception\MissingCoordinateException;
use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;
use function count;

final class Assert
{
    public static function sameDimension(Geometry $geometry, Geometry $subGeometry): void
    {
        if ($geometry->getDimension() === $subGeometry->getDimension()) {
            return;
        }

        throw MixedDimensionalityException::create($geometry, $subGeometry);
    }

    public static function sameSrid(Geometry $geometry, Geometry $subGeometry): void
    {
        $srid = $subGeometry->getSrid();

        if (null === $srid) {
            return;
        }

        if ($srid === $geometry->getSrid()) {
            return;
        }

        throw MixedSridsException::create($geometry, $subGeometry);
    }

    public static function geometry(Geometry $geometry): void
    {
        match (true) {
            $geometry instanceof Point => self::point($geometry),
            $geometry instanceof LinearRing => self::linearRing($geometry),
            $geometry instanceof LineString => self::lineString($geometry),
            $geometry instanceof Polygon => self::polygon($geometry),
            $geometry instanceof MultiPoint => self::multiPoint($geometry),
            $geometry instanceof MultiLineString => self::multiLineString($geometry),
            $geometry instanceof MultiPolygon => self::multiPolygon($geometry),
            $geometry instanceof GeometryCollection => self::geometryCollection($geometry),
        };
    }

    public static function point(Point $point): void
    {
        $dimension = $point->getDimension();

        if (
            (
                Dimension::DIMENSION_4D === $dimension ||
                Dimension::DIMENSION_3DZ === $dimension
            ) &&
            (
                !$point->isEmpty() &&
                null === $point->getZ()
            )
        ) {
            throw MissingCoordinateException::create(
                'Z',
                $dimension
            );
        }

        if (
            (
                Dimension::DIMENSION_4D === $dimension ||
                Dimension::DIMENSION_3DM === $dimension
            ) &&
            (
                !$point->isEmpty() &&
                null === $point->getM()
            )
        ) {
            throw MissingCoordinateException::create(
                'M',
                $dimension
            );
        }
    }

    public static function lineString(LineString $lineString): void
    {
        $points = $lineString->getPoints();

        $count = count($points);

        if (1 === $count) {
            throw InsufficientNumberOfGeometriesException::create(
                2,
                $count,
                'Point'
            );
        }

        foreach ($points as $point) {
            self::sameDimension($lineString, $point);
            self::sameSrid($lineString, $point);
            self::point($point);
        }
    }

    public static function linearRing(LinearRing $linearRing): void
    {
        $points = $linearRing->getPoints();

        $count = count($points);

        if ($count > 0 && $count < 4) {
            throw InsufficientNumberOfGeometriesException::create(
                4,
                $count,
                'Point'
            );
        }

        $lastPoint = end($points);
        $firstPoint = reset($points);

        if ($lastPoint &&
            $firstPoint &&
            (
                $lastPoint->getX() !== $firstPoint->getX() ||
                $lastPoint->getY() !== $firstPoint->getY() ||
                $lastPoint->getZ() !== $firstPoint->getZ() ||
                $lastPoint->getM() !== $firstPoint->getM()
            )
        ) {
            throw LinearRingNotClosedException::create();
        }

        foreach ($points as $point) {
            self::sameDimension($linearRing, $point);
            self::sameSrid($linearRing, $point);
            self::point($point);
        }
    }

    public static function polygon(Polygon $polygon): void
    {
        foreach ($polygon->getLinearRings() as $lineString) {
            self::sameDimension($polygon, $lineString);
            self::sameSrid($polygon, $lineString);
            self::linearRing($lineString);
        }
    }

    public static function multiPoint(MultiPoint $multiPoint): void
    {
        foreach ($multiPoint->getPoints() as $point) {
            self::sameDimension($multiPoint, $point);
            self::sameSrid($multiPoint, $point);
            self::point($point);
        }
    }

    public static function multiLineString(MultiLineString $multiLineString): void
    {
        foreach ($multiLineString->getLineStrings() as $lineString) {
            self::sameDimension($multiLineString, $lineString);
            self::sameSrid($multiLineString, $lineString);
            self::lineString($lineString);
        }
    }

    public static function multiPolygon(MultiPolygon $multiPolygon): void
    {
        foreach ($multiPolygon->getPolygons() as $polygon) {
            self::sameDimension($multiPolygon, $polygon);
            self::sameSrid($multiPolygon, $polygon);
            self::polygon($polygon);
        }
    }

    public static function geometryCollection(GeometryCollection $geometryCollection): void
    {
        foreach ($geometryCollection->getGeometries() as $geometry) {
            self::sameDimension($geometryCollection, $geometry);
            self::sameSrid($geometryCollection, $geometry);
            self::geometry($geometry);
        }
    }
}
