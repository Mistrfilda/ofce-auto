<?php


namespace App\Components\Other\Menu;


use App\Model\UserModel;
use Nette\Application\UI\Control;


class MenuControl extends Control
{
	private $userModel;

	private $userId;

	public function __construct(UserModel $userModel)
	{
		$this->userModel = $userModel;
	}

	public function setUserId(int $id)
	{
		$this->userId = $id;
	}

	public function render()
	{
		$this->getTemplate()->loggedUser = $this->userModel->getData($this->userId);
		$this->getTemplate()->setFile(str_replace('.php', '.latte', __FILE__));
		$this->getTemplate()->render();
	}
}