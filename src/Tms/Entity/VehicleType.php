<?php

namespace Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class VehicleType
 * @ORM\Entity
 * @ORM\Table(name="vehicle_types")
 */
class VehicleType
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