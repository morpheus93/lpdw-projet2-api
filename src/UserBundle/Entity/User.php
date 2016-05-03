<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
// TODO : nullable=false et verifier champ validation
class User extends BaseUser
{
    use TimestampableEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="firstname",type="string", length=25, nullable=true)
     */
    protected $firstname;

    /**
     * @ORM\Column(name="lastname",type="string", length=25, nullable=true)
     */
    protected $lastname;

    /**
     * @ORM\Column(name="age",type="integer", nullable=true )
     */
    protected $age;

    /**
     * @ORM\Column(name="admin_validation",type="boolean", nullable=true)
     */
    protected $adminValidation;

    /**
     * @ORM\Column(name="date_signin", type="datetime", nullable=true)
     */
    protected $dateSignin;

    /**
     * @ORM\Column(name="address", type="string", length=60, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(name="postalcode", type="integer", nullable=true)
     */
    protected $postalcode;

    /**
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    protected $img;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set age
     *
     * @param \int $age
     *
     * @return User
     */
    public function setAge(\int $age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return \int
     */
    public function getAge()
    {
        return $this->age;
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
     * Set validation
     *
     * @param boolean $validation
     *
     * @return User
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return boolean
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return User
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalcode
     *
     * @param \int $postalcode
     *
     * @return User
     */
    public function setPostalcode(\int $postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode
     *
     * @return \int
     */
    public function getPostalcode()
    {
        return $this->postalcode;
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
     * Set img
     *
     * @param string $img
     *
     * @return User
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set adminValidation
     *
     * @param boolean $adminValidation
     *
     * @return User
     */
    public function setAdminValidation($adminValidation)
    {
        $this->adminValidation = $adminValidation;

        return $this;
    }

    /**
     * Get adminValidation
     *
     * @return boolean
     */
    public function getAdminValidation()
    {
        return $this->adminValidation;
    }

    /**
     * Set dateSignin
     *
     * @param \DateTime $dateSignin
     *
     * @return User
     */
    public function setDateSignin($dateSignin)
    {
        $this->dateSignin = $dateSignin;

        return $this;
    }

    /**
     * Get dateSignin
     *
     * @return \DateTime
     */
    public function getDateSignin()
    {
        return $this->dateSignin;
    }
}
