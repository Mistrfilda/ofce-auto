<?php


namespace App\Model\Database\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Nette\Security\Passwords;
use Nettrine\ORM\Entity\Attributes\Id;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\RoleRepository")
 */
class Role extends Entity
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
	 * @var Entity
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(nullable=TRUE, name="creation_user_id", unique=FALSE)
	 */
	private $createdBy;

	/**
	 * @var User[]|Collection
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="role")
	 */
	private $users;

	/**
	 * @var User[]|Collection
	 * @ORM\ManyToMany(targetEntity="Right", inversedBy="roles")
	 * @JoinTable(name="roles_rights")
	 */
	private $rights;


	public function __construct()
	{
		$this->rights = new ArrayCollection();
	}


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
	 * @return User[]|Collection
	 */
	public function getUsers()
	{
		return $this->users;
	}


	/**
	 * @param User[]|Collection $users
	 */
	public function setUsers($users)
	{
		$this->users = $users;
	}


	/**
	 * @return User[]|Collection
	 */
	public function getRights()
	{
		return $this->rights;
	}


	/**
	 * @param User[]|Collection $rights
	 */
	public function setRights($rights)
	{
		$this->rights = $rights;
	}

	/**
	 * @return null|Entity
	 */
	public function getCreatedBy(): ?Entity
	{
		return $this->createdBy;
	}


	/**
	 * @param Entity $createdBy
	 */
	public function setCreatedBy(Entity $createdBy)
	{
		$this->createdBy = $createdBy;
	}
}