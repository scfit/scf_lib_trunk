<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 24.11.17
 * Time: 15:36
 */

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EntityAddress
 * @ORM\Entity
 * @ORM\Table(name="entity_addresses")
 */
class EntityAddress
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
     * @ORM\Column(type="string", name="city", nullable=false)
     */
    protected $city;

    /**
     * @var string
     * @ORM\Column(type="string", name="postcode", nullable=true)
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
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id",referencedColumnName="id")
     */
    protected $country;

    /**
     * @var Entity
     * @ORM\ManyToOne(targetEntity="Entity")
     * @ORM\JoinColumn(name="entities_id",referencedColumnName="id")
     */
    protected $entity;

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
     * @return EntityAddress
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
     * @return EntityAddress
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
     * @return EntityAddress
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
     * @return EntityAddress
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;
        return $this;
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
     * @return EntityAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param Entity $entity
     * @return EntityAddress
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
        return $this;
    }
}