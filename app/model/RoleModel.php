<?php


namespace App\Model;


use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\Role;
use App\Model\Database\Repository\RoleRepository;


class RoleModel extends BaseModel
{
	/** @var  RoleRepository */
	private $roleRepository;

	protected function setRepositories()
	{
		$this->roleRepository = $this->entityManager->getRoleRepository();
	}

	public function update(array $data, int $id = NULL) : Entity
	{
		/** @var Role $role */
		$role = $this->mapArrayToEntity($id === NULL ? new Role() : $this->roleRepository->find($id), $data, []);

		$this->entityManager->persist($role);
		$this->entityManager->flush();

		return $role;
	}

	public function getPairs() : array
	{
		return $this->roleRepository->findPairs('name');
	}

	/**
	 * @param string $name
	 * @return Role
	 */
	public function getByName(string $name) : Role
	{
		return $this->roleRepository->getByKey('name', $name);
	}
}