<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 24.11.17
 * Time: 15:36
 */

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Entity
 * @ORM\Entity
 * @ORM\Table(name="entities")
 */
class Entity
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
     * @ORM\Column(type="string", name="entity_lgl_name", nullable=false)
     */
    protected $entityLglName;

    /**
     * @var string
     * @ORM\Column(type="string", name="vat_number", nullable=false)
     */
    protected $vatNumber;

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
    public function getEntityLglName()
    {
        return $this->entityLglName;
    }

    /**
     * @param string $entityLglName
     * @return Entity
     */
    public function setEntityLglName($entityLglName)
    {
        $this->entityLglName = $entityLglName;
        return $this;
    }

    /**
     * @return string
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     * @param string $vatNumber
     * @return Entity
     */
    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;
        return $this;
    }


}