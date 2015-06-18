<?php

namespace TK\UserManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use TK\UserManagerBundle\Entity\UserAddress;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 */
class User implements UserInterface
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
     * @var string
     */
    private $salt;

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
        $this->userAddresses = new ArrayCollection();
        $this->setSalt('');
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
     * @return string The salt.
     */
    public function getSalt()
    {
        // return $this->salt;
        return null;

    }
 
    /**
     * @param string $value The salt.
     */
    public function setSalt($value)
    {
        $this->salt = $value;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt->format('Y-m-d H:i:s');
    }

    /**
     * Add userAddresses
     *
     * @param UserAddress $userAddress
     * @return userAddresses
     */
    public function addUserAddress(UserAddress $userAddress)
    {
        if ( ! $this->userAddresses->contains($userAddress)) {
            $userAddress->setUser($this);
            $this->userAddresses->add($userAddress);
        }

        return $this->userAddresses;
    }

    /**
     * Remove userAddresses
     *
     * @param UserAddress $userAddresses
     * @return userAddresses
     */
    public function removeUserAddress(UserAddress $userAddress)
    {
        if ($this->userAddresses->contains($userAddress)) {
            $this->userAddresses->removeElement($userAddress);
        }

        return $this->userAddresses;
    }


    /**
     * Set userAddresses
     *
     * @param Collection $userAddresses
     * @return $this
     */
    public function setUserAddresses(Collection $userAddresses)
    {
        $this->userAddresses = $userAddresses;

        return $this;
    }

    /**
     * Get userAddresses
     *
     * @return Collection 
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
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * 
     * @return array An array of Role objects
     */
    public function getRoles()
    {
        $role = $this->userRole->getName();
        return array($role);
    }

    /**
     * @return string The username.
     */
    public function getUsername()
    {
        return $this->email;
    }
    
    /**
     * @param string $value The username.
     */
    public function setUsername($email)
    {
        $this->email = $value;
    }

    public function eraseCredentials(){
    }

    public function equals(UserInterface $user)
    {
        return md5($this->getUsername()) == md5($user->getUsername());
    }
}
