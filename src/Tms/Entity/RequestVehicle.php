<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class RequestVehicle
 * @ORM\Entity
 * @ORM\Table(name="tms_request_vehicle",indexes={
 *     @ORM\Index(name="idx_tms_request_vehicle_vehicle_type_id", columns={"vehicle_type_id"})
 * },uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_tms_request_vehicle",columns={"tms_request_id","vehicle_type_id"})
 * })
 */
class RequestVehicle
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var Request
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="requestVehicles")
     * @ORM\JoinColumn(name="tms_request_id",referencedColumnName="id")
     */
    protected $request;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="quantity", nullable=false)
     */
    protected $quantity;

    /**
     * @var VehicleType
     * @ORM\ManyToOne(targetEntity="VehicleType")
     * @ORM\JoinColumn(name="vehicle_type_id",referencedColumnName="id")
     */
    protected $vehicleType;

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
     * @return RequestVehicle
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return RequestVehicle
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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
     * @return RequestVehicle
     */
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
        return $this;
    }
}