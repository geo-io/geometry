<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Coordinates;
use GeoIO\Factory as FactoryInterface;
use Traversable;

class Factory implements FactoryInterface
{
    public function createPoint(
        string $dimension,
        ?int $srid,
        ?Coordinates $coordinates,
    ): Geometry {
        return new Point(
            $dimension,
            $srid,
            $coordinates
        );
    }

    public function createLineString(
        string $dimension,
        ?int $srid,
        iterable $points,
    ): LineString {
        /** @var Point[] $points */
        $points = self::iterableToArray($points);

        return new LineString(
            $dimension,
            $srid,
            ...$points
        );
    }

    public function createLinearRing(
        string $dimension,
        ?int $srid,
        iterable $points,
    ): LinearRing {
        /** @var Point[] $points */
        $points = self::iterableToArray($points);

        return new LinearRing(
            $dimension,
            $srid,
            ...$points
        );
    }

    public function createPolygon(
        string $dimension,
        ?int $srid,
        iterable $lineStrings,
    ): Polygon {
        /** @var LineString[] $lineStrings */
        $lineStrings = self::iterableToArray($lineStrings);

        return new Polygon(
            $dimension,
            $srid,
            ...$lineStrings
        );
    }

    public function createMultiPoint(
        string $dimension,
        ?int $srid,
        iterable $points,
    ): MultiPoint {
        /** @var Point[] $points */
        $points = self::iterableToArray($points);

        return new MultiPoint(
            $dimension,
            $srid,
            ...$points
        );
    }

    public function createMultiLineString(
        string $dimension,
        ?int $srid,
        iterable $lineStrings,
    ): MultiLineString {
        /** @var LineString[] $lineStrings */
        $lineStrings = self::iterableToArray($lineStrings);

        return new MultiLineString(
            $dimension,
            $srid,
            ...$lineStrings
        );
    }

    public function createMultiPolygon(
        string $dimension,
        ?int $srid,
        iterable $polygons,
    ): MultiPolygon {
        /** @var Polygon[] $polygons */
        $polygons = self::iterableToArray($polygons);

        return new MultiPolygon(
            $dimension,
            $srid,
            ...$polygons
        );
    }

    public function createGeometryCollection(
        string $dimension,
        ?int $srid,
        iterable $geometries,
    ): GeometryCollection {
        /** @var Geometry[] $geometries */
        $geometries = self::iterableToArray($geometries);

        return new GeometryCollection(
            $dimension,
            $srid,
            ...$geometries
        );
    }

    private static function iterableToArray(iterable $iterable): array
    {
        if ($iterable instanceof Traversable) {
            return iterator_to_array($iterable);
        }

        return $iterable;
    }
}
