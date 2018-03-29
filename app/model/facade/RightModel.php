<?php declare(strict_types = 1);


namespace App\Model\Facade;


use App\Lib\Rights;
use App\Model\Database\Entity\Right;
use App\Model\Database\Repository\RightRepository;


class RightModel extends BaseModel
{
	/**
	 * @var RightRepository
	 */
	private $rightRepository;

	protected function setRepositories()
	{
		$this->rightRepository = $this->entityManager->getRightRepository();
	}

	public function getPairs()
	{
		return $this->rightRepository->findPairs('name', 'id');
	}

	public function updateRights()
	{
		$pairs = $this->getPairs();
		$rights = new \ReflectionClass(Rights::class);

		foreach ($rights->getConstants() as $name => $id) {
			if (!array_key_exists($id, $pairs)) {
				$right = new Right();
				$right->setId($id);
				$right->setName($name);
				$this->entityManager->persist($right);
			}
		}

		$this->entityManager->flush();
	}
}