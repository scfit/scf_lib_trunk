<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 24.11.17
 * Time: 15:53
 */

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Part
 * @ORM\Entity
 * @ORM\Table(name="tms_part",uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_tms_part_part_number",columns={"tms_request_id","part_number"})
 * })
 */
class Part
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
     * @ORM\ManyToOne(targetEntity="Request")
     * @ORM\JoinColumn(name="tms_request_id",referencedColumnName="id")
     */
    protected $request;

    /**
     * @var Package
     * @ORM\ManyToOne(targetEntity="Package")
     * @ORM\JoinColumn(name="tms_package_id",referencedColumnName="id")
     */
    protected $package;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="quantity", nullable=false)
     */
    protected $quantity;

    /**
     * @var string
     * @ORM\Column(type="string", name="part_number", nullable=false)
     */
    protected $partNumber;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="part_length", nullable=true)
     */
    protected $length;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="part_width", nullable=true)
     */
    protected $width;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="part_height", nullable=true)
     */
    protected $height;

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
     * @return Part
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param Package $package
     * @return Part
     */
    public function setPackage($package)
    {
        $this->package = $package;
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
     * @return Part
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartNumber()
    {
        return $this->partNumber;
    }

    /**
     * @param string $partNumber
     * @return Part
     */
    public function setPartNumber($partNumber)
    {
        $this->partNumber = $partNumber;
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
     * @return Part
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
     * @return Part
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
     * @return Part
     */
    public function setHeight($height)
    {
        $this->height = $height;
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
     * @return Part
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
     * @return Part
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
     * @return Part
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
     * @return Part
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
     * @return Part
     */
    public function setMaxTemperature($maxTemperature)
    {
        $this->maxTemperature = $maxTemperature;
        return $this;
    }
}