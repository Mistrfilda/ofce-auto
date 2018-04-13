<?php declare(strict_types = 1);


namespace App\Model\Facade;


use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\Role;
use App\Model\Database\Entity\User;
use App\Model\Database\Repository\RightRepository;
use App\Model\Database\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;


class RoleModel extends BaseModel
{
	/** @var  RoleRepository */
	private $roleRepository;

	/** @var  RightRepository */
	private $rightRepository;

	protected function setRepositories()
	{
		$this->roleRepository = $this->entityManager->getRoleRepository();
		$this->rightRepository = $this->entityManager->getRightRepository();
	}

	public function update(array $data, int $id = NULL) : Entity
	{
		/** @var Role $role */
		$role = $this->mapArrayToEntity($id === NULL ? new Role() : $this->roleRepository->find($id), $data, ['createdBy' => [User::class, 'createdBy']]);

		$this->entityManager->persist($role);
		$this->entityManager->flush();

		return $role;
	}

	public function getPairs() : array
	{
		return $this->roleRepository->findPairs('name');
	}

	/**
	 * @param int $id
	 * @return Role
	 */
	public function getData(int $id) : Role
	{
		return $this->roleRepository->getById($id);
	}

	/**
	 * @param string $name
	 * @return Role
	 */
	public function getByName(string $name) : Role
	{
		return $this->roleRepository->getByKey('name', $name);
	}

	public function setRoleRights(int $id, array $rights)
	{
		/** @var Role $role */
		$role = $this->roleRepository->getById($id);

		$rightsArray = [];
		foreach ($rights as $right) {
			$rightsArray[] = $this->rightRepository->getById($right);
		}

		$role->setRights(new ArrayCollection($rightsArray));

		$this->entityManager->persist($role);
		$this->entityManager->flush();
	}

	public function getRolesRights()
	{
		$rsm = new ResultSetMapping();
		$rsm->addScalarResult('role_id', 'role');
		$rsm->addScalarResult('right_id', 'right');
		$queryBuilder = $this->entityManager->createNativeQuery('SELECT role_id, right_id from roles_rights', $rsm);
		$results = $queryBuilder->getResult();

		$rolesRights = [];
		foreach ($results as $result) {
			$rolesRights[$result['role']][] = $result['right'];
		}

		return $rolesRights;
	}

	public function getQueryBuilder() : QueryBuilder
	{
		$queryBuilder = $this->roleRepository->createQueryBuilder('r');
		return $queryBuilder;
	}
}