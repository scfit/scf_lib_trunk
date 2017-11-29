<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OfferPackage
 * @ORM\Entity
 * @ORM\Table(name="tms_offer_package",indexes={
 *     @ORM\Index(name="idx_tms_offer_package_tms_package_id", columns={"tms_package_id"}),
 *     @ORM\Index(name="idx_tms_offer_package_loading_tms_offer_waypoint_id", columns={"loading_tms_offer_waypoint_id"}),
 *     @ORM\Index(name="idx_tms_offer_package_unloading_tms_offer_waypoint_id", columns={"unloading_tms_offer_waypoint_id"})
 * },uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_tms_offer_package_loading",columns={"tms_package_id","loading_tms_offer_waypoint_id"}),
 *     @ORM\UniqueConstraint(name="un_tms_offer_package_unloading",columns={"tms_package_id","unloading_tms_offer_waypoint_id"})
 * })
 */
class OfferPackage
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
     * @var OfferWaypoint﻿
     * @ORM\ManyToOne(targetEntity="OfferWaypoint")
     * @ORM\JoinColumn(name="loading_tms_offer_waypoint_id",referencedColumnName="id")
     */
    protected $loadingOfferWaypoint;

    /**
     * @var OfferWaypoint
     * @ORM\ManyToOne(targetEntity="OfferWaypoint")
     * @ORM\JoinColumn(name="unloading_tms_offer_waypoint_id",referencedColumnName="id")
     */
    protected $unloadingOfferWaypoint;

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
     * @return OfferWaypoint﻿
     */
    public function getLoadingOfferWaypoint()
    {
        return $this->loadingOfferWaypoint;
    }

    /**
     * @param OfferWaypoint﻿ $loadingOfferWaypoint
     * @return OfferPackage
     */
    public function setLoadingOfferWaypoint($loadingOfferWaypoint)
    {
        $this->loadingOfferWaypoint = $loadingOfferWaypoint;
        return $this;
    }

    /**
     * @return OfferWaypoint
     */
    public function getUnloadingOfferWaypoint()
    {
        return $this->unloadingOfferWaypoint;
    }

    /**
     * @param OfferWaypoint $unloadingOfferWaypoint
     * @return OfferPackage
     */
    public function setUnloadingOfferWaypoint($unloadingOfferWaypoint)
    {
        $this->unloadingOfferWaypoint = $unloadingOfferWaypoint;
        return $this;
    }
}