<?php declare(strict_types  = 1);

namespace App\Model\Database\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Nettrine\ORM\Entity\Attributes\Id;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\UserRepository")
 */
class User extends Entity
{
	use Id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=64)
	 * @var string
	 */
	private $password;


	/**
	 * @var UserGroup[]|Collection
	 * @ORM\ManyToMany(targetEntity="UserGroup", inversedBy="users")
	 * @JoinTable(name="users_groups")
	 */
	private $userGroups;

	public function __construct()
	{
		$this->userGroups = new ArrayCollection();
	}


	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}


	/**
	 * @param string $email
	 */
	public function setEmail(string $email)
	{
		$this->email = $email;
	}


	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}


	/**
	 * @param string $password
	 */
	public function setPassword(string $password)
	{
		$this->password = $password;
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
	 * @return UserGroup[]|Collection
	 */
	public function getUserGroups()
	{
		return $this->userGroups;
	}


	/**
	 * @param UserGroup $userGroup
	 */
	public function setUserGroup(UserGroup $userGroup)
	{
		$this->userGroups->add($userGroup);
	}
}