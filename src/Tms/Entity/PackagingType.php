<?php

namespace Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PackageType
 * @ORM\Entity
 * @ORM\Table(name="packaging_types")
 */
class PackagingType
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
     * @ORM\Column(type="string", name="packaging_type", nullable=false)
     */
    protected $packagingType;

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
    public function getPackagingTypeName()
    {
        return $this->packagingType;
    }

    /**
     * @param string $packagingType
     * @return PackagingType
     */
    public function setPackagingTypeName($packagingType)
    {
        $this->packagingType = $packagingType;
        return $this;
    }
}