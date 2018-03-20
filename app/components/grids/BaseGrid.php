<?php


namespace App\Components\Grids;


use Nette\Application\UI\Control;


class BaseGrid extends Control
{
	protected $id;

	/** @var GridFactory */
	protected $gridFactory;

	public function injectGridFactory(GridFactory $gridFactory)
	{
		$this->gridFactory = $gridFactory;
	}

	/**
	 * @param int|null $id
	 */
	public function setId(?int $id)
	{
		$this->id = $id;
	}
}