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
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @var \Currency
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="exchange_currency_id",referencedColumnName="id",nullable=true)
     */
    protected $exchangeCurrency;

    /**
     * @var float
     * @ORM\Column(type="decimal",name="exchange_rate", precision=30, scale=6, nullable=true)
     */
    protected $exchangeRate;

    /**
     * @var \DateTime
     * @ORM\Column(type="date",name="exchange_rate_date", nullable=true)
     */
    protected $exchangeRateDate;

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

    /**
     * @return \Currency
     */
    public function getExchangeCurrency()
    {
        return $this->exchangeCurrency;
    }

    /**
     * @param \Currency $exchangeCurrency
     * @return OfferCost
     */
    public function setExchangeCurrency($exchangeCurrency)
    {
        $this->exchangeCurrency = $exchangeCurrency;
        return $this;
    }

    /**
     * @return float
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @param float $exchangeRate
     * @return OfferCost
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExchangeRateDate()
    {
        return $this->exchangeRateDate;
    }

    /**
     * @param \DateTime $exchangeRateDate
     * @return OfferCost
     */
    public function setExchangeRateDate($exchangeRateDate)
    {
        $this->exchangeRateDate = $exchangeRateDate;
        return $this;
    }
}