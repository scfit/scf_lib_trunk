<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Country
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="country", nullable=false)
     */
    protected $country;

    /**
     * @var string
     * @ORM\Column(type="string", name="country_iso", nullable=false)
     */
    protected $countryIso;

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
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Country
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryIso()
    {
        return $this->countryIso;
    }

    /**
     * @param string $countryIso
     * @return Country
     */
    public function setCountryIso($countryIso)
    {
        $this->countryIso = $countryIso;
        return $this;
    }
}