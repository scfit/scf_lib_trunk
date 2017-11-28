<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 24.11.17
 * Time: 16:19
 */

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Shipment
 * @ORM\Entity
 * @ORM\Table(name="tms_shipment")
 */
class Shipment
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at", nullable=false)
     */
    protected $createdAt;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="created_by_person_id", nullable=false)
     */
    protected $createdByPersonId;

    /**
     * @var string
     * @ORM\Column(type="string", name="shipment_number", nullable=false)
     */
    protected $shipmentNumber;

    /**
     * @var EntityAddress
     * @ORM\ManyToOne(targetEntity="EntityAddress")
     * @ORM\JoinColumn(name="manager_entity_address_id",referencedColumnName="id")
     */
    protected $managerEntityAddress;

    /**
     * @var EntityAddress
     * @ORM\ManyToOne(targetEntity="EntityAddress")
     * @ORM\JoinColumn(name="operator_entity_address_id",referencedColumnName="id")
     */
    protected $operatorEntityAddress;

    /**
     * @var ShipmentType
     * @ORM\ManyToOne(targetEntity="ShipmentType")
     * @ORM\JoinColumn(name="tms_shipment_type_id",referencedColumnName="id")
     */
    protected $shipmentType;

    /**
     * @var ShipmentMode
     * @ORM\ManyToOne(targetEntity="ShipmentMode")
     * @ORM\JoinColumn(name="tms_shipment_mode_id",referencedColumnName="id")
     */
    protected $shipmentMode;

    /**
     * @ORM\OneToMany(targetEntity="Transport",mappedBy="shipment",cascade={"persist"},orphanRemoval=true)
     */
    protected $transports;

    /**
     * @ORM\OneToMany(targetEntity="ShipmentWaypoint",mappedBy="shipment",cascade={"persist"},orphanRemoval=true)
     */
    protected $shipmentWaypoints;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->transports = new ArrayCollection();
        $this->shipmentWaypoints = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Shipment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedByPersonId()
    {
        return $this->createdByPersonId;
    }

    /**
     * @param int $createdByPersonId
     * @return Shipment
     */
    public function setCreatedByPersonId($createdByPersonId)
    {
        $this->createdByPersonId = $createdByPersonId;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentNumber()
    {
        return $this->shipmentNumber;
    }

    /**
     * @param string $shipmentNumber
     * @return Shipment
     */
    public function setShipmentNumber($shipmentNumber)
    {
        $this->shipmentNumber = $shipmentNumber;
        return $this;
    }

    /**
     * @return EntityAddress
     */
    public function getManagerEntityAddress()
    {
        return $this->managerEntityAddress;
    }

    /**
     * @param EntityAddress $managerEntityAddress
     * @return Shipment
     */
    public function setManagerEntityAddress($managerEntityAddress)
    {
        $this->managerEntityAddress = $managerEntityAddress;
        return $this;
    }

    /**
     * @return EntityAddress
     */
    public function getOperatorEntityAddress()
    {
        return $this->operatorEntityAddress;
    }

    /**
     * @param EntityAddress $operatorEntityAddress
     * @return Shipment
     */
    public function setOperatorEntityAddress($operatorEntityAddress)
    {
        $this->operatorEntityAddress = $operatorEntityAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipmentType()
    {
        return $this->shipmentType;
    }

    /**
     * @param mixed $shipmentType
     * @return Shipment
     */
    public function setShipmentType($shipmentType)
    {
        $this->shipmentType = $shipmentType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipmentMode()
    {
        return $this->shipmentMode;
    }

    /**
     * @param mixed $shipmentMode
     * @return Shipment
     */
    public function setShipmentMode($shipmentMode)
    {
        $this->shipmentMode = $shipmentMode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransports()
    {
        return $this->transports;
    }

    /**
     * @param mixed $transports
     * @return Shipment
     */
    public function setTransports($transports)
    {
        $this->transports = $transports;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipmentWaypoints()
    {
        return $this->shipmentWaypoints;
    }

    /**
     * @param mixed $shipmentWaypoints
     * @return Shipment
     */
    public function setShipmentWaypoints($shipmentWaypoints)
    {
        $this->shipmentWaypoints = $shipmentWaypoints;
        return $this;
    }

    /**
     * @param Transport $transport
     * @return $this
     */
    public function addTransport(Transport $transport) {
        if( $this->transports->contains($transport) === false) {
            $this->transports->add($transport);
            $transport->setShipment($this);
        }
        return $this;
    }

    /**
     * @param Transport $transport
     * @return $this
     */
    public function removeTransport(Transport $transport) {
        if( $this->transports->contains($transport) ) {
            $this->transports->remove($transport);
            $transport->setShipment(null);
        }
        return $this;
    }

    /**
     * @param ShipmentWaypoint $shipmentWaypoint
     * @return $this
     */
    public function addShipmentWaypoint(Transport $shipmentWaypoint) {
        if( $this->shipmentWaypoints->contains($shipmentWaypoint) === false) {
            $this->shipmentWaypoints->add($shipmentWaypoint);
            $shipmentWaypoint->setShipment($this);
        }
        return $this;
    }

    /**
     * @param ShipmentWaypoint $shipmentWaypoint
     * @return $this
     */
    public function removeShipmentWaypoint(Transport $shipmentWaypoint) {
        if( $this->shipmentWaypoints->contains($shipmentWaypoint) ) {
            $this->shipmentWaypoints->remove($shipmentWaypoint);
            $shipmentWaypoint->setShipment(null);
        }
        return $this;
    }
}