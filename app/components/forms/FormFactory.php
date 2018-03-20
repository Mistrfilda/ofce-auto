<?php


namespace App\Components\Forms;


use Tomaj\Form\Renderer\BootstrapRenderer;


class FormFactory
{
	/**
	 * @return AppForm
	 */
	public function create() : AppForm
	{
		$form = new AppForm();
		$form->setRenderer(new BootstrapRenderer());
		return $form;
	}
}