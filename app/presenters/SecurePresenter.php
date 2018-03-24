<?php


namespace App\Presenters;


use App\Model\Database\Entity\User;
use App\Model\UserModel;


class SecurePresenter extends BasePresenter
{
	public function startup()
	{
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->redirect('Login:Login', ['backlink' => $this->storeRequest()]);
		}
	}
}