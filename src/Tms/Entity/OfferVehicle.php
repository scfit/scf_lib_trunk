<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OfferVehicle
 * @ORM\Entity
 * @ORM\Table(name="tms_offer_vehicle",indexes={
 *     @ORM\Index(name="idx_tms_offer_vehicle_vehicle_type_id", columns={"vehicle_type_id"}),
 * },uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_tms_offer_vehicle_vehicle_number",columns={"tms_offer_id","vehicle_number"})
 * })
 */
class OfferVehicle
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
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="offerVehicles")
     * @ORM\JoinColumn(name="tms_offer_id",referencedColumnName="id")
     */
    protected $offer;

    /**
     * @var VehicleType
     * @ORM\ManyToOne(targetEntity="VehicleType")
     * @ORM\JoinColumn(name="vehicle_type_id",referencedColumnName="id")
     */
    protected $vehicleType;

    /**
     * @var string
     * @ORM\Column(type="string", name="vehicle_number", nullable=true)
     */
    protected $vehicleNumber;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return OfferVehicle
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
     * @return OfferVehicle
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
        return $this;
    }

    /**
     * @return VehicleType
     */
    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    /**
     * @param VehicleType $vehicleType
     * @return OfferVehicle
     */
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
        return $this;
    }

    /**
     * @return string
     */
    public function getVehicleNumber()
    {
        return $this->vehicleNumber;
    }

    /**
     * @param string $vehicleNumber
     * @return OfferVehicle
     */
    public function setVehicleNumber($vehicleNumber)
    {
        $this->vehicleNumber = $vehicleNumber;
        return $this;
    }
}