<?php

require __DIR__ . '/vendor/autoload.php';

use Cesc\Ottivio\Infrastructure\Console\GetEmployeeVacationListEndpoint;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$loader           = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('config/services.yaml');

/**@var $consoleCommand GetEmployeeVacationListEndpoint */
$consoleCommand = $containerBuilder->get('console.employee_list');

echo $consoleCommand->execute($argv[1]);

