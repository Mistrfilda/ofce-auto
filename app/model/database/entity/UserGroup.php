<?php


namespace App\Model\Database\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Nettrine\ORM\Entity\Attributes\Id;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\UserGroupRepository")
 */
class UserGroup extends Entity
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
	 * @ORM\OneToOne(targetEntity="User")
	 * @ORM\JoinColumn(nullable=TRUE, name="creation_user_id")
	 */
	private $createdBy;

	/**
	 * @var User[]|Collection
	 * @ORM\ManyToMany(targetEntity="User", mappedBy="userGroups")
	 */
	private $users;

	public function __construct()
	{
		$this->users = new ArrayCollection();
		$this->createdBy = NULL;
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