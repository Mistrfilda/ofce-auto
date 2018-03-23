<?php


namespace App\Model\Database\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Nette\Security\Passwords;
use Nettrine\ORM\Entity\Attributes\Id;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\RightRepository")
 */
class Right extends Entity
{
	use Id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 * @var string
	 */
	private $description;

	/**
	 * @var Role[]|Collection
	 * @ORM\ManyToMany(targetEntity="Role", inversedBy="rights")
	 * @JoinTable(name="roles_rights")
	 */
	private $roles;


	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}


	/**
	 * @param string $name
	 */
	public function setName(string $name)
	{
		$this->name = $name;
	}


	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}


	/**
	 * @param string $description
	 */
	public function setDescription(string $description)
	{
		$this->description = $description;
	}


	/**
	 * @return Role[]|Collection
	 */
	public function getRoles()
	{
		return $this->roles;
	}


	/**
	 * @param Role $role
	 */
	public function setRoles(Role $role)
	{
		$this->roles->add($role);
	}
}