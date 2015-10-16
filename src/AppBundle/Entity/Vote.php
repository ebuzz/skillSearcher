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
     * @ORM\ManyToOne(targetEntity="UserSkill")
     * @ORM\JoinColumn(name="userSkillId", referencedColumnName="userSkillId")
     */
    private $userkill;

    /**
    * @ORM\ManyToOne(targetEntity="User")
    * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
    */
    private $user;

}

