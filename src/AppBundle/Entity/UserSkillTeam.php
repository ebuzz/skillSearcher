<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSkillTeam
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserSkillTeam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="userSkillTeamId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $userSkillTeamId;
    
    /** === FOREIGN KEYS === **/

    /**
     * @ORM\ManyToOne(targetEntity="UserSkill")
     * @ORM\JoinColumn(name="userSkillId", referencedColumnName="userSkillId")
     */
    private $userskill;

    /**
     * @ORM\ManyToOne(targetEntity="UserTeam")
     * @ORM\JoinColumn(name="userTeamId", referencedColumnName="userTeamId")
     */
    private $userteam;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

