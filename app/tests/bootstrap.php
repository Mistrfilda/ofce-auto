<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

Tester\Environment::setup();

$configurator = new Nette\Configurator;

$configurator->setDebugMode(TRUE);
$configurator->setTempDirectory(__DIR__ . '/temp');
$configurator->enableTracy(__DIR__ . '/log');
$configurator->enableDebugger(__DIR__ . '/log');

$configurator->createRobotLoader()
	->addDirectory(__DIR__ . '/../../app')
	->register();

$configurator->addConfig(__DIR__ . '/../config/config.neon');

$configurator->addConfig(__DIR__ . '/tests.local.neon');

return $configurator->createContainer();
