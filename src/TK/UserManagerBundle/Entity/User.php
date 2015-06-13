<?php

namespace TK\UserManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var integer
     */
    private $age;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $userAddresses;

    /**
     * @var \TK\UserManagerBundle\Entity\UserRole
     */
    private $userRole;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userAddresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
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
     * Set age
     *
     * @param integer $age
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set email
     *
     * @param string $email
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
     * Set createdAt
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add userAddresses
     *
     * @param \TK\UserManagerBundle\Entity\UserAddress $userAddresses
     * @return User
     */
    public function addUserAddress(\TK\UserManagerBundle\Entity\UserAddress $userAddresses)
    {
        $this->userAddresses[] = $userAddresses;

        return $this;
    }

    /**
     * Remove userAddresses
     *
     * @param \TK\UserManagerBundle\Entity\UserAddress $userAddresses
     */
    public function removeUserAddress(\TK\UserManagerBundle\Entity\UserAddress $userAddresses)
    {
        $this->userAddresses->removeElement($userAddresses);
    }

    /**
     * Get userAddresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserAddresses()
    {
        return $this->userAddresses;
    }

    /**
     * Set userRole
     *
     * @param \TK\UserManagerBundle\Entity\UserRole $userRole
     * @return User
     */
    public function setUserRole(\TK\UserManagerBundle\Entity\UserRole $userRole = null)
    {
        $this->userRole = $userRole;

        return $this;
    }

    /**
     * Get userRole
     *
     * @return \TK\UserManagerBundle\Entity\UserRole 
     */
    public function getUserRole()
    {
        return $this->userRole;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
    }
}
