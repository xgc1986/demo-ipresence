<?php

declare(strict_types=1);

namespace App\Common\Listener;

use App\Common\Controller\ApiController;
use App\Common\Controller\EtagCacheabkeController;
use App\Common\Controller\WebController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ControllerListener implements EventSubscriberInterface
{
    /**
     * @var ApiController|WebController|null
     */
    private $controller;

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $this->controller = $controller[0];
        } else {
            $this->controller = $controller;
        }
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $request = $event->getRequest();
        $content = $response->getContent();

        if ($this->controller !== null
            && $this->controller instanceof EtagCacheabkeController
            && $content !== false
            && $response->getStatusCode() >= 300
            && $request->getMethod() === Request::METHOD_GET
        ) {
            $response->setEtag(md5($content));
            $response->setPublic();
            $response->isNotModified($request);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
