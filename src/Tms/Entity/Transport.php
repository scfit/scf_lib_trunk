<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 24.11.17
 * Time: 16:53
 */

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Transport
 * @ORM\Entity
 * @ORM\Table(name="tms_transport")
 */
class Transport
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
     * @ORM\ManyToOne(targetEntity="Shipment", inversedBy="transports")
     * @ORM\JoinColumn(name="tms_shipment_id",referencedColumnName="id")
     */
    protected $shipment;

    /**
     * @var ShipmentWaypoint
     * @ORM\ManyToOne(targetEntity="ShipmentWaypoint")
     * @ORM\JoinColumn(name="start_tms_shipment_waypoint_id",referencedColumnName="id")
     */
    protected $startWaypoint;

    /**
     * @var ShipmentWaypoint
     * @ORM\ManyToOne(targetEntity="ShipmentWaypoint")
     * @ORM\JoinColumn(name="end_tms_shipment_waypoint_id",referencedColumnName="id")
     */
    protected $endWaypoint;

    /**
     * @var VehicleType
     * @ORM\ManyToOne(targetEntity="VehicleType")
     * @ORM\JoinColumn(name="vehicle_type_id",referencedColumnName="id")
     */
    protected $vehicleType;

    /**
     * @var string
     * @ORM\Column(type="string",name="vehicle_number",nullable=true)
     */
    protected $vehicleNumber;

    /**
     * @var Order
     * @ORM\ManyToOne(targetEntity="Order")
     * @ORM\JoinColumn(name="tms_order_id",referencedColumnName="id")
     */
    protected $order;

    /**
     * @var Request
     * @ORM\ManyToMany(targetEntity="Request")
     * @ORM\JoinTable(name="tms_transport_request",joinColumns={
     *     @ORM\JoinColumn(name="tms_transport_id",referencedColumnName="id")
     * },inverseJoinColumns={
     *     @ORM\JoinColumn(name="tms_request_id",referencedColumnName="id")
     * })
     */
    protected $requests;

    public function __construct()
    {
        $this->requests = new ArrayCollection();
    }

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
     * @return Transport
     */
    public function setShipment($shipment)
    {
        $this->shipment = $shipment;
        return $this;
    }

    /**
     * @return ShipmentWaypoint
     */
    public function getStartWaypoint()
    {
        return $this->startWaypoint;
    }

    /**
     * @param ShipmentWaypoint $startWaypoint
     * @return Transport
     */
    public function setStartWaypoint($startWaypoint)
    {
        $this->startWaypoint = $startWaypoint;
        return $this;
    }

    /**
     * @return ShipmentWaypoint
     */
    public function getEndWaypoint()
    {
        return $this->endWaypoint;
    }

    /**
     * @param ShipmentWaypoint $endWaypoint
     * @return Transport
     */
    public function setEndWaypoint($endWaypoint)
    {
        $this->endWaypoint = $endWaypoint;
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
     * @return Transport
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
     * @return Transport
     */
    public function setVehicleNumber($vehicleNumber)
    {
        $this->vehicleNumber = $vehicleNumber;
        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return Transport
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return Request
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param Request $requests
     * @return Transport
     */
    public function setRequests($requests)
    {
        $this->requests = $requests;
        return $this;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function addRequest(Request $request) {
        if( $this->requests->contains($request) === false) {
            $this->requests->add($request);
        }
        return $this;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function removeRequest(Request $request) {
        if( $this->requests->contains($request) ) {
            $this->requests->remove($request);
        }
        return $this;
    }
}