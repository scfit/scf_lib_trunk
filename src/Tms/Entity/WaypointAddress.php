<?php

namespace Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class WaypointAddress
 * @ORM\Entity
 * @ORM\Table(name="tms_waypoint_address",uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idx_tms_waypoint_address_address_hash",columns={"address_hash"})
 *     },indexes={
 *     @ORM\Index(name="idx_tms_waypoint_address_country_iso", columns={"country_iso"})
 *     })
 */
class WaypointAddress
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
     * @ORM\Column(type="string", name="city", nullable=false)
     */
    protected $city;

    /**
     * @var string
     * @ORM\Column(type="string", name="postocode", nullable=true)
     */
    protected $postcode;

    /**
     * @var string
     * @ORM\Column(type="string", name="street1", nullable=true)
     */
    protected $street1;

    /**
     * @var string
     * @ORM\Column(type="string", name="street2", nullable=true)
     */
    protected $street2;

    /**
     * @var string
     * @ORM\Column(type="string", name="company_name", nullable=true)
     */
    protected $companyName;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id",referencedColumnName="id")
     */
    protected $country;

    /**
     * @var string
     * @ORM\Column(type="string", name="address_hash", nullable=false, length=32)
     */
    protected $addressHash;

    /**
     * @var EntityAddress
     * @ORM\ManyToOne(targetEntity="EntityAddress")
     * @ORM\JoinColumn(name="entity_address_id",referencedColumnName="id")
     */
    protected $entityAddress;

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
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return WaypointAddress
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     * @return WaypointAddress
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet1()
    {
        return $this->street1;
    }

    /**
     * @param string $street1
     * @return WaypointAddress
     */
    public function setStreet1($street1)
    {
        $this->street1 = $street1;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * @param string $street2
     * @return WaypointAddress
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     * @return WaypointAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param string $companyName
     * @return WaypointAddress
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @param string $addressHash
     * @return WaypointAddress
     */
    public function setAddressHash($addressHash)
    {
        $this->addressHash = $addressHash;
        return $this;
    }

    /**
     * @return EntityAddress
     */
    public function getEntityAddress()
    {
        return $this->entityAddress;
    }

    /**
     * @param EntityAddress $entityAddress
     * @return WaypointAddress
     */
    public function setEntityAddress($entityAddress)
    {
        $this->entityAddress = $entityAddress;
        return $this;
    }
}