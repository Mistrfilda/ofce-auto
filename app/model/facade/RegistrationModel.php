<?php declare(strict_types = 1);


namespace App\Model\Facade;


use App\Lib\AppException;
use App\Model\Database\Repository\RegistrationTokenRepository;
use App\Model\Database\Entity\RegistrationToken;
use App\Model\Database\Entity\User;
use Nette\Utils\Random;


class RegistrationModel extends BaseModel
{
	private $userModel;

	private $roleModel;

	private $userGroupModel;

	private $user;

	/** @var  RegistrationTokenRepository */
	private $registrationTokenRepository;

	public function __construct(UserModel $userModel, RoleModel $roleModel, UserGroupModel $userGroupModel, \Nette\Security\User $user)
	{
		$this->userModel = $userModel;
		$this->roleModel = $roleModel;
		$this->userGroupModel = $userGroupModel;
		$this->user = $user;
	}

	protected function setRepositories() : void
	{
		$this->registrationTokenRepository = $this->entityManager->getRegistrationTokenRepository();
	}

	public function register(array $data) : void
	{
		$user = new User();
		$user->setName($data['name']);
		$user->setPassword($data['password']);
		$user->setEmail($data['email']);
		$user->setUsername($data['username']);
		$user->setRole($this->roleModel->getByName('Other'));
		$user->setUserGroup($this->userGroupModel->getByName('Other'));
		$this->entityManager->persist($user);
		$this->entityManager->flush();

		$registrationToken = new RegistrationToken();
		$registrationToken->setToken(Random::generate(50));
		$registrationToken->setUser($user);
		$this->entityManager->persist($registrationToken);
		$this->entityManager->flush();


		try {
		 	$this->user->login($user->getUsername(), $data['password']);
		} catch (AppException $e) {
			throw $e;
		}
	}

	public function validateToken(string $token) : void
	{
		$registrationToken = $this->getToken($token);
		$user = $this->userModel->getData($registrationToken->getUser()->getId());
		$user->setEmailValid(1);
		$this->entityManager->persist($user);
		$this->entityManager->flush();
	}

	private function getToken(string $token) : RegistrationToken
	{
		return $this->registrationTokenRepository->getByKey('token', $token);
	}
}