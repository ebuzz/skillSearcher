<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTeam
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserTeam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="userTeamId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $userTeamId;

    /** === FOREIGN KEYS === **/

    /** 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usersTeam") 
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId") 
     */
    protected $user;

    /** 
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="team") 
     * @ORM\JoinColumn(name="teamId", referencedColumnName="teamId") 
     */
    protected $team;


    /**
     * Get userTeamId
     *
     * @return integer
     */
    public function getUserTeamId()
    {
        return $this->userTeamId;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserTeam
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set team
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return UserTeam
     */
    public function setTeam(\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
