<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Coordinates;
use GeoIO\Dimension;
use GeoIO\Geometry\Exception\MissingCoordinateException;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testConstructorShouldThrowExceptionForMissingZCoordinate(): void
    {
        $this->expectException(MissingCoordinateException::class);

        new Point(
            Dimension::DIMENSION_3DZ,
            4326,
            new Coordinates(1, 2)
        );
    }

    public function testConstructorShouldThrowExceptionForMissingMCoordinate(): void
    {
        $this->expectException(MissingCoordinateException::class);

        new Point(
            Dimension::DIMENSION_3DM,
            4326,
            new Coordinates(1, 2, 3)
        );
    }

    public function testConstruct2d(): void
    {
        $point = new Point(
            Dimension::DIMENSION_2D,
            4326,
            new Coordinates(1, 2),
        );

        $this->assertEquals(1, $point->getX());
        $this->assertEquals(2, $point->getY());
        $this->assertNull($point->getZ());
        $this->assertNull($point->getM());
    }

    public function testConstruct3dz(): void
    {
        $point = new Point(
            Dimension::DIMENSION_3DZ,
            4326,
            new Coordinates(1, 2, 3),
        );

        $this->assertEquals(1, $point->getX());
        $this->assertEquals(2, $point->getY());
        $this->assertEquals(3, $point->getZ());
        $this->assertNull($point->getM());
    }

    public function testConstruct3dm(): void
    {
        $point = new Point(
            Dimension::DIMENSION_3DM,
            4326,
            new Coordinates(1, 2, null, 4),
        );

        $this->assertEquals(1, $point->getX());
        $this->assertEquals(2, $point->getY());
        $this->assertNull($point->getZ());
        $this->assertEquals(4, $point->getM());
    }

    public function testConstruct4d(): void
    {
        $point = new Point(
            Dimension::DIMENSION_3DM,
            4326,
            new Coordinates(1, 2, 3, 4),
        );

        $this->assertEquals(1, $point->getX());
        $this->assertEquals(2, $point->getY());
        $this->assertEquals(3, $point->getZ());
        $this->assertEquals(4, $point->getM());
    }

    public function testConstructorShouldAllowEmptySridAndCoordinates(): void
    {
        $point = new Point(Dimension::DIMENSION_2D);

        $this->assertTrue($point->isEmpty());

        $this->assertNull($point->getX());
        $this->assertNull($point->getY());
        $this->assertNull($point->getZ());
        $this->assertNull($point->getM());
    }
}
