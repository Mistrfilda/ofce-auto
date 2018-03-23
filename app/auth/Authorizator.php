<?php


namespace App\Auth;


use App\Model\RoleModel;
use Nette\Security\IAuthorizator;


class Authorizator implements IAuthorizator
{
	private $roleModel;

	public function __construct(RoleModel $roleModel)
	{
		$this->roleModel = $roleModel;
	}

	public function isAllowed($role, $resource, $privilege)
	{
	}
}