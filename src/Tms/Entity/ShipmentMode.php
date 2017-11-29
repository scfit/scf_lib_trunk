<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ShipmentMode
 * @ORM\Entity
 * @ORM\Table(name="tms_shipment_mode")
 */
class ShipmentMode
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
     * @ORM\Column(type="string", name="mode_name", nullable=false)
     */
    protected $modeName;

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
    public function getModeName()
    {
        return $this->modeName;
    }

    /**
     * @param string $modeName
     * @return ShipmentMode
     */
    public function setModeName($modeName)
    {
        $this->modeName = $modeName;
        return $this;
    }
}