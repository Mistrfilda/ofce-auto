<?php


namespace App\Components\Forms\Rights;


interface RightsFormFactory
{
	/** @return RightsForm */
	public function create();
}