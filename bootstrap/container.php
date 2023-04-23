<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$config = require dirname(__DIR__).'/config/container.php';

$builder = new ContainerBuilder();
$builder->addDefinitions($config);

if ('prod' === $_ENV['APP_ENV']) {
    $builder->enableCompilation(dirname(__DIR__).'/storage/di');
    $builder->writeProxiesToFile(true, dirname(__DIR__).'/storage/di/proxies');
}

$container = $builder->build();

return $container;
