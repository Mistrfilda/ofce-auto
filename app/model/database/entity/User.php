<?php declare(strict_types  = 1);

namespace App\Model\Database\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Nette\Security\Passwords;
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
	private $username;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $email;

	/**
	 * @ORM\Column(type="boolean")
	 * @var int
	 */
	private $emailValid;

	/**
	 * @ORM\Column(type="string", length=64)
	 * @var string
	 */
	private $password;

	/**
	 * @ORM\Column(type="datetime")
	 * @var DateTimeType
	 */
	private $registered;


	/**
	 * @var UserGroup[]|Collection
	 * @ORM\ManyToMany(targetEntity="UserGroup", inversedBy="users")
	 * @JoinTable(name="users_groups")
	 */
	private $userGroups;


	/**
	 * @var Role
	 * @ORM\ManyToOne(targetEntity="Role", inversedBy="users")
	 * @JoinColumn(name="role_id", referencedColumnName="id")
	 */
	private $role;

	public function __construct()
	{
		$this->userGroups = new ArrayCollection();
		$this->registered = new \DateTime();
		$this->emailValid = 0;
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
		$this->password = Passwords::hash($password);
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
	public function getUserGroups() : Collection
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


	/**
	 * @return DateTimeType
	 */
	public function getRegistered(): DateTimeType
	{
		return $this->registered;
	}


	/**
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * @param string $username
	 */
	public function setUsername(string $username)
	{
		$this->username = $username;
	}

	/**
	 * @return Role
	 */
	public function getRole() : Role
	{
		return $this->role;
	}


	/**
	 * @param Role $role
	 */
	public function setRole(Role $role)
	{
		$this->role = $role;
	}

	/**
	 * @return int
	 */
	public function getEmailValid(): int
	{
		return $this->emailValid;
	}

	/**
	 * @param int $emailValid
	 */
	public function setEmailValid(int $emailValid)
	{
		$this->emailValid = $emailValid;
	}
}