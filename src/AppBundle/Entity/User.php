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
     * @ORM\Column(name="image", type="string", length="50")
     */
    private $image;
    /** === FOREIGN KEYS === **/
    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="user")
     * @ORM\JoinColumn(name="roleId", referencedColumnName="roleId")
     */
    private $role;
    /**
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="user")
     * @ORM\JoinTable(name="user_team",
     *      joinColumns={@ORM\JoinColumn(name="userId", referencedColumnName="userId")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="teamId", referencedColumnName="teamId")}
     * )
     */
    private $team;
    /**
     * @ORM\ManyToOne(targetEntity="Position")
     * @ORM\JoinColumn(name="positionId", referencedColumnName="positionId")
     **/
    private $position;
}