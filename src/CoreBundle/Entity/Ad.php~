<?php
namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="ad")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\AdRepository")
 */
class Ad{

	/**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="code",type="string", length=50, nullable=true)
     */
    protected $label;

    /**
     * @ORM\Column(name="description",type="string", length=25, nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(name="address",type="string", length=60, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(name="date_begin", type="datetime", nullable=true)
     */
    protected $dateBegin;

    /**
     * @ORM\Column(name="date_end", type="datetime", nullable=true)
     */
    protected $dateEnd;
    
    /**
     * @ORM\Column(name="date_publication", type="datetime", nullable=true)
     */
    protected $datePublication;

    /**
     * @ORM\Column(name="visibility", type="boolean", nullable=true)
     */
    protected $visibility;
    /**
     * @ORM\Column(name="state", type="boolean", nullable=true)
     */
    protected $state;
    

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
     * Set label
     *
     * @param string $label
     *
     * @return Ad
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Ad
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Ad
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
     * Set dateBegin
     *
     * @param \DateTime $dateBegin
     *
     * @return Ad
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return \DateTime
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Ad
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Ad
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set visibility
     *
     * @param boolean $visibility
     *
     * @return Ad
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return boolean
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set state
     *
     * @param boolean $state
     *
     * @return Ad
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return boolean
     */
    public function getState()
    {
        return $this->state;
    }
}
