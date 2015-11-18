<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Vote
{
    /**
     * @var integer
     *
     * @ORM\Column(name="voteId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $voteId;

    /** === FOREIGN KEYS === **/

    /**
     * @ORM\ManyToOne(targetEntity="UserSkill", inversedBy="vote")
     * @ORM\JoinColumn(name="userSkillId", referencedColumnName="userSkillId")
     */
    private $userkill;

    /**
    * @ORM\ManyToOne(targetEntity="User")
    * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
    */
    private $user;


    /**
     * Get voteId
     *
     * @return integer
     */
    public function getVoteId()
    {
        return $this->voteId;
    }

    /**
     * Set userkill
     *
     * @param \AppBundle\Entity\UserSkill $userkill
     *
     * @return Vote
     */
    public function setUserSkill(\AppBundle\Entity\UserSkill $userkill = null)
    {
        $this->userkill = $userkill;

        return $this;
    }

    /**
     * Get userkill
     *
     * @return \AppBundle\Entity\UserSkill
     */
    public function getUserSkill()
    {
        return $this->userkill;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Vote
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
     * Set userkill
     *
     * @param \AppBundle\Entity\UserSkill $userkill
     *
     * @return Vote
     */
    public function setUserkill(\AppBundle\Entity\UserSkill $userkill = null)
    {
        $this->userkill = $userkill;

        return $this;
    }

    /**
     * Get userkill
     *
     * @return \AppBundle\Entity\UserSkill
     */
    public function getUserkill()
    {
        return $this->userkill;
    }
}
