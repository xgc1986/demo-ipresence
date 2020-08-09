<?php

declare(strict_types=1);

namespace App\Tests\Demo\Unit\Infrastructure;

use App\Demo\Infrastructure\DemoSerializer;
use PHPUnit\Framework\TestCase;

class DemoSerializerTest extends TestCase
{
    private const INPUT = [
        'object' => [
            'b' => 'text_0',
            'c' => 1
        ],
        'b' => [2, 'text_3'],
        'c' => true
    ];

    public function testEncodeToJson(): void
    {
        $serializer = new DemoSerializer();
        $result = $serializer->encode(self::INPUT, 'json');
        $expected = '{"object":{"b":"text_0","c":1},"b":[2,"text_3"],"c":true}';

        self::assertEquals($expected, $result);
    }

    public function testEncodeToCsv(): void
    {
        $serializer = new DemoSerializer();
        $result = $serializer->encode(self::INPUT, 'csv');
        $expected = <<<CSV
object.b,object.c,b.0,b.1,c
text_0,1,2,text_3,1

CSV;


        self::assertEquals($expected, $result);
    }

    public function testEncodeToXml(): void
    {
        $serializer = new DemoSerializer();
        $result = $serializer->encode(self::INPUT, 'xml');
        $expected = <<<XML
<?xml version="1.0"?>
<response><object><b>text_0</b><c>1</c></object><b>2</b><b>text_3</b><c>1</c></response>

XML;

        self::assertEquals($expected, $result);
    }

    public function testEncodeToYaml(): void
    {
        $serializer = new DemoSerializer();
        $result = $serializer->encode(self::INPUT, 'yaml');
        $expected = <<<YAML
object:
    b: text_0
    c: 1
b:
    - 2
    - text_3
c: true

YAML;

        self::assertEquals($expected, $result);
    }
}
