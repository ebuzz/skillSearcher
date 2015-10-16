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

}

