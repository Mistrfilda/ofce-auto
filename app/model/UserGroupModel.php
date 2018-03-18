<?php declare(strict_types = 1);


namespace App\Model;


use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\UserGroup;
use App\Model\Database\Repository\UserGroupRepository;


class UserGroupModel extends BaseModel implements IModel
{
	/** @var UserGroupRepository */
	private $userGroupRepository;

	/**
	 * @param array $data
	 * @param int|NULL $id
	 * @return Entity
	 */
	public function update(array $data, int $id = NULL) : Entity
	{
		$this->userGroupRepository = $this->entityManager->getUserGroupRepository();
		if ($id !== NULL) {
			$group = $this->getData($id);
		} else {
			$group = new UserGroup();
		}

		$group->setName($data['name']);
		$group->setDescription($data['description']);
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
		$this->userGroupRepository = $this->entityManager->getUserGroupRepository();
		return $this->userGroupRepository->getById($id);
	}

	public function getPairs() : array
	{
		$this->userGroupRepository = $this->entityManager->getUserGroupRepository();
		return $this->userGroupRepository->findPairs('name');
	}
}