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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->account = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set surName
     *
     * @param string $surName
     *
     * @return User
     */
    public function setSurName($surName)
    {
        $this->surName = $surName;

        return $this;
    }

    /**
     * Get surName
     *
     * @return string
     */
    public function getSurName()
    {
        return $this->surName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set admissionDate
     *
     * @param \DateTime $admissionDate
     *
     * @return User
     */
    public function setAdmissionDate($admissionDate)
    {
        $this->admissionDate = $admissionDate;

        return $this;
    }

    /**
     * Get admissionDate
     *
     * @return \DateTime
     */
    public function getAdmissionDate()
    {
        return $this->admissionDate;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set roles
     *
     * @param \AppBundle\Entity\Role $roles
     *
     * @return User
     */
    public function setRoles(\AppBundle\Entity\Role $roles = null)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return \AppBundle\Entity\Role
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add team
     *
     * @param \AppBundle\Entity\UserTeam $team
     *
     * @return User
     */
    public function addTeam(\AppBundle\Entity\UserTeam $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \AppBundle\Entity\UserTeam $team
     */
    public function removeTeam(\AppBundle\Entity\UserTeam $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set positions
     *
     * @param \AppBundle\Entity\Position $positions
     *
     * @return User
     */
    public function setPositions(\AppBundle\Entity\Position $positions = null)
    {
        $this->positions = $positions;

        return $this;
    }

    /**
     * Get positions
     *
     * @return \AppBundle\Entity\Position
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Add skill
     *
     * @param \AppBundle\Entity\UserSkill $skill
     *
     * @return User
     */
    public function addSkill(\AppBundle\Entity\UserSkill $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\UserSkill $skill
     */
    public function removeSkill(\AppBundle\Entity\UserSkill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Add account
     *
     * @param \AppBundle\Entity\Account $account
     *
     * @return User
     */
    public function addAccount(\AppBundle\Entity\Account $account)
    {
        $this->account[] = $account;

        return $this;
    }

    /**
     * Remove account
     *
     * @param \AppBundle\Entity\Account $account
     */
    public function removeAccount(\AppBundle\Entity\Account $account)
    {
        $this->account->removeElement($account);
    }

    /**
     * Get account
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccount()
    {
        return $this->account;
    }
}
