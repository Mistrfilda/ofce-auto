<?php


namespace App\Components\Forms;


use Nette\Forms\Form;


class FormFactory
{
	/**
	 * @return AppForm
	 */
	public function create() : AppForm
	{
		$form = new AppForm();
		return $form;
	}
}