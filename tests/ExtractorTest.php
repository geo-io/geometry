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

    public function testType()
    {
        $extractor = new Extractor();

        $this->assertSame(ExtractorInterface::TYPE_POINT, $extractor->type($this->getPointMock()));
        $this->assertSame(ExtractorInterface::TYPE_LINESTRING, $extractor->type($this->getLineStringMock()));
        $this->assertSame(ExtractorInterface::TYPE_POLYGON, $extractor->type($this->getPolygonMock()));
        $this->assertSame(ExtractorInterface::TYPE_MULTIPOINT, $extractor->type($this->getMultiPointMock()));
        $this->assertSame(ExtractorInterface::TYPE_MULTILINESTRING, $extractor->type($this->getMultiLineStringMock()));
        $this->assertSame(ExtractorInterface::TYPE_MULTIPOLYGON, $extractor->type($this->getMultiPolygonMock()));
        $this->assertSame(ExtractorInterface::TYPE_GEOMETRYCOLLECTION, $extractor->type($this->getGeometryCollectionMock()));
    }

    public function testTypeThrowsExceptionForInvalidGeometry()
    {
        $this->setExpectedException('GeoIO\Geometry\Exception\InvalidGeometryException');

        $extractor = new Extractor();
        $extractor->type(new \stdClass());
    }

    public function testExtractPoint()
    {
        $object = $this->getPointMock(
            Dimension::DIMENSION_4D,
            1234,
            new Coordinates(1, 2, 3, 4)
        );

        $extractor = new Extractor();

        $geometry = $extractor->extractPoint($object);

        $this->assertInternalType('array', $geometry);
        $this->arrayHasKey('dimension', $geometry);
        $this->arrayHasKey('coordinates', $geometry);
        $this->arrayHasKey('srid', $geometry);

        $this->assertSame(Dimension::DIMENSION_4D, $geometry['dimension']);
        $this->assertSame(1, $geometry['coordinates']['x']);
        $this->assertSame(2, $geometry['coordinates']['y']);
        $this->assertSame(3, $geometry['coordinates']['z']);
        $this->assertSame(4, $geometry['coordinates']['m']);
        $this->assertSame(1234, $geometry['srid']);
    }

    public function testExtractLineString()
    {
        $object = $this->getLineStringMock(
            Dimension::DIMENSION_4D,
            1234,
            array()
        );

        $extractor = new Extractor();

        $geometry = $extractor->extractLineString($object);

        $this->assertInternalType('array', $geometry);
        $this->arrayHasKey('dimension', $geometry);
        $this->arrayHasKey('points', $geometry);
        $this->arrayHasKey('srid', $geometry);

        $this->assertSame(Dimension::DIMENSION_4D, $geometry['dimension']);
        $this->assertSame(1234, $geometry['srid']);
    }

    public function testExtractPolygon()
    {
        $object = $this->getPolygonMock(
            Dimension::DIMENSION_4D,
            1234,
            array()
        );

        $extractor = new Extractor();

        $geometry = $extractor->extractPolygon($object);

        $this->assertInternalType('array', $geometry);
        $this->arrayHasKey('dimension', $geometry);
        $this->arrayHasKey('linestrings', $geometry);
        $this->arrayHasKey('srid', $geometry);

        $this->assertSame(Dimension::DIMENSION_4D, $geometry['dimension']);
        $this->assertSame(1234, $geometry['srid']);
    }

    public function testExtractMultiPoint()
    {
        $object = $this->getMultiPointMock(
            Dimension::DIMENSION_4D,
            1234,
            array()
        );

        $extractor = new Extractor();

        $geometry = $extractor->extractMultiPoint($object);

        $this->assertInternalType('array', $geometry);
        $this->arrayHasKey('dimension', $geometry);
        $this->arrayHasKey('points', $geometry);
        $this->arrayHasKey('srid', $geometry);

        $this->assertSame(Dimension::DIMENSION_4D, $geometry['dimension']);
        $this->assertSame(1234, $geometry['srid']);
    }

    public function testExtractMultiLineString()
    {
        $object = $this->getMultiLineStringMock(
            Dimension::DIMENSION_4D,
            1234,
            array()
        );

        $extractor = new Extractor();

        $geometry = $extractor->extractMultiLineString($object);

        $this->assertInternalType('array', $geometry);
        $this->arrayHasKey('dimension', $geometry);
        $this->arrayHasKey('linestrings', $geometry);
        $this->arrayHasKey('srid', $geometry);

        $this->assertSame(Dimension::DIMENSION_4D, $geometry['dimension']);
        $this->assertSame(1234, $geometry['srid']);
    }

    public function testExtractMultiPolygon()
    {
        $object = $this->getMultiPolygonMock(
            Dimension::DIMENSION_4D,
            1234,
            array()
        );

        $extractor = new Extractor();

        $geometry = $extractor->extractMultiPolygon($object);

        $this->assertInternalType('array', $geometry);
        $this->arrayHasKey('dimension', $geometry);
        $this->arrayHasKey('polygons', $geometry);
        $this->arrayHasKey('srid', $geometry);

        $this->assertSame(Dimension::DIMENSION_4D, $geometry['dimension']);
        $this->assertSame(1234, $geometry['srid']);
    }

    public function testExtractGeometryCollection()
    {
        $object = $this->getGeometryCollectionMock(
            Dimension::DIMENSION_4D,
            1234,
            array()
        );

        $extractor = new Extractor();

        $geometry = $extractor->extractGeometryCollection($object);

        $this->assertInternalType('array', $geometry);
        $this->arrayHasKey('dimension', $geometry);
        $this->arrayHasKey('geometries', $geometry);
        $this->arrayHasKey('srid', $geometry);

        $this->assertSame(Dimension::DIMENSION_4D, $geometry['dimension']);
        $this->assertSame(1234, $geometry['srid']);
    }
}
