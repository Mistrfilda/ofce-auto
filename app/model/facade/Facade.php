<?php


namespace App\Model\Facade;


use App\Model\Database\EntityManager;
use Nette\SmartObject;


abstract class Facade
{
	use SmartObject;

	/** @var EntityManager */
	protected $entityManager;

	public function injectEntityManager(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}
}