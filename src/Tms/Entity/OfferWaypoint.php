<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OfferWaypoint
 * @ORM\Entity
 * @ORM\Table(name="tms_offer_waypoint",uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_tms_offer_waypoint",columns={"tms_offer_id","tms_request_waypoint_id"})},
 *     indexes={
 *     @ORM\Index(name="idx_tms_offer_waypoint_start_timestamp", columns={"start_timestamp"}),
 *     @ORM\Index(name="idx_tms_offer_waypoint_end_timestamp", columns={"end_timestamp"})
 *     })
 */
class OfferWaypoint
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var Offer
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="tms_offer_id",referencedColumnName="id")
     */
    protected $offer;

    /**
     * @var WaypointAddress
     * @ORM\ManyToOne(targetEntity="WaypointAddress")
     * @ORM\JoinColumn(name="tms_waypoint_request_id",referencedColumnName="id")
     */
    protected $waypointAddress;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return OfferWaypoint
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param Offer $offer
     * @return OfferWaypoint
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
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
     * @param WaypointAddress $waypointAddress
     * @return OfferWaypoint
     */
    public function setWaypointAddress($waypointAddress)
    {
        $this->waypointAddress = $waypointAddress;
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
     * @return OfferWaypoint
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
     * @return OfferWaypoint
     */
    public function setEndTimestamp($endTimestamp)
    {
        $this->endTimestamp = $endTimestamp;
        return $this;
    }
}