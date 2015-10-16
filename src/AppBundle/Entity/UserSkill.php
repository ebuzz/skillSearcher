<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UserSkill
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserSkill
{

    /**
     * @var integer
     *
     * @ORM\Column(name="userSkillId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $userSkillId;

    /** === FOREIGN KEYS === **/
    
    /**
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="userskill")
     * @ORM\JoinColumn(name="skillId", referencedColumnName="skillId")
     **/
    private $skill;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userskill")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private $user;  

    /**
     * Get userSkillId
     *
     * @return integer
     */
    public function getUserSkillId()
    {
        return $this->userSkillId;
    }

    /**
     * Set skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return UserSkill
     */
    public function setSkill(\AppBundle\Entity\Skill $skill = null)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserSkill
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
}
