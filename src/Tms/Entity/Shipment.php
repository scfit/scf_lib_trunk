<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 24.11.17
 * Time: 16:19
 */

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Shipment
 * @ORM\Entity
 * @ORM\Table(name="tms_shipment")
 */
class Shipment
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at", nullable=false)
     */
    protected $createdAt;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="created_by_person_id", nullable=false)
     */
    protected $createdByPersonId;

    /**
     * @var string
     * @ORM\Column(type="string", name="shipment_number", nullable=false)
     */
    protected $shipmentNumber;

    /**
     * @var EntityAddress
     * @ORM\ManyToOne(targetEntity="EntityAddress")
     * @ORM\JoinColumn(name="manager_entity_address_id",referencedColumnName="id")
     */
    protected $managerEntityAddress;

    /**
     * @var EntityAddress
     * @ORM\ManyToOne(targetEntity="EntityAddress")
     * @ORM\JoinColumn(name="operator_entity_address_id",referencedColumnName="id")
     */
    protected $operatorEntityAddress;

    /**
     * @ORM\OneToMany(targetEntity="Transport",mappedBy="shipment",cascade={"persist"},orphanRemoval=true)
     */
    protected $transports;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->transports = new ArrayCollection();
    }

    /**
     * @param Transport $transport
     * @return $this
     */
    public function addTransport(Transport $transport) {
        if( $this->transports->contains($transport) === false) {
            $this->transports->add($transport);
            $transport->setShipment($this);
        }
        return $this;
    }

    /**
     * @param Transport $transport
     * @return $this
     */
    public function removeTransport(Transport $transport) {
        if( $this->transports->contains($transport) ) {
            $this->transports->remove($transport);
            $transport->setShipment(null);
        }
        return $this;
    }
}