<?php

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Extractor as ExtractorInterface;

class ExtractorTest  extends TestCase
{
    public function testSupports()
    {
        $extractor = new Extractor();

        $this->assertTrue($extractor->supports($this->getGeometryMock()));
        $this->assertTrue($extractor->supports($this->getPointMock()));
        $this->assertTrue($extractor->supports($this->getLineStringMock()));
        $this->assertTrue($extractor->supports($this->getPolygonMock()));
        $this->assertTrue($extractor->supports($this->getMultiPointMock()));
        $this->assertTrue($extractor->supports($this->getMultiLineStringMock()));
        $this->assertTrue($extractor->supports($this->getMultiPolygonMock()));
        $this->assertTrue($extractor->supports($this->getGeometryCollectionMock()));

        $this->assertFalse($extractor->supports(new \stdClass()));
    }

    public function testExtractType()
    {
        $extractor = new Extractor();

        $this->assertSame(ExtractorInterface::TYPE_POINT, $extractor->extractType($this->getPointMock()));
        $this->assertSame(ExtractorInterface::TYPE_LINESTRING, $extractor->extractType($this->getLineStringMock()));
        $this->assertSame(ExtractorInterface::TYPE_POLYGON, $extractor->extractType($this->getPolygonMock()));
        $this->assertSame(ExtractorInterface::TYPE_MULTIPOINT, $extractor->extractType($this->getMultiPointMock()));
        $this->assertSame(ExtractorInterface::TYPE_MULTILINESTRING, $extractor->extractType($this->getMultiLineStringMock()));
        $this->assertSame(ExtractorInterface::TYPE_MULTIPOLYGON, $extractor->extractType($this->getMultiPolygonMock()));
        $this->assertSame(ExtractorInterface::TYPE_GEOMETRYCOLLECTION, $extractor->extractType($this->getGeometryCollectionMock()));
    }

    public function testExtractTypeThrowsExceptionForInvalidGeometry()
    {
        $this->setExpectedException('GeoIO\Geometry\Exception\InvalidGeometryException');

        $extractor = new Extractor();
        $extractor->extractType(new \stdClass());
    }

    public function testExtractDimension()
    {
        $object = $this->getPointMock(
            Dimension::DIMENSION_4D
        );

        $extractor = new Extractor();
        $this->assertSame(Dimension::DIMENSION_4D, $extractor->extractDimension($object));
    }

    public function testExtractSrid()
    {
        $object = $this->getPointMock(
            Dimension::DIMENSION_4D,
            1234
        );

        $extractor = new Extractor();
        $this->assertSame(1234, $extractor->extractSrid($object));
    }

    public function testExtractCoordinatesfromPoint()
    {
        $object = $this->getPointMock(
            Dimension::DIMENSION_4D,
            1234,
            new Coordinate(1, 2, 3, 4)
        );

        $extractor = new Extractor();

        $coords = $extractor->extractCoordinatesfromPoint($object);

        $this->assertInternalType('array', $coords);
        $this->assertSame(1, $coords['x']);
        $this->assertSame(2, $coords['y']);
        $this->assertSame(3, $coords['z']);
        $this->assertSame(4, $coords['m']);
    }

    public function testExtractLineString()
    {
        $object = $this->getLineStringMock(
            Dimension::DIMENSION_4D,
            1234,
            array(1, 2, 3)
        );

        $extractor = new Extractor();

        $array = $extractor->extractPointsFromLineString($object);

        $this->assertInternalType('array', $array);
        $this->assertSame(array(1, 2, 3), $array);
    }

    public function testExtractPolygon()
    {
        $object = $this->getPolygonMock(
            Dimension::DIMENSION_4D,
            1234,
            array(1, 2, 3)
        );

        $extractor = new Extractor();

        $array = $extractor->extractLineStringsFromPolygon($object);

        $this->assertInternalType('array', $array);
        $this->assertSame(array(1, 2, 3), $array);
    }

    public function testExtractMultiPoint()
    {
        $object = $this->getMultiPointMock(
            Dimension::DIMENSION_4D,
            1234,
            array(1, 2, 3)
        );

        $extractor = new Extractor();

        $array = $extractor->extractPointsFromMultiPoint($object);

        $this->assertInternalType('array', $array);
        $this->assertSame(array(1, 2, 3), $array);
    }

    public function testExtractMultiLineString()
    {
        $object = $this->getMultiLineStringMock(
            Dimension::DIMENSION_4D,
            1234,
            array(1, 2, 3)
        );

        $extractor = new Extractor();

        $array = $extractor->extractLineStringsFromMultiLineString($object);

        $this->assertInternalType('array', $array);
        $this->assertSame(array(1, 2, 3), $array);
    }

    public function testExtractMultiPolygon()
    {
        $object = $this->getMultiPolygonMock(
            Dimension::DIMENSION_4D,
            1234,
            array(1, 2, 3)
        );

        $extractor = new Extractor();

        $array = $extractor->extractPolygonsFromMultiPolygon($object);

        $this->assertInternalType('array', $array);
        $this->assertSame(array(1, 2, 3), $array);
    }

    public function testExtractGeometryCollection()
    {
        $object = $this->getGeometryCollectionMock(
            Dimension::DIMENSION_4D,
            1234,
            array(1, 2, 3)
        );

        $extractor = new Extractor();

        $array = $extractor->extractGeometriesFromGeometryCollection($object);

        $this->assertInternalType('array', $array);
        $this->assertSame(array(1, 2, 3), $array);
    }
}
