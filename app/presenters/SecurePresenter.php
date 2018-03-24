<?php


namespace App\Presenters;


use App\Model\Database\Entity\User;
use App\Model\UserModel;


class SecurePresenter extends BasePresenter
{
	/** @var User */
	private $loggedUser;

	/** @var  UserModel */
	protected $userModel;

	public function injectUserModel(UserModel $userModel)
	{
		$this->userModel = $userModel;
	}

	public function startup()
	{
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->redirect('Login:Login', ['backlink' => $this->storeRequest()]);
		} else {
			$this->loggedUser = $this->userModel->getData($this->getUser()->getId());
		}
	}

	public function beforeRender()
	{
		parent::beforeRender();
		$this->getTemplate()->loggedUser = $this->loggedUser;
	}
}