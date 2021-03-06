<?php declare(strict_types = 1);

namespace App\Components\Forms;


use App\Model\Database\Entity\Entity;
use Doctrine\Common\Collections\Collection;
use Kdyby\Monolog\Logger;
use Nette\Application\UI\Control;
use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Security\Passwords;
use Nette\Security\User;
use Nette\Utils\Strings;


abstract class BaseForm extends Control
{
	protected $id;

	/** @var FormFactory */
	protected $formFactory;

	/** @var  User */
	protected $user;

	/** @var  Logger */
	protected $logger;

	public function injectFormFactory(FormFactory $formFactory)
	{
		$this->formFactory = $formFactory;
	}

	public function injectUser(User $user)
	{
		$this->user = $user;
	}

	public function injectMonologLogger(Logger $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * @param int|null $id
	 */
	public function setId(?int $id)
	{
		$this->id = $id;
	}


	/**
	 * @param Entity $entity
	 * @param AppForm $form
	 * @param array $skip
	 * @return AppForm
	 */
	public function setEntityToForm(Entity $entity, AppForm $form, array $skip = []) : AppForm
	{
		$defaults = [];
		foreach ($form->getControls() as $key => $control) {
			if (in_array($key, $skip)) {
				continue;
			}

			if ($control instanceof Button) {
				continue;
			}

			if ($control instanceof MultiSelectBox) {
				$ids = [];
				$methodName = 'get' . Strings::capitalize(str_replace('_', '',$key));
				/** @var Collection $collection */
				$collection = $entity->$methodName();
				if ($collection instanceof Collection) {
					foreach ($collection->getValues() as $value) {
						$ids[] = $value->getId();
					}
				}

				$defaults[$key] = $ids;
				continue;
			}

			$methodName = 'get' . Strings::capitalize($key);
			$value = $entity->$methodName();

			if ($value instanceof Entity) {
				$value = $value->getId();
			}

			$defaults[$key] = $value;
		}

		$form->setDefaults($defaults);
		return $form;
	}
}