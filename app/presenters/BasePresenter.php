<?php


namespace App\Presenters;


use App\Components\Other\Menu\MenuControlFactory;
use Nette\Application\UI\Presenter;


abstract class BasePresenter extends Presenter
{
	/** @var  MenuControlFactory */
	private $menuControlFactory;

	public function injectMenuControl(MenuControlFactory $menuControlFactory)
	{
		$this->menuControlFactory = $menuControlFactory;
	}

	public function createComponentMenuControl($name)
	{
		$control = $this->menuControlFactory->create();
		$control->setUserId($this->getUser()->getId());
		return $control;
	}


	public function startup()
	{
		parent::startup();
		$this->getTemplate()->menu = $this->getMenu();
	}


	private function getMenu()
	{
		return [
			'home' => [
				'label' => 'Home',
				'icon'  => 'user',
				'link'  => 'Homepage:Default',
			],
			'cars' => [
				'label' => 'Cars',
				'icon' => 'car',
				'link' => 'Car:default'
			],
			'calendar' => [
				'label' => 'Calendar',
				'icon' => 'calendar',
				'link' => 'Calendar:default'
			],
			'system' => [
				'label' => 'System',
				'icon' => 'database',
				'link' => 'System:default',
				'submenu' => [
					'users' => [
						'label' => 'Users',
						'icon' => 'users',
						'link' => 'System:Users'
					],
					'rights' => [
						'label' => 'Rights',
						'icon' => 'gavel',
						'link' => 'System:Rights'
					],
				],
			],
		];
	}

	public function handleLogout()
	{
		$this->getUser()->logout(TRUE);
		$this->getPresenter()->redirect('Login:Login');
	}
}