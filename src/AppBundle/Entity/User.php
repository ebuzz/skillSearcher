<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $userId;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50)
     */
    private $lastName;
    /**
     * @var string
     *
     * @ORM\Column(name="surName", type="string", length=50)
     */
    private $surName;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text")
     */
    private $password;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="admissionDate", type="date")
     */
    private $admissionDate;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50)
     */
    private $image;
    
    /** === FOREIGN KEYS === **/
    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="user")
     * @ORM\JoinColumn(name="roleId", referencedColumnName="roleId")
     */
    private $roles;

    /** @ORM\OneToMany(targetEntity="UserTeam", mappedBy="user") */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity="Position")
     * @ORM\JoinColumn(name="positionId", referencedColumnName="positionId")
     **/
    private $positions;

    /**
    * @ORM\OneToMany(targetEntity="UserSkill", mappedBy="user")
    **/
    private $skills;

    /**
     * @ORM\ManyToMany(targetEntity="Account", inversedBy="user")
     * @ORM\JoinTable(name="user_account",
     *      joinColumns={@ORM\JoinColumn(name="userId", referencedColumnName="userId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="accountId", referencedColumnName="accountId")}
     * )
     */
    private $account;
}