<?php


namespace App\Model\Facade;


use App\Lib\AppException;
use App\Model\Database\Entity\RegistrationToken;
use App\Model\Database\Entity\User;
use App\Model\RegistrationTokenModel;
use App\Model\RoleModel;
use App\Model\UserGroupModel;
use App\Model\UserModel;
use Nette\Utils\Random;
use Nette\Utils\Strings;


class RegistrationFacade extends Facade
{
	private $registrationTokenModel;

	private $userModel;

	private $roleModel;

	private $userGroupModel;

	private $user;

	public function __construct(RegistrationTokenModel $registrationTokenModel, UserModel $userModel, RoleModel $roleModel, UserGroupModel $userGroupModel, \Nette\Security\User $user)
	{
		$this->registrationTokenModel = $registrationTokenModel;
		$this->userModel = $userModel;
		$this->roleModel = $roleModel;
		$this->userGroupModel = $userGroupModel;
		$this->user = $user;
	}


	public function register(array $data)
	{
		$this->entityManager->beginTransaction();
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
			$this->entityManager->rollback();
			throw $e;
		}
	}

	public function validateToken(string $token)
	{
		$registrationToken = $this->registrationTokenModel->getTokenByToken($token);
		$user = $this->userModel->getData($registrationToken->getUser()->getId());
		$user->setEmailValid(1);
		$this->entityManager->persist($user);
		$this->entityManager->flush();
	}
}