<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Request
 * @ORM\Entity
 * @ORM\Table(name="tms_request")
 */
class Request
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
     * @ORM\Column(type="string", name="reference_number", nullable=false)
     */
    protected $referenceNumber;

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
     * @var \Currency
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="declared_value_currency_id",referencedColumnName="id",nullable=true)
     */
    protected $declaredValueCurrency;

    /**
     * @var float
     * @ORM\Column(type="decimal",name="declared_value", precision=30, scale=2, nullable=true)
     */
    protected $declaredValue;

    /**
     * @ORM\OneToMany(targetEntity="RequestWaypoint",mappedBy="request",cascade={"persist"},orphanRemoval=true)
     */
    protected $requestWaypoints;

    /**
     * @ORM\OneToMany(targetEntity="RequestVehicle",mappedBy="request",cascade={"persist"},orphanRemoval=true)
     */
    protected $requestVehicles;

    /**
     * @ORM\OneToMany(targetEntity="Package",mappedBy="request",cascade={"persist"},orphanRemoval=true)
     */
    protected $packages;

    /**
     * @ORM\OneToMany(targetEntity="Offer",mappedBy="request",cascade={"persist"},orphanRemoval=true)
     */
    protected $offers;

    public function __construct()
    {
        $this->requestWaypoints = new ArrayCollection();
        $this->requestVehicles = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->packages = new ArrayCollection();
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
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param string $referenceNumber
     * @return Request
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * @param mixed $offers
     * @return Request
     */
    public function setOffers($offers)
    {
        $this->offers = $offers;
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
     * @return Request
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
     * @return Request
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
     * @return Request
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
     * @return Request
     */
    public function setRecipientEntityAddress($recipientEntityAddress)
    {
        $this->recipientEntityAddress = $recipientEntityAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeclaredValueCurrency()
    {
        return $this->declaredValueCurrency;
    }

    /**
     * @param mixed $declaredValueCurrency
     * @return Request
     */
    public function setDeclaredValueCurrency($declaredValueCurrency)
    {
        $this->declaredValueCurrency = $declaredValueCurrency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeclaredValue()
    {
        return $this->declaredValue;
    }

    /**
     * @param mixed $declaredValue
     * @return Request
     */
    public function setDeclaredValue($declaredValue)
    {
        $this->declaredValue = $declaredValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestWaypoints()
    {
        return $this->requestWaypoints;
    }

    /**
     * @param mixed $requestWaypoints
     * @return Request
     */
    public function setRequestWaypoints($requestWaypoints)
    {
        $this->requestWaypoints = $requestWaypoints;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestVehicles()
    {
        return $this->requestVehicles;
    }

    /**
     * @param mixed $requestVehicles
     * @return Request
     */
    public function setVehicles($requestVehicles)
    {
        $this->requestVehicles = $requestVehicles;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * @param mixed $packages
     * @return Request
     */
    public function setPackages($packages)
    {
        $this->packages = $packages;
        return $this;
    }

    /**
     * @param RequestWaypoint $requestWaypoint
     * @return $this
     */
    public function addRequestWaypoint(RequestWaypoint $requestWaypoint) {
        if( $this->requestWaypoints->contains($requestWaypoint) === false) {
            $this->requestWaypoints->add($requestWaypoint);
            $requestWaypoint->setRequest($this);
        }
        return $this;
    }

    /**
     * @param RequestWaypoint $requestWaypoint
     * @return $this
     */
    public function removeRequestWaypoint(RequestWaypoint $requestWaypoint) {
        if( $this->requestWaypoints->contains($requestWaypoint) ) {
            $this->requestWaypoints->remove($requestWaypoint);
            $requestWaypoint->setRequest(null);
        }
        return $this;
    }

    /**
     * @param RequestVehicle $requestVehicle
     * @return $this
     */
    public function addRequestVehicle(RequestVehicle $requestVehicle) {
        if( $this->requestVehicles->contains($requestVehicle) === false) {
            $this->requestVehicles->add($requestVehicle);
            $requestVehicle->setRequest($this);
        }
        return $this;
    }

    /**
     * @param RequestVehicle $requestVehicle
     * @return $this
     */
    public function removeRequestVehicle(RequestVehicle $requestVehicle) {
        if( $this->requestVehicles->contains($requestVehicle) ) {
            $this->requestVehicles->remove($requestVehicle);
            $requestVehicle->setRequest(null);
        }
        return $this;
    }

    /**
     * @param Package $package
     * @return $this
     */
    public function addPackage(Package $package) {
        if( $this->packages->contains($package) === false) {
            $this->packages->add($package);
            $package->setRequest($this);
        }
        return $this;
    }

    /**
     * @param Package $package
     * @return $this
     */
    public function removePackage(Package $package) {
        if( $this->packages->contains($package) ) {
            $this->packages->remove($package);
            $package->setRequest(null);
        }
        return $this;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function addOffer(Offer $offer) {
        if( $this->offers->contains($offer) === false) {
            $this->offers->add($offer);
            $offer->setRequest($this);
        }
        return $this;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function removeOffer(Offer $offer) {
        if( $this->offers->contains($offer) ) {
            $this->offers->remove($offer);
            $offer->setRequest(null);
        }
        return $this;
    }
}