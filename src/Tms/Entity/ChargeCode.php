<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ChargeCode
 * @ORM\Entity
 * @ORM\Table(name="charge_codes")
 */
class ChargeCode
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="charge_code", nullable=false)
     */
    protected $chargeCode;

    /**
     * @var string
     * @ORM\Column(type="string", name="short_description", nullable=false)
     */
    protected $shortDescription;

    /**
     * @var string
     * @ORM\Column(type="string", name="short_name", nullable=false)
     */
    protected $shortName;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getChargeCode()
    {
        return $this->chargeCode;
    }

    /**
     * @param string $chargeCode
     * @return ChargeCode
     */
    public function setChargeCode($chargeCode)
    {
        $this->chargeCode = $chargeCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     * @return ChargeCode
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     * @return ChargeCode
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
        return $this;
    }
}