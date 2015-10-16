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

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=140)
     */
    private $description;


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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return UserSkill
     */
    public function setDescripcion($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->description;
    }    
}
