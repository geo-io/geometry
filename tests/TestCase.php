<?php

namespace GeoIO\Geometry;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getGeometryMock($dimension = null, $srid = null)
    {
        return $this->getGeometryMockForClass('GeoIO\\Geometry\\Geometry', $dimension, $srid);
    }

    protected function getPointMock($dimension = null, $srid = null, Coordinates $coordinates = null)
    {
        $mock = $this->getGeometryMockForClass('GeoIO\\Geometry\\Point', $dimension, $srid);

        if ($coordinates) {
            $mock
                ->expects($this->any())
                ->method('getX')
                ->will($this->returnValue($coordinates->getX()));

            $mock
                ->expects($this->any())
                ->method('getY')
                ->will($this->returnValue($coordinates->getY()));

            $mock
                ->expects($this->any())
                ->method('getZ')
                ->will($this->returnValue($coordinates->getZ()));

            $mock
                ->expects($this->any())
                ->method('getM')
                ->will($this->returnValue($coordinates->getM()));
        }

        return $mock;
    }

    protected function getLineStringMock($dimension = null, $srid = null)
    {
        return $this->getGeometryMockForClass('GeoIO\\Geometry\\LineString', $dimension, $srid);
    }

    protected function getLinearRingMock($dimension = null, $srid = null)
    {
        return $this->getGeometryMockForClass('GeoIO\\Geometry\\LinearRing', $dimension, $srid);
    }

    protected function getPolygonMock($dimension = null, $srid = null)
    {
        return $this->getGeometryMockForClass('GeoIO\\Geometry\\Polygon', $dimension, $srid);
    }

    protected function getMultiPointMock($dimension = null, $srid = null)
    {
        return $this->getGeometryMockForClass('GeoIO\\Geometry\\MultiPoint', $dimension, $srid);
    }

    protected function getMultiLineStringMock($dimension = null, $srid = null)
    {
        return $this->getGeometryMockForClass('GeoIO\\Geometry\\MultiLineString', $dimension, $srid);
    }

    protected function getMultiPolygonMock($dimension = null, $srid = null)
    {
        return $this->getGeometryMockForClass('GeoIO\\Geometry\\MultiPolygon', $dimension, $srid);
    }

    protected function getGeometryCollectionMock($dimension = null, $srid = null)
    {
        return $this->getGeometryMockForClass('GeoIO\\Geometry\\GeometryCollection', $dimension, $srid);
    }

    protected function getGeometryMockForClass($class, $dimension = null, $srid = null)
    {
        $mock = $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->getMock();

        if ($dimension) {
            $mock
                ->expects($this->any())
                ->method('getDimension')
                ->will($this->returnValue($dimension));
        }

        if ($srid) {
            $mock
                ->expects($this->any())
                ->method('getSrid')
                ->will($this->returnValue($srid));
        }

        return $mock;
    }

    protected function getCoordinatesMock()
    {
        return $this->getMockBuilder('GeoIO\\Geometry\\Coordinates')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
