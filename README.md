Geo I/O Geometry
================

[![Build Status](https://travis-ci.org/geo-io/geometry.png?branch=master)](https://travis-ci.org/geo-io/geometry)

Basic implementation of geometric objects which roughly follows the
[Simple Feature Access for SQL](http://www.opengeospatial.org/standards/sfs)
specification, although without any kind of advanced functionalities such as
geometric operations.

It can be used as a default input/output for the Geo I/O geometric data
representation parsers and generators.

Supported types are Point, LineString, Polygon, MultiPoint, MultiLineString,
MultiPolygon and GeometryCollection.

Installation
------------

Install [through composer](http://getcomposer.org). Check the
[packagist page](https://packagist.org/packages/geo-io/geometry) for all
available versions.

```json
{
    "require": {
        "geo-io/geometry": "0.1.*@dev"
    }
}
```

License
-------

Geo I/O Geometry is released under the [MIT License](LICENSE).
