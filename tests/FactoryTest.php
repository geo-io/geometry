<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use ArrayIterator;
use GeoIO\Coordinates;
use GeoIO\Dimension;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testCreatePoint(): void
    {
        $factory = new Factory();

        $geometry = $factory->createPoint(Dimension::DIMENSION_4D, 1234, new Coordinates(1, 2, 3, 4));

        $this->assertEquals(Dimension::DIMENSION_4D, $geometry->getDimension());
        $this->assertEquals(1234, $geometry->getSrid());

        $this->assertEquals(1, $geometry->getX());
        $this->assertEquals(2, $geometry->getY());
        $this->assertEquals(3, $geometry->getZ());
        $this->assertEquals(4, $geometry->getM());
    }

    /**
     * @dataProvider provideEmptyIterables
     */
    public function testCreateLineString(iterable $iterable): void
    {
        $factory = new Factory();

        $geometry = $factory->createLineString(Dimension::DIMENSION_4D, 1234, $iterable);

        $this->assertEquals(Dimension::DIMENSION_4D, $geometry->getDimension());
        $this->assertEquals(1234, $geometry->getSrid());
    }

    /**
     * @dataProvider provideEmptyIterables
     */
    public function testCreateLinearRing(iterable $iterable): void
    {
        $factory = new Factory();

        $geometry = $factory->createLinearRing(Dimension::DIMENSION_4D, 1234, $iterable);

        $this->assertEquals(Dimension::DIMENSION_4D, $geometry->getDimension());
        $this->assertEquals(1234, $geometry->getSrid());
    }

    /**
     * @dataProvider provideEmptyIterables
     */
    public function testCreatePolygon(iterable $iterable): void
    {
        $factory = new Factory();

        $geometry = $factory->createPolygon(Dimension::DIMENSION_4D, 1234, $iterable);

        $this->assertEquals(Dimension::DIMENSION_4D, $geometry->getDimension());
        $this->assertEquals(1234, $geometry->getSrid());
    }

    /**
     * @dataProvider provideEmptyIterables
     */
    public function testCreateMultiPoint(iterable $iterable): void
    {
        $factory = new Factory();

        $geometry = $factory->createMultiPoint(Dimension::DIMENSION_4D, 1234, $iterable);

        $this->assertEquals(Dimension::DIMENSION_4D, $geometry->getDimension());
        $this->assertEquals(1234, $geometry->getSrid());
    }

    /**
     * @dataProvider provideEmptyIterables
     */
    public function testCreateMultiLineString(iterable $iterable): void
    {
        $factory = new Factory();

        $geometry = $factory->createMultiLineString(Dimension::DIMENSION_4D, 1234, $iterable);

        $this->assertEquals(Dimension::DIMENSION_4D, $geometry->getDimension());
        $this->assertEquals(1234, $geometry->getSrid());
    }

    /**
     * @dataProvider provideEmptyIterables
     */
    public function testCreateMultiPolygon(iterable $iterable): void
    {
        $factory = new Factory();

        $geometry = $factory->createMultiPolygon(Dimension::DIMENSION_4D, 1234, $iterable);

        $this->assertEquals(Dimension::DIMENSION_4D, $geometry->getDimension());
        $this->assertEquals(1234, $geometry->getSrid());
    }

    /**
     * @dataProvider provideEmptyIterables
     */
    public function testCreateGeometryCollection(iterable $iterable): void
    {
        $factory = new Factory();

        $geometry = $factory->createGeometryCollection(Dimension::DIMENSION_4D, 1234, $iterable);

        $this->assertEquals(Dimension::DIMENSION_4D, $geometry->getDimension());
        $this->assertEquals(1234, $geometry->getSrid());
    }

    public function provideEmptyIterables(): iterable
    {
        yield [[]];
        yield [new ArrayIterator([])];
    }
}
