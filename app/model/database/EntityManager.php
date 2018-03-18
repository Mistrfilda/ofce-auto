<?php declare(strict_types = 1);

namespace App\Model\Database;

use Nettrine\ORM\EntityManager as NettrineEntityManager;


final class EntityManager extends NettrineEntityManager
{
	use TRepositories;
}