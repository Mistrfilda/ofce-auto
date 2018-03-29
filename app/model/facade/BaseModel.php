<?php declare(strict_types = 1);


namespace App\Model\Facade;


use App\Components\Forms\FormFactory;
use App\Model\Database\Entity\Entity;
use App\Model\Database\Entity\UserGroup;
use App\Model\Database\EntityManager;
use Nette\SmartObject;


abstract class BaseModel
{
	use SmartObject;

	/** @var EntityManager */
	protected $entityManager;


	public function injectEntityManager(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
		$this->setRepositories();
	}

	protected abstract function setRepositories();

	/**
	 * @param Entity $entity
	 * @param array $values
	 * @param array $foreignKeys
	 * @return Entity
	 */
	public function mapArrayToEntity(Entity $entity, array $values, array $foreignKeys = []) : Entity
	{
		foreach ($values as $key => $value) {
			if (array_key_exists($key, $foreignKeys)) {
				$method = 'set' . $foreignKeys[$key][1];
				if (is_array($value)) {
					$entities = [];
					foreach ($value as $id) {
						$entities[] = $this->getReferencedEntity($foreignKeys[$key][0], $id);
					}
					$entity->$method($entities);
				} else {
					$entity->$method($this->getReferencedEntity($foreignKeys[$key][0], $value));
				}

				continue;
			}

			$method = 'set' . $key;
			$entity->$method($value);
		}

		return $entity;
	}


	/**
	 * @param string $name
	 * @param int $id
	 * @return mixed|Entity
	 */
	protected function getReferencedEntity(string $name, int $id) : Entity
	{
		return $this->entityManager->find($name, $id);
	}
}