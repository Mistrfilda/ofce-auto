<?php


namespace App\Components\Forms;


use App\Components\Forms\FormFactory;
use App\Model\Database\EntityManager;
use Nette\SmartObject;


class BaseModelA
{
	use SmartObject;

	/** @var EntityManager */
	public $entityManager;

	public function injectEntityManager(FormFactory $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function injectFormFactory(FormFactory $formFactory)
	{
		$this->entityManager = $formFactory;
	}
}