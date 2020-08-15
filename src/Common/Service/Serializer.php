<?php

declare(strict_types=1);

namespace App\Common\Service;

use RuntimeException;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;

class Serializer
{
    /**
     * @param mixed $data
     * @param string $format
     * @return string
     */
    public function encode($data, string $format): string
    {
        switch ($format) {
            case 'json':
                return $this->printWithJsonFormat($data);
            case 'xml':
                return $this->printWithXmlFormat($data);
            case 'yaml':
                return $this->printWithYamlFormat($data);
            case 'csv':
                return $this->printWithCsvFormat($data);
        }

        throw new RuntimeException("Invalid format '${format}'");
    }

    /**
     * @param mixed $data
     * @return string
     */
    private function printWithJsonFormat($data): string
    {
        $encoder = new JsonEncoder();
        return (string) $encoder->encode($data, 'json');
    }

    /**
     * @param mixed $data
     * @return string
     */
    private function printWithXmlFormat($data): string
    {
        $encoder = new XmlEncoder();
        return (string) $encoder->encode($data, 'xml');
    }

    /**
     * @param mixed $data
     * @return string
     */
    private function printWithCsvFormat($data): string
    {
        $encoder = new CsvEncoder();
        return (string) $encoder->encode($this->fixData($data), 'xml');
    }

    /**
     * @param mixed $data
     * @return string
     */
    private function printWithYamlFormat($data): string
    {
        $encoder = new YamlEncoder(null, null, [
            'yaml_inline' => 3
        ]);
        return (string) $encoder->encode($data, 'yaml');
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    private function fixData($data)
    {
        if (is_array($data) && count($data) > 0 && isset($data[0])) {
            return array_map(
                fn($item) => ['data' => $item],
                $data
            );
        }

        return $data;
    }
}
