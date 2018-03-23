<?php


namespace App\Model\Database\Entity;

use Nettrine\ORM\Entity\Attributes\Id;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\RegistrationTokenRepository")
 * @Table(name="registration_token", uniqueConstraints={@UniqueConstraint(name="token", columns={"token"})})
 */
class RegistrationToken extends Entity
{
	use Id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $token;

	/**
	 * @ORM\Column(type="datetime")
	 * @var \DateTime
	 */
	private $valid;


	/**
	 * @var User
	 * @ORM\OneToOne(targetEntity="User")
	 * @JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $user;

	public function __construct()
	{
		$this->valid = new \DateTime(date('Y-m-d H:i:s', strtotime('+ 7 days')));
	}

	/**
	 * @return string
	 */
	public function getToken(): string
	{
		return $this->token;
	}


	/**
	 * @param string $token
	 */
	public function setToken(string $token)
	{
		$this->token = $token;
	}


	/**
	 * @return \DateTime
	 */
	public function getValid(): \DateTime
	{
		return $this->valid;
	}

	/**
	 * @param $user User
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}

	/**
	 * @return User
	 */
	public function getUser() : User
	{
		return $this->user;
	}
}