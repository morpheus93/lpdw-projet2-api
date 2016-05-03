<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * User
 *
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\AccountRepository")
 */
// TODO : nullable=false et verifier champ validation
class Account extends BaseUser
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
     * @ORM\Column(name="address", type="string", length=60, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(name="firstname",type="string", length=25, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(name="lastname",type="string", length=25, nullable=true)
     */
    protected $country;

    /**
     * @ORM\Column(name="admin_validation",type="boolean", nullable=true)
     */
    protected $region;


    /**
     * @ORM\Column(name="postalcode", type="string", nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    protected $img;
    /**
    * @ORM\ManyToOne(targetEntity="User")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */


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
     * Set address
     *
     * @param string $address
     *
     * @return Account
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
     * Set city
     *
     * @param string $city
     *
     * @return Account
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Account
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set region
     *
     * @param boolean $region
     *
     * @return Account
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return boolean
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Account
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Account
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
}
