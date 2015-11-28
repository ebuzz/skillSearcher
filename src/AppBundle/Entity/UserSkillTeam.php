<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSkillTeam
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserSkillTeamRepository")
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
     * @ORM\JoinColumn(name="userSkillId", referencedColumnName="userSkillId", onDelete="CASCADE")
     */
    private $userskill;

    /**
     * @ORM\ManyToOne(targetEntity="UserTeam")
     * @ORM\JoinColumn(name="userTeamId", referencedColumnName="userTeamId", onDelete="CASCADE")
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

    /**
     * Get userSkillTeamId
     *
     * @return integer
     */
    public function getUserSkillTeamId()
    {
        return $this->userSkillTeamId;
    }

    /**
     * Set userskill
     *
     * @param \AppBundle\Entity\UserSkill $userskill
     *
     * @return UserSkillTeam
     */
    public function setUserSkill(\AppBundle\Entity\UserSkill $userskill = null)
    {
        $this->userskill = $userskill;

        return $this;
    }

    /**
     * Get userskill
     *
     * @return \AppBundle\Entity\UserSkill
     */
    public function getUserSkill()
    {
        return $this->userskill;
    }

    /**
     * Set userteam
     *
     * @param \AppBundle\Entity\UserTeam $userteam
     *
     * @return UserSkillTeam
     */
    public function setUserTeam(\AppBundle\Entity\UserTeam $userteam = null)
    {
        $this->userteam = $userteam;

        return $this;
    }

    /**
     * Get userteam
     *
     * @return \AppBundle\Entity\UserTeam
     */
    public function getUserTeam()
    {
        return $this->userteam;
    }
}
