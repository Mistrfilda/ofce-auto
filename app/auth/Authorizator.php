<?php


namespace App\Auth;


use App\Model\Database\Entity\User;
use App\Model\Facade\RoleModel;
use App\Model\Facade\UserModel;
use Nette\Security\IAuthorizator;


class Authorizator implements IAuthorizator
{
	private $roleModel;

	private $userModel;

	/** @var  User */
	private $user;

	/** @var  array */
	private $rights;

	public function __construct(RoleModel $roleModel, UserModel $userModel)
	{
		$this->roleModel = $roleModel;
		$this->userModel = $userModel;
	}

	/**
	 * Role is actually user_id
	 */
	public function isAllowed($role, $resource, $privilege)
	{
		$user =  $this->getUser($role);
		$roles = $this->getRights();

		if (in_array($resource, $roles[$user->getRole()->getId()])) {
			return TRUE;
		}

		return FALSE;
	}

	private function getUser($id)
	{
		if ($this->user === NULL || $this->user->getId() !== $id) {
			$this->user = $this->userModel->getData($id);
		}

		return $this->user;
	}

	private function getRights()
	{
		if ($this->rights === NULL) {
			$this->rights = $this->roleModel->getRolesRights();
		}

		return $this->rights;
	}
}