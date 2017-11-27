<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 23.11.17
 * Time: 14:56
 */

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OfferCost
 * @ORM\Entity
 * @ORM\Table(name="tms_offer_cost")
 */
class OfferCost
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var Offer
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="offerCosts")
     * @ORM\JoinColumn(name="tms_offer_id",referencedColumnName="id")
     */
    protected $offer;

    /**
     * @var ChargeCode
     * @ORM\ManyToOne(targetEntity="ChargeCode")
     * @ORM\JoinColumn(name="charge_code_id",referencedColumnName="id")
     */
    protected $chargeCode;

    /**
     * @var float
     * @ORM\Column(type="decimal",name="amount", precision=30, scale=2, nullable=false)
     */
    protected $amount;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return OfferCost
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param Offer $offer
     * @return OfferCost
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
        return $this;
    }

    /**
     * @return ChargeCode
     */
    public function getChargeCode()
    {
        return $this->chargeCode;
    }

    /**
     * @param ChargeCode $chargeCode
     * @return OfferCost
     */
    public function setChargeCode($chargeCode)
    {
        $this->chargeCode = $chargeCode;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return OfferCost
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
}