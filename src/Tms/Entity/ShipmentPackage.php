<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ShipmentPackage
 * @ORM\Entity
 * @ORM\Table(name="tms_shipment_package",indexes={
 *     @ORM\Index(name="idx_tms_shipment_package_tms_package_id", columns={"tms_package_id"}),
 *     @ORM\Index(name="idx_tms_shipment_package_loading_tms_shipment_waypoint_id", columns={"loading_tms_shipment_waypoint_id"}),
 *     @ORM\Index(name="idx_tms_shipment_package_unloading_tms_shipment_waypoint_id", columns={"unloading_tms_shipment_waypoint_id"})
 * },uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_tms_shipment_package_loading",columns={"tms_package_id","loading_tms_shipment_waypoint_id"}),
 *     @ORM\UniqueConstraint(name="un_tms_shipment_package_unloading",columns={"tms_package_id","unloading_tms_shipment_waypoint_id"})
 * })
 */
class ShipmentPackage
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var Offer
     * @ORM\ManyToOne(targetEntity="Package")
     * @ORM\JoinColumn(name="tms_package_id",referencedColumnName="id")
     */
    protected $package;

    /**
     * @var ShipmentWaypoint﻿
     * @ORM\ManyToOne(targetEntity="ShipmentWaypoint")
     * @ORM\JoinColumn(name="loading_tms_shipment_waypoint_id",referencedColumnName="id")
     */
    protected $loadingShipmentWaypoint;

    /**
     * @var ShipmentWaypoint
     * @ORM\ManyToOne(targetEntity="ShipmentWaypoint")
     * @ORM\JoinColumn(name="unloading_tms_shipment_waypoint_id",referencedColumnName="id")
     */
    protected $unloadingShipmentWaypoint;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Offer
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param Offer $package
     * @return ShipmentPackage
     */
    public function setPackage($package)
    {
        $this->package = $package;
        return $this;
    }

    /**
     * @return ShipmentWaypoint﻿
     */
    public function getLoadingShipmentWaypoint()
    {
        return $this->loadingShipmentWaypoint;
    }

    /**
     * @param ShipmentWaypoint﻿ $loadingShipmentWaypoint
     * @return ShipmentPackage
     */
    public function setLoadingShipmentWaypoint($loadingShipmentWaypoint)
    {
        $this->loadingShipmentWaypoint = $loadingShipmentWaypoint;
        return $this;
    }

    /**
     * @return ShipmentWaypoint
     */
    public function getUnloadingShipmentWaypoint()
    {
        return $this->unloadingShipmentWaypoint;
    }

    /**
     * @param ShipmentWaypoint $unloadingShipmentWaypoint
     * @return ShipmentPackage
     */
    public function setUnloadingShipmentWaypoint($unloadingShipmentWaypoint)
    {
        $this->unloadingShipmentWaypoint = $unloadingShipmentWaypoint;
        return $this;
    }
}