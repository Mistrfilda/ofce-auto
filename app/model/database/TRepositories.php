<?php declare(strict_types=1);

namespace App\Model\Database;

use App\Model\Database\Entity\Group;
use App\Model\Database\Entity\Right;
use App\Model\Database\Entity\Role;
use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserGroup;
use App\Model\Database\Repository\GroupRepository;

use App\Model\Database\Repository\RightRepository;
use App\Model\Database\Repository\RoleRepository;
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
	public function getUserRepository(): UserRepository
	{
		return $this->getRepository(User::class);
	}


	/**
	 * @return UserGroupRepository
	 */
	public function getUserGroupRepository(): UserGroupRepository
	{
		return $this->getRepository(UserGroup::class);
	}


	/**
	 * @return RightRepository
	 */
	public function getRightRepository(): RightRepository
	{
		return $this->getRepository(Right::class);
	}


	/**
	 * @return RoleRepository
	 */
	public function getRoleRepository(): RoleRepository
	{
		return $this->getRepository(Role::class);
	}
}
