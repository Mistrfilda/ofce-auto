<?php


namespace App\Model;


use App\Components\Forms\FormFactory;
use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\UserGroup;
use App\Model\Database\EntityManager;
use Nette\SmartObject;


class BaseModel
{
	use SmartObject;

	/** @var EntityManager */
	public $entityManager;

	public function injectEntityManager(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function mapArrayToEntity(Entity $entity, array $values)
	{
	}
}