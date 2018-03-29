<?php declare(strict_types = 1);


namespace App\Model\Facade;


use App\Model\Database\Entity\RegistrationToken;
use App\Model\Database\Repository\RegistrationTokenRepository;


class RegistrationTokenModel extends BaseModel
{
	/** @var  RegistrationTokenRepository */
	private $registrationTokenRepository;

	protected function setRepositories()
	{
		$this->registrationTokenRepository = $this->entityManager->getRegistrationTokenRepository();
	}

	public function getTokenByToken(string $token) : RegistrationToken
	{
		return $this->registrationTokenRepository->getByKey('token', $token);
	}
}