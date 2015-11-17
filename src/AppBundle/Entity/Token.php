<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Token
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Token
{
    /**
     * @var string
     *
     * @ORM\Column(name="tokenId", type="string", length=50, unique=true)
     * @ORM\Id
     *
     */
    private $tokenId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expDate", type="datetime", length=50)
     *
     */
    private $expDate;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     **/
    private $userId;

    public function __construct()
    {
        $this->userId = new \Doctrine\Common\Collections\ArrayCollection();
    }  

    /**
     * Set tokenId
     *
     * @param string $tokenId
     *
     * @return Token
     */
    public function setTokenId($tokenId)
    {
        $this->tokenId = $tokenId;

        return $this;
    }

    /**
     * Get tokenId
     *
     * @return string
     */
    public function getTokenId()
    {
        return $this->tokenId;
    }

    /**
     * Set expDate
     *
     * @param \DateTime $expDate
     *
     * @return Token
     */
    public function setExpDate($expDate)
    {
        $this->expDate = $expDate;

        return $this;
    }

    /**
     * Get expDate
     *
     * @return \DateTime
     */
    public function getExpDate()
    {
        return $this->expDate;
    }

    /**
     * Set userId
     *
     * @param \AppBundle\Entity\User $userId
     *
     * @return Token
     */
    public function setUserId(\AppBundle\Entity\User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
