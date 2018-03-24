<?php


namespace App\Components\Other\Menu;


interface MenuControlFactory
{
	/** @return MenuControl */
	public function create();
}