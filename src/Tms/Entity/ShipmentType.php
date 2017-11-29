<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ShipmentType
 * @ORM\Entity
 * @ORM\Table(name="tms_shipment_type")
 */
class ShipmentType
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
     * @ORM\Column(type="string", name="type_name", nullable=false)
     */
    protected $typeName;

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
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * @param string $typeName
     * @return VehicleType
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }
}