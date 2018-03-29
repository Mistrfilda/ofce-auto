<?php declare(strict_types = 1);


namespace App\Model;


use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\UserGroup;
use App\Model\Database\Repository\UserGroupRepository;
use App\Model\Database\Repository\UserRepository;


class UserGroupModel extends BaseModel implements IModel
{
	/** @var UserGroupRepository */
	private $userGroupRepository;

	/** @var  UserRepository */
	private $userRepository;

	protected function setRepositories()
	{
		$this->userGroupRepository = $this->entityManager->getUserGroupRepository();
		$this->userRepository = $this->entityManager->getUserRepository();
	}

	/**
	 * @param array $data
	 * @param int|NULL $id
	 * @return Entity
	 */
	public function update(array $data, int $id = NULL) : Entity
	{
		if ($id !== NULL) {
			$group = $this->getData($id);
		} else {
			$group = new UserGroup();
		}

		$group->setName($data['name']);
		$group->setDescription($data['description']);
		$group->setCreatedBy($this->userRepository->getById($data['createdBy']));
		$this->entityManager->persist($group);
		$this->entityManager->flush();
		return $group;
	}

	/**
	 * @param int|NULL $id
	 * @return UserGroup
	 */
	public function getData(int $id = NULL) : UserGroup
	{
		return $this->userGroupRepository->getById($id);
	}

	public function getPairs() : array
	{
		return $this->userGroupRepository->findPairs('name');
	}

	/**
	 * @param string $name
	 * @return UserGroup
	 */
	public function getByName(string $name) : UserGroup
	{
		return $this->userGroupRepository->getByKey('name', $name);
	}

	public function getQueryBuilder()
	{
		$queryBuilder = $this->userGroupRepository->createQueryBuilder('u');
		return $queryBuilder;
	}
}