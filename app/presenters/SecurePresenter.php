<?php


namespace App\Presenters;


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