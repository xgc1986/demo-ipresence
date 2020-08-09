<?php

declare(strict_types=1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use function dirname;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(dirname(__DIR__).'/config/services.yaml')) {
            $container->import('../config/{services}.yaml');
            $container->import('../config/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = dirname(__DIR__).'/config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }

        $files = scandir(__DIR__);

        if ($files !== false) {
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $root = __DIR__ . "/${file}/_config/";

                    if (is_dir($root)) {
                        $prodFile = "${root}/*.yaml";
                        $container->import($prodFile);
                    }

                    if (is_dir($root . $this->environment)) {
                        $envFile = $root . $this->environment . '/*.yaml';
                        $container->import($envFile);
                    }
                }
            }
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(dirname(__DIR__).'/config/routes.yaml')) {
            $routes->import('../config/{routes}.yaml');
        } elseif (is_file($path = dirname(__DIR__).'/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }

        $files = scandir(__DIR__ . '/../src');

        if ($files !== false) {
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $root = __DIR__ . "/${file}/_routes";

                    if (is_dir($root)) {
                        if (is_dir($root . $this->environment)) {
                            $routes->import($root . $this->environment . '/*.yaml');
                        }

                        $routes->import("${root}/*.yaml");
                    }
                }
            }
        }
    }
}
