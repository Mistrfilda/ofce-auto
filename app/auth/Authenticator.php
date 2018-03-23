<?php


namespace App\Auth;


use App\Lib\AppException;
use App\Lib\ErrorCodes;
use App\Model\UserModel;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\Security\Passwords;


class Authenticator implements IAuthenticator
{
	private $userModel;

	public function __construct(UserModel $userModel)
	{
		$this->userModel = $userModel;
	}


	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		try {
			$user = $this->userModel->getByLogin($username);
		} catch (AppException $e) {
			if ($e->getCode() === ErrorCodes::UNKNOWN_ENTITY) {
				throw new AppException(ErrorCodes::UNKNOWN_LOGIN);
			}
			throw $e;
		}

		if (!Passwords::verify($password, $user->getPassword())) {
			throw new AppException(ErrorCodes::UNKNOWN_LOGIN);
		}

		return new Identity($user->getId());
	}
}