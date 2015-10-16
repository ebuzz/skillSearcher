<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Account
{
    /**
     * @var integer
     *
     * @ORM\Column(name="accountId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="leaderName", type="string", length=50)
     */
    private $leaderName;

    /**
     * @var string
     *
     * @ORM\Column(name="technologyDescription", type="string", length=140)
     */
    private $technologyDescription;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="account")
     */
    protected $users;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Account
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set leaderName
     *
     * @param string $leaderName
     *
     * @return Account
     */
    public function setLeaderName($leaderName)
    {
        $this->leaderName = $leaderName;

        return $this;
    }

    /**
     * Get leaderName
     *
     * @return string
     */
    public function getLeaderName()
    {
        return $this->leaderName;
    }

    /**
     * Set technologyDescription
     *
     * @param string $technologyDescription
     *
     * @return Account
     */
    public function setTechnologyDescription($technologyDescription)
    {
        $this->technologyDescription = $technologyDescription;

        return $this;
    }

    /**
     * Get technologyDescription
     *
     * @return string
     */
    public function getTechnologyDescription()
    {
        return $this->technologyDescription;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Account
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
