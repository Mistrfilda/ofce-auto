<?php


namespace App\Presenters;


use App\Components\Forms\Rights\RightsFormFactory;
use App\Lib\Rights;


class SystemPresenter extends SecurePresenter
{
	private $rightsFormFactory;

	public function __construct(RightsFormFactory $rightsFormFactory)
	{
		$this->rightsFormFactory = $rightsFormFactory;
	}


	public function renderRights()
	{
//		if ($this->getUser()->isAllowed(Rights::SYSTEM)) {
//			dump('bbb');
//			die();
//		}
	}

	public function createComponentRightsForm()
	{
		return $this->rightsFormFactory->create();
	}
}