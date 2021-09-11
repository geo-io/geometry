<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Coordinates;
use GeoIO\Dimension;
use GeoIO\Geometry\Exception\InvalidGeometryException;
use GeoIO\GeometryType;
use PHPUnit\Framework\TestCase;
use stdClass;

class ExtractorTest extends TestCase
{
    public function testSupports(): void
    {
        $extractor = new Extractor();

        $this->assertTrue($extractor->supports(new Point(Dimension::DIMENSION_2D)));
        $this->assertTrue($extractor->supports(new LineString(Dimension::DIMENSION_2D)));
        $this->assertTrue($extractor->supports(new LinearRing(Dimension::DIMENSION_2D)));
        $this->assertTrue($extractor->supports(new Polygon(Dimension::DIMENSION_2D)));
        $this->assertTrue($extractor->supports(new MultiPoint(Dimension::DIMENSION_2D)));
        $this->assertTrue($extractor->supports(new MultiLineString(Dimension::DIMENSION_2D)));
        $this->assertTrue($extractor->supports(new MultiPolygon(Dimension::DIMENSION_2D)));
        $this->assertTrue($extractor->supports(new GeometryCollection(Dimension::DIMENSION_2D)));

        $this->assertFalse($extractor->supports(new stdClass()));
    }

    public function testExtractType(): void
    {
        $extractor = new Extractor();

        $this->assertEquals(GeometryType::POINT, $extractor->extractType(new Point(Dimension::DIMENSION_2D)));
        $this->assertEquals(GeometryType::LINESTRING, $extractor->extractType(new LineString(Dimension::DIMENSION_2D)));
        $this->assertEquals(GeometryType::LINESTRING, $extractor->extractType(new LinearRing(Dimension::DIMENSION_2D)));
        $this->assertEquals(GeometryType::POLYGON, $extractor->extractType(new Polygon(Dimension::DIMENSION_2D)));
        $this->assertEquals(GeometryType::MULTIPOINT, $extractor->extractType(new MultiPoint(Dimension::DIMENSION_2D)));
        $this->assertEquals(GeometryType::MULTILINESTRING, $extractor->extractType(new MultiLineString(Dimension::DIMENSION_2D)));
        $this->assertEquals(GeometryType::MULTIPOLYGON, $extractor->extractType(new MultiPolygon(Dimension::DIMENSION_2D)));
        $this->assertEquals(GeometryType::GEOMETRYCOLLECTION, $extractor->extractType(new GeometryCollection(Dimension::DIMENSION_2D)));
    }

