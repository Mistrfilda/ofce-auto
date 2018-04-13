<?php declare(strict_types = 1);


namespace App\Model\Facade;


use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\Role;
use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserGroup;
use App\Model\Database\Repository\UserRepository;
use Doctrine\ORM\QueryBuilder;


class UserModel extends BaseModel implements IModel
{
	/** @var  UserRepository */
	private $userRepository;

	protected function setRepositories()
	{
		$this->userRepository = $this->entityManager->getUserRepository();
	}


	/**
	 * @param array $data
	 * @param int|NULL $id
	 * @return Entity
	 */
	public function update(array $data, int $id = NULL) : Entity
	{
		/** @var User $user */
		$user = $this->mapArrayToEntity($id === NULL ? new User() : $this->userRepository->find($id), $data, [
			'user_groups' => [UserGroup::class, 'UserGroups'],
			'role' => [Role::class, 'Role']
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


	/**
	 * @param string $login
	 * @return User
	 */
	public function getByLogin(string $login) : User
	{
		return $this->userRepository->getByKey('username', $login);
	}

	public function getQueryBuilder() : QueryBuilder
	{
		$queryBuilder = $this->userRepository->createQueryBuilder('u');
		return $queryBuilder;
	}
}