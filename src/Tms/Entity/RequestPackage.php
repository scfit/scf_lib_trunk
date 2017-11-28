<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class RequestPackage
 * @ORM\Entity
 * @ORM\Table(name="tms_request_package",indexes={
 *     @ORM\Index(name="idx_tms_request_package_tms_package_id", columns={"tms_package_id"}),
 *     @ORM\Index(name="idx_tms_request_package_loading_tms_request_waypoint_id", columns={"loading_tms_request_waypoint_id"}),
 *     @ORM\Index(name="idx_tms_request_package_unloading_tms_request_waypoint_id", columns={"unloading_tms_request_waypoint_id"})
 * },uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_tms_request_package_loading",columns={"tms_package_id","loading_tms_request_waypoint_id"}),
 *     @ORM\UniqueConstraint(name="un_tms_request_package_unloading",columns={"tms_package_id","unloading_tms_request_waypoint_id"})
 * })
 */
class RequestPackage
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
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="requestVehicles")
     * @ORM\JoinColumn(name="tms_request_id",referencedColumnName="id")
     */
    protected $request;

    /**
     * @var RequestWaypoint﻿
     * @ORM\ManyToOne(targetEntity="RequestWaypoint")
     * @ORM\JoinColumn(name="loading_tms_request_waypoint_id",referencedColumnName="id")
     */
    protected $loadingRequestWaypoint;

    /**
     * @var RequestWaypoint
     * @ORM\ManyToOne(targetEntity="RequestWaypoint")
     * @ORM\JoinColumn(name="unloading_tms_request_waypoint_id",referencedColumnName="id")
     */
    protected $unloadingRequestWaypoint;

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
     * @return RequestWaypoint﻿
     */
    public function getLoadingRequestWaypoint()
    {
        return $this->loadingRequestWaypoint;
    }

    /**
     * @param RequestWaypoint﻿ $loadingRequestWaypoint
     * @return RequestPackage
     */
    public function setLoadingRequestWaypoint($loadingRequestWaypoint)
    {
        $this->loadingRequestWaypoint = $loadingRequestWaypoint;
        return $this;
    }

    /**
     * @return RequestWaypoint
     */
    public function getUnloadingRequestWaypoint()
    {
        return $this->unloadingRequestWaypoint;
    }

    /**
     * @param RequestWaypoint $unloadingRequestWaypoint
     * @return RequestPackage
     */
    public function setUnloadingRequestWaypoint($unloadingRequestWaypoint)
    {
        $this->unloadingRequestWaypoint = $unloadingRequestWaypoint;
        return $this;
    }
}