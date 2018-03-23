<?php


namespace App\Model;


use App\Model\Database\Repository\RegistrationTokenRepository;


class RegistrationTokenModel extends BaseModel
{
	/** @var  RegistrationTokenRepository */
	private $registrationTokenRepository;

	protected function setRepositories()
	{
		$this->registrationTokenRepository = $this->entityManager->getRegistrationTokenRepository();
	}
}