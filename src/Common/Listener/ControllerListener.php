<?php

declare(strict_types=1);

namespace App\Common\Listener;

use App\Common\Controller\ApiController;
use App\Common\Controller\EtagCacheabkeController;
use App\Common\Controller\WebController;
use App\Common\Service\Serializer;
use DomainException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;

class ControllerListener implements EventSubscriberInterface
{
    /**
     * @var ApiController|WebController|null
     */
    private $controller;

    private string $env;

    public function __construct(string $env)
    {
        $this->env = $env;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $this->controller = $controller[0];
        } elseif ($controller instanceof ApiController ||$controller instanceof WebController) {
            $this->controller = $controller;
        }
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $request = $event->getRequest();
        $content = $response->getContent();

        if ($this->controller !== null
            && $this->controller instanceof EtagCacheabkeController
            && $content !== false
            && $response->getStatusCode() < 300
            && $request->getMethod() === Request::METHOD_GET
        ) {
            $response->setEtag(md5($content));
            $response->setPublic();
            $response->isNotModified($request);
        }
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        if ($this->controller !== null
            && $this->controller instanceof ApiController
        ) {
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
                $data['trace'] = array_map(fn($trace) => [
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
            $serializer = new Serializer();

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

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::RESPONSE => 'onKernelResponse',
            KernelEvents::EXCEPTION => 'onKernelException'
        ];
    }
}
