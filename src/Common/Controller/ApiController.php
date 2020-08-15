<?php

declare(strict_types=1);

namespace App\Common\Controller;

use App\Demo\Infrastructure\DemoSerializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ApiController
{
    protected function getReqOptInt(Request $request, string $key, int $default = 0): int
    {
        $original = $request->get($key, $default);
        $ret = filter_var($original, FILTER_VALIDATE_INT);

        if ($ret === false) {
            throw new BadRequestHttpException("Param '${key}' must be an integer '${original}' received.");
        }

        return $ret;
    }

    /**
     * @param Request $request
     * @param string $key
     * @param string[] $validValues
     * @param string $default
     * @return string
     */
    protected function getReqOptEnum(Request $request, string $key, array $validValues, string $default = ''): string
    {
        $ret = $request->get($key, $default);
        if (!in_array($ret, $validValues)) {
            $values = join("', '", $validValues);
            throw new BadRequestHttpException("Param '${key}' must be ('${values}') '${ret}' received.");
        }
        return $request->get($key, $default);
    }

    /**
     * @param Request $request
     * @param array<mixed>|null $data
     * @param int $code
     * @param array<mixed> $headers
     * @return Response
     */
    protected function createResponse(
        Request $request,
        array $data = null,
        int $code = 200,
        array $headers = []
    ): Response {
        $format = $this->getReqOptEnum(
            $request,
            'format',
            [
                'json', 'csv', 'xml', 'yaml'
            ],
            'json'
        );

        $mime = 'application/json';
        switch ($format) {
            case 'xml':
                $mime = 'text/xml';
                break;
            case 'csv':
                $mime = 'text/csv';
                break;
            case 'yaml':
                $mime = 'text/yaml';
                break;
        }

        $serializer = new DemoSerializer();

        return new Response($serializer->encode($data, $format), $code, array_merge($headers, [
            'Content-Type' => $mime
        ]));
    }
}
