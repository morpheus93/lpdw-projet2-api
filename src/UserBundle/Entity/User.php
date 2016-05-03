<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User{

	/**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name",type="string", length=25, nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(name="lastname",type="string", length=25, nullable=true)
     */
    protected $lastname;

    /**
     * @Gedmo\Slug(fields={"name", "lastname"}, updatable=false)
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(name="description",type="string", length=25, nullable=true)
     */
    protected $birth_date;

    /**
    * @ORM\ManyToOne(targetEntity="Account")
    * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
    */
    private $account;


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
     * Set slug
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set birthDate
     *
     * @param string $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birth_date = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * Set account
     *
     * @param \UserBundle\Entity\Account $account
     *
     * @return User
     */
    public function setAccount(\UserBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \UserBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
