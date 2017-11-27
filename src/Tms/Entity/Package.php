<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Package
 * @ORM\Entity
 * @ORM\Table(name="tms_package",indexes={
 *     @ORM\Index(name="idx_tms_package_tms_request_id", columns={"tms_request_id"}),
 *     @ORM\Index(name="idx_tms_package_packaging_type_id", columns={"packaging_type_id"}),
 *     @ORM\Index(name="idx_loading_tms_request_waypoint_id", columns={"loading_tms_request_waypoint_id"}),
 *     @ORM\Index(name="idx_unloading_tms_request_waypoint_id", columns={"unloading_tms_request_waypoint_id"})
 *     })
 */
class Package
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
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="packages")
     * @ORM\JoinColumn(name="tms_request_id",referencedColumnName="id")
     */
    protected $request;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="quantity", nullable=false)
     */
    protected $quantity;

    /**
     * @var decimal
     * @ORM\Column(type="decimal",name="gross_weight", precision=30, scale=2, nullable=false)
     */
    protected $grossWeight;

    /**
     * @var decimal
     * @ORM\Column(type="decimal",name="net_weight", precision=30, scale=2, nullable=true)
     */
    protected $netWeight;

    /**
     * @var decimal
     * @ORM\Column(type="decimal",name="tare_weight", precision=30, scale=2, nullable=true)
     */
    protected $tareWeight;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="package_length", nullable=true)
     */
    protected $length;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="package_width", nullable=true)
     */
    protected $width;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="package_height", nullable=true)
     */
    protected $height;

    /**
     * @var decimal
     * @ORM\Column(type="decimal",name="volume", precision=30, scale=2, nullable=true)
     */
    protected $volume;

    /**
     * @var decimal
     * @ORM\Column(type="decimal",name="loading_meter", precision=30, scale=2, nullable=true)
     */
    protected $loadingMeter;

    /**
     * @var boolean
     * @ORM\Column(type="boolean",name="empty", nullable=false)
     */
    protected $empty;

    /**
     * @var boolean
     * @ORM\Column(type="boolean",name="stackable", nullable=false)
     */
    protected $stackable;

    /**
     * @var string
     * @ORM\Column(type="string", name="un_class", nullable=true)
     */
    protected $unClass;

    /**
     * @var string
     * @ORM\Column(type="string", name="un_number", nullable=true)
     */
    protected $unNumber;

    /**
     * @var string
     * @ORM\Column(type="decimal", name="un_net_weight", precision=30, scale=2, nullable=true)
     */
    protected $unNetWeight;

    /**
     * @var string
     * @ORM\Column(type="decimal", name="min_temperature", precision=30, scale=2, nullable=true)
     */
    protected $minTemperature;

    /**
     * @var string
     * @ORM\Column(type="decimal", name="max_temperature", precision=30, scale=2, nullable=true)
     */
    protected $maxTemperature;

    /**
     * @var PackagingType
     * @ORM\ManyToOne(targetEntity="PackagingType")
     * @ORM\JoinColumn(name="packaging_type_id",referencedColumnName="id")
     */
    protected $packagingType;

    /**
     * @var RequestWaypoint
     * @ORM\ManyToOne(targetEntity="RequestWaypoint")
     * @ORM\JoinColumn(name="loading_tms_request_waypoint_id",referencedColumnName="id")
     */
    protected $loadingWaypoint;

    /**
     * @var RequestWaypoint
     * @ORM\ManyToOne(targetEntity="RequestWaypoint")
     * @ORM\JoinColumn(name="unloading_tms_request_waypoint_id",referencedColumnName="id")
     */
    protected $unloadingWaypoint;

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
     * @return Package
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
     * @return Package
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return decimal
     */
    public function getGrossWeight()
    {
        return $this->grossWeight;
    }

    /**
     * @param decimal $grossWeight
     * @return Package
     */
    public function setGrossWeight($grossWeight)
    {
        $this->grossWeight = $grossWeight;
        return $this;
    }

    /**
     * @return decimal
     */
    public function getNetWeight()
    {
        return $this->netWeight;
    }

    /**
     * @param decimal $netWeight
     * @return Package
     */
    public function setNetWeight($netWeight)
    {
        $this->netWeight = $netWeight;
        return $this;
    }

    /**
     * @return decimal
     */
    public function getTareWeight()
    {
        return $this->tareWeight;
    }

    /**
     * @param decimal $tareWeight
     * @return Package
     */
    public function setTareWeight($tareWeight)
    {
        $this->tareWeight = $tareWeight;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return Package
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Package
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Package
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return decimal
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param decimal $volume
     * @return Package
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
        return $this;
    }

    /**
     * @return decimal
     */
    public function getLoadingMeter()
    {
        return $this->loadingMeter;
    }

    /**
     * @param decimal $loadingMeter
     * @return Package
     */
    public function setLoadingMeter($loadingMeter)
    {
        $this->loadingMeter = $loadingMeter;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->empty;
    }

    /**
     * @param bool $empty
     * @return Package
     */
    public function setEmpty($empty)
    {
        $this->empty = $empty;
        return $this;
    }

    /**
     * @return bool
     */
    public function isStackable()
    {
        return $this->stackable;
    }

    /**
     * @param bool $stackable
     * @return Package
     */
    public function setStackable($stackable)
    {
        $this->stackable = $stackable;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnClass()
    {
        return $this->unClass;
    }

    /**
     * @param string $unClass
     * @return Package
     */
    public function setUnClass($unClass)
    {
        $this->unClass = $unClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnNumber()
    {
        return $this->unNumber;
    }

    /**
     * @param string $unNumber
     * @return Package
     */
    public function setUnNumber($unNumber)
    {
        $this->unNumber = $unNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnNetWeight()
    {
        return $this->unNetWeight;
    }

    /**
     * @param string $unNetWeight
     * @return Package
     */
    public function setUnNetWeight($unNetWeight)
    {
        $this->unNetWeight = $unNetWeight;
        return $this;
    }

    /**
     * @return string
     */
    public function getMinTemperature()
    {
        return $this->minTemperature;
    }

    /**
     * @param string $minTemperature
     * @return Package
     */
    public function setMinTemperature($minTemperature)
    {
        $this->minTemperature = $minTemperature;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaxTemperature()
    {
        return $this->maxTemperature;
    }

    /**
     * @param string $maxTemperature
     * @return Package
     */
    public function setMaxTemperature($maxTemperature)
    {
        $this->maxTemperature = $maxTemperature;
        return $this;
    }

    /**
     * @return PackagingType
     */
    public function getPackagingType()
    {
        return $this->packagingType;
    }

    /**
     * @param PackagingType $packagingType
     * @return Package
     */
    public function setPackagingType($packagingType)
    {
        $this->packagingType = $packagingType;
        return $this;
    }

    /**
     * @return RequestWaypoint
     */
    public function getLoadingWaypoint()
    {
        return $this->loadingWaypoint;
    }

    /**
     * @param RequestWaypoint $loadingWaypoint
     * @return Package
     */
    public function setLoadingWaypoint($loadingWaypoint)
    {
        $this->loadingWaypoint = $loadingWaypoint;
        return $this;
    }

    /**
     * @return RequestWaypoint
     */
    public function getUnloadingWaypoint()
    {
        return $this->unloadingWaypoint;
    }

    /**
     * @param RequestWaypoint $unloadingWaypoint
     * @return Package
     */
    public function setUnloadingWaypoint($unloadingWaypoint)
    {
        $this->unloadingWaypoint = $unloadingWaypoint;
        return $this;
    }
}