<?php declare(strict_types = 1);

namespace App\Model\Database\Repository;

use App\Lib\AppException;
use App\Lib\ErrorCodes;
use App\Model\Database\Entity\Entity;
use Doctrine\ORM\EntityRepository as DoctrineEntityRepository;

/**
 * Custom base EntityRepository
 */
abstract class EntityRepository extends DoctrineEntityRepository
{

	/**
	 * @param string $value
	 * @param string $key
	 * @return mixed[]
	 */
	public function findPairs($value, $key = 'id') : array
	{
		$select = [];
		$categories = $this->createQueryBuilder('e')
			->select('e.' . $key, 'e.' . $value)
			->getQuery()
			->getArrayResult();
		foreach ($categories as $category) {
			$select[$category[$key]] = $category[$value];
		}
		return $select;
	}

	/**
	 * @param integer $id
	 * @return mixed
	 * @throws AppException
	 */
	public function getById($id) : Entity
	{
		$entity = $this->findOneBy([
			'id' => $id,
		]);

		if ($entity === NULL) {
			throw new AppException(ErrorCodes::UNKNOWN_ENTITY);
		}

		return $entity;
	}


	/**
	 * @param $key
	 * @param $value
	 * @return mixed
	 * @throws AppException
	 */
	public function getByKey($key, $value) : Entity
	{
		$entity = $this->findOneBy([
			$key => $value
		]);

		if ($entity === NULL) {
			throw new AppException(ErrorCodes::UNKNOWN_ENTITY);
		}

		return $entity;
	}
}
