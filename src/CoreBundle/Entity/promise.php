<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * promise
 *
 * @ORM\Table(name="promise")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\promiseRepository")
 */
class promise
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var bool
     *
     * @ORM\Column(name="user_hidden", type="boolean")
     */
    private $userHidden;


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
     * Set amount
     *
     * @param float $amount
     *
     * @return promise
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set userHidden
     *
     * @param boolean $userHidden
     *
     * @return promise
     */
    public function setUserHidden($userHidden)
    {
        $this->userHidden = $userHidden;

        return $this;
    }

    /**
     * Get userHidden
     *
     * @return bool
     */
    public function getUserHidden()
    {
        return $this->userHidden;
    }
}

