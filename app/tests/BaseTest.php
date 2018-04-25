<?php

namespace App\Tests;

use Nette\DI\Container;
use Tester\TestCase;


require __DIR__ . '/bootstrap.php';

/**
 * @skip
 */
class BaseTest extends TestCase
{
	protected $container;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	public function setUp()
	{
		parent::setUp();
	}
}