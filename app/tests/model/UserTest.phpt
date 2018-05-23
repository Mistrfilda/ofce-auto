<?php declare(strict_types = 1);

namespace App\Tests\Model;

use App\Model\Database\Entity\Role;
use App\Model\Database\Entity\User;
use App\Model\Database\Entity\UserGroup;
use App\Model\Facade\RegistrationModel;
use App\Model\Facade\RoleModel;
use App\Model\Facade\UserGroupModel;
use App\Model\Facade\UserModel;
use App\Tests\BaseTest;
use Nette\Security\Passwords;
use Tester\Assert;


$container = require __DIR__ . '/../bootstrap.php';

/**
 * Class UserTest
 * @testCase
 */
class UserTest extends BaseTest
{
	/** @var  RegistrationModel */
	private $registrationModel;

	/** @var  UserModel */
	private $userModel;

	/** @var  UserGroupModel */
	private $userGroupModel;

	/** @var  RoleModel */
	private $roleModel;

	private $roleId;

	private $userGroupId;

	public function setUp()
	{
		parent::setUp();
		$this->userModel = $this->container->getByType(UserModel::class);
		$this->registrationModel = $this->container->getByType(RegistrationModel::class);
		$this->userGroupModel = $this->container->getByType(UserGroupModel::class);
		$this->roleModel = $this->container->getByType(RoleModel::class);

		$this->roleId = $this->createRole();
		$this->userGroupId = $this->createUserGroup();
	}

	private function createRole(string $name = 'Other')
	{
		$roleData = [
			'name' => $name,
			'description' => 'Test role'
		];

		/** @var Role $role */
		$role = $this->roleModel->update($roleData);
		return $role->getId();
	}

	private function createUserGroup(string $name = 'Other')
	{
		$userGroupData = [
			'name' => $name,
			'description' => 'Test group'
		];

		/** @var UserGroup $userGroup */
		$userGroup = $this->userGroupModel->update($userGroupData);
		return $userGroup->getId();
	}


	public function testUser() : void
	{
		$userGroupId2 = $this->createUserGroup('Another users');
		$userData = [
			'name' => 'Filip',
			'username' => 'mistrfilda',
			'email' => 'filduv@testovaci.email.cz',
			'password' => '123456',
			'user_groups' => [$this->userGroupId, $userGroupId2],
			'role' => $this->roleId
		];

		/** @var User $user */
		$user = $this->userModel->update($userData);
		Assert::equal('Filip', $user->getName());
		Assert::equal('mistrfilda', $user->getUsername());
		Assert::equal('filduv@testovaci.email.cz', $user->getEmail());
		Assert::true(Passwords::verify('123456', $user->getPassword()));
		Assert::equal('Other', $user->getRole()->getName());
		foreach ($user->getUserGroups() as $userGroup) {
			Assert::true(in_array($userGroup->getName(), ['Another users', 'Other']));
			Assert::true(in_array($userGroup->getId(), [$this->userGroupId, $userGroupId2]));
		}
	}
}

(new UserTest($container))->run();