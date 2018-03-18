<?php declare(strict_types = 1);


namespace App\Model;


use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserGroup;
use Nette\Security\Passwords;


class UserModel extends BaseModel implements IModel
{
	private $userRepository;

	public function update(array $data, int $id = NULL) : Entity
	{
		$this->userRepository = $this->entityManager->getUserRepository();
		$userGroupRepository = $this->entityManager->getUserGroupRepository();
		$user = new User();
		$user->setName($data['name']);
		$user->setEmail($data['email']);
		$user->setPassword(Passwords::hash($data['password']));

		foreach ($data['user_groups'] as $group) {
			$user->setUserGroup($userGroupRepository->getById($group));
		}

		$this->entityManager->persist($user);
		$this->entityManager->flush();

		return $user;
	}


	/**
	 * @param int $id
	 * @return User
	 */
	public function getData(int $id) : User
	{
		$this->userRepository = $this->entityManager->getUserRepository();
		$this->mapArrayToEntity(new User(), []);
		return $this->userRepository->getById($id);
	}
}