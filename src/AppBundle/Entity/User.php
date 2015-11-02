<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="admissionDate", type="date", nullable=true)
     */
    private $admissionDate;

    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    public $image;

    /**
     * @Assert\File(maxSize="6000000",mimeTypes = {"image/jpeg", "image/jpg", "image/png"},mimeTypesMessage = "Solo se acepta jpg, jpeg, png")
     */
    private $file;

    private $temp;
    
    /** === FOREIGN KEYS === **/
    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(name="roleId", referencedColumnName="roleId")
     */
    private $rol;

    /** @ORM\OneToMany(targetEntity="UserTeam", mappedBy="user") */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity="Position", cascade={"persist"})
     * @ORM\JoinColumn(name="positionId", referencedColumnName="positionId")
     **/
    private $position;

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
    private $accounts;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->accounts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set rol
     *
     * @param \AppBundle\Entity\Role $rol
     *
     * @return User
     */
    public function setRol(\AppBundle\Entity\Role $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \AppBundle\Entity\Role
     */
    public function getRol()
    {
        return $this->rol;
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
     * Set position
     *
     * @param \AppBundle\Entity\Position $position
     *
     * @return User
     */
    public function setPosition(\AppBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \AppBundle\Entity\Position
     */
    public function getPosition()
    {
        return $this->position;
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
        $this->accounts[] = $account;

        return $this;
    }

    /**
     * Remove account
     *
     * @param \AppBundle\Entity\Account $account
     */
    public function removeAccount(\AppBundle\Entity\Account $account)
    {
        $this->accounts->removeElement($account);
    }

    /**
     * Get accounts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->image)) {
            // store the old name to delete after the update
            $this->temp = $this->image;
            $this->image = null;
        } else {
            $this->image = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->image = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }
        $this->getFile()->move($this->getUploadRootDir(), $this->image);

        if (isset($this->temp)) {
            unlink($this->getUploadRootDir().'/'.$this->temp);
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->image
            ? null
            : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebPath()
    {
        return null === $this->image
            ? null
            : $this->getUploadDir().'/'.$this->image;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/profilePhotos';
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
}
