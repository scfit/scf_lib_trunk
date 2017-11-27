<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class RequestWaypoint
 * @ORM\Entity
 * @ORM\Table(name="tms_request_waypoint",uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idx_tms_request_waypoint_shipment_position",columns={"tms_request_id","waypoint_position"})},
 *     indexes={
 *     @ORM\Index(name="idx_tms_request_waypoint_start_timestamp", columns={"start_timestamp"}),
 *     @ORM\Index(name="idx_tms_request_waypoint_end_timestamp", columns={"end_timestamp"}),
 *     @ORM\Index(name="idx_tms_request_waypoint_position", columns={"waypoint_position"})
 *     })
 */
class RequestWaypoint
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var Request
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="requestWaypoints")
     * @ORM\JoinColumn(name="tms_request_id",referencedColumnName="id")
     */
    protected $request;

    /**
     * @var WaypointAddress
     * @ORM\ManyToOne(targetEntity="WaypointAddress")
     * @ORM\JoinColumn(name="tms_waypoint_request_id",referencedColumnName="id")
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
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return RequestWaypoint
     */
    public function setRequest($request)
    {
        $this->request = $request;
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
     * @return RequestWaypoint
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
     * @return RequestWaypoint
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
     * @return RequestWaypoint
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
     * @return RequestWaypoint
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
     * @return RequestWaypoint
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
     * @return RequestWaypoint
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }
}