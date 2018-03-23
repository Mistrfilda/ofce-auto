<?php


namespace App\Auth;


use Nette\Security\IAuthorizator;


class Authorizator implements IAuthorizator
{
	public function isAllowed($role, $resource, $privilege)
	{
		dump($role);
		die();
		//for now
		return TRUE;
	}

}