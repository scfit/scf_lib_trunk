<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ShipmentWaypoint
 * @ORM\Entity
 * @ORM\Table(name="tms_shipment_waypoint",uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idx_tms_shipment_waypoint_shipment_position",columns={"tms_shipment_id","waypoint_position"})},
 *     indexes={
 *     @ORM\Index(name="idx_tms_shipment_waypoint_start_timestamp", columns={"start_timestamp"}),
 *     @ORM\Index(name="idx_tms_shipment_waypoint_end_timestamp", columns={"end_timestamp"}),
 *     @ORM\Index(name="idx_tms_shipment_waypoint_position", columns={"waypoint_position"})
 *     })
 */
class ShipmentWaypoint
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var Shipment
     * @ORM\ManyToOne(targetEntity="Shipment", inversedBy="shipmentWaypoints")
     * @ORM\JoinColumn(name="tms_shipment_id",referencedColumnName="id")
     */
    protected $shipment;

    /**
     * @var WaypointAddress
     * @ORM\ManyToOne(targetEntity="WaypointAddress")
     * @ORM\JoinColumn(name="tms_waypoint_shipment_id",referencedColumnName="id")
     */
    protected $waypointAddress;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="waypoint_position", nullable=false)
     */
    protected $position;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="start_timestamp", nullable=false)
     */
    protected $startTimestamp;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="end_timestamp", nullable=false)
     */
    protected $endTimestamp;

    /**
     * @var string
     * @ORM\Column(type="string", name="waypoint_reference", nullable=true)
     */
    protected $reference;

    /**
     * @var string
     * @ORM\Column(type="string", name="waypoint_detail", nullable=true)
     */
    protected $detail;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * @param Shipment $shipment
     * @return ShipmentWaypoint
     */
    public function setShipment($shipment)
    {
        $this->shipment = $shipment;
        return $this;
    }

    /**
     * @return WaypointAddress
     */
    public function getWaypointAddress()
    {
        return $this->waypointAddress;
    }

    /**
     * @param WaypointAddress $address
     * @return ShipmentWaypoint
     */
    public function setWaypointAddress($address)
    {
        $this->waypointAddress = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return ShipmentWaypoint
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartTimestamp()
    {
        return $this->startTimestamp;
    }

    /**
     * @param \DateTime $startTimestamp
     * @return ShipmentWaypoint
     */
    public function setStartTimestamp($startTimestamp)
    {
        $this->startTimestamp = $startTimestamp;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndTimestamp()
    {
        return $this->endTimestamp;
    }

    /**
     * @param \DateTime $endTimestamp
     * @return ShipmentWaypoint
     */
    public function setEndTimestamp($endTimestamp)
    {
        $this->endTimestamp = $endTimestamp;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return ShipmentWaypoint
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     * @return ShipmentWaypoint
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }
}