    public function testExtractTypeThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractType(new stdClass());
    }

    public function testExtractDimension(): void
    {
        $object = new Point(
            Dimension::DIMENSION_4D,
            1234,
            new Coordinates(1, 2, 3, 4)
        );

        $extractor = new Extractor();
        $this->assertEquals(Dimension::DIMENSION_4D, $extractor->extractDimension($object));
    }

    public function testExtractDimensionThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractDimension(new stdClass());
    }

    public function testExtractSrid(): void
    {
        $object = new Point(
            Dimension::DIMENSION_4D,
            1234,
            new Coordinates(1, 2, 3, 4)
        );

        $extractor = new Extractor();
        $this->assertEquals(1234, $extractor->extractSrid($object));
    }

    public function testExtractSridThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractSrid(new stdClass());
    }

    public function testExtractCoordinatesFromPoint(): void
    {
        $object = new Point(
            Dimension::DIMENSION_4D,
            1234,
            new Coordinates(1, 2, 3, 4)
        );

        $extractor = new Extractor();

        $coords = $extractor->extractCoordinatesFromPoint($object);

        $this->assertEquals(1, $coords->x);
        $this->assertEquals(2, $coords->y);
        $this->assertEquals(3, $coords->z);
        $this->assertEquals(4, $coords->m);
    }

    public function testExtractCoordinatesFromPointReturnsNullForEmptyPoint(): void
    {
        $object = new Point(
            Dimension::DIMENSION_4D
        );

        $extractor = new Extractor();

        $this->assertNull($extractor->extractCoordinatesFromPoint($object));
    }

    public function testExtractCoordinatesFromPointThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractCoordinatesFromPoint(new stdClass());
    }

    public function testExtractLineString(): void
    {
        $points = [
            new Point(
                Dimension::DIMENSION_4D,
                1234,
                new Coordinates(1, 2, 3, 4)
            ),
            new Point(
                Dimension::DIMENSION_4D,
                1234,
                new Coordinates(1, 2, 3, 4)
            ),
        ];

        $object = new LineString(
            Dimension::DIMENSION_4D,
            1234,
            ...$points
        );

        $extractor = new Extractor();

        $array = $extractor->extractPointsFromLineString($object);

        $this->assertEquals($points, $array);
    }

    public function testExtractLineStringThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractPointsFromLineString(new stdClass());
    }

    public function testExtractPolygon(): void
    {
        $lineStrings = [
            new LinearRing(
                Dimension::DIMENSION_4D,
                1234,
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                )
            ),
        ];

        $object = new Polygon(
            Dimension::DIMENSION_4D,
            1234,
            ...$lineStrings
        );

        $extractor = new Extractor();

        $array = $extractor->extractLineStringsFromPolygon($object);

        $this->assertEquals($lineStrings, $array);
    }

    public function testExtractPolygonThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractLineStringsFromPolygon(new stdClass());
    }

    public function testExtractMultiPoint(): void
    {
        $points = [
            new Point(
                Dimension::DIMENSION_4D,
                1234,
                new Coordinates(1, 2, 3, 4)
            ),
            new Point(
                Dimension::DIMENSION_4D,
                1234,
                new Coordinates(1, 2, 3, 4)
            ),
        ];

        $object = new MultiPoint(
            Dimension::DIMENSION_4D,
            1234,
            ...$points
        );

        $extractor = new Extractor();

        $array = $extractor->extractPointsFromMultiPoint($object);

        $this->assertEquals($points, $array);
    }

    public function testExtractMultiPointThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractPointsFromMultiPoint(new stdClass());
    }

    public function testExtractMultiLineString(): void
    {
        $lineStrings = [
            new LinearRing(
                Dimension::DIMENSION_4D,
                1234,
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                )
            ),
        ];

        $object = new MultiLineString(
            Dimension::DIMENSION_4D,
            1234,
            ...$lineStrings
        );

        $extractor = new Extractor();

        $array = $extractor->extractLineStringsFromMultiLineString($object);

        $this->assertEquals($lineStrings, $array);
    }

    public function testExtractMultiLineStringThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractLineStringsFromMultiLineString(new stdClass());
    }

    public function testExtractMultiPolygon(): void
    {
        $polygons = [
            new Polygon(
                Dimension::DIMENSION_4D,
                1234,
                new LinearRing(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Point(
                        Dimension::DIMENSION_4D,
                        1234,
                        new Coordinates(1, 2, 3, 4)
                    ),
                    new Point(
                        Dimension::DIMENSION_4D,
                        1234,
                        new Coordinates(1, 2, 3, 4)
                    ),
                    new Point(
                        Dimension::DIMENSION_4D,
                        1234,
                        new Coordinates(1, 2, 3, 4)
                    ),
                    new Point(
                        Dimension::DIMENSION_4D,
                        1234,
                        new Coordinates(1, 2, 3, 4)
                    )
                ),
            ),
        ];

        $object = new MultiPolygon(
            Dimension::DIMENSION_4D,
            1234,
            ...$polygons
        );

        $extractor = new Extractor();

        $array = $extractor->extractPolygonsFromMultiPolygon($object);

        $this->assertEquals($polygons, $array);
    }

    public function testExtractMultiPolygonThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractPolygonsFromMultiPolygon(new stdClass());
    }

    public function testExtractGeometryCollection(): void
    {
        $geometries = [
            new Point(
                Dimension::DIMENSION_4D,
                1234,
                new Coordinates(1, 2, 3, 4)
            ),
            new LinearRing(
                Dimension::DIMENSION_4D,
                1234,
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                ),
                new Point(
                    Dimension::DIMENSION_4D,
                    1234,
                    new Coordinates(1, 2, 3, 4)
                )
            ),
        ];

        $object = new GeometryCollection(
            Dimension::DIMENSION_4D,
            1234,
            ...$geometries
        );

        $extractor = new Extractor();

        $array = $extractor->extractGeometriesFromGeometryCollection($object);

        $this->assertEquals($geometries, $array);
    }

    public function testExtractGeometryCollectionThrowsExceptionForInvalidGeometry(): void
    {
        $this->expectException(InvalidGeometryException::class);

        $extractor = new Extractor();
        $extractor->extractGeometriesFromGeometryCollection(new stdClass());
    }
}
