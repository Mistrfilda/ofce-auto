<?php


namespace App\Presenters;


use Nette\Application\UI\Presenter;


abstract class BasePresenter extends Presenter
{
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
}