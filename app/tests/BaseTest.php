<?php

namespace App\Tests;

use App\Model\Database\EntityManager;
use Nette\DI\Container;
use Tester\TestCase;


require __DIR__ . '/bootstrap.php';

/**
 * @skip
 */
class BaseTest extends TestCase
{
	protected $container;

	/** @var EntityManager $entityManager */
	protected $entityManager;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	public function setUp()
	{
		parent::setUp();
		$this->entityManager = $this->container->getByType(EntityManager::class);
		$this->entityManager->getConnection()->beginTransaction();
	}

	public function tearDown()
	{
		parent::tearDown();
		$this->entityManager->rollback();
	}
}