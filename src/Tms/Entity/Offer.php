<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 23.11.17
 * Time: 14:56
 */

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Offer
 * @ORM\Entity
 * @ORM\Table(name="tms_offer",uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_tms_offer_offer_number",columns={"originator_entity_address_id","offer_number"})
 * })
 */
class Offer
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
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="offers")
     * @ORM\JoinColumn(name="tms_request_id",referencedColumnName="id")
     */
    protected $request;

    /**
     * @var string
     * @ORM\Column(type="string", name="offer_number", nullable=false)
     */
    protected $offerNumber;

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
     * @var EntityAddress
     * @ORM\ManyToOne(targetEntity="EntityAddress")
     * @ORM\JoinColumn(name="originator_entity_address_id",referencedColumnName="id")
     */
    protected $originatorEntityAddress;

    /**
     * @var EntityAddress
     * @ORM\ManyToOne(targetEntity="EntityAddress")
     * @ORM\JoinColumn(name="recipient_entity_address_id",referencedColumnName="id")
     */
    protected $recipientEntityAddress;

    /**
     * @var Currency
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="currency_id",referencedColumnName="id")
     */
    protected $currency;

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
     * @ORM\OneToMany(targetEntity="OfferCost",mappedBy="offer",cascade={"persist"},orphanRemoval=true)
     */
    protected $offerCosts;

    /**
     * @ORM\OneToMany(targetEntity="OfferVehicle",mappedBy="offer",cascade={"persist"},orphanRemoval=true)
     */
    protected $offerVehicles;

    /**
     * @ORM\OneToMany(targetEntity="OfferWaypoint",mappedBy="offer",cascade={"persist"},orphanRemoval=true)
     */
    protected $offerWaypoints;

    /**
     *
     * @ORM\OneToOne(targetEntity="Order", mappedBy="offer")
     */
    protected $order;

    public function __construct()
    {
        $this->offerCosts = new ArrayCollection();
        $this->offerVehicles = new ArrayCollection();
        $this->offerWaypoints = new ArrayCollection();
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Offer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Offer
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return string
     */
    public function getOfferNumber()
    {
        return $this->offerNumber;
    }

    /**
     * @param string $offerNumber
     * @return Offer
     */
    public function setOfferNumber($offerNumber)
    {
        $this->offerNumber = $offerNumber;
        return $this;
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
     * @return Offer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedByPersonId()
    {
        return $this->createdByPersonId;
    }

    /**
     * @param mixed $createdByPersonId
     * @return Offer
     */
    public function setCreatedByPersonId($createdByPersonId)
    {
        $this->createdByPersonId = $createdByPersonId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOriginatorEntityAddress()
    {
        return $this->originatorEntityAddress;
    }

    /**
     * @param mixed $originatorEntityAddress
     * @return Offer
     */
    public function setOriginatorEntityAddress($originatorEntityAddress)
    {
        $this->originatorEntityAddress = $originatorEntityAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipientEntityAddress()
    {
        return $this->recipientEntityAddress;
    }

    /**
     * @param mixed $recipientEntityAddress
     * @return Offer
     */
    public function setRecipientEntityAddress($recipientEntityAddress)
    {
        $this->recipientEntityAddress = $recipientEntityAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return Offer
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
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
     * @return Offer
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
     * @return Offer
     */
    public function setShipmentMode($shipmentMode)
    {
        $this->shipmentMode = $shipmentMode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return Offer
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOfferCosts()
    {
        return $this->offerCosts;
    }

    /**
     * @param mixed $offerCosts
     * @return Offer
     */
    public function setOfferCosts($offerCosts)
    {
        $this->offerCosts = $offerCosts;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOfferVehicles()
    {
        return $this->offerVehicles;
    }

    /**
     * @param mixed $offerVehicles
     * @return Offer
     */
    public function setOfferVehicles($offerVehicles)
    {
        $this->offerVehicles = $offerVehicles;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOfferWaypoints()
    {
        return $this->offerWaypoints;
    }

    /**
     * @param mixed $offerWaypoints
     * @return Offer
     */
    public function setOfferWaypoints($offerWaypoints)
    {
        $this->offerWaypoints = $offerWaypoints;
        return $this;
    }



    /**
     * @param OfferCost $offerCost
     * @return $this
     */
    public function addOfferCost(OfferCost $offerCost) {
        if( $this->offerCosts->contains($offerCost) === false) {
            $this->offerCosts->add($offerCost);
            $offerCost->setOffer($this);
        }
        return $this;
    }

    /**
     * @param OfferCost $offerCost
     * @return $this
     */
    public function removeOfferCost(OfferCost $offerCost) {
        if( $this->offerCosts->contains($offerCost) ) {
            $this->offerCosts->remove($offerCost);
            $offerCost->setOffer(null);
        }
        return $this;
    }

    /**
     * @param OfferVehicle $offerVehicle
     * @return $this
     */
    public function addOfferVehicle(OfferVehicle $offerVehicle) {
        if( $this->offerVehicles->contains($offerVehicle) === false) {
            $this->offerVehicles->add($offerVehicle);
            $offerVehicle->setOffer($this);
        }
        return $this;
    }

    /**
     * @param OfferVehicle $offerVehicle
     * @return $this
     */
    public function removeOfferVehicle(OfferVehicle $offerVehicle) {
        if( $this->offerVehicles->contains($offerVehicle) ) {
            $this->offerVehicles->remove($offerVehicle);
            $offerVehicle->setOffer(null);
        }
        return $this;
    }

    /**
     * @param OfferWaypoint $offerWaypoint
     * @return $this
     */
    public function addOfferWaypoint(OfferWaypoint $offerWaypoint) {
        if( $this->offerWaypoints->contains($offerWaypoint) === false) {
            $this->offerWaypoints->add($offerWaypoint);
            $offerWaypoint->setOffer($this);
        }
        return $this;
    }

    /**
     * @param OfferWaypoint $offerWaypoint
     * @return $this
     */
    public function removeOfferWaypoint(OfferWaypoint $offerWaypoint) {
        if( $this->offerWaypoints->contains($offerWaypoint) ) {
            $this->offerWaypoints->remove($offerWaypoint);
            $offerWaypoint->setOffer(null);
        }
        return $this;
    }
}