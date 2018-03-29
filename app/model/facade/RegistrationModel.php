<?php declare(strict_types = 1);


namespace App\Model\Facade;


use App\Lib\AppException;
use App\Model\Facade\BaseModel;
use App\Model\Database\Entity\RegistrationToken;
use App\Model\Database\Entity\User;
use App\Model\Facade\RegistrationTokenModel;
use App\Model\Facade\RoleModel;
use App\Model\Facade\UserGroupModel;
use App\Model\Facade\UserModel;
use Nette\Utils\Random;
use Nette\Utils\Strings;


class RegistrationModel extends BaseModel
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

	protected function setRepositories()
	{
		// TODO: Implement setRepositories() method.
	}

	public function register(array $data)
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

	public function validateToken(string $token)
	{
		$registrationToken = $this->registrationTokenModel->getTokenByToken($token);
		$user = $this->userModel->getData($registrationToken->getUser()->getId());
		$user->setEmailValid(1);
		$this->entityManager->persist($user);
		$this->entityManager->flush();
	}
}