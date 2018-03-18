<?php declare(strict_types = 1);

namespace App\Model\Database;

use App\Model\Database\Entity\Group;
use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserGroup;
use App\Model\Database\Repository\GroupRepository;

use App\Model\Database\Repository\UserGroupRepository;
use App\Model\Database\Repository\UserRepository;


/**
 * Shortcuts for type hinting
 */
trait TRepositories
{
	/**
	 * @return UserRepository
	 */
	public function getUserRepository() : UserRepository
	{
		return $this->getRepository(User::class);
	}

	/**
	 * @return UserGroupRepository
	 */
	public function getUserGroupRepository() : UserGroupRepository
	{
		return $this->getRepository(UserGroup::class);
	}
}
