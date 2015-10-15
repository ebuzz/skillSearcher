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
}