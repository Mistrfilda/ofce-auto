<?php declare(strict_types = 1);


namespace App\Model;


use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserGroup;


class UserModel extends BaseModel implements IModel
{
	private $userRepository;

	protected function setRepositories()
	{
		$this->userRepository = $this->entityManager->getUserRepository();
	}

	public function update(array $data, int $id = NULL) : Entity
	{
		/** @var User $user */
		$user = $this->mapArrayToEntity($id === NULL ? new User() : $this->userRepository->find($id), $data, [
			'user_groups' => [UserGroup::class, 'UserGroup']
		]);

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
		return $this->userRepository->getById($id);
	}
}