<?php

declare(strict_types=1);

namespace App\Demo\Infrastructure;

use DomainException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;

class ExceptionListener
{
    private string $env;

    public function __construct(string $env)
    {
        $this->env = $env;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $message = sprintf(
            'My Error says: %s with code: %s',
            $exception->getMessage(),
            $exception->getCode()
        );

        $data = [];

        if ($exception instanceof HttpExceptionInterface) {
            $data['message'] = $exception->getMessage();
            $data['code'] = $exception->getStatusCode();
        } elseif ($exception instanceof DomainException) {
            $data['message'] = $exception->getMessage();
            $data['code'] = 400;
        } elseif ($exception instanceof ClientExceptionInterface) {
            $data['message'] = $exception->getMessage();
            $data['code'] = $exception->getCode();
        } else {
            if ($this->env === 'prod') {
                $data['message'] = 'Internal Server Error';
                $data['code'] = 500;
            } else {
                $data['message'] = $exception->getMessage();
                $data['code'] = 500;
            }
        }

        if ($this->env !== 'prod') {
            $data['type'] = get_class($exception);
            $data['file'] = $exception->getFile();
            $data['line'] = $exception->getLine();
            $data['trace'] = array_map(fn ($trace) => [
                'file' => $trace['file'],
                'line' => $trace['line'],
                'function' => $trace['function'],
                'class' => $trace['class'],
                'type' => $trace['type']
            ], $exception->getTrace());
        }

        $response = new Response();
        $response->setContent($message);

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $format = $event->getRequest()->get('format', 'json');
        $serializer = new DemoSerializer();

        switch ($format) {
            case 'csv':
                $mime = 'text/csv';
                break;
            case 'xml':
                $mime = 'text/xml';
                break;
            case 'yaml':
                $mime = 'text/yaml';
                break;
            default:
                $mime = 'application/json';
                $format = 'json';
                break;
        }

        $event->setResponse(new Response($serializer->encode($data, $format), $data['code'], [
            'Content-Type' => $mime
        ]));
    }
}
